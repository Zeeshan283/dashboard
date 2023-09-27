<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Intervention\Image\Facades\Image;
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
        $data = Menu::select('id', 'name', 'icon')->orderBy('id', 'desc')->get();
        return view('category.allmenu', compact('data'));
    }

    public function create()
    {
        $data = $this->fontIndex();
        return view('category.addmenu', compact('data'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'icon' => 'required',
            'image' => 'mimes:png,jpg,jpeg',
            'imageforapp' => 'mimes:png,jpg,jpeg'
        ]);

        $menu = Menu::create($request->except(['image', 'imageforapp']));

        if ($request->hasFile('image')) {
            // Process and save the image for the main menu
        }

        if ($request->hasFile('imageforapp')) {
            // Process and save the image for the app
        }

        Toastr::success('Menu Added Successfully!');
        return redirect()->route('allmenu');
    }

    public function edit($id)
    {
        $edit = Menu::findOrFail($id);
        $data = $this->fontIndex();
        return view('category.edit', compact('edit', 'data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'icon' => 'required',
            'image' => 'mimes:png,jpg,jpeg',
            'imageforapp' => 'mimes:png,jpg,jpeg'
        ]);

        $edit = Menu::findOrFail($id);
        $edit->name = $request->input('name');
        $edit->icon = $request->input('icon');
        $edit->save();

        if ($request->hasFile('image')) {
            // Process and save the updated image for the main menu
        }

        if ($request->hasFile('imageforapp')) {
            // Process and save the updated image for the app
        }

        Toastr::success('Menu Updated Successfully!');
        return redirect()->route('allmenu');

    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        // Handle image deletion if needed
        $menu->delete();
        Toastr::success('Menu Deleted Successfully!');
        return redirect()->route('allmenu');

}
}