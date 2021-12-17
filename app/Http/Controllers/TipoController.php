<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    public function getAll()
    {
        try {
            return response()->json([
                'success' => 'true',
                'message' => 'Tipos Obtenidos Correctamente',
                'data' => Tipo::all()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'true',
                'message' => 'Error al Obtener el Tipo',
                'data' => null
            ]);
        }
    }

    public function getId($id)
    {
        try {
            $idTipo = Tipo::find($id);
            if (!isset($idTipo)) {
                return response()->json([
                    'success' => 'true',
                    'message' => 'Error al Obtener el Tipo',
                    'data' => null
                ], 404);
            } else {
                return response()->json([
                    'success' => 'true',
                    'message' => 'Tipos Obtenidos Correctamente',
                    'data' => $idTipo
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'true',
                'message' => 'Error al Obtener el Tipo',
                'data' => null
            ], 404);
        }
    }

    public function insertTipo(Request $request)
    {
        $request->only(['nombre']);
        $request->validate([
            'nombre' => 'required|string|max:254'
        ]);
        try {
            $tipoCreate = Tipo::create([
                'nombre' => $request->nombre,
            ]);
            return response()->json([
                'success' => 'true',
                'message' => 'Tipo Insertado Correctamente',
                'data' => $tipoCreate
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'false',
                'message' => 'Error al Insertar el Tipo',
                'data' => null
            ], 404);
        }
    }

    public function modifyTipo(Request $request)
    {
        $id = $request->route('id');
        $data = $request->only(['nombre']);
        $request->validate([
            'nombre' => 'required|string|max:254'
        ]);
        try {
            $updateTipo = Tipo::find($id);
            $updateTipo->update($data);
            return response()->json([
                'success' => 'true',
                'message' => 'Tipo Modificado Correctamente',
                'data' => $updateTipo
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'false',
                'message' => 'Error al Modificar el Tipo',
                'data' => null
            ], 404);
        }
    }

    public function deleteTipo($id)
    {
        $tipo = Tipo::whereId($id)->first();
        try {
            if ($tipo === null) {
                return response()->json([
                    'success' => 'false',
                    'message' => 'Error No se ha podido eliminar porque no existe el tipo especificado',
                    'data' => null
                ], 404);
            }
            Tipo::destroy($id);
            return response()->json([
                'success' => 'true',
                'message' => 'Tipo Eliminado Correctamente',
                'data' => $tipo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'true',
                'message' => 'Error al Eliminar el Tipo',
                'data' => null
            ], 404);
        }
    }
}
