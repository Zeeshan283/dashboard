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
        $data = BlogsCategories::orderBy('id')->get(['id', 'title', 'category', 'description']);
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
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
        ]);
    
        $data = new BlogsCategories;
        $data->title = $request->title;
        $data->category = $request->category;
        $data->description = $request->description;
    
        $data->save(); 
    
        return redirect()->back()->with(Toastr::success('Blog Category Added Successfully'));
    }
    

    public function show(BlogsCategories $blogsCategories)
    {
       $data = BlogsCategories::orderBy('id')->get(['id','title']);
       return view('', compact('data'));
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
        'title' => 'required',
        'category' => 'required',
        'description' => 'required',
    ]);

    $edit = BlogsCategories::findOrFail($id);
    $edit->title = $request->title;
    $edit->category = $request->category;
    $edit->description = $request->description;

    $edit->update();

    return redirect()->back()->with(Toastr::success('Blog Category Updated Successfully'));
}

    public function destroy($id)
    {
        $data = BlogsCategories::findOrFail($id);
        $data->delete();
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
