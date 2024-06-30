<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuBar extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_name',
        'menu_link',
        'menu_color',
        'menu_bg_color',
        'menu_order',
        'menu_status',
    ];
}
