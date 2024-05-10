<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = ['name', 'capacity'];

    /**
     * Retrieve all tables.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getAllTables()
    {
        return self::all();
    }

    /**
     * Check if a table is available at a given date and time.
     *
     * @param string $dateTime
     * @return bool
     */
    public function isAvailable($dateTime)
    {
        // Implement logic to check table availability based on reservations or other factors
        // For demonstration, let's assume tables are always available
        return true;
    }

    /**
     * Check if a table can fit the given party size.
     *
     * @param int $partySize
     * @return bool
     */
    public function canFitParty($partySize)
    {
        return $this->capacity >= $partySize;
    }
}
