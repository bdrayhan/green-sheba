<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, int $int)
 */
class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function postcat()
    {
        return $this->hasOne(BlogCategory::class, 'bc_id', 'bc_id');
    }
    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s',
        'updated_at' => 'datetime:Y-m-d h:i:s',
    ];
}
