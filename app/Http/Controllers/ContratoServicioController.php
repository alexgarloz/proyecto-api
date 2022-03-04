<?php

namespace App\Http\Controllers;

use App\Models\ContratoServicio;
use Carbon\Carbon;

class ContratoServicioController extends Controller
{
    public function getIdUser($id)
    {
        try {
            $idContratoServicio = ContratoServicio::where('id_usuario', $id)->get();
            if (!isset($idContratoServicio)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al Obtener el Contrato Servicio',
                    'data' => null
                ], 404);
            }
            $resultadoAnydados = [];
            foreach ($idContratoServicio as $ficha_contrato) {
                $resultadoAnydados[] = [
                    'id' => $ficha_contrato->id,
                    'descripcion' => $ficha_contrato->servicio->descripcion,
                    'precio' => str_replace('.', ',', $ficha_contrato->precio),
                    'fecha_inicio' => Carbon::parse($ficha_contrato->fecha_inicio)->locale('es')
                        ->format('d M, Y H:m'),
                    'fecha_fin' => Carbon::parse($ficha_contrato->fecha_fin)->locale('es')
                        ->format('d M, Y H:m'),
                    'servicio_nombre' => $ficha_contrato->servicio->nombre,
                    'usuario_nombre' => $ficha_contrato->usuario->nombre,
                    'fecha_status' => date('Ynj', strtotime($ficha_contrato->fecha_fin))
                ];
            }

            return response()->json([
                'success' => true,
                'message' => 'Contrato Servicio Obtenidos Correctamente',
                'data' => $resultadoAnydados
            ], 200);



        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al Obtener el Contrato Servicio',
                'data' => null
            ], 404);
        }
    }
}
