<?php

namespace App\Http\Controllers;

use App\Models\Testimonials;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\File;
use Brian2694\Toastr\Facades\Toastr;

class TestimonialsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $testimonials = Testimonials::OrderBy('id')->get();
        return view('testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('testimonials.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'message' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);
        $t = Testimonials::create($request->all());

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = uniqid() . $file->getClientOriginalName();

            //Testimonial image save in 100 x 100 
            $imagePath =  base_path('upload/testimonials/' . $fileName);
            $img = Image::make($request->file('image'));
            $img->resize(100, 100);
            $img->save($imagePath);

            $t->image = $fileName;
            $t->save();
        }

        return redirect()->back()->with(Toastr::success('Testimonial Added Successfully!'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit = Testimonials::findOrFail($id);
        return view('testimonials.edit', compact('edit'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'message' => 'required',
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);
        $edit1 = Testimonials::findOrFail($id);
        $edit = Testimonials::findOrFail($id);
        $edit->update($request->all());

        if ($request->hasFile('image')) {
            File::delete('root/upload/testimonials/' . $edit1->image);

            $file = $request->file('image');
            $fileName = uniqid() . $file->getClientOriginalName();

            //Testimonial image save in 100 x 100 
            $imagePath =  base_path('upload/testimonials/' . $fileName);
            $img = Image::make($request->file('image'));
            $img->resize(100, 100);
            $img->save($imagePath);

            $edit->image = $fileName;
            $edit->save();
        }

        return redirect('our-testimonials')->with(Toastr::success('Testimonial Updated Successfully!'));
    }

    public function destroy($id)
    {
        $t = Testimonials::findOrFail($id);
        File::delete('root/upload/testimonials/' . $t->image);
        $t->delete();

        return redirect()->back()->with(Toastr::success('Testimonial Deleted Successfully!'));
    }
}
