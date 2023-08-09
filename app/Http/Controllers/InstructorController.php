<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;
use Brian2694\Toastr\Facades\Toastr;
use File;
class InstructorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data = Instructor::orderBy('id')->get();
        return view('intructor.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('intructor.create');
    }

    
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'courses' => 'required',
                'education' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'image' => 'required|mimes:png,jpg,jpeg',
            ],
        );
        $t = Instructor::create($request->all());
        $t->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = uniqid() . $file->getClientOriginalName();

            //prorgam image save in 930 x 500
            $imagePath =  base_path('upload/intructor/big/' . $fileName);
            $img = Image::make($file);
            $img->resize(930, 500);
            $img->save($imagePath);

            //prorgam image save in 600 x 420
            $imagePath =  base_path('upload/intructor/medium/' . $fileName);
            $img = Image::make($file);
            $img->resize(600, 420);
            $img->save($imagePath);

            //prorgam image save in 600 x 420
            $imagePath =  base_path('upload/intructor/small/' . $fileName);
            $img = Image::make($file);
            $img->resize(100, 70);
            $img->save($imagePath);

            $t->image = $fileName;
            $t->save();
        }
        return redirect()->back()->with(Toastr::success('Intructor Added Successfully!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function show(Instructor $instructor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = Instructor::findOrFail($id);
        if ($edit) {
            return view('intructor.edit', compact('edit'));
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'courses' => 'required',
                'education' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'image' => 'required|mimes:png,jpg,jpeg',
            ],
        );
        $edit1 = Instructor::findOrFail($id);
        $edit = Instructor::findOrFail($id);
        if ($edit) {
            $edit->update($request->all());
            $edit->save();


            if ($request->hasFile('image')) {
                File::delete('root/upload/intructor/big/' . $edit1->image);
                File::delete('root/upload/intructor/medium/' . $edit1->image);
                File::delete('root/upload/intructor/small/' . $edit1->image);

                $file = $request->file('image');
                $fileName = uniqid() . $file->getClientOriginalName();

                //prorgam image save in 930 x 500
                $imagePath =  base_path('upload/intructor/big/' . $fileName);
                $img = Image::make($file);
                $img->resize(930, 500);
                $img->save($imagePath);

                //prorgam image save in 600 x 420
                $imagePath =  base_path('upload/intructor/medium/' . $fileName);
                $img = Image::make($file);
                $img->resize(600, 420);
                $img->save($imagePath);

                //prorgam image save in 600 x 420
                $imagePath =  base_path('upload/intructor/small/' . $fileName);
                $img = Image::make($file);
                $img->resize(100, 70);
                $img->save($imagePath);

                $edit->image = $fileName;
                $edit->save();
            }

            return redirect('/intructor')->with(Toastr::success('Intructor Updated Successfully!'));
        } else {
            abort(404);
        }
    }

    public function destroy($id)
    {
        $data = Instructor::findOrFail($id);
        if ($data) {
            File::delete('root/upload/intructor/big/' . $data->image);
            File::delete('root/upload/intructor/medium/' . $data->image);
            File::delete('root/upload/intructor/small/' . $data->image);
            $data->delete();
            return redirect()->back()->with(Toastr::success('Intructor Deleted Successfully!'));
        } else {
            abort(404);
        }
    }
}
