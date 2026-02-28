<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function index()
    {
        return view('authentications.login', [
        ]);
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email', 'min:3', 'max:255'],
            'password' => ['required', 'min:5', 'max:255']
        ]);

        if (Auth::attempt($credentials)) {
            if (!Auth::user()->is_active) {
                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();
        
                Log::error('Login failed', [
                    'error' => "Gagal Login untuk email {$request->email} [inactive user]"
                ]);

                Alert::error('Failed', 'Gagal Login, Coba Beberapa Saat Lagi.');
                return back();
            }

            $request->session()->regenerate();
            return redirect()->intended('/cms/dashboard');
        } else {
            Log::error('Login failed', [
                'error' => "Gagal Login untuk email {$request->email} [invalid credentials]"
            ]);

            Alert::error('Failed', 'Gagal Login, Coba Beberapa Saat Lagi.');
            return back();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/cms/login');
    }
}
