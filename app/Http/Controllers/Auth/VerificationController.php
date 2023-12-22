<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;

class VerificationController extends Controller
{
    use VerifiesEmails;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    // Customize the response for email verification success
    protected function verified(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Email verified successfully'], 200);
        }

        return redirect($this->redirectPath())->with('verified', true);
    }

    // Customize the response for resending the verification email
    protected function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Email is already verified'], 200);
            }

            return redirect($this->redirectPath())->with('already_verified', true);
        }

        $request->user()->sendEmailVerificationNotification();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Email verification link sent'], 200);
        }

        return back()->with('resent', true);
    }

    public function sendVerificationEmail(Request $request, $email)
    {
        // Check if the provided email exists in the database
        $user = User::where('email', $email)->first();

        // Check if the user with the provided email exists
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Check if the user's email is already verified
        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email is already verified.'], 200);
        }

        // Send the verification email
        $user->sendEmailVerificationNotification();

        return response()->json(['message' => 'Verification email sent successfully.'], 200);
    }
    
}

