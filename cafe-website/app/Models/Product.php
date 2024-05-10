<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','image_url', 'description', 'price', 'quantity'];
    public static function findProductById($productId)
    {
        return self::find($productId);
    }

    public static function getAllProducts()
    {
        return self::all();
    }

    public static function isAvailable($productId, $quantityRequested)
    {
        $product = self::find($productId);
        if (!$product) {
            return false;
        }
        return $product->quantity >= $quantityRequested;
    }

    public static function incrementQuantity($productId, $quantity)
    {
        $product = self::find($productId);
        if (!$product) {
            return false;
        }

        $product->increment('quantity', $quantity);
        return true;
    }

    public static function decrementQuantity($productId, $quantity)
    {
        $product = self::find($productId);
        if (!$product) {
            return false;
        }

        $product->decrement('quantity', $quantity);
        return true;
    }
}
