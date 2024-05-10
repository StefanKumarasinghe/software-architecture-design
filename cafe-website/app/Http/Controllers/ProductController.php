<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $cartItems = $request->session()->get('cart', []);
        $itemCount = count($cartItems);

        $products = Product::all();
        return view('products', compact('products','itemCount'));
    }


}
