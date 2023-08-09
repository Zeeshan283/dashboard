<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\BlogsCategories;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;

class BlogsCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = BlogsCategories::orderBy('id')->get(['id', 'title']);
        return view('blogs-categories.index', compact('data'));
    }

    public function create()
    {
        return view('blogs-categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);
        BlogsCategories::create($request->all());
        return redirect()->back()->with(Toastr::success('Blog Category Added Successfully'));
    }

    public function show(BlogsCategories $blogsCategories)
    {
        //
    }

    public function edit($id)
    {
        $edit = BlogsCategories::findOrFail($id);
        if($edit)
        {
            return view('blogs-categories.edit',compact('edit'));
        }else{
            abort(404);
        }
    }

    public function update($id,Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        $edit = BlogsCategories::findOrFail($id);
        if($edit)
        {
            $edit->update($request->all());
            return redirect('/blogs-categories')->with('flash_message', 'Blog Category Updated Successfully');
        }else{
            abort(404);
        }
    }

    public function destroy($id)
    {
        $data = BlogsCategories::findOrFail($id);
        if($data)
        {
            $data->delete();
            $events = Blogs::where('blog_category_id',$id)->get();
            foreach($events as $value)
            {
                File::delete('root/upload/blogs/big/'.$value->image);
                File::delete('root/upload/blogs/medium/'.$value->image);
                File::delete('root/upload/blogs/small/'.$value->image);
            }
            Blogs::where('blog_category_id',$id)->delete();
            return redirect()->back()->with('flash_message', 'Blog Category Deleted Successfully');;
        }else{
            abort(404);
        }
    }
}
