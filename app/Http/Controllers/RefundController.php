<?php

namespace App\Http\Controllers;

use App\Models\Refund;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import the Log facade


class RefundController extends Controller
{
    public function index(){

        
        $refunds = Refund::with('product','customer')->get();

        return view('refund.refunded',compact('refunds'));

    }

    public function refundstatus(){
        $refund_status = Refund::all();
        return view('refund.allrefunds',compact('refund_status'));
    }

    public function create(){
        $vendors = User::where('role', '=','vendor')->get();
        $products = Product::where('sku','!=','null')->get();
        $customers = User::where('role','!=','admin')->get();
        $orders = Order::all();
        return view('refund.createrefund', compact('vendors','products','customers','orders'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'vendor' => 'required',
            'product_id' => 'required',
            'customer_id' => 'required',
            'order_id' => 'required',
            'amount' => 'required|numeric',
            'reason' => 'required',
        ]);

        $refund = new Refund();
        $refund->vendor = $validatedData['vendor'];
        $refund->product_id = $validatedData['product_id'];
        $refund->customer_id = $validatedData['customer_id'];
        $refund->order_id = $validatedData['order_id'];
        $refund->amount = $validatedData['amount'];
        $refund->reason = $validatedData['reason'];

        // Save the record 
        $refund->save();

        Toastr::success('Refund request generated successfully', 'Success');

        return redirect()->back();
        }


}
