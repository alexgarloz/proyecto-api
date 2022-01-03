<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAll()
    {
        try {
            return response()->json([
                'success' => 'true',
                'message' => 'Usuarios Obtenidos Correctamente',
                'data' => User::all()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'true',
                'message' => 'Error al Obtener el Usuario',
                'data' => null
            ]);
        }
    }

    public function getId($id)
    {
        try {
            $idUser = User::find($id);
            if (!isset($idUser)) {
                return response()->json([
                    'success' => 'true',
                    'message' => 'Error al Obtener el Usuario',
                    'data' => null
                ], 404);
            } else {
                return response()->json([
                    'success' => 'true',
                    'message' => 'Usuarios Obtenidos Correctamente',
                    'data' => $idUser
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'true',
                'message' => 'Error al Obtener el Usuario',
                'data' => null
            ], 404);
        }
    }

    public function insertUser(Request $request)
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
            'email' => 'string|email|max:200|unique:users',
            'password' => 'required|string|min:6',
            'rol' => 'integer|digits_between:1,2'
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
                'password' => $request->password,
            ]);
            return response()->json([
                'success' => 'true',
                'message' => 'Usuario Insertado Correctamente',
                'data' => $userCreate
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'false',
                'message' => 'Error al Insertar Usuario',
                'data' => null
            ], 404);
        }
    }

    public function modifyUser(Request $request)
    {
        $id = $request->route('id');
        $data = $request->only(['nombre', 'apellido1', 'apellido2', 'pais', 'descripcion', 'idioma', 'habilidades',
            'email', 'password', 'rol']);
        $request->validate([
            'nombre' => 'required|string',
            'apellido1' => 'required|string',
            'apellido2' => 'required|string',
            'pais' => 'required|string|max:60',
            'descripcion' => 'string|max:254',
            'idioma' => 'string|max:2',
            'habilidades' => 'string|max:250',
            'email' => 'string|email|max:200|unique:users,email,' . $id,
            'password' => 'required|string|min:6',
            'rol' => 'integer|digits_between:1,2'
        ]);
        try {
            $updateUser = User::find($id);
            if (!isset($updateUser)) {
                return response()->json([
                    'success' => 'true',
                    'message' => 'Error al Obtener el Usuario',
                    'data' => null
                ], 404);
            } else {
                $updateUser->update($data);
                return response()->json([
                    'success' => 'true',
                    'message' => 'Usuario Modificado Correctamente',
                    'data' => $updateUser
                ], 201);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'false',
                'message' => 'Error al Modificar el Usuario',
                'data' => null
            ], 404);
        }
    }

    public function deleteUser($id)
    {
        $usuario = User::whereId($id)->first();
        try {
            if ($usuario === null) {
                return response()->json([
                    'success' => 'false',
                    'message' => 'Error No se ha podido eliminar porque no existe el usuario especificado',
                    'data' => null
                ], 404);
            }
            User::destroy($id);
            return response()->json([
                'success' => 'true',
                'message' => 'Usuario Eliminado Correctamente',
                'data' => $usuario
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'true',
                'message' => 'Error al Eliminar el Usuario',
                'data' => null
            ], 404);
        }
    }
}
