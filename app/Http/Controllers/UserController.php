<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Notifications\NewUser;
use Illuminate\Support\Facades\Notification;

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
        $user->address = $request->input('address'); // Corrected spelling of 'address'
        $user->password = Hash::make($request->input('password'));
        $user->gender = $request->input('gender');
        $user->save();

        Toastr::success('User added successfully', 'Success');

        return redirect()->route('userlist');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit')->with('user', $user);
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
        $user->address = $request->input('address'); // Corrected spelling of 'address'
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
        $user = User::find($userId); // Retrieve the user instance
        Notification::send($user, new NewUser);

        $message = "This is a custom message.";
        Notification::send($user, new ExampleNotification($message));
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

    public function showNotifications()
    {
        $user = User::find(1);

        foreach ($user->notifications as $notification) {
            echo $notification->type;
        }
    }

    public function showUnreadNotifications()
    {
        $user = User::find(1);

        foreach ($user->unreadNotifications as $notification) {
            echo $notification->type;
        }
    }

    public function markAllNotificationsAsRead($userId)
    {
        $user = User::find($userId);

        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }

        // Alternatively, you can use the following line to mark all unread notifications as read:
        // $user->unreadNotifications->markAsRead();

        return redirect()->back(); // Redirect back to the previous page or wherever you want
    }
}
