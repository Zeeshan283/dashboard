<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as Image;

class BannersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $banners = Banners::OrderBy('id')->get(['id', 'title1', 'title2', 'offer']);
        return view('banners.index', compact('banners'));
    }

    public function create()
    {
        return view('banners.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title1' => 'required|max:15',
            'title2' => 'required|max:15',
            'offer' => 'required|max:20',
            'image' => 'required|mimes:jpg,png,jpeg',
            'bg_image' => 'required|mimes:jpg,png,jpeg',
            'url' => 'required'
        ]);
        $banner = Banners::create($request->all());

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();

            //banner image save in 474 x 397
            $imagePath =  base_path('upload/banners/' . $fileName);
            $img = Image::make($file);
            $img->resize(474, 397);
            $img->save($imagePath);

            $banner->image = $request->root() . '/root/upload/banners/' . $fileName;
            $banner->save();
        }
        if ($request->hasFile('bg_image')) {
            $file = $request->file('bg_image');
            $fileName = uniqid() . $request->file('bg_image')->getClientOriginalName();

            //banner image save in 1903 x 520
            $imagePath = base_path('upload/banners/' . $fileName);
            $img = Image::make($file);
            $img->resize(1903, 520);
            $img->save($imagePath);

            $banner->bg_image = $request->root() . '/root/upload/banners/' . $fileName;
            $banner->save();
        }

        return redirect()->back()->with(Toastr::success('Banner Added Successfully!'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit = Banners::findOrFail($id);
        return view('banners.edit', compact('edit'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title1' => 'required|max:15',
            'title2' => 'required|max:15',
            'offer' => 'required|max:20',
            'image' => 'mimes:jpg,png,jpeg',
            'bg_image' => 'mimes:jpg,png,jpeg',
            'url' => 'required'
        ]);

        $edit1 = Banners::findOrFail($id);
        $edit = Banners::findOrFail($id);
        $edit->update($request->all());

        if ($request->hasFile('image')) {
            // return $request->root().'/root/upload/banners/' . $edit1->image;
            File::delete('root/upload/banners/' . $edit1->image);

            $file = $request->file('image');
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();

            //banner image save in 474 x 397
            $imagePath =  base_path('upload/banners/' . $fileName);

            $img = Image::make($file);
            $img->resize(474, 397);
            $img->save($imagePath);

            $edit->image = $request->root() . '/root/upload/banners/' . $fileName;
            $edit->save();
        }
        if ($request->hasFile('bg_image')) {
            File::delete('root/upload/banners/' . $edit1->bg_image);

            $file = $request->file('bg_image');
            $fileName = uniqid() . $request->file('bg_image')->getClientOriginalName();

            //banner image save in 1903 x 520
            $imagePath =  base_path('upload/banners/' . $fileName);
            $img = Image::make($file);
            $img->resize(1903, 520);
            $img->save($imagePath);

            $edit->bg_image = $request->root() . '/root/upload/banners/' . $fileName;
            $edit->save();
        }

        return redirect('banners')->with(Toastr::success('Banner Updated Successfully!'));
    }

    public function destroy($id)
    {
        $banner = Banners::findOrFail($id);
        File::delete('root/upload/banners/' . $banner->image);
        File::delete('root/upload/banners/' . $banner->bg_image);
        $banner->delete();

        return redirect()->back()->with(Toastr::success('Banner Deleted Successfully!'));
    }
}