<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = SubCategory::with('categories:id,name')->OrderBy('name', 'asc')->get();
        return view('sub-category.index', compact('data'));
    }

    public function create()
    {
        $categories = Category::OrderBy('id', 'asc')->pluck('name', 'id');
        return view('sub-category.create', Compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'biller'=>'required',
            'name' => 'required',
            'category_id'=>'required'
        ]);

        $s = SubCategory::create($request->all());
        $s->slug = Str::slug($request->name);
        $s->save();

        return redirect()->back()->with(Toastr::success('Sub Category Added Successfully!'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit = SubCategory::findOrFail($id);
        $categories = Category::OrderBy('id', 'asc')->pluck('name', 'id');
        return view('sub-category.edit', Compact('edit', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'category_id'=>'required'
        ]);
        $update = SubCategory::findOrFail($id);
        $update->update($request->all());
        $update->slug = Str::slug($request->name);
        $update->save();
        
        return redirect('sub-category')->with(Toastr::success('Sub Category Updated Successfully!'));
    }

    public function destroy($id)
    {
        SubCategory::findOrFail($id)->delete();
        return redirect()->back()->with(Toastr::success('Sub Category Deleted Successfully!'));
    }
}
