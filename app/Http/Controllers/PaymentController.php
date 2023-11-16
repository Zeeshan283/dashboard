<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = PaymentMethod::orderBy('name')->get(['id', 'name']);
        return view('payment_method.index', compact('data'));
    }

    public function create()
    {
        return view('payment_method.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ], [
            'name' => 'The name field is required'
        ]);

        $b = PaymentMethod::create($request->all());

        Toastr::success('Added Successfully!');
        return redirect('payment_method');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = PaymentMethod::findOrFail($id);
        return view('payment_method.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ], [
            'name' => 'The name field is required'
        ]);
        $update = PaymentMethod::findOrFail($id);
        $update->update($request->all());

        

        Toastr::success('Updated Successfully!');
        return redirect('payment_method');
    }

    public function destroy($id)
    {
        $delete = PaymentMethod::findOrFail($id);
        $delete->delete();

        return redirect()->back()->with(Toastr::success('Deleted Successfully!'));
    }
}
