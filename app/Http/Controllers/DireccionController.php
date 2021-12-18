<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DireccionController extends Controller
{
    public function getAll()
    {
        try {
            return response()->json([
                'success' => 'true',
                'message' => 'Dirección Obtenida Correctamente',
                'data' => Direccion::all()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'true',
                'message' => 'Error al Obtener la Dirección',
                'data' => null
            ]);
        }
    }

    public function getId($id)
    {
        try {
            $idDireccion = Direccion::find($id);
            if (!isset($idDireccion)) {
                return response()->json([
                    'success' => 'true',
                    'message' => 'Error al Obtener la Dirección',
                    'data' => null
                ], 404);
            } else {
                return response()->json([
                    'success' => 'true',
                    'message' => 'Dirección Obtenida Correctamente',
                    'data' => $idDireccion
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'true',
                'message' => 'Error al Obtener la Dirección',
                'data' => null
            ], 404);
        }
    }

    public function insertDireccion(Request $request)
    {
        $request->only(['codigo_postal', 'pais', 'provincia', 'domicilio', 'ciudad']);
        $request->validate([
            'codigo_postal' => 'digits:5',
            'pais' => 'string|max:254',
            'provincia' => 'string|max:254',
            'domicilio' => 'string|max:254',
            'ciudad' => 'string|max:254'
        ]);
        try {
            $direccionCreate = Direccion::create([
                'codigo_postal' => $request->codigo_postal,
                'pais' => $request->pais,
                'provincia' => $request->provincia,
                'domicilio' => $request->domicilio,
                'ciudad' => $request->ciudad,
                'id_usuario' => '2'//Auth::user()->id
            ]);
            return response()->json([
                'success' => 'true',
                'message' => 'Dirección Insertada Correctamente',
                'data' => $direccionCreate
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'false',
                'message' => 'Error al Insertar la Dirección',
                'data' => null
            ], 404);
        }
    }

    public function modifyDireccion(Request $request)
    {
        $id = $request->route('id');
        $data = $request->only(['codigo_postal', 'pais', 'provincia', 'domicilio', 'ciudad']);

        $request->validate([
            'codigo_postal' => 'integer|max:6',
            'pais' => 'string|max:254',
            'provincia' => 'string|max:254',
            'domicilio' => 'string|max:254',
            'ciudad' => 'string|max:254'
        ]);
        try {
            $updateDireccion = Direccion::find($id);
            $updateDireccion->update($data);
            return response()->json([
                'success' => 'true',
                'message' => 'Dirección Modificada Correctamente',
                'data' => $updateDireccion
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'false',
                'message' => 'Error al Modificar la Dirección',
                'data' => null
            ], 404);
        }
    }

    public function deleteDireccion($id)
    {
        $direccion = Direccion::whereId($id)->first();
        try {
            if ($direccion === null) {
                return response()->json([
                    'success' => 'false',
                    'message' => 'Error No se ha podido eliminar porque no existe la dirección especificada',
                    'data' => null
                ], 404);
            }
            Direccion::destroy($id);
            return response()->json([
                'success' => 'true',
                'message' => 'Dirección Eliminada Correctamente',
                'data' => $direccion
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'true',
                'message' => 'Error al Eliminar la Dirección',
                'data' => null
            ], 404);
        }
    }
}
