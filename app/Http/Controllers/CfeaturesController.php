<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cfeatures;
use Brian2694\Toastr\Facades\Toastr;

class CfeaturesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cfeatures = Cfeatures::orderBy('id')->get(['id', 'instructor', 'rating', 'lectures', 'duration', 'skilllevel', 'language', 'coursefee']);
       $cfeatures = Cfeatures::all(); 
        return view('cfeatures.index', compact('cfeatures'));
    }

    public function create()
    {
       $cfeatures = ($id = request()->get('id'));
       $cfeatures = Cfeatures::all(); 
        return view('cfeatures.create' , compact('cfeatures'));
    }   

    public function store(Request $request)
    {
        $request->validate([
            'instructor' => 'required',
            'rating' => 'required',
            'lectures' => 'required',
            'duration' => 'required',
            'skilllevel' => 'required',
            'language' => 'required',
            'coursefee' => 'required',
        ]);
    
        $cfeatures = new Cfeatures;
        $cfeatures->instructor = $request->instructor;
        $cfeatures->rating = $request->rating;
        $cfeatures->lectures = $request->lectures;
        $cfeatures->duration = $request->duration;
        $cfeatures->skilllevel = $request->skilllevel;
        $cfeatures->language = $request->language;
        $cfeatures->coursefee = $request->coursefee;
        $cfeatures->save();
        Toastr::success('Course features Updated Successfully!');
        return redirect()->route('cfeatures.index');
    }
    

    public function show()
    {
        //
    }

  
    public function edit($id)
    {
        $edit = Cfeatures::findOrFail($id);
        $cfeatures = Cfeatures::all();
        return view('cfeatures.edit', compact('edit'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'instructor' => 'required',
            'rating' => 'required',
            'lectures' => 'required',
            'duration' => 'required',
            'skilllevel' => 'required',
            'language' => 'required',
            'coursefee' => 'required',
        ]);
    
        $edit = Cfeatures::findOrFail($id);
        $edit->instructor = $request->instructor;
        $edit->rating = $request->rating;
        $edit->lectures = $request->lectures;
        $edit->duration = $request->duration;
        $edit->skilllevel = $request->skilllevel; 
        $edit->language = $request->language;
        $edit->coursefee = $request->coursefee;
    
        $edit->update($request->all());
    
        Toastr::success('Course detail Updated Successfully!');
        return redirect()->route('cfeatures.index')->with(compact('edit')); 
    }
    

    public function destroy($id)
    {
        $data = Cfeatures::findOrFail($id);
        if($data)
        {
            $data->delete();
            return redirect()->back()->with('flash_message', 'Course Detail Deleted Successfully');;
        }else{
            abort(404);
        }
    }
}
