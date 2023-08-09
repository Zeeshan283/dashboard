<?php

namespace App\Http\Controllers;

use App\Models\TrainingCategories;
use App\Models\Trainings;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as Image;
use Brian2694\Toastr\Facades\Toastr;

class TrainingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Trainings::with('training_category:id,title')->with('instructor')->orderBy('id')->get();
        return view('trainings.index', compact('data'));
    }

    public function create()
    {
        $trainingCategories = TrainingCategories::orderBy('id')->pluck('title', 'id');
        $instructor = Instructor::orderBy('id')->pluck('name', 'id');
        return view('trainings.create', compact('trainingCategories','instructor'));
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'language' => 'required',
                'students' => 'required',
                'lectures' => 'required',
                'quizzes' => 'required',
                'duration' => 'required',
                'skill_level' => 'required',
                'certificate' => 'required',
                'assessments' => 'required',
                'training_category_id' => 'required',
                'image' => 'required|mimes:png,jpg,jpeg',
                'description' => 'required'
            ],
            [
                'training_category_id.required' => 'The training category field is required'
            ],
            [
                'intructor_id.required' => 'The training category field is required'
            ]
        );
        $t = Trainings::create($request->all());
        $t->slug = Str::slug($request->title);
        $t->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = uniqid() . $file->getClientOriginalName();

            //prorgam image save in 930 x 500
            $imagePath =  base_path('upload/trainings/big/' . $fileName);
            $img = Image::make($file);
            $img->resize(930, 500);
            $img->save($imagePath);

            //prorgam image save in 600 x 420
            $imagePath =  base_path('upload/trainings/medium/' . $fileName);
            $img = Image::make($file);
            $img->resize(600, 420);
            $img->save($imagePath);

            //prorgam image save in 600 x 420
            $imagePath =  base_path('upload/trainings/small/' . $fileName);
            $img = Image::make($file);
            $img->resize(100, 70);
            $img->save($imagePath);

            $t->image = $fileName;
            $t->save();
        }

        return redirect()->back()->with(Toastr::success('Training Added Successfully!'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit = Trainings::findOrFail($id);
        $trainingCategories = TrainingCategories::orderBy('id')->pluck('title', 'id');
        $instructor = Instructor::orderBy('id')->pluck('name', 'id');
        if ($edit) {
            return view('trainings.edit', compact('edit', 'trainingCategories','instructor'));
        } else {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'language' => 'required',
                'students' => 'required',
                'lectures' => 'required',
                'quizzes' => 'required',
                'duration' => 'required',
                'skill_level' => 'required',
                'certificate' => 'required',
                'assessments' => 'required',
                'training_category_id' => 'required',
                'image' => 'required|mimes:png,jpg,jpeg',
                'description' => 'required'
            ],
            [
                'training_category_id.required' => 'The training category field is required'
            ],
            [
                'intructor_id.required' => 'The training category field is required'
            ]
        );

        $edit1 = Trainings::findOrFail($id);
        $edit = Trainings::findOrFail($id);
        if ($edit) {
            $edit->update($request->all());
            $edit->slug = Str::slug($request->title);
            $edit->save();


            if ($request->hasFile('image')) {
                File::delete('root/upload/trainings/big/' . $edit1->image);
                File::delete('root/upload/trainings/medium/' . $edit1->image);
                File::delete('root/upload/trainings/small/' . $edit1->image);

                $file = $request->file('image');
                $fileName = uniqid() . $file->getClientOriginalName();

                //prorgam image save in 930 x 500
                $imagePath =  base_path('upload/trainings/big/' . $fileName);
                $img = Image::make($file);
                $img->resize(930, 500);
                $img->save($imagePath);

                //prorgam image save in 600 x 420
                $imagePath =  base_path('upload/trainings/medium/' . $fileName);
                $img = Image::make($file);
                $img->resize(600, 420);
                $img->save($imagePath);

                //prorgam image save in 600 x 420
                $imagePath =  base_path('upload/trainings/small/' . $fileName);
                $img = Image::make($file);
                $img->resize(100, 70);
                $img->save($imagePath);

                $edit->image = $fileName;
                $edit->save();
            }

            return redirect('/our-trainings')->with(Toastr::success('Training Updated Successfully!'));
        } else {
            abort(404);
        }
    }

    public function destroy($id)
    {
        $data = Trainings::findOrFail($id);
        if ($data) {
            File::delete('root/upload/trainings/big/' . $data->image);
            File::delete('root/upload/trainings/medium/' . $data->image);
            File::delete('root/upload/trainings/small/' . $data->image);
            $data->delete();
            return redirect()->back()->with(Toastr::success('Training Deleted Successfully!'));
        } else {
            abort(404);
        }
    }
    public function uploadImage(Request $request)
     {
       
        $filename = $request->file('file')->getClientOriginalName();

         $path = $request->file('file')->move('root/upload/training', $filename);
        return response()->json(['location' => '../root/upload/training/'.$filename]);
        
        $filename1 = $request->file('file1')->getClientOriginalName();

         $path = $request->file('file1')->move('root/upload/training', $filename1);
        return response()->json(['location' => '../root/upload/training/'.$filename1]);
       
         
    }
}
