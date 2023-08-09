<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class UserAPIController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|max:16',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $userId = $user->id;
            return response()->json(['success' => $success, 'customer_id' => $userId], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8|max:16',
            'c_password' => 'required|same:password|min:8|max:16',
            'gender' => 'required|string'
        ], [
            'c_password.required' => 'The confirm password field is required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        // $input = $request->all();
        // $input['password'] = bcrypt($input['password']);
        // $user = User::create($input);


        $data = $request->all();
        $user = User::create([
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone1' => $data['phone_number'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'Customer',
            'gender' => $data['gender']
        ]);


        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        return response()->json(['success' => $success], $this->successStatus);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details($id)
    {
        $user = User::select('first_name', 'last_name', 'gender', 'phone1 as phone', 'address1 as address', 'zipcode', 'city', 'country')
            ->whereId($id)
            ->first();
        return response()->json(['success' => $user], $this->successStatus);

        // $user = Auth::user();
        // return response()->json(['success' => $user], $this->successStatus);
    }

    public function UpdateProfile(Request $request)
    {
        if ($request->isMethod('PATCH')) {
            $validator = Validator::make($request->all(), [
                'customer_id' => 'required',
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'phone1' => 'required|max:255',
                'gender' => 'required|max:255'
            ], [
                'phone1' => 'The Phone Number field is required.'
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }

            $user = User::findOrFail($request->customer_id);
            if ($user) {
                $user->update($request->all());

                if ($request->old_password) {
                    if (Hash::check($request->old_password, $user->password)) {
                        $user->password = Hash::make($request->new_password);
                        $user->save();
                        return Response::json(['data' => 'Password Updated Successfully', 'status' => '200']);
                    } else {
                        return Response::json(['data' => 'Password does not match']);
                    }
                }

                return Response::json(['data' => 'Profile Updated Successfully', 'status' => '200']);
            } else {
                return Response::json(['data' => 'Something went wrong', 'status' => '200']);
            }
        } else {
            return Response::json(['data' => 'Bad Method Call', 'status' => '200']);
        }
    }
}