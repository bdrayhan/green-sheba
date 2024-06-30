<?php

namespace App\Http\Controllers\Backend;

use App\Exports\CategoryExport;
use App\Http\Controllers\Controller;
use App\Imports\CategoryImport;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Maatwebsite\Excel\Facades\Excel;

class ProductCategoryController extends Controller
{

    public function index()
    {
        // $categories = ProductCategory::where('pc_status', 1)->orderBy('pc_orderby', 'ASC')->get();

        $categories = ProductCategory::where('pc_status', 1)->orderBy('pc_orderby', 'ASC')->get()->map(function ($category) {
            $category->children = $category->children->map(function ($child) {
                $child->children = $child->children->map(function ($child) {
                    return $child;
                });
                return $child;
            });
            return $category;
        });

        // return $categories;
        return view('backend.product_category.index', compact('categories'));
    }

    public function insert(Request $request)
    {
        $validateData = $request->validate([
            'pc_name' => 'required|unique:categories,pc_name|max:255',
            'pc_url' => 'required|max:255',
        ]);

        $data = array();
        $data['parent_id'] = $request->parent_id;
        $data['pc_name'] = $request->pc_name;
        $data['pc_slug'] = uniqid();
        $data['pc_url'] = Str::slug($request->pc_url, '-');
        $data['pc_orderby'] = $request->pc_orderby;
        $data['pc_remarks'] = $request->pc_remarks;
        $data['pc_creator'] = Auth::user()->id;


        // Image Upload
        if ($request->hasFile('pc_image')) {
            $image = $request->file('pc_image');
            // Folder Create
            $path = public_path() . '/media/ProductCategory';
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('media/ProductCategory/' . $image_name);
            $data['pc_image'] = 'media/ProductCategory/' . $image_name;
        }
        $proCategory = ProductCategory::create($data);

        if ($proCategory) {
            $notification = array(
                'message' => 'Category Added Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Category Added Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function edit($slug)
    {
        $category = ProductCategory::where('pc_slug', $slug)->firstOrFail();
        return view('backend.product_category.edit', compact('category'));
    }

    public function update(Request $request, $slug)
    {
        $validateData = $request->validate([
            'pc_name' => 'required|unique:categories,pc_slug,' . $slug . ',pc_name'
        ]);

        $data = array();
        $data['pc_name'] = $request->pc_name;
        $data['pc_orderby'] = $request->pc_orderby;
        $data['pc_url'] = Str::slug($request->pc_url, '-');
        $data['pc_remarks'] = Auth::user()->id;
        $data['pc_creator'] = Auth::user()->id;

        // Image Upload
        if ($request->hasFile('pc_image')) {
            if (File::exists($request->old_image)) {
                File::delete($request->old_image);
            }
            $path = public_path() . '/media/ProductCategory';
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
            $image = $request->file('pc_image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('media/ProductCategory/' . $image_name);
            $data['pc_image'] = 'media/ProductCategory/' . $image_name;
        }
        $update = ProductCategory::where('pc_slug', $slug)->update($data);

        if ($update) {
            $notification = array(
                'message' => 'Category Update Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->route('admin.product.category.index')->with($notification);
        } else {
            $notification = array(
                'message' => 'Category Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function delete($slug)
    {
        // Get Single Category
        $category = ProductCategory::where('pc_slug', $slug)->firstOrFail();
        // Category Images Delete
        if (File::exists($category->pc_image)) {
            File::delete($category->pc_image);
        }
        if (count($category->products) > 0) {
            $notification = array(
                'message' => 'Category Delete Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        } else {
            $category->delete();
            $notification = array(
                'message' => 'Category Delete Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function featureStatus($slug)
    {
        $category = ProductCategory::where('pc_slug', $slug)->firstOrFail();
        if ($category->pc_feature == 1) {
            ProductCategory::where('pc_slug', $slug)->update([
                'pc_feature' => 0,
            ]);
        } else {
            ProductCategory::where('pc_slug', $slug)->update([
                'pc_feature' => 1,
            ]);
        }
        $notification = array(
            'message' => 'Category Feature Updated!',
            'alert-type' => 'success',
        ); // returns Notification,
        return redirect()->back()->with($notification);
    }

    public function status($slug)
    {
        $category = ProductCategory::where('pc_slug', $slug)->firstOrFail();
        if ($category->pc_active == 1) {
            ProductCategory::where('pc_slug', $slug)->update([
                'pc_active' => 0,
            ]);

            $notification = array(
                'message' => 'Category Status Disable!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            ProductCategory::where('pc_slug', $slug)->update([
                'pc_active' => 1,
            ]);
            $notification = array(
                'message' => 'Category Status Enable',
                'alert-type' => 'success',
            ); // returns Notification,
        }

        return redirect()->back()->with($notification);
    }

    public function mulipleDelete(Request $request)
    {
        if ($request->ids) {
            foreach ($request->ids as $id) {
                $category = ProductCategory::where('id', $id)->firstOrFail();
                if ($category->products->count() > 0) {
                    $response['status'] = 'error';
                    $response['message'] = 'Unsuccessful to Delete Category';
                } else {
                    // Category Image Delete
                    if (File::exists($category->pc_image)) {
                        File::delete($category->pc_image);
                    }
                    // Category Delete
                    ProductCategory::where('id', $category->id)->delete();
                    $response['status'] = 'success';
                    $response['message'] = 'Successfully Delete Category';
                }
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Unsuccessful to Delete Category';
        }
        return response()->json($response, 201);
    }

    public function importStore(Request $request)
    {
        try {
            Excel::import(new CategoryImport(), $request->file('category_file'));
            $notification = array(
                'message' => 'Category Import Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
        } catch (\Exception $e) {
            $notification = array(
                'message' => 'Category Import Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function export()
    {
        return Excel::download(new CategoryExport(), 'category.xlsx');
    }
}
