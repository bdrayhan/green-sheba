<?php

namespace App\Http\Controllers\Backend\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Partner;

class PartnerController extends Controller
{

    public function registration_index(){
        return view('partner.profile.index');
    }
    public function registration(Request $request){

        $request->validate([
            
        ]);

        $slug='P'.uniqid(11);
        $insert=Partner::insert([
            'partner_name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'date_of_birth'=>$request->date_of_birth,
            'nid'=>$request->nid_number,
            'address'=>$request->address,
            'partner_slug'=>$slug,
        ]);
        if($insert){
            Session::flash('success','Successfully! Registration Partner');
            return redirect('partner/registration');
        }else{
            Session::flash('error','Opps! failed Please try again');
            return redirect('partner/registration');
        }

    }

    public function index() 
    {
        $id=Auth::user()->id;
        $products = Product::where('user_id',$id)->orderBy('created_at', 'DESC')->get();
        return view('partner.product.index', compact('products'));
    }

    public function create()
    {
        $data['categories'] = ProductCategory::orderby('pc_name', 'ASC')->get();
        $data['tags'] = Tag::orderby('tag_name', 'ASC')->get();
        $data['brands'] = Brand::orderby('brand_name', 'ASC')->get();
        $data['sizes'] = ProductSize::orderby('size_name', 'ASC')->get();
        $data['colors'] = ProductColor::orderby('color_name', 'ASC')->get();
        $data['sizes'] = ProductSize::orderby('size_name', 'ASC')->get();
        return view('partner.product.add', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'product_name' => 'required',
            'product_url' => 'required',
            'product_code' => 'required',
            'product_short_details' => 'required',
            'product_thumbnail' => 'required|mimes:png,jpg,jpeg',
            'product_regular_price' => 'required',
            'product_quantity' => 'required',
            'product_stock_status' => 'required',
        ]);
        // Product Thumbnail Update
        if ($request->hasFile('product_thumbnail')) {
            $createFolder = public_path('/media/product/thumbnail/');
            if (!is_dir($createFolder)){
                File::makeDirectory($createFolder,0777,true);
            }
            $image = $request->file('product_thumbnail');
            $image_name = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('media/product/thumbnail/' . $image_name);
            $product_thumbnail = 'media/product/thumbnail/' . $image_name;
        }
        $product = new Product();
        $product->user_id = Auth::user()->id;
        $product->product_name = $request->product_name;
        $product->product_url = Str::slug($request->product_url,'-');
        $product->product_code = $request->product_code;
        $product->product_short_details = $request->product_short_details;
        $product->product_details = $request->product_details;
        $product->product_video_link = $request->product_video_link;
        $product->product_quantity = $request->product_quantity;
        $product->product_regular_price = $request->product_regular_price;
        $product->product_discount_price = $request->product_discount_price;
        $product->product_stock_status = $request->product_stock_status;
        $product->product_active = $request->product_active;
        $product->product_featured = $request->product_featured;
        $product->product_hotDeal = $request->product_hotDeal;
        $product->product_best_rated = $request->product_best_rated;
        $product->product_trending = $request->product_trending;
        $product->product_warranty = $request->product_warranty;
        $product->product_back_order = $request->product_back_order;
        $product->product_meta_title = $request->product_meta_title;
        $product->product_meta_keyword = $request->product_meta_keyword;
        $product->product_meta_details = $request->product_meta_details;
        $product->product_featured = $request->product_featured;
        $product->product_thumbnail = $product_thumbnail;
        $product->product_slug = uniqid('product', true);
        $product->save();
        // Attach Product Category
        if (!empty($request->category_id)) {
            $product->category()->attach($request->category_id);
        }
        // Attach Product Color
        if (!empty($request->color_id)) {
            $product->color()->attach($request->color_id);
        }
        // Attach Product Size
        if (!empty($request->size_id)) {
            $product->size()->attach($request->size_id);
        }
        // Product Gallery Image Upload
        if (!empty($request->multiImage)) {
            $createFolder = public_path('/media/product/gallery/');
            if (!is_dir($createFolder)){
                File::makeDirectory($createFolder,0777,true);
            }
            $images = $request->file('multiImage');
            foreach ($images as $image) {
                $image_name = uniqid() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->save('media/product/gallery/' . $image_name);
                $product_gallery = 'media/product/gallery/' . $image_name;
                ProductGallery::create([
                    'product_id' => $product->id,
                    'pg_image' => $product_gallery,
                    'pg_slug' => uniqid('', true),
                ]);
            }
        }
        if ($product) {
            $notification = array(
                'message' => 'Product Added!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Product Added Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }



    public function edit($slug)
    {
        $data['product'] = Product::with('color', 'size', 'tag', 'category', 'gallery')->where('product_slug', $slug)->firstOrFail();
        $data['categories'] = ProductCategory::orderby('pc_name', 'ASC')->get();
        $data['tags'] = Tag::orderby('tag_name', 'ASC')->get();
        $data['sizes'] = ProductSize::orderby('size_name', 'ASC')->get();
        $data['colors'] = ProductColor::orderby('color_name', 'ASC')->get();
        return view('partner.product.edit', $data);
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'product_name' => 'required',
            'product_url' => 'required',
            'product_code' => 'required',
            'product_short_details' => 'required',
            'category_id' => 'required',
            'product_regular_price' => 'required',
            'product_quantity' => 'required',
        ]);

        $product = Product::where('product_slug', $slug)->firstOrFail();
        // Product Image Upload
        if ($request->hasFile('product_thumbnail')) {
            if (File::exists($request->old_image)) {
                File::delete($request->old_image);
            }
            $image = $request->file('product_thumbnail');
            $image_name = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('media/product/thumbnail/' . $image_name);
            $product_thumbnail = 'media/product/thumbnail/' . $image_name;
        } else {
            $product_thumbnail = $request->old_thumbnail;
        }
        $product->product_name = $request->product_name;
        $product->product_url = Str::slug($request->product_url,'-');
        $product->product_code = $request->product_code;
        $product->product_short_details = $request->product_short_details;
        $product->product_details = $request->product_details;
        $product->product_video_link = $request->product_video_link;
        $product->product_quantity = $request->product_quantity;
        $product->product_regular_price = $request->product_regular_price;
        $product->product_discount_price = $request->product_discount_price;
        $product->product_stock_status = $request->product_stock_status;
        $product->product_active = $request->product_active;
        $product->product_featured = $request->product_featured;
        $product->product_hotDeal = $request->product_hotDeal;
        $product->product_best_rated = $request->product_best_rated;
        $product->product_trending = $request->product_trending;
        $product->product_warranty = $request->product_warranty;
        $product->product_back_order = $request->product_back_order;
        $product->product_meta_title = $request->product_meta_title;
        $product->product_meta_keyword = $request->product_meta_keyword;
        $product->product_meta_details = $request->product_meta_details;
        $product->product_featured = $request->product_featured;
        $product->product_thumbnail = $product_thumbnail;
        $product->product_slug = uniqid();
        $product->update();
        // Attach Product Category
        if (!empty($request->category_id)) {
            $product->category()->sync($request->category_id);
        }
        // Attach Product Color
        if (!empty($request->color_id)) {
            $product->color()->sync($request->color_id);
        }
        // Attach Product Size
        if (!empty($request->size_id)) {
            $product->size()->sync($request->size_id);
        }
        if (!empty($request->multiImage)) {
            $images = $request->multiImage;
            foreach ($images as $image) {
                $image_name = uniqid() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->save('media/product/gallery/' . $image_name);
                $gallery_image = 'media/product/gallery/' . $image_name;
                ProductGallery::create([
                    'product_id' => $product->id,
                    'pg_image' => $gallery_image,
                    'pg_slug' => uniqid(),
                ]);
            }
        }
        $notification = array(
            'message' => 'Product Updated!',
            'alert-type' => 'success',
        );
        return redirect()->route('backend.partner.product')->with($notification);
    }

