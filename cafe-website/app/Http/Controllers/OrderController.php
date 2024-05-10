<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Reservation;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $userID = $request->session()->get('user_id');
        
        // Check if user ID is defined
        if (!$userID) {
            // Redirect to the customer route with product details
            return redirect()->route('start_order');
        }

        // Retrieve orders associated with the user ID
        
        // Get all reservations for the user ID
        $reservations = Reservation::where('customer_id', $userID)->get();
        
        $orders = Order::where('customer_id', $userID)->get();


        return view('order', compact('orders','reservations'));
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'order_id' => 'required|exists:orders,id',
        ]);
        $userID = $request->session()->get('user_id');
        
        // Check if user ID is defined
        if (!$userID) {
            // Redirect to the customer route with product details
            return redirect()->route('start_order');
        }

        try {
            $order = Order::findOrFail( $request->input('order_id'));
            $reservationId = $request->input('reservation_id');
            $order->reservation_id = $reservationId;
            $order->save();

            return redirect()->back()->with('success', 'Reservation updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update reservation.');
        }
    }
    


}

