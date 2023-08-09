<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AboutUsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit($id)
    {
        $edit = AboutUs::findOrFail($id);
        return view('aboutus.edit', compact('edit'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'mission' => 'required',
            'stories' => 'required',
            'approach' => 'required',
            'philosophy' => 'required'
        ]);

        $edit = AboutUs::findOrFail($id);
        $edit->update($request->all());

        Session::flash('flash_message', 'About updated Successfully!');
        return redirect()->back();
    }
}
