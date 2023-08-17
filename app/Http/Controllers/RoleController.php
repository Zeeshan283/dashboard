<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Role;
use Brian2694\Toastr\Facades\Toastr;

use Session;
use File;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::where('type', '=', 'USER')->OrderBy('name', 'asc')->get();
<<<<<<< HEAD
        return view('users.userlist', Compact('users'));
=======
        return view('users.index', Compact('users'));
>>>>>>> main
    }

    public function create()
    {
        $shop = Category::OrderBy('name', 'asc')->pluck('name', 'id');
        return view('users.create', Compact('shop'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'email' => 'required|unique:users|max:255',
            'name' => 'required',
            'country' => 'required',
            'password' => 'required' //,
            //'category_id' => 'required'
        ]);

        $users = new User(array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            // 'category_id' => $request->get('category_id'),
<<<<<<< HEAD
            'phone'  => $request->get('phone'),
            'country' => $request->get('country'),
            'city' => $request->get('city'),
            'addres' => $request->get('addres'),
            'status' => $request->get('status'),
=======
            'phone1'  => $request->get('phone1'),
            'country' => $request->get('country'),
            'city' => $request->get('city'),
            'address1' => $request->get('address1'),
            'gender' => $request->get('gender'),
>>>>>>> main
            // 'profession' => $request->get('profession'),
            'type' => "USER",
            'password' => bcrypt($request->get('password')),
            // 'biller_id' => $request->get('biller_id')
            //'image' => $imageName
        ));
<<<<<<< HEAD
        $users->save();
        $users->roles()->attach(Role::where('name', 'Editor')->first());
=======
        $student->save();
        // $student->roles()->attach(Role::where('name', 'Editor')->first());
>>>>>>> main

        Toastr::success('User successfully added!', 'Success');

        return redirect()->back();

    }

    public function Assign(Request $request)
    {
        $user = User::where('email', $request['email'])->first();
        //return $user;
        $user->roles()->detach();

        if ($request['role_supervisor']) {
            $user->roles()->attach(Role::where('name', 'Supervisor')->first());
        }

        if ($request['role_center']) {
            $user->roles()->attach(Role::where('name', 'Center')->first());
        }

        if ($request['role_driver']) {
            $user->roles()->attach(Role::where('name', 'Driver')->first());
        }

        if ($request['role_editor']) {
            $user->roles()->attach(Role::where('name', 'Editor')->first());
        }
        if ($request['role_author']) {
            $user->roles()->attach(Role::where('name', 'Author')->first());
        }
        if ($request['role_admin']) {
            $user->roles()->attach(Role::where('name', 'Admin')->first());
        }
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit = User::findOrFail($id);
        $shop = Category::OrderBy('name', 'asc')->pluck('name', 'id');
        return view('roles.edit', Compact('edit', 'shop'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'email' => 'required|max:255',
            'name' => 'required',
            'country' => 'required',
            'category_id' => 'required'
        ]);
        $update = User::findOrFail($id);
        //return $update;
        $update->update($request->all());

        if (!is_null($request->file('image'))) {

            $imageName = $request->file('image')->getClientOriginalName();

            $request->file('image')->move(
                base_path() . '/upload/users/',
                $imageName
            );

            $update->image = $request->file('image')->getClientOriginalName();
            $update->save();
        }
        //return "jh";

        Toastr::success('Record Updated Successfully!', 'Success');

        return redirect()->back();
    }

    public function destroy($id)
    {
        $delete = User::findOrFail($id);
        $delete->delete();

        Toastr::success('Record Deleted Successfully!', 'Success');

        return redirect()->back();
    }



}
