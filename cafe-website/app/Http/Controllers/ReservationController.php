<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Support\Carbon;

class ReservationController extends Controller
{
    public function index()
    {
        // Get the user ID from the session
        $userId = session('user_id');

        
        // Check if user ID is defined
        if (!$userId) {
            // Redirect to the customer route with product details
            return redirect()->route('start_order');
        }

        // Get all reservations for the user ID
        $reservations = Reservation::where('customer_id', $userId)->get();
        
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
        $request->validate([
            'table_id' => 'nullable|exists:tables,id',
            'party_size' => 'required|integer|min:1',
            'date_time' => 'nullable'
        ]);
    
        // Retrieve the customer ID from the session
        $customerId = $request->session()->get('user_id');
    
        // If customer ID is not set in the session, redirect to the starting_order route
        if (!$customerId) {
            return redirect()->route('starting_order')->with('error', 'Please provide customer information to proceed.');
        }

        $reservations = Reservation::where('customer_id', $customerId)->get();
        $pendingCount = 0;

        foreach ($reservations as $reservation) {
            if ($reservation->arrival == 0) {
                $pendingCount++;
            }
        }

        if ($pendingCount >= 2) {
            return redirect()->back()->with('error', 'You can only have 2 pending reservations.');
        }
    
        $tableId = $request->input('table_id');
        $request->merge(['date_time' => Carbon::now()]);
    
        // If table_id is not provided, find a free table automatically
        if (!$tableId) {
      
            $existingReservations = Reservation::whereDate('date_time', $request->input('date_time'))->pluck('table_id');
    
            // Get all available tables
            $availableTables = Table::whereNotIn('id', $existingReservations)->get();
    
            // If no available tables found, return an error message
            if ($availableTables->isEmpty()) {
                return redirect()->route('reservations')->with('error', 'No available tables for the given date and time.');
            }
    
            // Assign the first available table to the request data
            $request->merge(['table_id' => $availableTables->first()->id]);
        }
    
        // Assign the customer ID to the request data
        $request->merge(['customer_id' => $customerId]);
    
        // Create the reservation
        $reservation = Reservation::create($request->all());
    
        return redirect()->route('reservation')->with('success', 'Reservation created successfully.');
    }
    

        
    public function destroy($id)
    {
        try {
            $reservation = Reservation::findOrFail($id);
            $reservation->delete();
            return redirect()->back()->with('success', 'Reservation deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Unable to delete reservation, call 045056789.');
        }
    }


    
}
