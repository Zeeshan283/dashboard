<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Settings;
use File;
use Auth;
use Session;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Appointment::all();
        return view('appointment.index', compact('data'));
    }

    public function create()
    {
        $data = Appointment::all();
        return view('appointment.create', compact('data'));
    }

    public function store(Request $request)
    {
        // return $request->all();
        $data = new Appointment();
        $data->created_by = $request->get('created_by');
        $data->updated_by = $request->get('updated_by');
        $data->appoint_no = $request->get('appoint_no');
        $data->date = $request->get('date');
        $data->designation = $request->get('designation');
        $data->employee_name = $request->get('employee_name');
        $data->salary = $request->get('salary');
        $data->status = $request->get('status');
        $data->phone = $request->get('phone');
        $data->address = $request->get('address');
        $data->created_by = $request->get('created_by');
        if (!is_null($request->file('image'))) {
            //return  "enter";
            $imageName = $request->file('image')->getClientOriginalName();

            $request->file('image')->move(
                base_path() . '/upload/product/',
                $imageName
            );

            $data->image = $imageName;
            $data->save();
        }
        if (!is_null($request->file('image_f'))) {
            //return  "enter";
            $imagef = $request->file('image_f')->getClientOriginalName();

            $request->file('image_f')->move(
                base_path() . '/upload/image_front/',
                $imagef
            );

            $data->image_f = $imagef;
            $data->save();
        }
        if (!is_null($request->file('image_b'))) {
            //return  "enter";
            $imageb = $request->file('image_b')->getClientOriginalName();

            $request->file('image_b')->move(
                base_path() . '/upload/image_back/',
                $imageb
            );

            $data->image_b = $imageb;
            $data->save();
        }


        Session::flash('flash_message', 'Record added Successfully!');
        return redirect('appointment');
    }

    public function show($id)
    {
        $details = Appointment::findOrFail($id);
        //  return $details;
        $settings = Settings::where('id', '=', 1)->get();
        //    return $settings;
        return view('appointment.show', compact('details', 'settings'));
    }

    public function edit($id)
    {
        $edit = Appointment::findOrFail($id);
        return view('appointment.edit', Compact('edit'));
    }

    public function update(Request $request, $id)
    {
        $update = Appointment::findOrFail($id);
        $update->updated_by = $request->get('updated_by');
        $update->updated_by = $request->get('updated_by');
        $update->appoint_no = $request->get('appoint_no');
        $update->date = $request->get('date');
        $update->designation = $request->get('designation');
        $update->employee_name = $request->get('employee_name');
        $update->salary = $request->get('salary');
        $update->status = $request->get('status');
        $update->phone = $request->get('phone');
        $update->address = $request->get('address');
        $update->created_by = $request->get('created_by');
        if (!is_null($request->file('image'))) {
            //return  "enter";
            $imageName = $request->file('image')->getClientOriginalName();

            $request->file('image')->move(
                base_path() . '/upload/product/',
                $imageName
            );

            $update->image = $imageName;
            $update->save();
        }
        if (!is_null($request->file('image_f'))) {
            //return  "enter";
            $imagef = $request->file('image_f')->getClientOriginalName();

            $request->file('image_f')->move(
                base_path() . '/upload/image_front/',
                $imagef
            );

            $update->image_f = $imagef;
            $update->save();
        }
        if (!is_null($request->file('image_b'))) {
            //return  "enter";
            $imageb = $request->file('image_b')->getClientOriginalName();

            $request->file('image_b')->move(
                base_path() . '/upload/image_back/',
                $imageb
            );

            $update->image_b = $imageb;
            $update->save();
        }
        $update->save();

        Session::flash('flash_message', 'Record Updated Successfully!');
        return redirect('appointment');
    }

    public function destroy($id)
    {
        $delete = Appointment::findOrFail($id);

        $cash = base_path("/upload/product/{$delete->image}");
        File::delete($cash);
        $cash1 = base_path("/upload/image_front/{$delete->image_f}");
        File::delete($cash1);
        $cash2 = base_path("/upload/image_back/{$delete->image_b}");
        File::delete($cash2);

        $delete->delete();
        Session::flash('flash_message', 'Record Deleted Successfully!');
        return redirect('appointment');
    }
}
