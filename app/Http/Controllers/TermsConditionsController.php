<?php

namespace App\Http\Controllers;

use App\Models\TermsConditions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TermsConditionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = TermsConditions::OrderBy('id')->get();
        return view('terms-conditions.index', compact('data'));
    }

    public function create()
    {
        return view('terms-conditions.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);
        TermsConditions::create($request->all());

        Session::flash('flash_message', 'Terms Added Successfully!');
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit = TermsConditions::findOrFail($id);
        return view('terms-conditions.edit', compact('edit'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);
        $edit = TermsConditions::findOrFail($id);
        $edit->update($request->all());

        Session::flash('flash_message', 'Terms Updated Successfully!');
        return redirect('/our-terms-conditions');
    }

    public function destroy($id)
    {
        TermsConditions::findOrFail($id)->delete();

        Session::flash('flash_message', 'Terms Deleted Successfully!');
        return redirect()->back();
    }
}
