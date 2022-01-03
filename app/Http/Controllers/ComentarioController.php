<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function getAll()
    {
        try {
            return response()->json([
                'success' => 'true',
                'message' => 'Comentarios Obtenidos Correctamente',
                'data' => Comentario::all()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'true',
                'message' => 'Error al Obtener los Comentarios',
                'data' => null
            ]);
        }
    }

    public function getId($id)
    {
        try {
            $idCometario = Comentario::find($id);
            if (!isset($idCometario)) {
                return response()->json([
                    'success' => 'true',
                    'message' => 'Error al Obtener el Comentario',
                    'data' => null
                ], 404);
            } else {
                return response()->json([
                    'success' => 'true',
                    'message' => 'Cometario Obtenido Correctamente',
                    'data' => $idCometario
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'true',
                'message' => 'Error al Obtener el Comentario',
                'data' => null
            ], 404);
        }
    }

    public function insertComentario(Request $request)
    {
        $request->only(['texto']);
        $request->validate([
            'texto' => 'required|string|max:254'
        ]);
        try {
            $tipoCreate = Comentario::create([
                'texto' => $request->texto,
                'id_servicio' => '2',
                'id_usuario' => '1'
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

    public function modifyComentario(Request $request)
    {
        $id = $request->route('id');
        $data = $request->only(['texto']);
        $request->validate([
            'texto' => 'required|string|max:254'
        ]);

        try {
            $updateTipo = Comentario::find($id);
            if (!isset($updateTipo)) {
                return response()->json([
                    'success' => 'true',
                    'message' => 'Error al Modificar el Comentario',
                    'data' => null
                ], 404);
            } else {
                $updateTipo->update($data);
                return response()->json([
                    'success' => 'true',
                    'message' => 'Comentario Modificado Correctamente',
                    'data' => $updateTipo
                ], 201);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'false',
                'message' => 'Error al Modificar el Comentario',
                'data' => null
            ], 404);
        }
    }

    public function deleteComentario($id)
    {
        $tipo = Comentario::whereId($id)->first();
        try {
            if ($tipo === null) {
                return response()->json([
                    'success' => 'false',
                    'message' => 'Error No se ha podido eliminar porque no existe el comentario especificado',
                    'data' => null
                ], 404);
            }
            Comentario::destroy($id);
            return response()->json([
                'success' => 'true',
                'message' => 'Comentario Eliminado Correctamente',
                'data' => $tipo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'true',
                'message' => 'Error al Eliminar el Comentario',
                'data' => null
            ], 404);
        }
    }
}
