<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HomeSettings;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as Image;

class HomeSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::orderBy('id')->pluck('name', 'id');
        $homeSettings = HomeSettings::find(1);
        return view('home-settings.index', compact('categories', 'homeSettings'));
    }

    public function UpdateHomeSettings(Request $request)
    {
        $this->validate($request, [
            'category1_image' => 'mimes:png,jpg,jpeg',
            'category2_image' => 'mimes:png,jpg,jpeg',
            'category3_image' => 'mimes:png,jpg,jpeg',
            'category4_image' => 'mimes:png,jpg,jpeg',
            'center_image1' => 'mimes:png,jpg,jpeg',
            'center_image2' => 'mimes:png,jpg,jpeg'
        ]);
        $h1 = HomeSettings::find(1);
        $h = HomeSettings::find(1);
        $h->update($request->all());

        if ($request->hasFile('category1_image')) {
            File::delete($h1->category1_image);

            $fileName = uniqid().'.'.$request->file('category1_image')->getClientOriginalExtension();

            //Home Settings image save in 295 x 672 
            $imagePath =  base_path('upload/home-settings/' . $fileName);
            $img = Image::make($request->file('category1_image'));
            $img->resize(295, 672);
            $img->save($imagePath);

            $h->category1_image = $request->root().'/root/upload/home-settings/'.$fileName;
            $h->save();
        }
        if ($request->hasFile('category2_image')) {
            File::delete($h1->category2_image);

            $fileName = uniqid().'.'.$request->file('category2_image')->getClientOriginalExtension();

            //Home Settings image save in 295 x 672 
            $imagePath =  base_path('upload/home-settings/' . $fileName);
            $img = Image::make($request->file('category2_image'));
            $img->resize(295, 672);
            $img->save($imagePath);

            $h->category2_image = $request->root().'/root/upload/home-settings/'.$fileName;
            $h->save();
        }
        if ($request->hasFile('category3_image')) {
            File::delete($h1->category3_image);

            $fileName = uniqid().'.'.$request->file('category3_image')->getClientOriginalExtension();

            //Home Settings image save in 295 x 672 
            $imagePath =  base_path('upload/home-settings/' . $fileName);
            $img = Image::make($request->file('category3_image'));
            $img->resize(295, 672);
            $img->save($imagePath);

            $h->category3_image = $request->root().'/root/upload/home-settings/'.$fileName;
            $h->save();
        }
        if ($request->hasFile('category4_image')) {
            File::delete($h1->category4_image);

            $fileName = uniqid().'.'.$request->file('category4_image')->getClientOriginalExtension();

            //Home Settings image save in 295 x 672 
            $imagePath =  base_path('upload/home-settings/' . $fileName);
            $img = Image::make($request->file('category4_image'));
            $img->resize(295, 672);
            $img->save($imagePath);

            $h->category4_image = $request->root().'/root/upload/home-settings/'.$fileName;
            $h->save();
        }
        if ($request->hasFile('center_image1')) {
            File::delete($h1->center_image1);

            $fileName = uniqid().'.'.$request->file('center_image1')->getClientOriginalExtension();

            //Home Settings image save in 610 x 200 
            $imagePath =  base_path('upload/home-settings/' . $fileName);
            $img = Image::make($request->file('center_image1'));
            $img->resize(610, 200);
            $img->save($imagePath);

            $h->center_image1 = $request->root().'/root/upload/home-settings/'.$fileName;
            $h->save();
        }
        if ($request->hasFile('center_image2')) {
            File::delete($h1->center_image2);

            $fileName = uniqid().'.'.$request->file('center_image2')->getClientOriginalExtension();

            //Home Settings image save in 610 x 200 
            $imagePath =  base_path('upload/home-settings/' . $fileName);
            $img = Image::make($request->file('center_image2'));
            $img->resize(610, 200);
            $img->save($imagePath);

            $h->center_image2 = $request->root().'/root/upload/home-settings/'.$fileName;
            $h->save();
        }

        return redirect()->back()->with(Toastr::success('Home Setting Added Successfully!'));
    }
}
