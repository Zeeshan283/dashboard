<?php

namespace App\Http\Controllers;

use App\Models\FAQ2;
use App\Models\FaqCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FAQ2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = FAQ2::OrderBy('id')->get();
        return view('faq2.index',compact('data'));
    }

    public function create()
    {
        return view('faq2.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'question'=>'required',
            'answer'=>'required'
        ]);
        FAQ2::create($request->all());

        Session::flash('flash_message', 'FAQ Added Successfully!');
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit = FAQ2::findOrFail($id);
        return view('faq2.edit',compact('edit'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'question'=>'required',
            'answer'=>'required'
        ]);
        $edit = FAQ2::findOrFail($id);
        $edit->update($request->all());

        Session::flash('flash_message', 'FAQ Updated Successfully!');
        return redirect('/our-faq2');
    }

    public function destroy($id)
    {
        FAQ2::findOrFail($id)->delete();
        
        Session::flash('flash_message', 'FAQ Deleted Successfully!');
        return redirect()->back();
    }
}
