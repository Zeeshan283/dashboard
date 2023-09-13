<?php

namespace App\Http\Controllers;

use App\Models\Refund;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class RefundController extends Controller
{
    public function allRefunds()
    {
        $refund_status = Refund::with('product', 'customer')->get();
        return view('refund.allrefunds', compact('refund_status'));
    }

    public function create()
    {
        $vendors = User::where('role', 'vendor')->get();
        $products = Product::whereNotNull('sku')->get();
        $customers = User::where('role', '<>', 'admin')->get();
        $orders = Order::all();

        return view('refund.createrefund', compact('vendors', 'products', 'customers', 'orders'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'vendor' => 'required',
            'product_id' => 'required',
            'customer_id' => 'required',
            'order_id' => 'required',
            'amount' => 'required|numeric',
            'reason' => 'required',
        ]);

        Refund::create($validatedData);

        Toastr::success('Refund request generated successfully', 'Success');

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:Pending,Approved,Refunded,Rejected',
        ]);

        $refund = Refund::findOrFail($id);
        $refund->status = $validatedData['status'];
        $refund->save();

        Toastr::success('Refund status updated successfully', 'Success');

        return redirect()->route('allrefunds'); // Correct the route name here.
    }

    public function refunded()
    {
        $refund_status = Refund::where('status', 'Refunded')->with('product', 'customer')->get();
        return view('refund.refunded', compact('refund_status'));
    }

    public function approvedRefunds()
    {
        $refund_status = Refund::where('status', 'Approved')->with('product', 'customer')->get();
        return view('refund.approvedrefund', compact('refund_status'));
    }

    public function pendingRefunds()
    {
        $refund_status = Refund::where('status', 'Pending')->with('product', 'customer')->get();
        return view('refund.pendingrefund', compact('refund_status'));
    }

    public function refundRejected()
    {
        $refund_status = Refund::where('status', 'Rejected')->with('product', 'customer')->get();
        return view('refund.refundrejected', compact('refund_status'));
    }
}