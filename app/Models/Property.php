<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    /**
     * Query and return results.
     *
     * @param  string  $location
     * @param  mixed  $near_beach
     * @param  mixed  $accepts_pets
     * @param  int  $sleeps
     * @param  int  $beds
     * @return \Illuminate\Support\Collection
     */
    public static function getAvailableProperties(string $location = null, mixed $near_beach = null, mixed $accepts_pets = null, int $sleeps = 0, int $beds = 0)
    {
        $query = Property::all();

        return $query;
    }
}
