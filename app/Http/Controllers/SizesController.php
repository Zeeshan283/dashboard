<?php

namespace App\Http\Controllers;

use App\Models\Sizes;
use Illuminate\Http\Request;

class SizesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Sizes::OrderBy('id')->get();
        return view('sizes.index', compact('data'));
    }

    public function create()
    {
        return view('sizes.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'size' => 'required'
        ]);
        Sizes::create($request->all());

        return redirect()->back()->with('flash_message', 'Size Added Successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit = Sizes::findOrFail($id);
        return view('sizes.edit', compact('edit'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'size' => 'required'
        ]);
        $edit = Sizes::findOrFail($id);
        $edit->update($request->all());

        return redirect('/our-sizes')->with('flash_message', 'Size Updated Successfully!');
    }

    public function destroy($id)
    {
        Sizes::findOrFail($id)->delete();

        return redirect()->back()->with('flash_message', 'Size Deleted Successfully!');
    }
}
