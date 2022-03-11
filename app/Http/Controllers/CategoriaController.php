<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Tipo;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $request->terms = trim($request->terms);
            return response()->json([
                'success' => true,
                'message' => 'Categorías Obtenidas Correctamente',//->paginate(30)
                'data' => Categoria::where('nombre', 'LIKE', '%' . $request->terms . '%')
                    ->addSelect(['tipoNombre' => Tipo::select('nombre')
                        ->whereColumn('id_tipo', 'tipo.id')
                    ])->paginate(30)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al Obtener la Categoría',
                'data' =>   null
            ]);
        }
    }

    public function getId($id)
    {
        try {
            $idCategoria = Categoria::find($id);
            if (!isset($idCategoria)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al Obtener la Categoría',
                    'data' => null
                ], 404);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'Categoría Obtenida Correctamente',
                    'data' => $idCategoria
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al Obtener la Categoría',
                'data' => null
            ], 404);
        }
    }

    public function insertCategoria(Request $request)
    {
        $request->only(['nombre', 'tipo']);
        $request->validate([
            'nombre' => 'required|string'
        ]);
        try {
            $categoriaCreate = Categoria::create([
                'nombre' => $request->nombre,
                'tipo' => 'tipo',
                'id_tipo' => '1'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Categoría Insertada Correctamente',
                'data' => $categoriaCreate
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al Insertar la Categoría',
                'data' => null
            ], 404);
        }
    }

    public function modifyCategoria(Request $request)
    {
        $id = $request->route('id');
        $data = $request->only(['nombre', 'tipo']);

        $request->validate([
            'nombre' => 'required|string'
        ]);

        $updateCategoria = Categoria::find($id);
        try {
            if (!isset($updateCategoria)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al Obtener la Categoría',
                    'data' => null
                ], 404);
            } else {
                $updateCategoria->update($data);
                return response()->json([
                    'success' => true,
                    'message' => 'Categoría Modificado Correctamente',
                    'data' => $updateCategoria
                ], 201);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al Modificar la Categoría',
                'data' => null
            ], 404);
        }
    }

    public function deleteCategoria($id)
    {
        $categoria = Categoria::whereId($id)->first();
        try {
            if ($categoria === null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error No se ha podido eliminar porque no existe la categoría especificada',
                    'data' => null
                ], 404);
            }
            Categoria::destroy($id);
            return response()->json([
                'success' => true,
                'message' => 'Categoría Eliminada Correctamente',
                'data' => $categoria
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al Eliminar la Categoría',
                'data' => null
            ], 404);
        }
    }
}
