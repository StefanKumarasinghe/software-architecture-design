<?php

use Illuminate\Support\Facades\Route;

Route::get('/root', function () {
    return view('welcome');
});


