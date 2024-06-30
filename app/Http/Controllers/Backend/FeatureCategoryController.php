<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FeatureCategory;
use App\Models\ProductCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FeatureCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $featureCategories = FeatureCategory::with('category')->get();
        $categories = ProductCategory::where('pc_status', 1)->get();
        return view('backend.feature-category.index',compact('featureCategories', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer|unique:feature_categories',
            'order_by' => 'nullable|integer',
        ]);
        $insert = FeatureCategory::create([
            'category_id' => $request->category_id,
            'order_by' => $request->order_by,
        ]);
        if ($insert) {
            $notification = array(
                'message' => 'Feature Category Added!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Added Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param FeatureCategory $featureCategory
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required|integer',
            'order_by' => 'nullable|integer',
        ]);
        $update = FeatureCategory::where('id',$id)->update([
            'category_id' => $request->category_id,
            'order_by' => $request->order_by,
        ]);
        if ($update) {
            $notification = array(
                'message' => 'Feature Category Updated!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Updated Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $delete = FeatureCategory::where('id',$id)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Feature Category Deleted!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Deleted Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }
}
