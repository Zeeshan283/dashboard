<?php
namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\BlogsCategories;
use App\Models\BlogSubCategory ;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as Image;

class BlogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = BlogsCategories::all();
        $blogs = Blogs::all(); 
        return view('blogs.index', compact('categories','blogs'));
    }

    public function create()
    {
        $categories = BlogsCategories::orderBy('id')->get(); 
        $blogsSubCategories = BlogSubCategory::orderBy('id')->pluck('title', 'id');
        return view('blogs.create', compact('categories', 'blogsSubCategories'));
    }
    

    public function store(Request $request)
    {   
        $request->validate([
            'title' => 'required',
            'blog_category_id' => 'required',
            'blog_sub_category_id' => 'required',
            'feature_image' => 'required|image|mimes:jpeg,jpg,png', 
            'description' => 'required',
        ]);        
    
        $blog = new Blogs;
        $blog->title = $request->title;
        $blog->blog_category_id = $request->blog_category_id;
        $blog->blog_sub_category_id = $request->blog_sub_category_id;
        $blog->description = $request->description;
    
        if ($request->hasFile('feature_image')) {
            $file = $request->file('feature_image');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();    
            $blog->feature_image = $fileName;   
            $blog->save();
        }
    
        return redirect()->back()->with(Toastr::success('Blog Created Successfully'));
    }
    

    public function show(BlogsCategories $blogsCategories)
    {
        //
    }

    public function getSubCategories(Request $request)
    { 
         $blogssubCategories = BlogSubCategory::where('blog_category_id', $request->cat_id)->get(['id']);
         return json_encode($blogssubCategories);
    }
    public function edit($id)
    {
        $edit = Blogs::findOrFail($id);
        $categories = BlogsCategories::all(); 
    
        return view('blogs.edit', compact('edit', 'categories'));
    }
    

    public function update($id,Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
                'title' => 'required',
                'blog_category_id' => 'required',
                'blog_sub_category_id' => 'required',
                'feature_image' => 'required|image|mimes:jpeg,jpg,png', 
                'description' => 'required',
            ]);

        $edit = Blogs::findOrFail($id);
        $edit->title = $request->title;
        $edit->blog_category_id = $request->blog_category_id;
        $edit->blog_sub_category_id = $request->blog_sub_category_id;
        $edit->feature_image = $request->feature_image;
        $edit->description = $request->description;

        if ($request->hasFile('feature_image')) {
            $file = $request->file('feature_image');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();    
            $edit->feature_image = $fileName;   
            $edit->save();   
        $edit->update($request->all());
        }
        return redirect()->back()->with(Toastr::success('Blog  Updated Successfully'));
    }

    public function destroy($id)
    {
        $data = Blogs::findOrFail($id);
        if($data)
        {
            File::delete('root/upload/blogs/big/'.$data->image);
            File::delete('root/upload/blogs/medium/'.$data->image);
            File::delete('root/upload/blogs/small/'.$data->image);
            $data->delete();
            return redirect()->back()->with('flash_message', 'Blog Deleted Successfully');;
        }else{
            abort(404);
        }
    }
    
        
}