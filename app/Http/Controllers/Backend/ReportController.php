<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Courier;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function wishListReport()
    {
        $products = Product::where('product_active', 1)->where('product_status', 1)->get();
        return view('backend.reports.wishlist_report', compact('products'));
    }

    public function categoryWisReport(Request $request)
    {
        $category_id = $request->category_id;
        $products = Product::where('product_active', 1)->where('product_status', 1)->where('category_id', $category_id)->get();
        return view('backend.reports.wishlist_report', compact('products'));
    }

    public function stockReport(Request $request)
    {
        $products = Product::where('product_active', 1)->where('product_status', 1)->get();
        return view('backend.reports.stock_report', compact('products'));
    }

    public function categoryStockReport(Request $request)
    {
        $category_id = $request->category_id;
        $products = Product::where('product_active', 1)->where('product_status', 1)->where('category_id', $category_id)->get();
        return view('backend.reports.stock_report', compact('products'));
    }

    public function courierReport()
    {
        $today = date('d-m-Y');
        $startDate = date('d-m-Y');
        $endDate = date('d-m-Y');
        $couriers = Courier::with('orders')
            ->where('courier_active', 1)
            ->where('courier_status', 1)->get();
        return view('backend.reports.courier_report', compact('couriers', 'today', 'startDate', 'endDate'));
    }

    public function courierReportDate(Request $request)
    {
        // Request Validation
        $request->validate([
            'startDate' => 'required',
            'endDate' => 'required',
            'id' => 'required',
        ]);
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $id = $request->id;
        $couriers = Courier::with('orders')
            ->where('id', $id)
            ->where('courier_active', 1)
            ->where('courier_status', 1)->get();
        return view('backend.reports.courier_report', compact('couriers', 'startDate', 'endDate'));
    }

    public function userReport()
    {
        $today = date('d-m-Y');
        $startDate = date('d-m-Y');
        $endDate = date('d-m-Y');
        $users = User::all();
        return view('backend.reports.user_report', compact('users', 'today', 'startDate', 'endDate'));
    }

    public function userReportDate(Request $request)
    {
        // Request Validation
        $request->validate([
            'startDate' => 'required',
            'endDate' => 'required',
            'user_id' => 'required',
        ]);
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $user_id = $request->user_id;
        $users = User::where('id', $user_id)->get();
        return view('backend.reports.user_report', compact('users', 'startDate', 'endDate'));
    }
}
