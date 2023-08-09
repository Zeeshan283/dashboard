<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Skills;

class SkillsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $skills = Skills::OrderBy('id')->get(['id', 'title', 'percentage']);
        return view('skills.index', compact('skills'));
    }

    public function create()
    {
        return view('skills.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'percentage' => 'required|numeric|max:100|min:1',
        ]);
        Skills::create($request->all());

        Toastr::success('Skill Added Successfully!');
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit = Skills::findOrFail($id);
        return view('skills.edit', compact('edit'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'percentage' => 'required|max:100|min:1',
        ]);

        $edit = Skills::findOrFail($id);
        $edit->update($request->all());

        Toastr::success('Skill Updated Successfully!');
        return redirect('our-skills');
    }

    public function destroy($id)
    {
        Skills::findOrFail($id)->delete();

        Toastr::success('Skill Deleted Successfully!');
        return redirect()->back();
    }
}
