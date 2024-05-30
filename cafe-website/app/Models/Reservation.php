<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['table_id', 'customer_id', 'arrival', 'party_size', 'date_time'];

    /**
     * Define the relationship between reservations and tables.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    /**
     * Define the relationship between reservations and orders.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Define the relationship between reservations and customers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Add an order to the reservation.
     *
     * @param int $orderId
     * @return bool
     */
    public function addOrder($orderId)
    {
        $this->order_id = $orderId;
        return $this->save();
    }

    /**
     * Delete the order associated with the reservation.
     *
     * @return bool
     */
    public function deleteOrder()
    {
        $this->order_id = null;
        return $this->save();
    }

    /**
     * Mark the reservation as arrived.
     *
     * @return bool
     */
    public function markArrival()
    {
        $this->arrival = true;
        return $this->save();
    }

    /**
     * Perform checkout for the reservation.
     *
     * @return bool
     */
    public function checkout()
    {
        // Perform any necessary actions for checkout
        // For example, marking the order as completed
        if ($this->order) {
            $this->order->markCompleted();
        }

        // Optionally, you can delete the reservation after checkout
        return $this->delete();
    }

    /**
     * Delete the reservation.
     *
     * @return bool
     */
    public function deleteReservation()
    {
        return $this->delete();
    }
}
