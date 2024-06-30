<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierZone extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function courier()
    {
        return $this->belongsTo(Courier::class, 'id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'id', 'id');
    }

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s',
        'updated_at' => 'datetime:Y-m-d h:i:s',
    ];
}
