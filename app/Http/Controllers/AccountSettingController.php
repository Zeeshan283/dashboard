<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AccountSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit($id)
    {
        $edit = User::where('id', Auth::User()->id)->first();
        if ($edit) {
            return view('account-setting.edit', compact('edit'));
        } else {
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        if ($request->get('profile')) {

            $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required'
            ]);

            $update = User::findOrFail($id);
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

            Session::flash('flash_message', 'Profile Updated Successfully!');
            return redirect('home');
        }


        if ($request->get('pswdChng')) {
            $this->validate($request, [
                'new_password' => 'required|min:6',
                'confirm_password' => 'required|same:new_password|min:6|different:old_password'
            ]);
            $currentPassword = $request->get("old_password");
            $NewPassword = $request->get("new_password");
            $update = User::findOrFail($id);


            if (Hash::check($currentPassword, $update->password)) {
                $update->fill([
                    'password' => Hash::make($NewPassword)
                ])->save();

                Session::flash('flash_message', 'Password Changed successfully!');
                return redirect('home');
            } else {
                Session::flash('flash_message', 'Current Password is Incorrect!');
                return redirect('account-setting/' . $update->id . '/edit');
            }
        }
    }
}
