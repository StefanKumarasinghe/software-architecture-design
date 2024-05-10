<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'first_name', 'last_name', 'address','phone'];
    public static function createCustomer($email, $firstName, $lastName, $address, $phone)
    {
        return self::create([
            'email' => $email,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'address' => $address,
            'phone' => $phone
        ]);
    }
}

