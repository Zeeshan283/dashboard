<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\File;
use Brian2694\Toastr\Facades\Toastr;

class ServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Services::OrderBy('id')->get(['id', 'title', 'image']);
        return view('services.index', compact('data'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
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
            $imagePath =  base_path('upload/services/big/' . $fileName);
            $img = Image::make($request->file('image'));
            $img->resize(1200, 800);
            $img->save($imagePath);

            //Service image save in 275 x 200
            $imagePath =  base_path('upload/services/medium/' . $fileName);
            $img = Image::make($request->file('image'));
            $img->resize(275, 200);
            $img->save($imagePath);

            //Service image save in 50 x 50
            $imagePath =  base_path('upload/services/small/' . $fileName);
            $img = Image::make($request->file('image'));
            $img->resize(50, 50);
            $img->save($imagePath);

            $s->image = $fileName;
            $s->save();
        }

        return redirect()->back()->with(Toastr::success('Service Added Successfully!'));
    }

    public function show(Services $services)
    {
        //
    }

    public function edit($id)
    {
        $edit = Services::findOrFail($id);
        return view('services.edit', compact('edit'));
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
            File::delete('root/upload/services/small/' . $edit1->image);
            File::delete('root/upload/services/medium/' . $edit1->image);
            File::delete('root/upload/services/big/' . $edit1->image);



            $file = $request->file('image');
            $fileName = uniqid() . $file->getClientOriginalName();

            //Service image save in 1200 x 800
            $imagePath =  base_path('upload/services/big/' . $fileName);
            $img = Image::make($request->file('image'));
            $img->resize(1200, 800);
            $img->save($imagePath);

            //Service image save in 275 x 200
            $imagePath =  base_path('upload/services/medium/' . $fileName);
            $img = Image::make($request->file('image'));
            $img->resize(275, 200);
            $img->save($imagePath);

            //Service image save in 50 x 50
            $imagePath =  base_path('upload/services/small/' . $fileName);
            $img = Image::make($request->file('image'));
            $img->resize(50, 50);
            $img->save($imagePath);

            $edit->image = $fileName;
            $edit->save();
        }

        return redirect('our-services')->with(Toastr::success('Service Updated Successfully!'));
    }

    public function destroy($id)
    {
        $s = Services::findOrFail($id);
        File::delete('root/upload/services/big/' . $s->image);
        File::delete('root/upload/services/medium/' . $s->image);
        File::delete('root/upload/services/small/' . $s->image);
        $s->delete();

        return redirect()->back()->with(Toastr::success('Service Deleted Successfully!'));
    }
    
    public function uploadImage(Request $request){
         $filename = $request->file('file')->getClientOriginalName();

         $path = $request->file('file')->move('root/upload/services/', $filename);
        return response()->json(['location' => '../root/upload/services/'.$filename]);
    }
}
