<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Locations;

class LocationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $locations = Locations::OrderBy('id')->get(['id', 'name', 'phoneno', 'email', 'address', 'for_about']);
        return view('locations.index', compact('locations'));
    }

    public function create()
    {
        $for_about = array(1 => 'Yes', 0 => 'No');
        return view('locations.create', compact('for_about'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phoneno' => 'required',
            'email' => 'required',
            'address' => 'required',
            'company' => 'required',
            'google_link' => 'required',
            'for_about' => 'required'
        ], [
            'name' => 'The Name field is required',
            'phoneno' => 'The Phone No field is required',
            'email' => 'The Email field is required',
            'address' => 'The Address field is required',
            'company' => 'The Company field is required',
            'google_link' => 'The Google Link field is required',
            'for_about' => 'The For About field is required'
        ]);
        Locations::create($request->all());

        Toastr::success('Location Added Successfully!');
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit = Locations::findOrFail($id);
        $for_about = array(1 => 'Yes', 0 => 'No');
        return view('locations.edit', compact('edit', 'for_about'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'phoneno' => 'required',
            'email' => 'required',
            'address' => 'required',
            'company' => 'required',
            'google_link' => 'required',
            'for_about' => 'required'
        ], [
            'name' => 'The Name field is required',
            'phoneno' => 'The Phone No field is required',
            'email' => 'The Email field is required',
            'address' => 'The Address field is required',
            'company' => 'The Company field is required',
            'google_link' => 'The Google Link field is required',
            'for_about' => 'The For About field is required'
        ]);

        $edit = Locations::findOrFail($id);
        $edit->update($request->all());

        Toastr::success('Location Updated Successfully!');
        return redirect('our-locations');
    }

    public function destroy($id)
    {
        Locations::findOrFail($id)->delete();

        Toastr::success('Location Deleted Successfully!');
        return redirect()->back();
    }
}
