<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

}
