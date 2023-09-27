<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HelpCenter;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as Image;
use Brian2694\Toastr\Facades\Toastr;

class HelpCenterController extends Controller
{
    //
    public function index()
    {
        $data = HelpCenter::get(['id', 'question', 'answer']);
        return view('helpcenter.index', compact('data'));
    }

    public function create()
    {
        return view('helpcenter.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'question' => 'required| max:255',
            'answer' => 'required'
        ], [
            'helpcenter_question' => 'The Question field is required'
        ]);

        $b = helpcenter::create($request->all());

        
        Toastr::success('FAQ Added Successfully!');
        return redirect('helpcenter');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $value = helpcenter::findOrFail($id);
        return view('helpcenter.edit', compact('value'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
        'question' => 'required| max:255',
            'answer' => 'required'
        ], [
            'helpcenter_question' => 'The Question field is required'
        ]);

        $update1 = helpcenter::findOrFail($id);
        $update = helpcenter::findOrFail($id);
        $update->update($request->all());


        Toastr::success('FAQ Updated Successfully!');
        return redirect('helpcenter');
    }

    public function destroy($id)
    {
        $delete = helpcenter::findOrFail($id);
        $delete->delete();

        return redirect()->back()->with(Toastr::success('FAQ Deleted Successfully!'));
    }
}
