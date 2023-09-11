<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use App\Models\Coupon;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use function Termwind\render;

class CouponController extends Controller
{ 
    public function index(){

        $coupons = Coupon::all();
        return view('coupon.allcoupons', compact('coupons'));
    }
    public function create(){

        $products = Product::all();

        $user = User::where('id', Auth::user()->id)->first();
        
        return view('coupon.createcoupon', compact('products','user'));
    }


    public function store(Request $request)
    {
    //   dd($request->all());
        $coupon = new Coupon([
            'coupon_type' => $request->input('coupon_type'),
            'coupon_title' => $request->input('coupon_title'),
            'coupon_code' => $request->input('coupon_code'),
            'minimum_purchase' => $request->input('minp'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'discount_type' => $request->input('discount_type'),
            'apply' =>$request->input('apply'),
            'amount' => $request->input('amount'),
            'percentage' => $request->input('percentage'),
            'limit_same_user' => $request->input('limit_same_user'),
            'store'=> $request->input('store'),
            'product_id' => $request->input('product_id'),
        ]);
        
        // Save the coupon
        $coupon->save();

        return redirect()->back();
    }


    public function updateStatus(Request $request)
{
    $couponId = $request->input('coupon_id');
    $isActive = $request->input('is_active');

    // Update the coupon status in your database
    $coupon = Coupon::find($couponId);
    if ($coupon) {
        $coupon->is_active = $isActive;
        $coupon->save();

        return response()->json(['message' => 'Coupon status updated successfully']);
    }

    return response()->json(['error' => 'Coupon not found'], 404);
}



}


