<?php

namespace App\Http\Controllers;

use App\Models\FAQ1;
use App\Models\FaqCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FAQ1Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = FAQ1::with('faq_category')->OrderBy('id')->get();
        return view('faq1.index',compact('data'));
    }

    public function create()
    {
        $faq_categories = FaqCategories::OrderBy('id')->pluck('title','id');
        return view('faq1.create',compact('faq_categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'question'=>'required',
            'answer'=>'required',
            'faq_category_id'=>'required'
        ]);
        FAQ1::create($request->all());

        Session::flash('flash_message', 'FAQ Added Successfully!');
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit = FAQ1::findOrFail($id);
        $faq_categories = FaqCategories::OrderBy('id')->pluck('title','id');
        return view('faq1.edit',compact('edit','faq_categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'question'=>'required',
            'answer'=>'required',
            'faq_category_id'=>'required'
        ]);
        $edit = FAQ1::findOrFail($id);
        $edit->update($request->all());

        Session::flash('flash_message', 'FAQ Updated Successfully!');
        return redirect('/our-faq1');
    }

    public function destroy($id)
    {
        FAQ1::findOrFail($id)->delete();
        
        Session::flash('flash_message', 'FAQ Deleted Successfully!');
        return redirect()->back();
    }
}
