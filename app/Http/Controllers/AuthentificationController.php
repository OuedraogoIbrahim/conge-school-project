<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthentificationController extends Controller
{
    //
    public function loginForm(): View
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('authentifcation.login', compact('pageConfigs'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Les informations saisies ne sont pas correctes.',
        ])->onlyInput('email');
    }

    public function passwordForgotten(): View
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('authentifcation.passwordForgotten', compact('pageConfigs'));
    }

    public function deconnexion(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function changePasswordForm()
    {
        if (!Hash::check('password', Auth::user()->password)) {
            return redirect()->route('dashboard');
        }
        return view('authentifcation.changePassword');
    }

    public function changePassword(Request $request)
    {
        $valid = $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        if ($valid['password'] == 'password') {
            return back()->withErrors([
                'password' => 'Le nouveau mot de passe doit être différent de password',
            ]);
        }

        $user = User::query()->find(Auth::user()->id);

        $user->update([
            'password' => bcrypt($valid['password']),
        ]);
        return redirect()->route('dashboard');
    }
}
