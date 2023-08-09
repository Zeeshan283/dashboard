<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Team::OrderBy('id')->get();
        return view('team.index',compact('data'));
    }

    public function create()
    {
        return view('team.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'designation'=>'required',
            'image'=>'required|mimes:png,jpg,jpeg|max:2048'
        ]);

        

        $team = Team::create($request->all());
        if($request->hasFile('image')){
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $imagePath =  base_path('upload/teams/' . $fileName);
            $img = Image::make($request->file('image'));
            $img->resize(540, 689);
            $img->save($imagePath);
            
            $imagePath =  base_path('upload/teams/small/' . $fileName);
            $img = Image::make($request->file('image'));
            $img->resize(100, 130);
            $img->save($imagePath);

            $team->image = $fileName;
            $team->save();
        }

        Session::flash('flash_message', 'Team Member Added Successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = Team::findOrFail($id);
        return view('team.edit',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        File::delete(base_path().'/upload/teams/'.$team->image);
        File::delete(base_path().'/upload/teams/small/'.$team->image);

        $team->delete();

        Session::flash('flash_message', 'Team Member Deleted Successfully!');
        return redirect()->back();
    }
}
