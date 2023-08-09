<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as Image;

class PartnersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Brand::whereType('partner')->orderBy('brand_name')->get(['id','brand_name']);
        return view('partners.index', compact('data'));
    }

    public function create()
    {
        return view('partners.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'brand_name' => 'required',
            'logo'=>'required|mimes:png,jpg',
            'link'=>'required',
            'type'=>'required'
        ],[
            'brand_name'=>'The Partner name field is required'
        ]);

        $b = Brand::create($request->all());

        if($request->hasFile('logo')){
            $file = $request->file('logo');
            $fileName = uniqid() . $file->getClientOriginalName();
            $imagePath =  'root/upload/partners/'.$fileName;
            
            $img = Image::make($file);
            $img->resize(410, 186);
            $img->save($imagePath);

            $b->logo = $fileName;
            $b->save();
        }

        return redirect()->back()->with('flash_message', 'Partner Added Successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit = Brand::findOrFail($id);
        return view('partners.edit', compact('edit'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'brand_name' => 'required',
            'logo'=>'mimes:png,jpg',
            'link'=>'required',
            'type'=>'required'
        ],[
            'brand_name'=>'The Partner name field is required'
        ]);
        $update1 = Brand::findOrFail($id);
        $update = Brand::findOrFail($id);
        $update->update($request->all());

        if($request->hasFile('logo')){
            File::delete('root/upload/partners/'.$update1->logo);


            $file = $request->file('logo');
            $fileName = uniqid() . $file->getClientOriginalName();
            $imagePath =  'root/upload/partners/'.$fileName;
            
            $img = Image::make($file);
            $img->resize(410, 186);
            $img->save($imagePath);

            $update->logo = $fileName;
            $update->save();
        }

        return redirect('partners')->with('flash_message', 'Partner Updated Successfully!');
    }

    public function destroy($id)
    {
        $delete = Brand::findOrFail($id);
        File::delete('root/upload/partners/'.$delete->logo);
        $delete->delete();
        
        return redirect()->back()->with('flash_message', 'Partner Deleted Successfully!');
    }
}
