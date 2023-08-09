<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit = Settings::findOrFail($id);
        return view('settings.edit', Compact('edit'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'system_name' => 'required',
            'title' => 'required',
            'address' => 'required',
            'currency' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ]);
        $update = Settings::findOrFail($id);
        $update->update($request->all());
        if(!is_null($request->file('logo')))
        {   
            $imageName = $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move(base_path() . '/upload/logo/', $imageName);
            $update->update(array('logo' => $imageName));
        }
        if(!is_null($request->file('header_logo')))
        {   
            $file = $request->file('header_logo');
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move('root/upload/logo/header_logo/', $fileName);
            $update->header_logo = '/root/upload/logo/header_logo/' .$fileName;
            $update->save();
        }



        // $update = Settings::findOrFail($id);
        // $update->update($request->all());
        // if (!is_null($request->file('logo'))) {
        //     $imageName = $request->file('logo')->getClientOriginalName();
        //     $request->file('logo')->move(
        //         base_path() . '/upload/logo/',
        //         $imageName
        //     );
        //     $update->update(array(
        //         'logo' => $imageName
        //     ));
        // }

        Session::flash('flash_message', 'Record successfully Updated!');
        return redirect('/home');
    }

    public function destroy($id)
    {
        //
    }
}
