<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\OrderTracker;
use App\Models\Product;
use App\Models\ProductConditions;
use App\Models\ProductContact;
use App\Models\ProductImages;
use App\Models\ProductLocations;
use App\Models\ProductShippment;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class InsertVendorsController extends Controller
{
      public function vendorlist (){
        return view('seller.addseller');
    }
    public function add( Request $request){
        $request->validate([
        'firstname'=>'required',
        'lastname'=>'required',
        'phonenumber'=>'required',
        'username'=>'required',
        'email'=>'required|email|unique:users',
        'address'=>'required',
        'postcode'=>'required',
        'radio'=>'required'

        ]);

        $query =DB::table('users')->insert([
            'first_name'=>$request->input('firstname'),
            'last_name'=>$request->input('lastname'),
            'phone1'=>$request->input('phonenumber'),
            'name'=>$request->input('username'),
            'email'=>$request->input('email'),
            'addres'=>$request->input('address'),
            'zipcode'=>$request->input('postcode'),
            'status'=>$request->input('radio')

        ]);
    }

}
