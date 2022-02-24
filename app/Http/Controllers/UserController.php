<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            return response()->json([
                'success' => true,
                'message' => 'Usuarios Obtenidos Correctamente',
                'data' => User::where('nombre', 'LIKE', '%' . $request->terms . '%')
                    ->orWhere('apellido1', 'LIKE', '%' . $request->terms . '%')
                    ->orWhere('apellido2', 'LIKE', '%' . $request->terms . '%')
                    ->orWhere('pais', 'LIKE', '%' . $request->terms . '%')
                    ->orWhere('email', 'LIKE', '%' . $request->terms . '%')
                    ->paginate(30)//User::paginate(30) //all()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => true,
                'message' => 'Error al Obtener el Usuario',
                'data' => null
            ]);
        }
    }

    public function getSearch(Request $request)
    {

        try {
            $nombre = (empty($request->nombre)) ? '' : $request->nombre;
            dd($nombre);
//->orWhere('last_name', 'like', "%{$data}%")
            $userSearch = User::limit(20)->where('nombre', 'like', "%{$nombre}%")->get();
            if (!$nombre == '') {
                return response()->json([
                    'success' => true,
                    'message' => 'Users Obtenidos Correctamente',
                    'data' => User::limit(20)->get()
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'Users Obtenidos Correctamente',
                    'data' => $userSearch
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => true,
                'message' => 'Error al Obtener el Users',
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
                    'success' => true,
                    'message' => 'Error al Obtener el Usuario',
                    'data' => null
                ], 404);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'Usuarios Obtenidos Correctamente',
                    'data' => $idUser
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => true,
                'message' => 'Error al Obtener el Usuario',
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
                    'success' => true,
                    'message' => 'Error al Obtener el Usuario',
                    'data' => null
                ], 404);
            } else {
                $updateUser->update($data);
                return response()->json([
                    'success' => true,
                    'message' => 'Usuario Modificado Correctamente',
                    'data' => $updateUser
                ], 201);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
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
                    'success' => false,
                    'message' => 'Error No se ha podido eliminar porque no existe el usuario especificado',
                    'data' => null
                ], 404);
            }
            User::destroy($id);
            return response()->json([
                'success' => true,
                'message' => 'Usuario Eliminado Correctamente',
                'data' => $usuario
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => true,
                'message' => 'Error al Eliminar el Usuario',
                'data' => null
            ], 404);
        }
    }
}
