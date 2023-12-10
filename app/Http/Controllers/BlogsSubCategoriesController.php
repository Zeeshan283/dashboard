<?php

namespace App\Http\Controllers;
use App\Models\BlogsCategories;
use App\Models\BlogsSubCategories;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class BlogsSubCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = BlogsSubCategories::orderBy('id')->get(['id', 'blog_category_id', 'blog_sub_category_id']);
        return view('blogs.blog_subcategories.index', compact('data'));
    }

    public function create()
    {
        $categories = BlogsCategories::all();
        return view('blogs.blog_subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'blog_category_id' => 'required',
            'blog_sub_category_id' => 'required',
        ]);

        BlogsSubCategories::create([
            'blog_category_id' => $request->blog_category_id,
            'blog_sub_category_id' => $request->blog_sub_category_id,
        ]);
        return redirect()->back()->with(Toastr::success('Blog Sub Category Added Successfully'));
    }

    public function show(BlogsSubCategories $BlogsSubCategories)
{
    return redirect()->route('blog_subcategories.index');
}


public function edit($id)
{
    $edit = BlogsSubCategories::findOrFail($id);
    $categories = BlogsCategories::all();  

    return view('blogs.blog_subcategories.edit', compact('edit', 'categories'));
}
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'blog_category_id' => 'required',
            'blog_sub_category_id' => 'required',
        ]);        

        $edit = BlogsSubCategories::findOrFail($id);
        $edit->update([
            'blog_category_id' => $request->blog_category_id,
            'blog_sub_category_id' => $request->blog_sub_category_id,
        ]);
        return redirect()->route('blog_subcategories.index')->with(Toastr::success('Blog SubCategory Updated Successfully'));
    }

    public function destroy($id)
    {
        $data = BlogsSubCategories::findOrFail($id);
        $data->delete();
    
        Toastr::success('SubCategory Deleted Successfully!');
        return redirect()->route('blog_subcategories.index');
    }
    
}
