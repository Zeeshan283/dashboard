<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Exception; // Make sure to import the Exception class

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
{
    try {
        $user = Socialite::driver('google')->user();
        \Log::info('Google User Data:', $user);

        $findUser = User::where('google_id', $user->id)->first();

        if ($findUser) {
            Auth::login($findUser);
            return redirect('/home');
        } else {
            // Add logging to check for any validation errors
            \Log::info('Creating New User:', [
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id,
            ]);

            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id,
            ]);

            Auth::login($newUser);

            return redirect()->back();
        }
    } catch (Exception $e) {
        \Log::error('Error in Google Callback:', ['error' => $e->getMessage()]);
        return redirect('auth/google');
    }
}

}
