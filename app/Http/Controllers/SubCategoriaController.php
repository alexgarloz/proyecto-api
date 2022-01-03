<?php

namespace App\Http\Controllers;

use App\Models\SubCategoria;
use Illuminate\Http\Request;

class SubCategoriaController extends Controller
{
    public function getAll()
    {
        try {
            return response()->json([
                'success' => 'true',
                'message' => 'Sub Categorías Obtenidas Correctamente',
                'data' => SubCategoria::all()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'true',
                'message' => 'Error al Obtener la Sub Categoría',
                'data' => null
            ]);
        }
    }

    public function getId($id)
    {
        try {
            $idSubCategoria = SubCategoria::find($id);
            if (!isset($idSubCategoria)) {
                return response()->json([
                    'success' => 'true',
                    'message' => 'Error al Obtener la Sub Categoría',
                    'data' => null
                ], 404);
            } else {
                return response()->json([
                    'success' => 'true',
                    'message' => 'Sub Categoría Obtenida Correctamente',
                    'data' => $idSubCategoria
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'true',
                'message' => 'Error al Obtener la Sub Categoría',
                'data' => null
            ], 404);
        }
    }

    public function insertSubCategoria(Request $request)
    {
        $request->only(['nombre']);
        $request->validate([
            'nombre' => 'required|string'
        ]);
        try {
            $SubCategoriaCreate = SubCategoria::create([
                'nombre' => $request->nombre,
                'id_categoria' => '3'
            ]);
            return response()->json([
                'success' => 'true',
                'message' => 'Sub Categoría Insertada Correctamente',
                'data' => $SubCategoriaCreate
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'false',
                'message' => 'Error al Insertar la Sub Categoría',
                'data' => null
            ], 404);
        }
    }

    public function modifySubCategoria(Request $request)
    {
        $id = $request->route('id');
        $data = $request->only(['nombre']);

        $request->validate([
            'nombre' => 'required|string'
        ]);
        try {
            $updateSubCategoria = SubCategoria::find($id);
            if (!isset($updateSubCategoria)) {
                return response()->json([
                    'success' => 'true',
                    'message' => 'Error al Obtener la Sub Categoría',
                    'data' => null
                ], 404);
            } else {
                $updateSubCategoria->update($data);
                return response()->json([
                    'success' => 'true',
                    'message' => 'SubCategoría Modificada Correctamente',
                    'data' => $updateSubCategoria
                ], 201);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => 'false',
                'message' => 'Error al Modificar la Sub Categoría',
                'data' => null
            ], 404);
        }
    }

    public function deleteSubCategoria($id)
    {
        $Subcategoria = SubCategoria::whereId($id)->first();
        try {
            if ($Subcategoria === null) {
                return response()->json([
                    'success' => 'false',
                    'message' => 'Error No se ha podido eliminar porque no existe la sub categoría especificada',
                    'data' => null
                ], 404);
            }
            SubCategoria::destroy($id);
            return response()->json([
                'success' => 'true',
                'message' => 'Sub Categoría Eliminada Correctamente',
                'data' => $Subcategoria
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => 'true',
                'message' => 'Error al Eliminar la Sub Categoría',
                'data' => null
            ], 404);
        }
    }
}
