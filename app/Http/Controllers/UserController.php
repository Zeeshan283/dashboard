<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Notifications\InvoicePaid;

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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'The email field is required',
            'name.required' => 'The Name field is required',
            'password.required' => 'The Password field is required'
        ]);

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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ], [
            'email.required' => 'The email field is required',
            'name.required' => 'The Name field is required',
            'password.required' => 'The Password field is required'
        ]);

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->country = $request->input('country');
        $user->city = $request->input('city');
        $user->addres = $request->input('addres'); // Corrected spelling of 'address'

        $user->gender = $request->input('gender');
        $user->save();

        return redirect()->route('userlist'); // Make sure you have defined the 'userlist' route
    }

    public function delete_user($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back();
    }

    public function createUser(Request $request)
    {
        // Your user creation logic here
    
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
    
        // Send the InvoicePaid notification
        $user->notify(new InvoicePaid());
        // Rest of your logic...
    
        return response()->json(['message' => 'User created successfully']);
    }

    /**
 * Get the notification's delivery channels.
 *
 * @return array<int, string>
 */
    public function via(object $notifiable): array
{
    return $notifiable->prefers_sms ? ['vonage'] : ['mail', 'database'];
}
}
