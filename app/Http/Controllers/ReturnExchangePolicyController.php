<?php

namespace App\Http\Controllers;

use App\Models\ReturnExchangePolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReturnExchangePolicyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = ReturnExchangePolicy::OrderBy('id')->get();
        return view('return-exchange-policy.index', compact('data'));
    }

    public function create()
    {
        return view('return-exchange-policy.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);
        ReturnExchangePolicy::create($request->all());

        Session::flash('flash_message', 'Return Exchange Policy Added Successfully!');
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit = ReturnExchangePolicy::findOrFail($id);
        return view('return-exchange-policy.edit', compact('edit'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);
        $edit = ReturnExchangePolicy::findOrFail($id);
        $edit->update($request->all());

        Session::flash('flash_message', 'Return Exchange Policy Updated Successfully!');
        return redirect('/return-exchange-policy');
    }

    public function destroy($id)
    {
        ReturnExchangePolicy::findOrFail($id)->delete();

        Session::flash('flash_message', 'Return Exchange Policy Deleted Successfully!');
        return redirect()->back();
    }
}
