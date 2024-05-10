<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $userID = $request->session()->get('user_id');
        
        // Check if user ID is defined
        if (!$userID) {
            // Redirect to the customer route with product details
            return redirect()->route('customer')->with('products', $this->getCartItems($request));
        }

        // Retrieve orders associated with the user ID
        $orders = Order::where('customer_id', $userID)->with('products')->get();

        return view('order', compact('orders'));
    }


}

