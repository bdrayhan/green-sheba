<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Banner;
use App\Models\BlogCategory;
use App\Models\Brand;
use App\Models\Coupon;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\Supplier;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SetupSeeder::class,
            DemoImportSeeder::class,
            DivisionSeeder::class,
            DistrictSeeder::class,
            UpazilaSeeder::class,
        ]);
        Tag::factory(10)->create();
        Coupon::factory(5)->create();
        Brand::factory(10)->create();
        Banner::factory(2)->create();
        BlogCategory::factory(10)->create();
        Post::factory(30)->create();
        ProductColor::factory(10)->create();
        ProductCategory::factory(10)->create();
        Product::factory(10)->create();
        Supplier::factory(5)->create();


        $products = Product::all();
        foreach ($products as $product) {
            $category = ProductCategory::all()->random(random_int(1, 5))->pluck('id')->toArray();
            $product-> category()->attach($category);
        }

        $products = Product::all();
        foreach ($products as $product) {
            $color = ProductColor::all()->random(random_int(1, 5))->pluck('id')->toArray();
            $product->color()->attach($color);
        }
        foreach ($products as $product) {
            $size = ProductSize::all()->random(random_int(1, 5))->pluck('id')->toArray();
            $product->size()->attach($size);
        }
    }
}
