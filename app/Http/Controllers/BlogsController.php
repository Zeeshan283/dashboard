<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\BlogsCategories;
use App\Models\BlogsSubCategories;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Notifications\TestingNotification;
use App\Models\User;

class BlogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = BlogsCategories::all();
        $blogs = Blogs::with('blogSubCategory', 'blogCategory')->get();
        return view('blogs.index', compact('categories', 'blogs'));
    }

    public function create()
    {
        $categories = BlogsCategories::orderBy('id')->get();
        $BlogsSubCategories = BlogsSubCategories::orderBy('id')->get();
        return view('blogs.create', compact('categories', 'BlogsSubCategories'));
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
            $file->move(public_path('upload/blogs/'), $fileName);
            $blog->feature_image = $fileName;
        }

        $blog->save();
        $blog->notify(new TestingNotification(900));
        // dd($blog->notifications);
        return redirect()->back()->with('success', 'Blog Created Successfully');

        // $testNotification = Blogs::first();
        // $testNotification->notify(new TestingNotification(900));
        // dd($testNotification->notifications);
    }

    public function show(BlogsCategories $blogsCategories)
    {
        //
    }

    public function getSubCategories(Request $request)
    {
        $blogssubCategories = BlogsSubCategories::where('blog_category_id', $request->cat_id)->get(['id', 'blog_sub_category_id']);
        return response()->json($blogssubCategories);
    }

    public function edit($id)
    {
        $edit = Blogs::findOrFail($id);
        $categories = BlogsCategories::all();
        $BlogsSubCategories = BlogsSubCategories::orderBy('id')->get();

        return view('blogs.edit', compact('edit', 'categories', 'BlogsSubCategories'));
    }


    public function update($id, Request $request)
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
            $file->move(public_path('upload/blogs/'), $fileName);
            $edit->feature_image = $fileName;
            $edit->save();
        }

        $edit->save();
        return redirect()->back()->with(Toastr::success('Blog  Updated Successfully'));
    }

    public function destroy($id)
    {
        $blog = Blogs::findOrFail($id);
        $blog->delete();
        return redirect()->back()->with(Toastr::success('Blogs Deleted Successfully'));
    }
}
