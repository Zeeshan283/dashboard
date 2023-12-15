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
        $BlogsSubCategories = BlogsSubCategories::orderBy('id')->get();
        return view('cfeatures.create', compact('categories', 'BlogsSubCategories'));
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
            // 'feature_image' => 'required|image|mimes: jpeg, jpg, png', 
            'image' => 'mimes:png,jpg,jpeg',
            'description' => 'required', 
        ]);
    
        $cfeature = new Cfeatures(); 
    
        // if ($request->hasFile('feature_image')) {
        //     $file = $request->file('feature_image');
        //     $fileName = uniqid() . '.' . $file->getClientOriginalExtension();    
        //     $file->move(public_path('upload/blogs/'), $fileName);
        //     $cfeature->feature_image = $fileName;
        // }
        if ($request->hasFile('image')) {
        }
    
        // Set other attributes and save the model
        $cfeature->instructor = $request->instructor;
        $cfeature->rating = $request->rating;
        $cfeature->lectures = $request->lectures; 
        $cfeature->duration = $request->duration;
        $cfeature->skilllevel = $request->skilllevel; 
        $cfeature->language = $request->language;
        $cfeature->coursetype = $request->coursetype;
        $cfeature->address = $request->address;
        $cfeature->title = $request->title;
        $cfeature->blog_category_id = $request->blog_category_id;
        $cfeature->blog_sub_category_id = $request->blog_sub_category_id;
        $cfeature->image = $request->image;
        $cfeature->description = $request->description;
    
        $cfeature->save();
    
        return redirect()->back()->with('success', 'Course Features Added Successfully');
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
        $categories = BlogsCategories::all();
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
            // 'feature_image' => 'nullable|image|mimes:jpeg,jpg,png', 
            'image' => 'mimes:png,jpg,jpeg',
            'description' => 'required',
        ]);
    
        $edit = Cfeatures::findOrFail($id);
    
        // if ($request->hasFile('feature_image')) {
        //     $file = $request->file('feature_image');
        //     $fileName = uniqid() . '.' . $file->getClientOriginalExtension();    
        //     $file->move(public_path('upload/blogs/'), $fileName);
        //     $edit->feature_image = $fileName;
        // }

        if ($request->hasFile('image')) {
            // Process and save the updated image for the main menu
        }
        // Set other attributes and save the model
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
        $edit->image = $request->image;
        $edit->description = $request->description;
    
        $edit->save();
    
        return redirect()->back()->with(Toastr::success('Details Updated Successfully'));
    }

    public function destroy($id)
    {
        $data = Cfeatures::findOrFail($id);
        if($data)
        {
            $data->delete();
            return redirect()->back()->with(Toastr::success('Blogs Deleted Successfully'));
        }else{
            abort(404);
        }
    }
}