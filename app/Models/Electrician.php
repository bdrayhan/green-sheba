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
    public function division(){
        return $this->belongsTo('App\Models\Division','address1','id');
    }
    public function district(){
        return $this->belongsTo('App\Models\District','address1','id');
    }
    public function upazila(){
        return $this->belongsTo('App\Models\Upazila','address1','id');
    }
    
}
