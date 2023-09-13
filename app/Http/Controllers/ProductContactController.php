<?php

namespace App\Http\Controllers;

use App\Models\ProductContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductContactController extends Controller
{

    public function index()
    {

        $data = "";
        if(Auth::User()->role == 'Admin'){
            $data = ProductContact::all();
        }elseif(Auth::User()->role == 'Vendor')
        {
            $data = ProductContact::OrderBy('id', 'desc')->where('vendor_id',Auth::User()->id)->get();
        }
        return view('products.customerqueries', compact('data'));
    }
    
    public function show($id){
        $data = ProductContact::findOrFail($id);

        return view('products.contactDetail', compact('data'));
    }
}
