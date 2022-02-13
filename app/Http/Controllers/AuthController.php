<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function registerUser(Request $request)
    {
        $request->only(['nombre', 'apellido1', 'apellido2', 'pais', 'descripcion', 'idioma', 'habilidades',
            'email', 'password', 'rol']);

        $request->validate([
            'nombre' => 'required|string',
            'apellido1' => 'required|string',
            'apellido2' => 'required|string',
            'pais' => 'required|string|max:60',
            'descripcion' => 'string|max:254',
            'idioma' => 'string|max:2',
            'habilidades' => 'string|max:250',
            'email' => 'required|string|email|max:200|unique:users',
            'password' => 'required|string|min:6',
            'rol' => 'required|integer|digits_between:1,2'
        ]);
        try {

            $userCreate = User::create([
                'nombre' => $request->nombre,
                'apellido1' => $request->apellido1,
                'apellido2' => $request->apellido2,
                'pais' => $request->pais,
                'descripcion' => $request->descripcion,
                'idioma' => $request->idioma,
                'habilidades' => $request->habilidades,
                'rol' => $request->rol,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Usuario Creado Correctamente',
                'data' => $userCreate
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al Crear el Usuario',
                'data' => null
            ], 404);
        }
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('auth_token')->plainTextToken;

        //$token = $tokenResult->token;

        //$tokenResult->save();

        return response()->json([
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
            //'expires_at' => Carbon::parse($tokenResult)->toDateTimeString()
        ]);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'response' => 'Session cerrada correctamente'
        ]);
    }
}
