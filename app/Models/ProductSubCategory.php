<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';
    protected $guarded = [];

    // Get All Product Category
    public function procategory()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }

}
