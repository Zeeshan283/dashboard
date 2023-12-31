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
            $imagePath =  'root/upload/subcategory/' .$fileName;

            $img = Image::make($file);
            $img->resize(100, 100);
            $img->save($imagePath);

            $s->img = 'root/upload/subcategory/'.$fileName;
            $s->save();
        }
        return redirect()->back()->with([
            'success' => 'Sub Category Added Successfully!'
        ]);


    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit = SubCategory::findOrFail($id);
        $categories = Category::OrderBy('id', 'asc')->pluck('name', 'id');
        return view('category.editcat', Compact('edit', 'categories'));
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
            $imagePath =  'root/upload/subcategory/' .$fileName;

            $img = Image::make($file);
            $img->resize(100, 100);
            $img->save($imagePath);

            $update->img = 'root/upload/subcategory/'.$fileName;
            $update->save();
        }

        return redirect()->back()->with([
            'success' => 'Sub Category Added Successfully!'
        ]);
    }

    public function destroy($id)
    {
        $delete = SubCategory::findOrFail($id);
        File::delete($delete->img);
        // File::delete($delete->imageforapp);
        $delete->delete();

        return redirect()->back()->with([
            'success' => 'Sub Category Deleted Successfully!'
        ]);
    }
}
