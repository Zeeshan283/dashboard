<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SingleProductInfo;
use Brian2694\Toastr\Facades\Toastr;

class SingleProductInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit($id)
    {
        $edit = SingleProductInfo::findOrFail($id);
        return view('products.product-info',compact('edit'));
    }

    public function update($id,Request $request)
    {
        $this->validate($request,[
            'shipping'=>'required',
            'delivery'=>'required',
            'returns'=>'required',
            'payment_method'=>'required',
            'disclaimer'=>'required'
        ]);

        $edit = SingleProductInfo::findOrFail($id);
        $edit->update($request->all());
        return redirect()->back()->with(Toastr::success('Product Info Updated Successfully!!!'));
    }
}
