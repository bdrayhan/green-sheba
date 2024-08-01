<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    public function userInfo() {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
