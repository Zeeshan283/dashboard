<?php

namespace App\Http\Controllers;

use App\Models\VendorAlbum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;

class VendorAlbumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vendorAlbums = VendorAlbum::select('id','image')->where('vendor_id', Auth::User()->id)->orderBy('id','desc')->get();
        return view('vendor-album.index',compact('vendorAlbums'));
    }

    public function UploadImageAJax(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if (!$validation->failed()) {
            $imagesName = [];
            foreach ($request->select_file as $key => $file) {
                $image = $file;
                $new_name = uniqid() . $image->getClientOriginalName();
                
                $imagePath =  base_path('upload/vendor-album/' . $new_name);
                $img = Image::make($image);
                $img->resize(190, 182);
                $img->save($imagePath);

                $imagesName[$key] = $new_name;

                $vendorAlbum = new VendorAlbum();
                $vendorAlbum->image = $new_name;
                $vendorAlbum->vendor_id = Auth::User()->id;
                $vendorAlbum->save();
            }
            return response()->json($imagesName);
        } else {
            return response()->json([
                'message'   => $validation->errors()->all(),
                'uploaded_image' => '',
                'class_name'  => 'alert-danger'
            ]);
        }
    }

    public function DeleteImageAJax(Request $request)
    {
        File::delete('root/upload/vendor-album/' . $request->path);

        VendorAlbum::where('image', $request->path)->delete();
        return "Deleted";
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'images.0' =>'required'
        ],[
            'images.0.required'=>'The image field is required.'
        ]);
        
        $count = count($request->images);
        for($i=0;$i<$count;$i++)
        {
            $vendorAlbum = new VendorAlbum();
            $vendorAlbum->image = $request->images[$i];
            $vendorAlbum->vendor_id = Auth::User()->id;
            $vendorAlbum->save();
        }

        return redirect()->back()->with(Toastr::success('New Album Image Added Successfully!'));
    }

    public function destroy($id)
    {
        $vendorAlbum = VendorAlbum::find($id);
        File::delete('root/upload/vendor-album/'.$vendorAlbum->image);
        $vendorAlbum->delete();

        return redirect()->back()->with(Toastr::success('Album Image Deleted Successfully!'));
    }
}
