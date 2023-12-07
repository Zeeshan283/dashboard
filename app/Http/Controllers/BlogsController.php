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
        $cat = BlogsCategories::all();
        $blogs = Blogs::all(); 
        return view('blogs.index', compact('cat','blogs'));
    }

    public function create()
    {
        $cat = BlogsCategories::orderBy('id')->get(); 
        $blogssubCategories = BlogSubCategory::orderBy('id')->pluck('title', 'id');
        return view('blogs.create', compact('cat', 'blogssubCategories'));
    }
    

    public function store(Request $request)
    {   
        $request->validate([
            'title' => 'required',
            'blog_category_id' => 'required',
            'subcategory' => '',
            'feature_image' => 'required|image|mimes:jpeg,jpg,png', 
            'description' => 'required',
        ]);        
    
        $blog = new Blogs;
        $blog->title = $request->title;
        $blog->blog_category = $request->category;
        $blog->subcategory = $request->subcategory;
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
         $blogssubCategories = BlogSubCategory::where('blog_category_id', $request->cat_id)->get(['id','title']);
         return json_encode($blogssubCategories);
    }
    public function edit($id)
    {
        $edit = Blogs::findOrFail($id);
        $categories = BlogsCategories::all();  // Change this line
    
        return view('blogs.edit', compact('edit', 'categories'));
    }
    

    public function update($id,Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
                'title' => 'required',
                'category' => 'required',
                'subcategory' => '',
                'feature_image' => 'required|image', 
                'description' => 'required',
            ]);

        $edit = Blogs::findOrFail($id);
        $edit->title = $request->title;
        $edit->category = $request->category;
        $edit->subcategory = $request->subcategory;
        $edit->feature_image = $request->feature_image;
        $edit->description = $request->description;

        if ($request->hasFile('feature_image')) {
            $file = $request->file('feature_image');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();    
            $edit->feature_image = $fileName;   
            $edit->save();   
        }
        $edit->update($request->all());
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