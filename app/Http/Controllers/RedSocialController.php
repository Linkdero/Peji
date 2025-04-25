<?php

namespace App\Http\Controllers;

use App\Models\RedSocial;
use Illuminate\Http\Request;

class RedSocialController extends Controller
{
    /**
     * Obtiene todas las redes sociales registradas
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $redesSociales = RedSocial::all();

            return response()->json([
                'success' => true,
                'data' => $redesSociales
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las redes sociales',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Almacena una nueva red social
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'red_social_detalle' => 'required|string|max:255|unique:tbl_red_social,red_social_detalle'
        ]);

        try {
            $redSocial = RedSocial::create($request->all());

            return response()->json([
                'success' => true,
                'data' => $redSocial,
                'message' => 'Red social creada exitosamente'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la red social',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Muestra una red social específica
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $redSocial = RedSocial::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $redSocial
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Red social no encontrada',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Actualiza una red social existente
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'red_social_detalle' => 'required|string|max:255|unique:tbl_red_social,red_social_detalle,' . $id . ',id_red_social'
        ]);

        try {
            $redSocial = RedSocial::findOrFail($id);
            $redSocial->update($request->all());

            return response()->json([
                'success' => true,
                'data' => $redSocial,
                'message' => 'Red social actualizada exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la red social',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Elimina una red social
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $redSocial = RedSocial::findOrFail($id);
            $redSocial->delete();

            return response()->json([
                'success' => true,
                'message' => 'Red social eliminada exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la red social',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtiene todas las redes sociales registradas
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllRedesSociales()
    {
        $redesSociales = RedSocial::select([
            'id_red_social',
            'red_social_detalle',
            'icon'
        ])->get();

        return response()->json([
            'success' => true,
            'data' => $redesSociales
        ], 200);
    }
}
