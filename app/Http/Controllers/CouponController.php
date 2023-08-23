<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use App\Models\Coupon;

use Illuminate\Http\Request;

use function Termwind\render;

class CouponController extends Controller
{
    public function create(){

        $products = Product::all();
        
        return view('coupon.createcoupon', compact('products'));
    }


    public function store(Request $request)
    {
      
        $coupon = new Coupon([
            'coupon_type' => $request->input('coupon_type'),
            'coupon_title' => $request->input('coupon_title'),
            'coupon_code' => $request->input('coupon_code'),
            'minimum_purchase' => $request->input('minp'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'discount_type' => $request->input('discount_type'),
            'amount' => $request->input('amount'),
            'percentage' => $request->input('percentage'),
            'limit_same_user' => $request->input('limit_same_user'),
            'product_id' => $request->input('product_id'),
        ]);
        
        // Save the coupon
        $coupon->save();

        return redirect()->back();
    }


    public function show(){

        $coupons = Coupon::all();

        return view('coupon.allcoupons', compact('coupons'));
    }
}


