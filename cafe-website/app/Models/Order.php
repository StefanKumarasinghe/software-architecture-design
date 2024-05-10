<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_id', 'total', 'special_notes', 'is_paid', 'is_completed'];

    /**
     * Define the relationship between orders and customers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Define the relationship between orders and order items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Define the relationship between orders and products (many-to-many).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    /**
     * Mark the order as paid.
     *
     * @return void
     */
    public function markAsPaid()
    {
        $this->update(['is_paid' => true]);
    }

    /**
     * Mark the order as completed.
     *
     * @return void
     */
    public function markAsCompleted()
    {
        $this->update(['is_completed' => true]);
    }

    /**
     * Check if the order is paid.
     *
     * @return bool
     */
    public function isPaid()
    {
        return $this->is_paid;
    }

    /**
     * Check if the order is completed.
     *
     * @return bool
     */
    public function isCompleted()
    {
        return $this->is_completed;
    }

    
}
