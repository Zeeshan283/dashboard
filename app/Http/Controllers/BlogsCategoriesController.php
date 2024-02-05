<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\BlogsCategories;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as Image;
class BlogsCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = BlogsCategories::orderBy('id')->get(['id', 'blog_category_id']);
        return view('blogs.blog_categories.index', compact('data'));
    }

    public function create()
    {
        $data = ($id = request()->get('id'));
        return view('blogs.blog_categories.create' , compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'blog_category_id' => 'required',
        ]);

        $data = new BlogsCategories;
        $data->blog_category_id = $request->blog_category_id;

        $data->save();
        notify()->success('Blog Category created successfully', 'Success');
        return redirect()->back()->with(Toastr::success('Blog Category Added Successfully'));
    }


    public function show(BlogsCategories $blogsCategories)
    {
        $data = BlogsCategories::orderBy('id')->get(['id', 'blog_category_id']);
        return view('blogs_categories.show', compact('data'));
    }


    public function edit($id)
    {
        $edit = BlogsCategories::findOrFail($id);
        if($edit)
        {
            return view('blogs.blog_categories.edit',compact('edit'));
        }else{
            abort(404);
        }
    }

    public function update($id, Request $request)
{
    $this->validate($request, [
        'blog_category_id' => 'required',
    ]);

    $edit = BlogsCategories::findOrFail($id);
    $edit->blog_category_id = $request->blog_category_id;

    $edit->update();
    notify()->success('Blog Category update successfully', 'Success');
    return redirect()->back()->with(Toastr::success('Blog Category Updated Successfully'));
}

    public function destroy($id)
    {
        $data = BlogsCategories::findOrFail($id);
        $data->delete();
        notify()->success('Blog Category deleted successfully', 'Success');
        Toastr::success('Blog Deleted Successfully!');
        return redirect()->back();
}
    //     $data = BlogsCategories::findOrFail($id);
    //     if($data)
    //     {
    //         $data->delete();
    //         $events = Blogs::where('blog_category_id',$id)->get();
    //         foreach($events as $value)
    //         {
    //             File::delete('root/upload/blogs/big/'.$value->image);
    //             File::delete('root/upload/blogs/medium/'.$value->image);
    //             File::delete('root/upload/blogs/small/'.$value->image);
    //         }
    //         Blogs::where('blog_category_id',$id)->delete();
    //         return redirect()->back()->with('flash_message', 'Blog Category Deleted Successfully');;
    //     }else{
    //         abort(404);
    //     }
    //}
}
