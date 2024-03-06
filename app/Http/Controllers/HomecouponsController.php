<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Homecoupons;
use App\Models\User;
use App\Models\Product;
use App\Models\Coupon;
class HomecouponsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $coupons = Homecoupons::orderBy('id')->get();
        return view('Homecoupons.allcoupons', compact('coupons'));
    }
    
    
    public function create()
    {
        $coupons = Homecoupons::all();
        return view('Homecoupons.create', compact('coupons'));
    }
    
    public function store(Request $request)
    {
    // $validatedData = $request->validate([
    //     'id' => 'required|exists:homecoupons,id',
    // ]);

    $coupons = coupon::where('id', $request->id)->first();
    
    if (!$coupons) {
        return redirect()->back()->withErrors(['coupons' => 'No coupons found with this id.']);
    }


    $coupon = new Homecoupons;
        $coupon->id = $request->id;

        $coupon->coupon_type = $coupons->coupon_type;  
        $coupon->coupon_title = $coupons->coupon_title;  
        $coupon->coupon_code = $coupons->coupon_code;
        $coupon->coupon_used = $coupons->coupon_used; 
        $coupon->minimum_purchase = $coupons->minimum_purchase; 
        $coupon->start_date = $coupons->start_date; 
        $coupon->end_date = $coupons->end_date;
        $coupon->discount_type = $coupons->discount_type;
        $coupon->apply = $coupons->apply;
        $coupon->amount = $coupons->amount;
        $coupon->percentage = $coupons->percentage;
        $coupon->limit_same_user = $coupons->limit_same_user;
        $coupon->store = $coupons->store;
        $coupon->product_id = $coupons->product_id;
        $coupon->vendor_id = $coupons->vendor_id;
        // $coupon->status = $request->status;
        $coupon->save();
        return redirect()->route('Homecoupons.index')->with('success', 'Coupons added successfully!');

    }
    
    public function edit($coupon_code)
    {
        $coupon = Homecoupons::where('coupon_code', $coupon_code)->firstOrFail();
        return view('Homecoupons.edit', compact('coupon'));
    }

    public function update(Request $request, $coupon_code)
    {
        $coupon = Homecoupons::where('coupon_code', $coupon_code)->firstOrFail();

        // $request->validate([
        //     'coupon_code' => 'required|unique:coupons,coupon_code,' . $coupon->id,
        // ]);
        $coupon->coupon_type = $request->coupon_type;
        $coupon->coupon_title = $request->coupon_title;
        $coupon->coupon_code = $request->coupon_code;
        $coupon->coupon_used = $request->coupon_used;
        $coupon->maximum_purchase = $request->maximum_purchase;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->discount_type = $request->discount_type;
        $coupon->apply = $request->apply;
        $coupon->amount = $request->amount;
        $coupon->percentage = $request->percentage;
        $coupon->limit_same_user = $request->limit_same_user;
        $coupon->store = $request->store;
        $coupon->product_id = $request->product_id;
        $coupon->status = $request->status;
        $coupon->save();

        return redirect()->route('Homecoupons.index')->with('success', 'Coupon updated successfully!');
    }

    public function destroy($id)
    {
        $coupon = Homecoupons::findOrFail($id); 
    
        $coupon->delete();
    
        return redirect()->route('Homecoupons.index')->with('success', 'Coupon deleted successfully!');
    }
    
    
}
