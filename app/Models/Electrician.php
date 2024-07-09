<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Electrician extends Model{
    use HasFactory;

    protected $primaryKey='id';

    public function electrician(){
        return $this->belongsTo('App\Models\ElectricianCategory','electrician_category','id');
    }
}
