<?php

namespace App\Http\Controllers;

use App\Models\TrainingCategories;
use App\Models\Trainings;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class TrainingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = trainingCategories::all();
        $data = Trainings::with('trainingCategory')->get();
        return view('trainings.index', compact('data'));
    }

    public function create()
    {
        $trainingCategories = TrainingCategories::orderBy('id')->pluck('id');
        return view('trainings.create', compact('trainingCategories'));
    }
    

    public function store(Request $request)
{
    $this->validate(
        $request,
        [
            'training_category_id' => 'required',
        ],
        [
            'training_category_id.required' => 'The training category field is required',
        ]
    );

    $training = Trainings::create([
        'training_category_id' => (int) $request->input('training_category_id'),
    ]);

    Toastr::success('Training Added Successfully!');
    return redirect()->back();
}


    public function edit($id)
    {
        $edit = Trainings::findOrFail($id);
        $trainingCategories = TrainingCategories::orderBy('id')->pluck('title', 'id');

        if ($edit) {
            return view('trainings.edit', compact('edit', 'trainingCategories'));
        } else {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        $this->validate(
            $request,
            [
                'training_category_id' => 'required',
            ],
            [
                'training_category_id.required' => 'The training category field is required',
            ]
        );

        $edit = Trainings::findOrFail($id);
        if ($edit) {
            $edit->update($request->all());

            Toastr::success('Training Updated Successfully!');
            return redirect('/our-trainings');
        } else {
            abort(404);
        }
    }

    public function destroy($id)
    {
        $data = Trainings::findOrFail($id);
        if ($data) {
            $data->delete();
            Toastr::success('Training Deleted Successfully!');
            return redirect()->back();
        } else {
            abort(404);
        }
    }
}
