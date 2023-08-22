<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Import the Hash facade

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $statuses = ['active' => 'Active', 'inactive' => 'Inactive'];
        return view('users.create', compact('statuses'));
    }

    public function add_user(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|same:password',
            'address' => 'required|string|max:255',
            'zipcode' => 'required|string|max:10',
            'status' => 'required|string|in:active,inactive',
        ]);

        // Hash the password
        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');

        }
        public function store(Request $request)
        {
            // $validatedData = $request->validate([
                $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'contact_number' => 'required|string|max:20',
                'username' => 'required|string|max:255|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'confirm_password' => 'required|same:password',
                'address' => 'required|string|max:255',
                'zipcode' => 'required|string|max:10',
                'status' => 'required|string|in:active,inactive',
            ]);


       print_r($request->all())  ;
            // Hash the password before storing
            $validatedData['password'] = bcrypt($validatedData['password']);

            $user = User::create($validatedData);

            return redirect()->route('users.index')
                ->with('success', 'User created successfully.');
        }
}
