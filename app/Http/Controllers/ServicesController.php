<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\File;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;


class ServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Services::where('vendor_id',Auth::user()->id)->OrderBy('id')->get(['id', 'title', 'image','description']);
        return view('sellers.services.index', compact('data'));
    }

    public function create()
    {
        return view('sellers.services.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'vendor_id' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);
        $s = Services::create($request->all());

        $s->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));
        $s->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = uniqid() . $file->getClientOriginalName();

            //Service image save in 1200 x 800
            $imagePath =  'upload/vendorProfile/services/' . $fileName;
            $img = Image::make($request->file('image'));
            $img->save($imagePath);


            $s->image = $imagePath;
            $s->save();
        }

        return redirect('/services')->with(Toastr::success('Service Added Successfully!'));
    }

    public function show(Services $services)
    {
        //
    }

    public function edit($id)
    {
        $edit = Services::findOrFail($id);
        return view('sellers.services.edit', compact('edit'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);
        $edit1 = Services::findOrFail($id);
        $edit = Services::findOrFail($id);
        $edit->update($request->all());

        $edit->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));
        $edit->save();


        if ($request->hasFile('image')) {
            File::delete($edit1->image);
            
            $file = $request->file('image');
            $fileName = uniqid() . $file->getClientOriginalName();

            //Service image save in 1200 x 800
            $imagePath =  'upload/vendorProfile/services/' . $fileName;
            $img = Image::make($request->file('image'));
            $img->save($imagePath);

            $edit->image = $imagePath;
            $edit->save();
        }

        return redirect('/services')->with(Toastr::success('Service Updated Successfully!'));
    }

    public function destroy($id)
    {
        $s = Services::findOrFail($id);
        File::delete( $s->image);
        $s->delete();

        return redirect('/services')->with(Toastr::success('Service Deleted Successfully!'));
    }
    
    public function uploadImage(Request $request){
         $filename = $request->file('file')->getClientOriginalName();

         $path = $request->file('file')->move('root/upload/services/', $filename);
        return response()->json(['location' => '../root/upload/services/'.$filename]);
    }
}
