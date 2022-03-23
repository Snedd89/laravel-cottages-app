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
     * @param  string   $location
     * @param  mixed    $near_beach
     * @param  mixed    $accepts_pets
     * @param  int      $sleeps
     * @param  int      $beds
     * @param  array    $bookedPropertyIds
     * @return \Illuminate\Support\Collection
     */
    public static function getAvailableProperties(string $location = null, mixed $near_beach = null, mixed $accepts_pets = null, int $sleeps = 0, int $beds = 0, array $bookedPropertyIds)
    {
        $query = Property::select(
            'properties.*',
            'locations.location_name as location_name'
            )->leftJoin(
                'locations',
                'locations.__pk',
                '=',
                'properties._fk_location'
            );

        if($location) {
            $query = $query->where('location_name', 'like', "%$location%");
        }

        if($near_beach) {
            $query = $query->where('near_beach', $near_beach);
        }

        if($accepts_pets) {
            $query = $query->where('accepts_pets', $accepts_pets);
        }

        if($sleeps) {
            $query = $query->where('sleeps', '>=', $sleeps);
        }

        if($beds) {
            $query = $query->where('beds', '>=', $beds);
        }

        $query->when(!empty($bookedPropertyIds), function ($q) use($bookedPropertyIds) {
            return $q->whereNotIn('properties.__pk', $bookedPropertyIds);
        }); 

        $result = $query->paginate(2);

        return $result;
    }
}