    public function delete(Product $product, $slug)
    {
        $product = Product::where('product_slug', $slug)->firstOrFail();
        // Product Image Delete
        if (File::exists($product->product_thumbnail)) {
            File::delete($product->product_thumbnail);
        }
        // Product Gallery Image Delete
        if (!empty($product->gallery)) {
            foreach ($product->gallery as $gallery) {
                if (File::exists($gallery->pg_image)) {
                    File::delete($gallery->pg_image);
                }
                $gallery->delete();
            }
        }
        // Product Category Delete
        $product->category()->detach();
        // Product Color Delete
        $product->color()->detach();
        // Product Size Delete
        $product->size()->detach();
        // Product Delete
        $product->delete();
        $notification = array(
            'message' => 'Product Delete Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function status($slug)
    {
        $product = Product::where('product_slug', $slug)->firstOrFail();
        $product->product_active = $product->product_active = !$product->product_active;
        $product->update();
        $notification = array(
            'message' => 'Status Updated!',
            'alert-type' => 'success',
        ); // returns Notification,
        return redirect()->back()->with($notification);
    }

    public function galleryRemove($slug): RedirectResponse
    {
        $gallery = ProductGallery::where('pg_slug', $slug)->firstOrFail();
        if (File::exists($gallery->pg_image)) {
            File::delete($gallery->pg_image);
        }
        $gallery->delete();
        $notification = array(
            'message' => 'Image Removed!',
            'alert-type' => 'success',
        ); // returns Notification
        return redirect()->back()->with($notification);
    }

    public function multipleDelete(Request $request): JsonResponse
    {
        if ($request->ids) {
            foreach ($request->ids as $id) {
                $product = Product::where('id', $id)->firstOrFail();
                // Product Image Delete
                if (File::exists($product->product_thumbnail)) {
                    File::delete($product->product_thumbnail);
                }
                // // Product Gallery Image Delete
                foreach ($product->gallery as $gallery) {
                    if (File::exists($gallery->pg_image)) {
                        File::delete($gallery->pg_image);
                    }
                    $gallery->delete();
                }
                $product->category()->detach();
                $product->color()->detach();
                $product->size()->detach();
                $product->delete();
                // Product Delete
                $response['status'] = 'success';
                $response['message'] = 'Successfully Delete Product';
            }
        }
        return response()->json($response, 201);
    }
}
