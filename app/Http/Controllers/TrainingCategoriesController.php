<?php

namespace App\Http\Controllers;

use App\Models\TrainingCategories;
use App\Models\Trainings;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;

class TrainingCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       
        $data = TrainingCategories::select('id', 'title')->OrderBy('id')->get();
        return view('trainings.category.index', compact('data'));
    }

    public function create()
    {
        return view('trainings.category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);
        TrainingCategories::create($request->all());
        return redirect('/trainingCategories')->with(Toastr::success('Training Category Added Successfully!'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit = TrainingCategories::findOrFail($id);
        return view('trainings.category.edit', compact('edit'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        $edit = TrainingCategories::findOrFail($id);
        $edit->update($request->all());

        return redirect('trainingCategories')->with(Toastr::success('Training Category Updated Successfully!'));
    }

    public function destroy($id)
    {
        TrainingCategories::findOrFail($id)->delete();
        $trainings = Trainings::where('training_category_id',$id)->get();
        foreach($trainings as $value)
        {
            File::delete('root/upload/trainings/big/'.$value->image);
            File::delete('root/upload/trainings/medium/'.$value->image);
            File::delete('root/upload/trainings/small/'.$value->image);
        }
        Trainings::where('training_category_id',$id)->delete();
        return redirect()->back()->with(Toastr::success('Training Category Deleted Successfully!'));
    }
}
