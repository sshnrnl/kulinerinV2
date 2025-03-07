<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableRestaurant extends Model
{
    use HasFactory;

    protected $fillable = ['restaurant_id', 'tableCapacity', 'availableTables'];

    // Tambahkan relasi ke reservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'table_restaurant_id', 'id');
    }
}
