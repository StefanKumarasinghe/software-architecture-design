<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Http\Controllers\Cart; // Make sure to import the Cart class if it's in a different namespace

class Checkout
{
    protected $cart; // Declare the property to hold the Cart object

    // Inject the Cart object through constructor
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function index(Request $request)
    {
        $cartItems = $request->session()->get('cart', []);
        $total = $this->cart->getTotal($request); // Access the getTotal() method through $this->cart
        // Retrieve products corresponding to the cart items
        $products = [];
        foreach ($cartItems as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $products[] = [
                    'product' => $product,
                    'quantity' => $quantity
                ];
            }
        }
        return view('checkout', [
            'products' => $products, // Assuming cartItems represent products
            'total' => $total
        ]);
    }
    public function processCheckout(Request $request)
    {
        $customerID = $request->session()->get('user_id');
        $specialNotes = $request->input('special_notes');
        $cartItems = $request->session()->get('cart', []);
    
        $total = $this->cart->getTotal($request);
    
        // Create a new Order instance
        $order = new Order();
        $order->customer_id = $customerID; // Set the customer ID
        $order->total = $total;
        $order->special_notes = $specialNotes;
        $order->is_paid = true;
        $order->is_completed = false;
        $order->save();
        $order_id = (string)$order->id;
        // Associate products with the order
        foreach ($cartItems as $productId => $quantity) {
            $order->products()->attach($productId, ['quantity' => $quantity]);
        }
        $this->cart->clearCart($request);
        return view('success', compact('order_id'));
    }
    

    private function sendInvoice($email, $products, $total)
    {
        // Code to send invoice via email
    }
}

