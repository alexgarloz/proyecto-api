<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::check()) {
            return ['success' => 'true', 'response' => 'El usuario ya está logueado'];
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return ['success' => 'true',
                'response' => 'Has iniciado Sesión',
                'usuario' => Auth::user()
            ];
        }
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }
}
