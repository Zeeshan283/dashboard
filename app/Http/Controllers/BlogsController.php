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
        $blogs = Blogs::orderBy('id')->get(['id', 'title', 'description']);
        $blogs = Blogs::all(); 
        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        $blogs = ($id = request()->get('id'));
        $blogs = Blogs::all(); 
        return view('blogs.create' , compact('blogs'));
    }   

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
    
        $blog = new Blogs;
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->save();
    
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
        $cat = BlogsCategories::where('id',$edit->blog_category_id)->first();
        $categories = BlogsCategories::all();


        return view('blogs.edit',compact('edit','cat','categories'));

    }

    public function update($id,Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required',
            'description'=>'required',
        ]);

        $edit = Blogs::findOrFail($id);
        $edit->title = $request->title;
        $edit->description = $request->description;
        
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
