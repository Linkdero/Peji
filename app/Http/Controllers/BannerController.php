<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        return Banner::with('estado')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner' => 'required|string',
            'id_estado' => 'required|exists:tbl_estado,id_estado',
        ]);

        return Banner::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        return $banner->load('estado');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'banner' => 'string',
            'id_estado' => 'exists:tbl_estado,id_estado',
        ]);

        $banner->update($request->all());

        return $banner;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();

        return response()->noContent();
    }

    public function getBannersActivos()
    {
        // Asumiendo que el estado activo tiene id_estado = 1 (ajusta según tu caso)
        $banners = Banner::with('estado')
            ->whereHas('estado', function ($query) {
                $query->where('id_estado', 1);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $banners
        ]);
    }

    public function getAllBanners()
    {
        $banners = Banner::with('estado')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $banners
        ]);
    }

    public function setCambiarEstadoBanner(Request $request, $id_banner)
    {
        $request->validate([
            'id_estado' => 'required|exists:tbl_estado,id_estado',
        ]);

        $banner = Banner::findOrFail($id_banner);
        $banner->update(['id_estado' => $request->id_estado]);

        return response()->json([
            'success' => true,
            'message' => 'Estado del banner actualizado correctamente',
            'data' => $banner->load('estado')
        ]);
    }

    /**
     * Elimina un banner (soft delete)
     */
    public function setEliminarBanner($id_banner)
    {
        $banner = Banner::findOrFail($id_banner);
        $banner->delete();

        return response()->json([
            'success' => true,
            'message' => 'Banner eliminado correctamente'
        ]);
    }

    /**
     * Alternar estado entre Activo/Inactivo
     */
    public function toggleEstadoBanner($id_banner)
    {
        $banner = Banner::findOrFail($id_banner);
        $nuevoEstado = $banner->id_estado == 1 ? 2 : 1; // Cambia entre 1 y 2
        $banner->update(['id_estado' => $nuevoEstado]);

        return response()->json([
            'success' => true,
            'message' => 'Estado del banner cambiado correctamente',
            'data' => $banner->load('estado')
        ]);
    }

    public function setNuevoBanner(Request $request)
    {
        $request->validate([
            'imagenes' => 'required|array',
            'imagenes.*' => 'image|mimes:webp|max:2048',
            'id_estado' => 'sometimes|exists:tbl_estado,id_estado'
        ]);

        try {
            $bannersCreados = [];
            $idEstado = $request->input('id_estado', 1);

            // Crear la carpeta si no existe
            if (!file_exists(public_path('banners'))) {
                mkdir(public_path('banners'), 0775, true);
            }

            foreach ($request->file('imagenes') as $imagen) {
                $banner = Banner::create([
                    'id_estado' => $idEstado,
                    'banner' => ''
                ]);

                $nombreArchivo = "banner{$banner->id_banner}.webp";
                $rutaPublica = public_path("banners/{$nombreArchivo}");

                // Guardar la imagen directamente en public/banners
                $imagen->move(public_path('banners'), $nombreArchivo);

                // Actualizar el banner con el nombre del archivo
                $banner->update([
                    'banner' => $nombreArchivo
                ]);

                $bannersCreados[] = $banner;
            }

            return response()->json([
                'success' => true,
                'message' => 'Banners creados exitosamente',
                'data' => $bannersCreados
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear banners: ' . $e->getMessage()
            ], 500);
        }
    }
}
