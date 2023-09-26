<?php

namespace App\Http\Controllers;

use App\Models\Refund;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RefundController extends Controller
{

    public function index()
    {
        $refund_status = Refund::with('product', 'customer')->get();
        return view('refund.allrefunds', compact('refund_status'));
    }

    public function create()
    {
        $vendors = User::where('role', 'vendor')->get();
        $products = Product::where('sku', '!=', null)->get();
        $customers = User::where('role', '!=', 'admin')->get();
        $orders = Order::all();
        return view('refund.createrefund', compact('vendors', 'products', 'customers', 'orders'));
    }

    public function refundstatus()
    {
        $refund_status = Refund::all(); 

        return view('refund.allrefunds', compact('refund_status'));
    }

    public function pendingRefunds()
    {
        $refund_status = Refund::with('user')->where('status', 'pending')->get();
        return view('refund.pendingrefund', compact('refund_status'));
    }

    public function approvedRefunds()
    {
        $refund_status = Refund::where('status', 'approved')->get();
        return view('refund.approvedrefund', compact('refund_status'));
    }

    public function refundedRefunds()
    {
        $refund_status = Refund::where('status', 'refunded')->get();
        return view('refund.refunded', compact('refund_status'));
    }

    public function rejectedRefunds()
    {
        $refund_status = Refund::where('status', 'rejected')->get();
        return view('refund.refundrejected', compact('refund_status'));
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
            // 'status' => ['pending', 'approved', 'refunded', 'rejected'],
        ]);

        $refund = new Refund();
        $refund->vendor = $validatedData['vendor'];
        $refund->product_id = $validatedData['product_id'];
        $refund->customer_id = $validatedData['customer_id'];
        $refund->order_id = $validatedData['order_id'];
        $refund->amount = $validatedData['amount'];
        $refund->reason = $validatedData['reason'];
        $refund->status = $request->input('status');

        // Save the record
        $refund->save();

        Toastr::success('Refund request generated successfully', 'Success');

        return redirect()->back();
    }

    public function updateRefundStatus(Request $request, $id)
    {
        $refund = Refund::find($id);

        if (!$refund) {
            return redirect()->back()->with('error', 'Refund not found.');
        }
    }
    public function update(Request $request) {

        // dd($request->all());
        $request->validate([
            'status' => 'required'
        ]);

        // Assuming 'refunds_status' is the column name you want to filter by
        $refund = Refund::where('id', $request->id)->first();

        $refund->status = $request->status;
        $refund->update();

        $redirectRoute = '';

        // if ($newStatus === 'Pending') {
        //     $redirectRoute = 'pendingrefund';
        // } elseif ($newStatus === 'Approved') {
        //     $redirectRoute = 'approvedrefund';
        // } elseif ($newStatus === 'Refunded') {
        //     $redirectRoute = 'refunded';
        // } elseif ($newStatus === 'Rejected') {
        //     $redirectRoute = 'refundrejected';
        // } else {
        //     $redirectRoute = 'allrefunds';
        // }

        Toastr::success('Refund request updated successfully', 'Success');
        return redirect()->back();
    }


    public function getOrdersByStatus($status)
    {
        $orders = Order::whereIn('id', function ($query) use ($status) {
            $query->select('order_id')
                ->from('refunds')
                ->where('status', $status);
        })
        ->get();

        return response()->json($orders);
    }
}
