<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function category($id)
    {
        $category = ProductCategory::where('id', $id)->firstOrFail();
        return $category->pc_name;
    }
    public function categoryUrl($id)
    {
        $category = ProductCategory::where('id', $id)->firstOrFail();
        return $category->pc_url;
    }

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s',
        'updated_at' => 'datetime:Y-m-d h:i:s',
    ];
}
