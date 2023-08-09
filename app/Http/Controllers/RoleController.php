<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Role;
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
        $donors = User::where('type', '=', 'USER')->OrderBy('name', 'asc')->get();
        return view('roles.index', Compact('donors'));
    }

    public function create()
    {
        $shop = Category::OrderBy('name', 'asc')->pluck('name', 'id');
        return view('roles.create', Compact('shop'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users|max:255',
            'name' => 'required',
            'country' => 'required',
            'password' => 'required' //,
            //'category_id' => 'required'
        ]);

        $student = new User(array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'category_id' => $request->get('category_id'),
            'phone'  => $request->get('phone'),
            'country' => $request->get('country'),
            'city' => $request->get('city'),
            'addres' => $request->get('addres'),
            'gender' => $request->get('gender'),
            'profession' => $request->get('profession'),
            'type' => "USER",
            'password' => bcrypt($request->get('password')),
            'biller_id' => $request->get('biller_id')
            //'image' => $imageName
        ));
        $student->save();
        $student->roles()->attach(Role::where('name', 'Editor')->first());

        if (!is_null($request->file('image'))) {
            //return "enter";
            $imageName = $request->file('image')->getClientOriginalName();
            //return $imageName;
            $request->file('image')->move(
                base_path() . '/upload/users/',
                $imageName
            );

            $student->image = $request->file('image')->getClientOriginalName();
            $student->save();
        }

        Session::flash('flash_message', 'User successfully added!');
        return redirect('roles/create');
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
        Session::flash('flash_message', 'Record Updated Successfully!');
        return redirect('roles');
    }

    public function destroy($id)
    {
        $delete = User::findOrFail($id);
        $delete->delete();
        $user = base_path("/upload/users/{$delete->image}");
        File::delete($user);
        Session::flash('flash_message', 'Record Deleted Successfully!');
        return redirect('roles');
    }
}
