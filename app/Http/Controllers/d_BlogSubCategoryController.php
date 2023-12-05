<?php

namespace App\Http\Controllers;

use App\Models\BlogSubCategory;
use App\Models\BlogsCategories;
use App\Models\Blogs;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
class BlogSubCategoryController extends Controller
{ public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $data = BlogSubCategory::orderBy('id')->get(['id', 'title']);
        $data = BlogSubCategory::with('subCategories')->orderBy('id')->get();
        
        return view('blogs-sub-categories.index', compact('data'));
    }

    public function create()
    {
        $blogcategory = BlogsCategories::orderBy('id')->pluck('title','id');
        return view('blogs-sub-categories.create',compact('blogcategory'));
    }

    public function store(Request $request)
    {
       
        $this->validate($request, [
            'title' => 'required'
        ]);
        BlogSubCategory::create($request->all());
        return redirect()->back()->with(Toastr::success('Blog Sub Category Added Successfully'));
    }

    public function show()
    {
        //
    }

    public function edit($id)
    {
        $blogcategory = BlogsCategories::orderBy('id')->pluck('title','id');
        $edit = BlogSubCategory::findOrFail($id);
        if($edit)
        {
            return view('blogs-sub-categories.edit',compact('edit','blogcategory'));
        }else{
            abort(404);
        }
    }

    public function update($id,Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        $edit = BlogSubCategory::findOrFail($id);
        if($edit)
        {
            $edit->update($request->all());
            return redirect('/blogs-sub-categories')->with('flash_message', 'Blog Sub Category Updated Successfully');
        }else{
            abort(404);
        }
    }

    public function destroy($id)
    {
        $data = BlogSubCategory::findOrFail($id);
        if($data)
        {
            $data->delete();
            $events = Blogs::where('blog_sub_category_id',$id)->get();
            foreach($events as $value)
            {
                File::delete('root/upload/blogs/big/'.$value->image);
                File::delete('root/upload/blogs/medium/'.$value->image);
                File::delete('root/upload/blogs/small/'.$value->image);
            }
            Blogs::where('blog_sub_category_id',$id)->delete();
            return redirect()->back()->with('flash_message', 'Blog Sub Category Deleted Successfully');;
        }else{
            abort(404);
        }
    }
}
