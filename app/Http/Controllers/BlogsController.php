<?php
namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\BlogsCategories;
use App\Models\BlogSubCategory ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as Image;
use Intervention\Image\Facades\Image as Image1;

class BlogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Blogs::with('blog_category:id,title')->with('blog_sub_category:id,title')->orderBy('id')->get();
        return view('blogs.index', compact('data'));
    }

    public function create()
    {
        $blogsCategories = BlogsCategories::orderBy('id')->pluck('title','id');
        $blogssubCategories = BlogSubCategory ::orderBy('id')->pluck('title','id');
        return view('blogs.create',compact('blogsCategories','blogssubCategories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'blog_category_id'=>'required',
            'image'=>'required|mimes:png,jpg,jpeg',
            'description'=>'required'
        ],
        [
            'blog_category_id.required'=>'The category field is required'
        ]);
        $b = Blogs::create($request->all());
        $b->slug = Str::slug($request->title);
        $b->save();

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $fileName = uniqid().$file->getClientOriginalName();

            //prorgam image save in 930 x 500
            $imagePath =  base_path('upload/blogs/big/' . $fileName);
            $img = Image::make($file);
            $img->resize(930, 500);
            $img->save($imagePath);

            //prorgam image save in 600 x 420
            $imagePath =  base_path('upload/blogs/medium/' . $fileName);
            $img = Image::make($file);
            $img->resize(600, 420);
            $img->save($imagePath);

            //prorgam image save in 600 x 420
            $imagePath =  base_path('upload/blogs/small/' . $fileName);
            $img = Image::make($file);
            $img->resize(100, 70);
            $img->save($imagePath);

            $b->image = $fileName;
            $b->save();
        }

        return redirect()->back()->with('flash_message', 'Blog Added Successfully');
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
        $blogsCategories = BlogsCategories::orderBy('id')->pluck('title','id');
        $blogssubCategories = BlogSubCategory ::orderBy('id')->pluck('title','id');
        if($edit)
        {
            return view('blogs.edit',compact('edit','blogsCategories','blogssubCategories'));
        }else{
            abort(404);
        }
    }

    public function update($id,Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'blog_category_id'=>'required',
            'image'=>'mimes:png,jpg,jpeg',
            'description'=>'required'
        ],
        [
            'blog_category_id.required'=>'The category field is required'
        ]);

        $edit1 = Blogs::findOrFail($id);
        $edit = Blogs::findOrFail($id);
        if($edit)
        {
            $edit->update($request->all());

            $edit->slug = Str::slug($request->title);
            $edit->save();


            if($request->hasFile('image'))
            {
                File::delete('root/upload/blogs/big/'.$edit1->image);
                File::delete('root/upload/blogs/medium/'.$edit1->image);
                File::delete('root/upload/blogs/small/'.$edit1->image);

                $file = $request->file('image');
                $fileName = uniqid().$file->getClientOriginalName();

                //prorgam image save in 930 x 500
                $imagePath =  base_path('upload/blogs/big/' . $fileName);
                $img = Image::make($file);
                $img->resize(930, 500);
                $img->save($imagePath);

                //prorgam image save in 600 x 420
                $imagePath =  base_path('upload/blogs/medium/' . $fileName);
                $img = Image::make($file);
                $img->resize(600, 420);
                $img->save($imagePath);

                //prorgam image save in 600 x 420
                $imagePath =  base_path('upload/blogs/small/' . $fileName);
                $img = Image::make($file);
                $img->resize(100, 70);
                $img->save($imagePath);

                $edit->image = $fileName;
                $edit->save();
            }


            return redirect('/our-blogs')->with('flash_message', 'Blog Updated Successfully');
        }else{
            abort(404);
        }
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
    
        public function uploadImage(Request $request)
    {
        //  $imgpath = $request->file('file')->store('upload', 'public');
        // return response()->json(['location' => "/storage/$imgpath"]);

        $filename = $request->file('file')->getClientOriginalName();

        //return $filename;
         $path = $request->file('file')->move('root/upload/tinymce', $filename);
        return response()->json(['location' => '../root/upload/tinymce/'.$filename]);

            $fileName = 'tiny'.uniqid(). $file->getClientOriginalName();
           return $request->file('file')->move(base_path() .'/upload/tinymce/' , $fileName);
            // $path = base_path() . '/upload/tinymce/' . $fileName;

            
            return $path;
            // Image::make($file)->resize(285, 305)->save($path);
            // $t->image = $fileName;
            // $t->save();
        
        // return response()->json(['location' => "/storage/$imgpath"]);
        // return response()->json(['location' => "/storage/$imgpath"]);
    }
}
