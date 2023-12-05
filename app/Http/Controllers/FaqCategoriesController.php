<?php

namespace App\Http\Controllers;

use App\Models\FAQCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;

class FaqCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = FAQCategory::OrderBy('id')->get();
        return view('faqs.category.index', compact('data'));
    }

    public function create()
    {
        return view('faqs.category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        FAQCategory::create($request->all());

        Toastr::success('FAQ Category Added Successfully!');
        Session::flash('flash_message', 'FAQ Category Added Successfully!');
        return redirect()->route('faqs_categories.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = FAQCategory::findOrFail($id);
        return view('faqs.category.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $edit = FAQCategory::findOrFail($id);
        $edit->update($request->all());

        Toastr::success('FAQ Category Updated Successfully!');
        Session::flash('flash_message', 'FAQ Category Updated Successfully!');
        return redirect()->route('faqs_categories.index');
    }

    public function destroy($id)
    {
        FAQCategory::findOrFail($id)->delete();

        Toastr::success('FAQ Category Deleted Successfully!');
        Session::flash('flash_message', 'FAQ Category Deleted Successfully!');
        return redirect()->back();
    }
}
