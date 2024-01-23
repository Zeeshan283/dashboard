<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Menu;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as Image;
// use Intervention\Image\ImageManagerStatic as Image;

class CategoryController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  // public function index()
  // {
  //   $data = Category::orderby('id','asc')->get();
  //   $menus = Menu::all();
  //   return view('category.allcat', compact('data','menus'));
  // }

  public function index()
  {
    $data = Category::orderby('id', 'asc')->get();
    $menus = Menu::all();

    return view('category.allcat', compact('data', 'menus'));
  }

  public function create()
  {
    $menus = Menu::all();

    return view('category.addcat', compact('menus'));
  }

  public function store(Request $request)
  {
    //dd($request->all());
    //return $request;
    $this->validate($request, [
      'name' => 'required',
      'menu_id' => 'required',
      'commission' => '',
      'img' => 'mimes:png,jpg,jpeg',
      'imageforapp' => 'mimes:png,jpg,jpeg',
      //   'menu' => 'required',
    ], [
      'menu_id.required' => 'The menu field is required'
    ]);

    $cat = Category::create($request->all());
    if ($request->hasFile('img')) {
      $file = $request->file('img');
      $fileName = uniqid() . $file->getClientOriginalName();
      $imagePath =  'upload/category/' . $fileName;

      $img = Image::make($file);
      // $img->resize(1920, 500);
      $img->save($imagePath);

      $cat->img = 'upload/category/' . $fileName;
      $cat->save();
    }
    if ($request->hasFile('imageforapp')) {
      $file = $request->file('imageforapp');
      $fileName = uniqid() . $file->getClientOriginalName();
      $appimagePath =  'upload/category/' . $fileName;

      $img = Image::make($file);
      // $img->resize(100, 100);
      $img->save($appimagePath);

      $cat->imageforapp = 'upload/category/' . $fileName;
      $cat->save();
    }

    if ($request->hasFile('side_sliders')) {
      foreach ($request->file('side_sliders') as $image) {
        if ($image->isValid()) {
          $extension = $image->getClientOriginalExtension();
          $fileName = uniqid() . '.' . $extension;
          $path = $image->move('upload/category/sliders', $fileName);

          $images[] = $path->getPathname();
        }
      }

      // Merge the new images with the existing ones
      $existingImages = json_decode($cat->side_sliders, true);

      if (is_array($existingImages)) {
        $images = array_merge($existingImages, $images);
      } else {
        // Handle the case where JSON decoding failed or $existingImages is not an array
      }
      $cat->side_sliders = json_encode($images);
      $cat->save();
    }

    // return redirect()->back()->with(Toastr::success('Category Added Successfully!'));
    Toastr::success('Category created successfully', 'Success');
    return redirect()->route('allcat');
  }

  // public function show($id)
  // {
  //   $data =  Category::findOrfail($id);

  //   return view('allcat',compact('data'));
  // }

  public function edit($id)
  {
    $data = Category::with('menus')->orderBy('id', 'asc')->get();

    $edit = Category::where('id', $id)->first();

    $cat_name = Menu::where('id', $edit->menu_id)->first();

    $menus = Menu::all();
    $menuNames = [];

    foreach ($data as $category) {
      $cat_menu = Menu::find($category->menu_id);
      $menuNames[$category->id] = $cat_menu ? $cat_menu->name : 'Menu Not Found';
    }

    return view('category.editcat', compact('edit', 'menus', 'cat_name', 'data', 'menuNames'));
  }
  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'name' => 'required',
      'menu_id' => 'required',
      'commission' => '',
      'img' => 'mimes:png,jpg,jpeg',
      'imageforapp' => 'mimes:png,jpg,jpeg',
      //   'menu' => 'required',
    ], [
      'menu_id.required' => 'The menu field is required'
    ]);

    $update1 = Category::findOrFail($id);
    $update = Category::findOrFail($id);
    $update->update($request->all());


    if ($request->hasFile('img')) {
      File::delete($update1->img);
      $file = $request->file('img');
      $fileName = uniqid() . $file->getClientOriginalName();
      $imagePath = 'upload/category/' . $fileName;

      $img = Image::make($file);
      // $img->resize(100, 100);
      $img->save($imagePath);

      $update->img = 'upload/category/' . $fileName;
      $update->save();
    }

    if ($request->hasFile('imageforapp')) {
      File::delete($update1->imageforapp);
      $file = $request->file('imageforapp');
      $fileName = uniqid() . $file->getClientOriginalName();
      $imagePath =  'upload/category/' . $fileName;

      $img = Image::make($file);
      // $img->resize(100, 100);
      $img->save($imagePath);

      $update->imageforapp = 'upload/category/' . $fileName;
      $update->save();
    }

    if ($request->hasFile('side_sliders')) {
      foreach ($request->file('side_sliders') as $image) {
        if ($image->isValid()) {
          $extension = $image->getClientOriginalExtension();
          $fileName = uniqid() . '.' . $extension;
          $path = $image->move('upload/category/sliders', $fileName);

          $images[] = $path->getPathname();
        }
      }

      // Merge the new images with the existing ones
      $existingImages = json_decode($update->side_sliders, true);

      if (is_array($existingImages)) {
        $images = array_merge($existingImages, $images);
      } else {
        // Handle the case where JSON decoding failed or $existingImages is not an array
      }
      $update->side_sliders = json_encode($images);
      $update->save();
    }


    Toastr::success('Category Updated successfully', 'Success');
    return redirect()->route('allcat');
  }

  public function destroy($id)
  {
    $delete = Category::findOrFail($id);
    File::delete($delete->img);
    File::delete($delete->imageforapp);
    File::delete($delete->side_sliders);
    $delete->delete();
    Toastr::success('Category deleted successfully', 'Success');
    return redirect()->route('allcat');
  }
}
