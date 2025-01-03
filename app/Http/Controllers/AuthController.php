<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate the input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginInput = $request->input('username');
        $password = $request->input('password');

        // Find the user by username or email
        $user = User::where('name', $loginInput)
            ->orWhereHas('contactDetails', function ($query) use ($loginInput) {
                $query->where('value', $loginInput);
            })
            ->with(['profile', 'userType'])
            ->first();

        // Check if the user exists
        if (!$user) {
            return back()->withErrors(['message' => 'User not found.'])->withInput();
        }

        // Check if the password is correct
        if (!Hash::check($password, $user->password)) {
            return back()->withErrors(['message' => 'Incorrect password.'])->withInput();
        }

        // Handle account status
        switch ($user->userstatus_id) {
            case 1: // Active account
                Session::regenerate();
                Session::put('profile_id', $user->profile_id);
                Session::put('usertype_id', $user->userType->user_level_id);
                Session::put('station_id', $user->station_id);
                Session::put('logged_in', true);

                return redirect()->route('dashboard')->with('success', 'Login successful.');

            case 0: // Inactive account
                return back()->withErrors(['message' => 'Your account is not yet activated.'])->withInput();

            case 2: // Deactivated account
                return back()->withErrors(['message' => 'Your account has been deactivated.'])->withInput();

            default:
                return back()->withErrors(['message' => 'Unknown account status.'])->withInput();
        }
    }

    public function index()
    {
        return view('index');
    }
}

