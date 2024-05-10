<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class Cart
{
    
    public function index(Request $request)
    {
        // Retrieve cart items from session
        $cartItems = $request->session()->get('cart', []);

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
        $total = 0;

        foreach ($cartItems as $itemId => $quantity) {
            $product = Product::find($itemId);
            if ($product) {
                $total += $product->price * $quantity;
            }
        }

       

        // Return the cart items view with the products
        return view('cart', compact('products','total'));
    }
    public function getTotal(Request $request) {
        $cartItems = $request->session()->get('cart', []);
        $total = 0;
        foreach ($cartItems as $itemId => $quantity) {
            $product = Product::find($itemId);
            if ($product) {
                $total += $product->price * $quantity;
            }
        }
        return $total;
    }
    
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
    
        // Retrieve cart items from session
        $cartItems = $request->session()->get('cart', []);
    
        if (isset($cartItems[$productId])) {
            $cartItems[$productId] += $quantity;
        } else {
            $cartItems[$productId] = $quantity;
        }
    
        $request->session()->put('cart', $cartItems);
    
        return back()->with("success","Amazing, just added to your cart");
    }
    


    public function clearCart(Request $request)
    {
        // Clear the cart items from session
        $request->session()->forget('cart');
        return back()->with("success","Successfully cleared the cart");
    }

    public function deleteFromCart(Request $request)
    {
        // Retrieve cart items from session
        $cartItems = $request->session()->get('cart', []);
        $productId = $request->input('product');
    
        // Remove the specified product from the cart
        unset($cartItems[$productId]);
    
        // Update the cart items in session
        $request->session()->put('cart', $cartItems);
    
        return back()->with("success","Sadly, we removed it from your cart");
    }
    
}
