<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use App\Models\Coupon;
use Brian2694\Toastr\Facades\Toastr;
use App\Events\DatabaseChange;
use Illuminate\Support\Facades\Notification;
use App\Notifications\InvoicePaid;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use function Termwind\render;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){

        $coupons = Coupon::all();
        $allcoupons = Coupon::count();
        return view('coupon.allcoupons', compact('coupons','allcoupons'));
    }
    public function create(Request $request){

        $products = Product::all();

        $user = User::where('id', Auth::user()->id)->first();
        $selectedType = $request->input('apply');

        if ($selectedType === 'store') {
            $selectedItem = $user->name;
        } elseif ($selectedType === 'sku') {
            $selectedItem = $request->input('product_sku');
        } else {
            $selectedItem = '';
        }
        return view('coupon.createcoupon', compact('products', 'user', 'selectedType', 'selectedItem'));

    }

    public function isUsed()
    {
        notify()->success('this coupon is used', 'Success');
        return $this->coupon_used? true : false;
    }

    public function store(Request $request )
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
            'store' => $request->input('apply') === '6' ? $request->input('store') : null,
            'sku' => $request->input('apply') === '7' ? $request->input('sku') : null,
            'product_id' => $request->input('apply') === '7' ? $request->input('product_id') : null,
            'status' => $request->input('status'),
            'vendor_id' => Auth::user()->id,
        ]);

        // Save the coupon
        $coupon->save();


        // ]);
        notify()->success('Coupon created successfully', 'Success');
        return redirect()->back();
    }


    public function toggleStatus(Request $request)
{
    $requestData = $request->all();
    \Log::info('Received request data:', $requestData);

    $couponModel = Coupon::find($requestData['coupon_id']);

    if ($couponModel) {
        // Toggle status based on the current status
        $couponModel->status = ($couponModel->status === 'active') ? 'inactive' : 'active';
        $couponModel->save();

        return response()->json(['message' => 'Coupon status toggled successfully']);
    }
    notify()->success('coupon status updated', 'Success');
    return response()->json(['message' => 'Coupon not found'], 404);
}


    public function destroy($id)
    {
        $coupon = Coupon::find($id);

        if (!$coupon) {
            Toastr::error('Coupon not found', 'Error');
            return redirect()->back();
        }

        $coupon->delete();
        notify()->success('Coupon deleted successfully', 'Success');
        Toastr::success('Coupon deleted successfully', 'Success');

        return redirect()->back();
    }

    // public function notification(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required|string|max:255',
    //         'coupon_id' => 'required|string',
    //     ]);

    //     $coupon = new Coupon();
    //     $coupon->id = Auth::user()->id;
    //     $coupon->coupon_id = $request->coupon_id;
    //     $coupon->timestamp = now();
    //     $coupon->save();

    //     // Create a new notification record
    //     $notification = new Notification();
    //     $notification->id = Auth::user()->id;
    //     $notification->coupon_id = $request->coupon_id;
    //     $notification->timestamp = now();
    //     $notification->save();

    //     $data = Coupon::where('timestamp', '>=', now()->subDay())->get();

    //     return redirect()->route('coupon.allcoupons')->with('data', $data);
    // }

    // public function getNotifications(request $request)
    // {

    //     Notification::send($coupons, new InvoicePaid($coupons));

    //   return view('layouts.header', compact('Notifications'));
    //  }


}


