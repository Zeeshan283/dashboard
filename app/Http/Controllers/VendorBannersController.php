<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VendorBanners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as Image;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;

class VendorBannersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vendorBanners = User::find(Auth::User()->id);
        return view('vendor-banners.index',compact('vendorBanners'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'image1' => 'image|mimes:jpeg,jpg,png',
            'image2' => 'image|mimes:jpeg,jpg,png',
            'image3' => 'image|mimes:jpeg,jpg,png',
        ]);
        $userBanner = User::find(Auth::User()->id);

        if ($request->hasFile('image1')) {
            File::delete('root/upload/vendor-banners/'.$userBanner->banner_image1);

            $file = $request->file('image1');
            $fileName = uniqid() . $file->getClientOriginalName();

            //Vendor Profile Banner image save in 820 x 430
            $imagePath =  base_path('upload/vendor-banners/' . $fileName);
            $img = Image::make($file);
            $img->resize(820, 430);
            $img->save($imagePath);

            $userBanner->banner_image1 = $fileName;
            $userBanner->save();
        }
        if ($request->hasFile('image2')) {
            File::delete('root/upload/vendor-banners/'.$userBanner->banner_image2);

            $file = $request->file('image2');
            $fileName = uniqid() . $file->getClientOriginalName();

            //Vendor Profile Banner image save in 400 x 205
            $imagePath =  base_path('upload/vendor-banners/' . $fileName);
            $img = Image::make($file);
            $img->resize(400, 205);
            $img->save($imagePath);

            $userBanner->banner_image2 = $fileName;
            $userBanner->save();
        }
        if ($request->hasFile('image3')) {
            File::delete('root/upload/vendor-banners/'.$userBanner->banner_image3);
            
            $file = $request->file('image3');
            $fileName = uniqid() . $file->getClientOriginalName();

            //Vendor Profile Banner image save in 400 x 205
            $imagePath =  base_path('upload/vendor-banners/' . $fileName);
            $img = Image::make($file);
            $img->resize(400, 205);
            $img->save($imagePath);

            $userBanner->banner_image3 = $fileName;
            $userBanner->save();
        }

        return redirect()->back()->with(Toastr::success('Banner Updated Successfully!'));
    }
}
