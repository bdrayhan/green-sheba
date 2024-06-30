<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\Supplier;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function allStock()
    {
        $stocks = Product::with('purchase')->get();
        return view('backend.stock.stock', compact('stocks'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return view('backend.productPurchase.create', compact('suppliers'));
    }

    public function store(Request $request, $slug)
    {
        $product = Product::where('product_slug', $slug)->firstOrFail();
        $product->product_quantity = $request->pp_quantity + $product->product_quantity;
        $product->update();
        $purchase = ProductPurchase::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'supplier_id' => $request->supplier_id,
            'pp_date' => $request->pp_date,
            'pp_memo_no' => $request->pp_memo_no,
            'pp_slug' => uniqid('', true),
            'pp_quantity' => $request->pp_quantity,
        ]);

        if ($purchase) {
            $notification = array(
                'message' => 'Purchase Added!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Purchase Added Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->route('admin.stock.index')->with($notification);
    }

    // PURCHASE FEATURE
    public function allPurchase()
    {
        $purchases = ProductPurchase::with('product', 'supplier')->get();
        return view('backend.productPurchase.index', compact('purchases'));
    }

    public function deletePurchase($slug)
    {
        $purchase = ProductPurchase::with('product')->where('pp_slug', $slug)->firstOrFail();
        $purchase->product->product_quantity -= $purchase->pp_quantity;
        $purchase->product->update();
        $purchase->delete();

        $notification = array(
            'message' => 'Purchase Removed!',
            'alert-type' => 'success',
        ); // returns Notification,
        return redirect()->route('admin.stock.purchase')->with($notification);
    }
}
