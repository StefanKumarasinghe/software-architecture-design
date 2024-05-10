<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Support\Carbon;

class ReservationController extends Controller
{
    public function index()
    {
        // Get all reservations
        $reservations = Reservation::all();
        
        // Get all tables
        $tables = Table::all();
        
        // Filter out tables that are not available
        $availableTables = $tables->filter(function ($table) use ($reservations) {
            return $table->isAvailable(Carbon::now()); // You might need to implement isAvailableNow() method in your Table model
        });
        
        return view('reservation', compact('reservations', 'availableTables'));
    }

    public function store(Request $request)
    {


        // Retrieve the customer ID from the session
        $customerId = $request->session()->get('user_id');

        // If customer ID is not set in the session, redirect to the starting_order route
        if (!$customerId) {
            return redirect()->route('starting_order')->with('error', 'Please provide customer information to proceed.');
        }

        $tableId = $request->input('table_id');

        // If table_id is not provided, find a free table automatically
        if (!$tableId) {
            // Get all existing reservations for the given date_time
            $existingReservations = Reservation::whereDate('date_time', $request->input('date_time'))->get();

            // Get all available tables
            $availableTables = Table::all();

            // Check each available table for collisions with existing reservations
            foreach ($availableTables as $table) {
                $isAvailable = true;
                foreach ($existingReservations as $existingReservation) {
                    if ($table->id == $existingReservation->table_id) {
                        // Table is already reserved for the given date_time
                        $isAvailable = false;
                        break;
                    }
                }
                if ($isAvailable) {
                    // Found an available table, assign it and break the loop
                    $tableId = $table->id;
                    break;
                }
            }
        }

        // If no available table is found, return an error message
        if (!$tableId) {
            return redirect()->route('reservations')->with('error', 'No available tables for the given date and time.');
        }

        // Assign the table ID to the request data
        $request->merge(['table_id' => $tableId, 'customer_id' => $customerId]);

        // Create the reservation
        $reservation = Reservation::create($request->all());

        return redirect()->route('reservations')->with('success', 'Reservation created successfully.');
    }

        

    public function update(Request $request, $id)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'order_id' => 'nullable|exists:orders,id',
            'customer_id' => 'required|exists:customers,id',
            'arrival' => 'nullable|boolean',
            'party_size' => 'required|integer|min:1',
            'date_time' => 'required|date_format:Y-m-d H:i:s'
        ]);
        $reservation = Reservation::findOrFail($id);
        $reservation->fill($request->all());
        $reservation->save();
        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
    }
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->route('home')->with('success', 'Reservation deleted successfully.');
    }
    public function checkout($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->checkout();
        return redirect()->route('reservations.index')->with('success', 'Reservation checked out successfully.');
    }
}
