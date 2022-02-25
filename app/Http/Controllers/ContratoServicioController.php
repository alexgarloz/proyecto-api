<?php

namespace App\Http\Controllers;

use App\Models\ContratoServicio;

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
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'Contrato Servicio Obtenidos Correctamente',
                    'data' => $idContratoServicio
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al Obtener el Contrato Servicio',
                'data' => null
            ], 404);
        }
    }
}
