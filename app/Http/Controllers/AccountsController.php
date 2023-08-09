<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Accountgroup;
use Auth;
use Session;
class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Account::with('accountgroup')->OrderBy('account_name', 'asc')->get();
      //  return $data;
        return view('accounts.index', compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $do = Accountgroup::orderBy('group_name')->pluck('group_name', 'id');
        return view('accounts.create', compact('do'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // return $request->all();
        $this->validate($request, [
        'account_name' => 'required'
]);

         $account = new Account();
         $account->account_name = $request->get('account_name');
         $account->group_id = $request->get('group_id');
         $account->city = $request->get('city');
         $account->address = $request->get('address');
         $account->save();
         Session::flash('flash_message', 'Record added Successfully!');
        return redirect('accounts/create');
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
        $edit = Account::findOrFail($id);
        $do = Accountgroup::orderBy('group_name')->pluck('group_name', 'id');
        return view('accounts.edit', compact('edit', 'do'));
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
        'account_name' => 'required'
        ]);
         $update = Account::findOrFail($id);
         $update->account_name = $request->get('account_name');
         $update->group_id = $request->get('group_id');
         $update->city = $request->get('city');
         $update->address = $request->get('address');
         $update->update($request->all());
        Session::flash('flash_message', 'Record Updated Successfully!');
        return redirect('accounts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $delete = Account::findOrFail($id);
        $delete->delete();
        Session::flash('flash_message', 'Record Deleted Successfully!');
        return redirect('accounts');
    }
}
