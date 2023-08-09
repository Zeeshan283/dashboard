<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $data = Category::with('menus')->get();
    return view('categories.index', compact('data'));
  }

  public function create()
  {
    $code = Category::OrderBy('id', 'asc')->get();
    if (count($code) > 0) {
      $codes = (int)$code->last()->code + 1;
    } else {
      $codes = 1;
    }
    $menu = Menu::OrderBy('id', 'asc')->pluck('name', 'id');
    return view('categories.create', compact('codes', 'menu'));
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required',
      'menu_id' => 'required',
      'commission' => 'required',
      'mimes:png,jpg,jpeg'
    ], [
      'menu_id.required' => 'The menu field is required'
    ]);

    $cat = Category::create($request->all());
    if (!is_null($request->file('img'))) {
      $imageName = $request->file('img')->getClientOriginalName();
      $request->file('img')->move(
        base_path() . '/upload/category/',
        $imageName
      );

      $cat->img = $imageName;
      $cat->save();
    }

    return redirect()->back()->with(Toastr::success('Category Added Successfully!'));
  }

  public function show($id)
  {
    //
  }

  public function edit($id)
  {
    $edit = Category::findOrFail($id);
    $menu = Menu::OrderBy('id', 'asc')->pluck('name', 'id');
    return view('categories.edit', compact('edit', 'menu'));
  }

  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'name' => 'required',
      'menu_id' => 'required',
      'commission' => 'required',
      'mimes:png,jpg,jpeg'
    ], [
      'menu_id.required' => 'The menu field is required'
    ]);

    $update1 = Category::findOrFail($id);
    $update = Category::findOrFail($id);
    $update->update($request->all());


    if (!is_null($request->file('img'))) {
      File::delete('root/upload/category/' . $update1->img);

      $imageName = $request->file('img')->getClientOriginalName();
      $request->file('img')->move(
        base_path() . '/upload/category/',
        $imageName
      );

      $update->img = $imageName;
      $update->save();
    }

    return redirect('categories')->with(Toastr::success('Category Updated Successfully!'));
  }

  public function destroy($id)
  {
    $delete = Category::findOrFail($id);
    File::delete('root/upload/category/' . $delete->img);
    $delete->delete();
    return redirect()->back()->with(Toastr::success('Category Deleted Successfully!'));
  }
}
