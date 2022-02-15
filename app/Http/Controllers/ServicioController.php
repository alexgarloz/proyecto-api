<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Env;

class ServicioController extends Controller
{
    public function getAll()
    {
        try {
            return response()->json([
                'success' => true,
                'message' => 'Servicios Obtenidos Correctamente',
                'data' => Servicio::all()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => true,
                'message' => 'Error al Obtener el Servicio',
                'data' => null
            ]);
        }
    }

    public function getId($id)
    {
        try {
            $idServicio = Servicio::find($id);
            if (!isset($idServicio)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Error al Obtener el Servicio',
                    'data' => null
                ], 404);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'Servicio Obtenido Correctamente',
                    'data' => response()->json([
                        'nombre' => $idServicio->nombre,
                        'descripcion' => $idServicio->descripcion,
                        'imagen' => $idServicio->imagen,
                        'precio' => $idServicio->precio,
                        'id_sub_categoria' => $idServicio->subCategoria,
                        'id_usuario' => $idServicio->usuario
                    ])
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => true,
                'message' => 'Error al Obtener el Servicio',
                'data' => null
            ], 404);
        }
    }

    public function insertServicio(Request $request)
    {
        $request->only(['nombre', 'descripcion', 'imagen', 'precio']);
        $request->validate([
            'nombre' => 'required|string|max:254',
            'descripcion' => 'required|string|max:254',
            'imagen' => 'required|string', //required|image|mimes:jpeg,png,jpg,gif,svg|max:2048
            'precio' => 'required|min:0'
        ]);

        $request->merge(['precio' => str_replace(',', '.', $request['precio'])]);

        try {
            $servicioCreate = Servicio::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'imagen' => $request->imagen,
                'precio' => $request->precio,
                'id_sub_categoria' => '3',
                'id_usuario' => '1'
            ]);
            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')
            );

            $product = $stripe->products->create([
                'name' =>  $request->nombre,
                'description' =>  $request->descripcion
                // 'images' =>
            ]);

            $stripe->prices->create([
                'product' => $product->id,
                'unit_amount' => $request->precio * 100,
                'currency' => 'eur'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Servicio Insertado Correctamente',
                'data' => $servicioCreate
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al Insertar Servicio',
                'data' => null
            ], 404);
        }
    }

    public function modifyServicio(Request $request)
    {
        $id = $request->route('id');
        $data = $request->only(['nombre', 'descripcion', 'imagen', 'precio']);

        $request->validate([
            'nombre' => 'required|string|max:254',
            'descripcion' => 'required|string|max:254',
            'imagen' => 'required|string', //required|image|mimes:jpeg,png,jpg,gif,svg|max:2048
            'precio' => 'required|min:0'
        ]);
        try {
            $updateServicio = Servicio::find($id);
            if (!isset($updateServicio)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Error al Obtener el Servicio',
                    'data' => null
                ], 404);
            } else {
                $updateServicio->update($data);
                return response()->json([
                    'success' => true,
                    'message' => 'Servicio Modificado Correctamente',
                    'data' => $updateServicio
                ], 201);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al Modificar el Servicio',
                'data' => null
            ], 404);
        }
    }

    public function deleteServicio($id)
    {
        $servicio = Servicio::whereId($id)->first();
        try {
            if ($servicio === null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error No se ha podido eliminar porque no existe el servicio especificado',
                    'data' => null
                ], 404);
            }
            Servicio::destroy($id);
            return response()->json([
                'success' => true,
                'message' => 'Servicio Eliminado Correctamente',
                'data' => $servicio
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => true,
                'message' => 'Error al Eliminar el Servicio',
                'data' => null
            ], 404);
        }
    }

}
