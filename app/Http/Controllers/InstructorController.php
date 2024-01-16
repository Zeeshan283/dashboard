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
        $data = Instructor::with('InstructorName')->get();
        return view('instructor.index', compact('data'));
    }

    public function create()
    {
        return view('instructor.create');
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',

            ]
        );

        $t = Instructor::create($request->all());

        Toastr::success('Instructor Added Successfully!');
        return redirect()->back();
    }

    public function edit($id)
    {
        $edit = Instructor::findOrFail($id);
        if ($edit) {
            return view('instructor.edit', compact('edit'));
        } else {
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
            ]
        );

        $edit = Instructor::findOrFail($id);
        if ($edit) {
            $edit->update($request->all());

            // Uncomment the image processing logic if needed
            // if ($request->hasFile('image')) {
            //     // Your image processing and saving logic here
            // }

            Toastr::success('Instructor Updated Successfully!');
            return redirect('/instructor');
        } else {
            abort(404);
        }
    }

    public function destroy($id)
    {
        $data = Instructor::findOrFail($id);
        if ($data) {
            // Your image deletion logic here

            $data->delete();
            Toastr::success('Instructor Deleted Successfully!');
            return redirect()->back();
        } else {
            abort(404);
        }
    }
}
