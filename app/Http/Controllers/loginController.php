<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login page.
     *
     * @return \Illuminate\View\View
     */
    public function loginPage()
    {
        return view('autentikasi.login');
    }

    /**
     * Handle the authentication request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function autentikasi(Request $request)
    {
        // Validate the incoming request
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt to authenticate the user with the given credentials
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Regenerate session to prevent session fixation
            return redirect()->intended(route('kegiatan.index')); // Redirect to kegiatan index if successful
        }

        // Return back with error message if authentication fails
        return back()->withErrors(['email' => 'These credentials do not match our records.']);
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect(route('login'));
    }
}
