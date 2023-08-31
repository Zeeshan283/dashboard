<?php

namespace App\Http\Controllers;

use App\Models\TermsConditions;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class TermsConditionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = TermsConditions::orderBy('id')->get();
        return view('terms.allterm', compact('data'));
    }

    public function create()
    {
        return view('terms.addterm');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);
        TermsConditions::create($request->all());

        // Session::flash('flash_message', 'Terms Added Successfully!');
        // return redirect()->route('allterm');
        Toastr::success('Terms Added Successfully!');
        return redirect()->back();
    }

    public function edit($id)
    {
        $edit = TermsConditions::findOrFail($id);
        return view('terms.edit', compact('edit'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);
        $edit = TermsConditions::findOrFail($id);
        $edit->update($request->all());

        // Session::flash('flash_message', 'Terms Updated Successfully!');
        // return redirect()->route('allterm');
        Toastr::success('Term Updated Successfully!');
        return redirect('allterm');
    }

    public function show($id)
    {
        $item = TermsConditions::find($id);

        if (!$item) {
            return redirect()->back()->with('error', 'Term not found.');
        }

        return view('terms.show', compact('item'));
    }


    public function destroy($id)
    {
        TermsConditions::findOrFail($id)->delete();

        Session::flash('flash_message', 'Terms Deleted Successfully!');
        return redirect()->route('allterm');
    }
}
