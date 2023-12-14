<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cfeatures;
use App\Models\Blogs;
use App\Models\BlogsCategories;
use App\Models\BlogsSubCategories;
use Brian2694\Toastr\Facades\Toastr;

class CfeaturesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        $blogs = Blogs::with('blogSubCategory')->get();
        $cfeatures = Cfeatures::all(); 
        return view('cfeatures.index', compact('cfeatures', 'blogs'));
    }

    public function create()
    {
        $categories = BlogsCategories::orderBy('id')->get();
        $blogSubCategories = BlogsSubCategories::orderBy('id')->get();
        return view('cfeatures.create', compact('categories', 'blogSubCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'instructor' => 'required',
            'rating' => 'required',
            'lectures' => 'required',
            'duration' => 'required',
            'skilllevel' => 'required',
            'language' => 'required',
            'coursetype' => 'required',
            'address' => $request->coursetype == 'Onsite' ? 'required' : '', 
            'title' => 'required',
            'blog_category_id' => 'required',
            'blog_sub_category_id' => 'required',
            'feature_image' => 'required|image|mimes:jpeg,jpg,png', 
            'description' => 'required',
        ]);

        $featureImage = $request->file('feature_image');
        $featureImageName = uniqid() . '.' . $featureImage->getClientOriginalExtension();
        $featureImage->move(public_path('upload/cfeatures/'), $featureImageName);

        $cfeature = new Cfeatures($request->all());
        $cfeature->feature_image = $featureImageName;
        $cfeature->save();

        Toastr::success('Course features added successfully!');
        return redirect()->route('cfeatures.index');
    }
    public function getSubCategories(Request $request)
    {
        $blogssubCategories = BlogsSubCategories::where('blog_category_id', $request->cat_id)->get(['id', 'blog_sub_category_id']);
        return response()->json($blogssubCategories);
    }
    public function show()
    {
        //
    }

  
    public function edit($id)
    {
        $edit = Cfeatures::findOrFail($id);
        $cfeatures = Cfeatures::all();
        $BlogsSubCategories = BlogsSubCategories::orderBy('id')->get();
        return view('cfeatures.edit', compact('edit','categories', 'BlogsSubCategories'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'instructor' => 'required',
            'rating' => 'required',
            'lectures' => 'required',
            'duration' => 'required',
            'skilllevel' => 'required',
            'language' => 'required',
            'coursetype' => 'required',
            'address' => $request->coursetype == 'Onsite' ? 'required' : '', 
            'title' => 'required',
            'blog_category_id' => 'required',
            'blog_sub_category_id' => 'required',
            'feature_image' => 'required|image|mimes:jpeg,jpg,png', 
            'description' => 'required',
        ]);
    
        $edit = Cfeatures::findOrFail($id);
        $edit->instructor = $request->instructor;
        $edit->rating = $request->rating;
        $edit->lectures = $request->lectures;
        $edit->duration = $request->duration;
        $edit->skilllevel = $request->skilllevel; 
        $edit->language = $request->language;
        $edit->coursetype = $request->coursetype;
        $edit->address = $request->address;
        $edit->title = $request->title;
        $edit->blog_category_id = $request->blog_category_id;
        $edit->blog_sub_category_id = $request->blog_sub_category_id;
        $edit->feature_image = $request->feature_image;
        $edit->description = $request->description;
        $edit->update($request->all());
    
        Toastr::success('Course detail Updated Successfully!');
        return redirect()->route('cfeatures.index')->with(compact('edit')); 
    }
    

    public function destroy($id)
    {
        $data = Cfeatures::findOrFail($id);
        if($data)
        {
            $data->delete();
            return redirect()->back()->with('flash_message', 'Course Detail Deleted Successfully');;
        }else{
            abort(404);
        }
    }
}
