<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use Brian2694\Toastr\Facades\Toastr;

class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data = Page::get(['id', 'question', 'answer']);
        return view('page.index', compact('data'));
    }

    public function create()
    {
        return view('page.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required'
        ], []);

        Page::create($request->all());


        Toastr::success('Page Added Successfully!');
        return redirect()->route('pages.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $value = Page::findOrFail($id);
        return view('page.edit', compact('value'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required'
        ], []);

        $update1 = Page::findOrFail($id);
        $update = Page::findOrFail($id);
        $update->update($request->all());


        Toastr::success('Page Updated Successfully!');
        return redirect()->route('pages.index');
    }

    public function destroy($id)
    {
        $delete = Page::findOrFail($id);
        $delete->delete();

        return redirect()->back()->with(Toastr::success('Page Deleted Successfully!'));
    }
}
