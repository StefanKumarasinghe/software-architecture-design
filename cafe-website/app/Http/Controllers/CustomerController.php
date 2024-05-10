<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Reservation;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('user_id')) {
            return redirect()->route('menu');
        } 
        return view('customer');
    }
    
    public function createCustomer(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:customers,email',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'string|max:255',
            'phone' => 'required|string|max:20', // Assuming phone number is a string
        ]);

        // Check if the customer already exists
        $existingCustomer = Customer::where('email', $request->email)->first();
        if ($existingCustomer) {
            // If customer already exists, you can store user-related data in the session
            $request->session()->put('user_id', $existingCustomer->id);
            $request->session()->put('email', $existingCustomer->email);
            // You can add more user-related data to the session if needed
            return redirect()->route('menu');
        }

        // If the customer does not exist, create a new customer
        $customer = Customer::create([
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        // Store user-related data in the session
        $request->session()->put('user_id', $customer->id);
        $request->session()->put('email', $customer->email);

        return redirect()->route('menu');
    }
}

