<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
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

  public function index()
  {
    $data = Category::orderby('id','asc')->get();
    return view('category.allcat', compact('data'));
  }

  public function create()
  {
    $menus = Menu::all();
    return view('category.addcat', compact('menus'));
  }

  public function store(Request $request)
  {
    // dd($request->all());
    //return $request;
    $this->validate($request, [
      'name' => 'required',
      'menu_id' => 'required',
      'commission' => 'required',
      'img'=>'mimes:png,jpg,jpeg',
      'imageforapp'=>'mimes:png,jpg,jpeg',
    ], [
      'menu_id.required' => 'The menu field is required'
    ]);

    $cat = Category::create($request->all());
    if ($request->hasFile('img')) {
      $file = $request->file('img');
      $fileName = uniqid() . $file->getClientOriginalName();
      $imagePath =  'upload/category/' . $fileName;

      $img = Image::make($file);
      $img->resize(100, 100);
      $img->save($imagePath);

      $cat->img = 'upload/category/'.$fileName;
      $cat->save();
  }
    if ($request->hasFile('imageforapp')) {
      $file = $request->file('imageforapp');
      $fileName = uniqid() . $file->getClientOriginalName();
      $imagePath =  'upload/category/' . $fileName;

      $img = Image::make($file);
      $img->resize(100, 100);
      $img->save($imagePath);

      $cat->imageforapp ='upload/category/'.$fileName;
      $cat->save();
  }

    return redirect()->back()->with(Toastr::success('Category Added Successfully!'));
  }

  public function show($id)
  {
    $data =  Category::findOrfail($id);
    return view('allcat',compact('data'));
  }

  public function edit($id)
  {
      $edit = Category::findOrFail($id);
      // dd($edit);
      // $menus = Menu::orderBy('id', 'asc')->get();
      $menus= Menu::all();
      return view('category.editcat', compact('edit', 'menus'));
  }
  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'name' => 'required',
      'menu_id' => 'required',
      'commission' => 'required',
      'img'=>'mimes:png,jpg,jpeg',
      'imageforapp'=>'mimes:png,jpg,jpeg',
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
      $imagePath =  'upload/category/' . $fileName;

      $img = Image::make($file);
      $img->resize(100, 100);
      $img->save($imagePath);

      $update->img = 'upload/category/'.$fileName;
      $update->save();
  }
    if ($request->hasFile('imageforapp')) {
      File::delete($update1->imageforapp);
      $file = $request->file('imageforapp');
      $fileName = uniqid() . $file->getClientOriginalName();
      $imagePath =  'upload/category/' . $fileName;

      $img = Image::make($file);
      $img->resize(100, 100);
      $img->save($imagePath);

      $update->imageforapp ='upload/category/'.$fileName;
      $update->save();
  }


    if (!is_null($request->file('img'))) {
      File::delete($update1->img);

      $imageName = $request->file('img')->getClientOriginalName();
      $request->file('img')->move(
        base_path() . '/upload/category/',
        $imageName
      );

      $update->img = 'root/upload/category/'.$imageName;
      $update->save();
    }
    if (!is_null($request->file('imageforapp'))) {
      File::delete($update1->imageforapp);

      $imageName = $request->file('imageforapp')->getClientOriginalName();
      $request->file('imageforapp')->move(
        base_path() . '/upload/category/',
        $imageName
      );

      $update->img ='upload/category/'.$imageName;
      $update->save();
    }

    return redirect('categories')->with(Toastr::success('Category Updated Successfully!'));
  }

  public function destroy($id)
  {
    $delete = Category::findOrFail($id);
    File::delete($delete->img);
    File::delete($delete->imageforapp);
    $delete->delete();
    return redirect()->back()->with(Toastr::success('Category Deleted Successfully!'));
  }
}
