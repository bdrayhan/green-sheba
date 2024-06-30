<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function citys()
    {
        return $this->hasMany(CourierCity::class, 'id');
    }

    public function zones()
    {
        return $this->hasMany(CourierZone::class, 'id');
    }

    // Get Courier All Order
    public function orders()
    {
        return $this->hasMany(Order::class, 'courier_id', 'id');
    }

}
