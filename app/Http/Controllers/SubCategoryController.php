<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as Image;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = SubCategory::with('categories:id,name')->OrderBy('name', 'asc')->get();
        return view('category.allsubcat', compact('data'));
    }

    public function create()
    {
        $categories = Category::OrderBy('id', 'asc')->pluck('name', 'id');
        return view('category.createsubcat', Compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'category_id'=>'required',
            'name' => 'required',
            'img'=>'mimes:png,jpg,jpeg',
            'slug'=>'required',
        ]);

        $s = SubCategory::create($request->all());
        // $s->slug = Str::slug($request->name);
        $s->save();
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = uniqid() . $file->getClientOriginalName();
            $imagePath =  'upload/subcategory/' .$fileName;

            $img = Image::make($file);
            // $img->resize(100, 100);
            $img->save($imagePath);

            $s->img = 'upload/subcategory/'.$fileName;
            $s->save();
        }
        Toastr::success('Sub-Category Added Successfully!', 'Success');
        return redirect()->route('sub-category.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit = SubCategory::findOrFail($id);
        $categories = Category::OrderBy('id', 'asc')->pluck('name', 'id');
        return view('category.editsubcat', Compact('edit', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'category_id'=>'required',
            'name' => 'required',
        ]);
        $update = SubCategory::findOrFail($id);
        $update1 = SubCategory::findOrFail($id);
        $update->update($request->all());
        $update->slug = Str::slug($request->name);
        $update->save();
        if ($request->hasFile('img')) {
            File::delete($update1->img);
            $file = $request->file('img');
            $fileName = uniqid() . $file->getClientOriginalName();
            $imagePath =  'upload/subcategory/' .$fileName;

            $img = Image::make($file);
            // $img->resize(100, 100);
            $img->save($imagePath);

            $update->img = 'upload/subcategory/'.$fileName;
            $update->save();
        }
        Toastr::success('Sub-Category Update Successfully!', 'Success');
        return redirect()->route('sub-category.index');
    }

    public function destroy($id)
    {
        $delete = SubCategory::findOrFail($id);
        File::delete($delete->img);
        // File::delete($delete->imageforapp);
        $delete->delete();

        Toastr::success('Sub-Category Delete Successfully!', 'Deleted');
        return redirect()->route('sub-category.index');


    }
}
