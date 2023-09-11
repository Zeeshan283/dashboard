<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.userlist', compact('users'));
    }

    public function add()
    {
        $users = User::where('role', '=', 'Customer')->get();
        return view('users.create', compact('users'));
    }

public function adduser(Request $request)
    {
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->country = $request->input('country');
        $user->city = $request->input('city');
        $user->addres = $request->input('addres'); // 
        $user->password = Hash::make($request->input('password'));
        $user->gender = $request->input('gender');
        $user->save();

        Toastr::success('User added successfully', 'Success');

        return redirect()->route('userlist');
    }


    public function edit($id)
    {
        $user = User::find($id);
        return view('users/edit')->with('user', $user);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->country = $request->input('country');
        $user->city = $request->input('city');
        $user->addres = $request->input('addres'); // Corrected spelling of 'address'

        if ($request->has('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->gender = $request->input('gender');
        $user->save();

        return redirect()->route('userlist'); // Make sure you have defined the 'userlist' route
    }

    public function delete_user($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('userlist');
    }
}
