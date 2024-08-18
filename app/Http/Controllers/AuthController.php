<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\PasswordUpdateRequest;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        } else {
            return view('login');
        }
    }

    /**
     * authenticate
     *
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'message' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    /**
     * logout
     *
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    /**
     * Show profile edit modal
     */
    public function edit()
    {
        $resultData = User::select('name', 'email', 'number')->find(Auth::user()->id);

        return view('profile.edit', compact(['resultData']))->render();
    }

    /**
     * Update profile
     */
    public function profileUpdate(ProfileUpdateRequest $request)
    {
        $resultData = User::where('id', Auth::user()->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'number' => $request->number,
            ]);

        ## return message
        if ($resultData) {
            return response()->json(['status' => '200', 'msg' => 'Profile Updated!!']);
        }
    }

    /**
     * Show password edit modal
     */
    public function passEdit()
    {
        $resultData = User::find(Auth::user()->id);

        return view('profile.change', compact(['resultData']))->render();
    }

    /**
     * Update password
     */
    public function passUpdate(PasswordUpdateRequest $request)
    {
        $user =  User::find(Auth::user()->id);
        $user->password =  Hash::make($request->password);
        $user->save();
        return response()->json(['status' => '200', 'msg' => 'Password Changed Successfully!!']);
    }
}
