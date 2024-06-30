<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\Brand;
use App\Models\City;
use App\Models\Courier;
use App\Models\CourierCity;
use App\Models\CourierZone;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use App\Models\ProductSubCategory;
use App\Models\User;
use Illuminate\Http\Request;

class RecycleBinController extends Controller
{
    public function all()
    {
        $data = array();
        $data['users'] = User::where('status', 0)->count();
        $data['brands'] = Brand::where('brand_status', 0)->count();
        $data['cities'] = City::where('city_status', 0)->count();
        $data['courier'] = Courier::where('courier_status', 0)->count();
        $data['courier_city'] = CourierCity::where('cc_status', 0)->count();
        $data['courier_zone'] = CourierZone::where('zone_status', 0)->count();
        $data['product_category'] = ProductCategory::where('pc_status', 0)->count();
        $data['product_subCategory'] = ProductSubCategory::where('psc_status', 0)->count();
        $data['product_color'] = ProductColor::where('color_status', 0)->count();
        $data['blog_category'] = BlogCategory::where('bc_status', 0)->count();
        $data['product'] = Product::where('product_status', 0)->count();
        return view('backend.recyclebin.all', compact('data'));
    }

    public function allCity()
    {
        $cities = City::where('city_status', 0)->get();
        return view('backend.recyclebin.all_city', compact('cities'));
    }

    public function allCourier()
    {
        $couriers = Courier::where('courier_status', 0)->get();
        return view('backend.recyclebin.all_courier', compact('couriers'));
    }

    public function allCourierCity()
    {
        $courier_city = CourierCity::with('courier', 'city')->where('cc_status', 0)->get();
        return view('backend.recyclebin.all_courier_city', compact('courier_city'));
    }

    public function allCourierZone()
    {
        $courierZone = CourierZone::with('courier', 'city')->where('zone_status', 0)->get();
        return view('backend.recyclebin.all_courier_zone', compact('courierZone'));
    }

    public function allBrand()
    {
        $brands = Brand::where('brand_status', 0)->get();
        return view('backend.recyclebin.all_brand', compact('brands'));
    }

    public function allProductCategory()
    {
        $productCategory = ProductCategory::where('pc_status', 0)->get();
        return view('backend.recyclebin.all_productCategory', compact('productCategory'));
    }

    public function allProSubCategory()
    {
        $productSubCategory = ProductSubCategory::where('psc_status', 0)->get();
        return view('backend.recyclebin.all_productSubCategory', compact('productSubCategory'));
    }

    public function allProductColor()
    {
        $productColor = ProductColor::where('color_status', 0)->get();
        return view('backend.recyclebin.all_productcolor', compact('productColor'));
    }

    public function allBlogCategory()
    {
        $blogCategory = BlogCategory::where('bc_status', 0)->get();
        return view('backend.recyclebin.all_blog_category', compact('blogCategory'));
    }

    public function allProduct()
    {
        $products = Product::where('product_status', 0)->get();
        return view('backend.recyclebin.all_product', compact('products'));
    }
}
