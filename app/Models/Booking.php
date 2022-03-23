<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * Query and return an array of Property Ids that are booked based on the start and end dates given
     * 
     * @param string $start_date
     * @param string $end_date
     * @return array
     */
    public static function getBookedPropertyIds(string $start_date, string $end_date)
    {
        return Booking::select('_fk_property')
        ->whereBetween('start_date', [$start_date, $end_date])
        ->orWhereBetween('end_date', [$start_date, $end_date])
        ->distinct()
        ->get()
        ->toArray();
    }
}
