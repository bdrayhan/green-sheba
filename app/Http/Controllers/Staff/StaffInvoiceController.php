<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class StaffInvoiceController extends Controller
{
    // All Invoice Show
    public function index()
    {
        $orders = Order::with('shipping', 'courier')->where('order_status', 4)->paginate(12);
        // return $ordersInvoice;
        return view('staff.order.invoice.index', compact('orders'));
    }

    // Single Invoice Show
    public function show($slug)
    {
        $order = Order::with('shipping', 'courier', 'user', 'orderDetails')->where('order_slug', $slug)->firstOrFail();
        // return $order->orderDetails;
        if (empty($order)) {
            abort(404);
        }
        return view('staff.order.invoice.show', compact('order'));
    }

    //  Single Invoice Print  Processing
    public function print()
    {
        $pdf = Pdf::loadView('backend.order.invoiced.print');
        return $pdf->setPaper('a4')->download('invoice.pdf');
    }
}
