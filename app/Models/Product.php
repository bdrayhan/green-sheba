<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function gallery()
    {
        return $this->hasMany(ProductGallery::class, 'product_id', 'id');
    }

    public function category()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_category', 'product_id', 'category_id');
    }

    public function color()
    {
        return $this->belongsToMany(ProductColor::class, 'product_colors', 'product_id', 'color_id');
    }

    public function size()
    {
        return $this->belongsToMany(ProductSize::class, 'product_size', 'product_id', 'size_id');
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'product_tag');
    }

    public function purchase()
    {
        return $this->hasMany(ProductPurchase::class, 'product_id', 'id');
    }
}
