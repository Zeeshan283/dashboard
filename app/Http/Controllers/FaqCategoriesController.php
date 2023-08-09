<?php

namespace App\Http\Controllers;

use App\Models\FaqCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FaqCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = FaqCategories::OrderBy('id')->get();
        return view('faq-categories.index',compact('data'));
    }

    public function create()
    {
        return view('faq-categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required'
        ]);
        FaqCategories::create($request->all());

        Session::flash('flash_message', 'FAQ Category Added Successfully!');
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit = FaqCategories::findOrFail($id);
        return view('faq-categories.edit',compact('edit'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required'
        ]);
        $edit = FaqCategories::findOrFail($id);
        $edit->update($request->all());

        Session::flash('flash_message', 'FAQ Category Updated Successfully!');
        return redirect('/faq-categories');
    }

    public function destroy($id)
    {
        FaqCategories::findOrFail($id)->delete();
        
        Session::flash('flash_message', 'FAQ Category Deleted Successfully!');
        return redirect()->back();
    }
}
