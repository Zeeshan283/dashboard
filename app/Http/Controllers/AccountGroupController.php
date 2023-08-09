<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Accountgroup;
use Auth;
use Session;
class AccountGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Accountgroup::OrderBy('group_name', 'asc')->get();
       
        return view('account-group.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('account-group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
     {
        
        $this->validate($request, [
        'group_name' => 'required'
]);

         $brand = new Accountgroup();
         $brand->group_name = $request->get('group_name');
         $brand->save();
         Session::flash('flash_message', 'Record added Successfully!');
        return redirect('account-group/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = Accountgroup::findOrFail($id);
        return view('account-group.edit', compact('edit'));
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
         $this->validate($request, [
        'group_name' => 'required'
        ]);
        $update = Accountgroup::findOrFail($id);
        $update->group_name = $request->get('group_name');
        $update->update($request->all());
        Session::flash('flash_message', 'Record Updated Successfully!');
        return redirect('account-group');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Accountgroup::findOrFail($id);
        $delete->delete();
        Session::flash('flash_message', 'Record Deleted Successfully!');
        return redirect('account-group');
    }
}
