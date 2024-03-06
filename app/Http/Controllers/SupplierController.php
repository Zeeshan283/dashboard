<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $suppliers = Supplier::where('added_by', Auth::user()->id)->orderBy('id', 'asc')->get();
        return view('vendor.index', compact('suppliers'));
    }
    public function create()
    {
        return view('vendor.create');
    }


    public function store(Request $request)
    {
        // dd($request->all());

        $supplier = new Supplier([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'website' => $request->input('website'),
            'address' => $request->input('address'),
            'added_by' => Auth::user()->id,
        ]);


        $supplier->save();

        Toastr::success('Supplier Added successfully', 'Success');
        return redirect('supplier');
    }


}
