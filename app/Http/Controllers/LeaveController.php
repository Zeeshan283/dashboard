<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\leave;
use App\Models\Appointment;
use Auth;
use Session;
use App\Models\Settings;
class LeaveController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
        $data = Leave::with('appoint')->get();
        return view('leave.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $appoint = Appointment::orderBy('employee_name')->pluck('employee_name', 'id');
     //   return $appoint;
        return view('leave.create', compact('appoint'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //return $request->all();
         $leave = new Leave();
         $leave->from = $request->get('from');
         $leave->to = $request->get('to');
         $leave->days = $request->get('days');
         $leave->employee_id = $request->get('employee_id');
         $leave->created_by = $request->get('created_by');
         $leave->reason = $request->get('reason');
         $leave->save();
         Session::flash('flash_message', 'Record added Successfully!');
        return redirect('leave/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $details  = Leave::findOrFail($id);
        $settings = Settings::where('id', '=', 1)->get();
    //    return $settings;
        return view('leave.show', compact('details', 'settings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = Leave::findOrFail($id);
        $appoint = Appointment::orderBy('employee_name')->pluck('employee_name', 'id');
        
        return view('leave.edit', compact('edit', 'appoint'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
      //  return $request->all();
         $leave = Leave::findOrFail($id);
         $leave->from = $request->get('from');
         $leave->to = $request->get('to');
         $leave->days = $request->get('days');
         $leave->employee_id = $request->get('employee_id');
         $leave->updated_by = $request->get('updated_by');
         $leave->reason = $request->get('reason');
         $leave->update($request->all());

         Session::flash('flash_message', 'Record Updated Successfully!');
        return redirect('leave');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $delete = Leave::findOrFail($id);
       
        $delete->delete();
        Session::flash('flash_message', 'Record Deleted Successfully!');
        return redirect('leave');
    }
}
