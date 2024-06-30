<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierStoreRequest;
use App\Http\Requests\SupplierUpdateRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::latest()->paginate(10);

        return view('backend.supplier.index', compact('suppliers'));
    }

    public function store(SupplierStoreRequest $request)
    {
        try {
            Supplier::create([
                'supplier_name' => $request->supplier_name,
                'supplier_phone' => $request->supplier_phone,
                'supplier_email' => $request->supplier_email,
                'wireHouse_address' => $request->wireHouse_address,
                'supplier_slug' => uniqid(),
            ]);
            $notification = array(
                'message' => 'Supplier Added successfully',
                'alert-type' => 'success'
            );
        } catch (\Throwable $e) {
            // return $e->getMessage();
            $notification = array(
                'message' => 'Process Failed!',
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);
    }

    public function update(SupplierUpdateRequest $request, $slug)
    {
        try {
            Supplier::where('supplier_slug', $slug)->update([
                'supplier_name' => $request->supplier_name,
                'supplier_phone' => $request->supplier_phone,
                'supplier_email' => $request->supplier_email,
                'wireHouse_address' => $request->wireHouse_address,
            ]);
            $notification = array(
                'message' => 'Supplier Updated!',
                'alert-type' => 'success'
            );
        } catch (\Throwable $e) {
            // return $e->getMessage();
            $notification = array(
                'message' => 'Process Failed!',
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);
    }

    public function destroy($slug)
    {
        try {
            Supplier::where('supplier_slug', $slug)->delete();
            $notification = array(
                'message' => 'Supplier Deleted successfully',
                'alert-type' => 'success'
            );
        } catch (\Throwable $e) {
            // return $e->getMessage();
            $notification = array(
                'message' => 'Process Failed!',
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);
    }

    public function searchFilter(Request $request)
    {
        $phone = $request->supplier_phone;
        $suppliers = Supplier::where(function ($query) use ($phone) {
            if (!empty($phone)) {
                $query->where('supplier_phone', 'like', '%' . $phone . '%');
            } else {
                $query->paginate(12);
            }
        })->paginate(12);

        return view('backend.supplier.index', compact('suppliers'));

    }
}
