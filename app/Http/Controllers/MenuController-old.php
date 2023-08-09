<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Intervention\Image\Facades\Image as Image;
use Brian2694\Toastr\Facades\Toastr;
use App\Traits\fontAwesomeTrait;
use Illuminate\Support\Facades\File;

class MenuController extends Controller
{
    use fontAwesomeTrait;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Menu::select('id', 'name', 'icon')->OrderBy('id', 'asc')->get();
        return view('menus.index', compact('data'));
    }

    public function create()
    {
        $data = $this->fontIndex();
        return view('menus.create', compact('data'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'icon' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);

        $menu = Menu::create($request->all());

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = uniqid() . $file->getClientOriginalName();
            $imagePath =  'root/upload/menu/' . $fileName;

            $img = Image::make($file);
            $img->resize(1100, 450);
            $img->save($imagePath);

            $menu->image = $fileName;
            $menu->save();
        }


        return redirect()->back()->with(Toastr::success('Menu Added Successfully!'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit = Menu::findOrFail($id);
        $data = $this->fontIndex();
        return view('menus.edit', compact('edit', 'data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'icon' => 'required',
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        $edit1 = Menu::findOrFail($id);
        $edit = Menu::findOrFail($id);
        $edit->update($request->all());

        if ($request->hasFile('image')) {
            File::delete('root/upload/menu/' . $edit1->image);

            $file = $request->file('image');
            $fileName = uniqid() . $file->getClientOriginalName();
            $imagePath =  'root/upload/menu/' . $fileName;

            $img = Image::make($file);
            // $img->resize(235, 356);
            $img->resize(1100, 450);
            $img->save($imagePath);

            $edit->image = $fileName;
            $edit->save();
        }

        return redirect('/menus')->with(Toastr::success('Menu Updated Successfully!'));
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        File::delete('root/upload/menu/' . $menu->image);
        $menu->delete();
        return redirect()->back()->with(Toastr::success('Menu Deleted Successfully!'));
    }
}
