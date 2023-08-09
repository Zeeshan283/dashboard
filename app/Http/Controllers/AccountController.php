<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Auth;
use Session;
class AccountController extends Controller
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
    $data = Account::OrderBy('name', 'asc')->get();
    return view('accounts.index', Compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     $code = Account::OrderBy('id', 'asc')->get();
        if(count($code) > 0){
        $codes = (int)$code->last()->code + 1;
    }
        else{
            $codes = 1;
        }
   
    return view('accounts.create', Compact('codes'));
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
        'code' => 'required',
        'name' => 'required'
]);

        $milk = new Account();
         $milk->code = $request->get('code');
         $milk->name = $request->get('name');
         $milk->type = $request->get('type');
         $milk->biller = Auth::User()->name;
         $milk->save();
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
     return view('accounts.edit', Compact('edit'));
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
        'code' => 'required',
        'name' => 'required'
        ]);
        $update = Account::findOrFail($id);
        //return $update;
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
