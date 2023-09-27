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
        $banners = Banners::OrderBy('id')->get(['id', 'title1', 'title2', 'offer','image','bg_image']);
        return view('banners.index', compact('banners'));
    }

    public function create()
    {
        return view('banners.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title1' => 'required',
            'title2' => 'required',
            'offer' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg',
            'bg_image' => 'required|mimes:jpg,png,jpeg',
            'url' => 'required'
        ]);
        
        $banner = Banners::create($request->all());

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();

            //banner image save in 474 x 397
            $imagePath = 'upload/banners/' . $fileName;
            $img = Image::make($file);
            // $img->resize(474, 397);
            $img->save($imagePath);

            $banner->image =   '/upload/banners/' . $fileName;
            $banner->save();
        }
        if ($request->hasFile('bg_image')) {
            $file = $request->file('bg_image');
            $fileName = uniqid() . $request->file('bg_image')->getClientOriginalName();

            //banner image save in 1903 x 520
            $imagePath = 'upload/banners/' . $fileName;
            $img = Image::make($file);
            // $img->resize(1903, 520);
            $img->save($imagePath);

            $banner->bg_image =   '/upload/banners/' . $fileName;
            $banner->save();
        }
        Toastr::success('Banner Added Successfully!', 'Success');
        return redirect()->back();
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
            'title1' => 'required',
            'title2' => 'required',
            'offer' => 'required',
            'image' => 'mimes:jpg,png,jpeg',
            'bg_image' => 'mimes:jpg,png,jpeg',
            'url' => 'required'
        ]);

        $edit1 = Banners::findOrFail($id);
        $edit = Banners::findOrFail($id);
        $edit->update($request->all());

        if ($request->hasFile('image')) {
            // return ./root/upload/banners/' . $edit1->image;
            File::delete('upload/banners/' . $edit1->image);

            $file = $request->file('image');
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();

            //banner image save in 474 x 397
            $imagePath =  'upload/banners/' . $fileName;

            $img = Image::make($file);
            // $img->resize(474, 397);
            $img->save($imagePath);

            $edit->image =   '/upload/banners/' . $fileName;
            $edit->save();
        }
        if ($request->hasFile('bg_image')) {
            File::delete('root/upload/banners/' . $edit1->bg_image);

            $file = $request->file('bg_image');
            $fileName = uniqid() . $request->file('bg_image')->getClientOriginalName();

            //banner image save in 1903 x 520
            $imagePath =  'upload/banners/' . $fileName;
            $img = Image::make($file);
            // $img->resize(1903, 520);
            $img->save($imagePath);

            $edit->bg_image =   '/upload/banners/' . $fileName;
            $edit->save();
        }
        Toastr::success('Banner Updated Successfully!', 'Success');
        return redirect('banners');
    }

    public function destroy($id)
    {
        $banner = Banners::findOrFail($id);
        File::delete('upload/banners/' . $banner->image);
        File::delete('upload/banners/' . $banner->bg_image);
        $banner->delete();
        Toastr::success('Banner Deleted Successfully!');
        return redirect()->back();
    }
}