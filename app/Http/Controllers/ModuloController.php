<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use Illuminate\Http\Request;

class ModuloController extends Controller
{
    public function index()
    {
        $modulos = Modulo::all();
        return response()->json($modulos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'modulo_detalle' => 'required|string|max:100',
            'icon' => 'required|string|max:50', // Validación añadida
            'activo' => 'boolean'
        ]);

        $modulo = Modulo::create($request->all());
        return response()->json($modulo, 201);
    }

    public function show(Modulo $modulo)
    {
        return response()->json($modulo);
    }

    public function update(Request $request, Modulo $modulo)
    {
        $request->validate([
            'modulo_detalle' => 'string|max:100',
            'icon' => 'string|max:50', // Validación añadida
            'activo' => 'boolean'
        ]);

        $modulo->update($request->all());
        return response()->json($modulo);
    }

    public function destroy(Modulo $modulo)
    {
        $modulo->delete();
        return response()->json(null, 204);
    }

    public function getModulosSubModulosActivos()
    {
        // Obtener módulos activos con sus sub módulos activos
        $modulos = Modulo::with(['subModulos' => function ($query) {
            $query->select('id_sub_modulo', 'id_modulo', 'sub_modulo_detalle')
                ->where('activo', 1);
        }])
            ->select('id_modulo', 'modulo_detalle', 'icon')
            ->where('activo', 1)
            ->get();

        return response()->json($modulos);
    }
}
