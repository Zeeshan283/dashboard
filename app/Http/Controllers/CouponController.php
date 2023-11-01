<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use App\Models\Coupon;
use Brian2694\Toastr\Facades\Toastr;

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

    public function isUsed()
    {
        return $this->coupon_used ? true : false;
    }
    
    public function store(Request $request)
    {
    //   dd($request->all());
        $coupon = new Coupon([
            'coupon_type' => $request->input('coupon_type'),
            'coupon_title' => $request->input('coupon_title'),
            'coupon_code' => $request->input('coupon_code'),
            'coupon_used' => $request->input('coupon_used'),
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
            'status' => $request->input('status'),
            'vendor_id' => Auth::user()->id,
        ]);
        
        // Save the coupon
        $coupon->save();

        return redirect()->back();
    }




    public function toggleStatus(Request $request)
    {
        $requestData = $request->all();
        $couponModel = Coupon::find($requestData['coupon_id']);

        if ($couponModel) {
            $couponModel->status = $requestData['status'];
            $couponModel->save();

            return response()->json(['message' => 'Coupon status toggled successfully']);
        }

        return response()->json(['message' => 'Coupon not found'], 404);
    }

    public function destroy($id)
    {
        $coupon = Coupon::find($id);

        if (!$coupon) {
            // Handle the case where the coupon with the given ID is not found.
            // You can display an error message or take other actions as needed.
            Toastr::error('Coupon not found', 'Error');
            return redirect()->back();
        }

        $coupon->delete();

        // Assuming you are using the Toastr library for notifications.
        Toastr::success('Coupon deleted successfully', 'Success');
        
        return redirect()->back();

    }




}


