<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Empresa;
use App\Models\EmpresaDireccion;

class EmpresaDireccionController extends Controller
{
    public function index(Empresa $empresa)
    {
        return response()->json($empresa->direcciones);
    }

    public function store(Request $request, Empresa $empresa)
    {
        $validated = $request->validate([
            'direccion_detalle' => 'required|string|max:255',
            'iframe_mapa' => 'nullable|string',
        ]);

        $direccion = $empresa->direcciones()->create($validated);

        return response()->json($direccion, 201);
    }

    public function show(Empresa $empresa, EmpresaDireccion $direccion)
    {
        return response()->json($direccion);
    }

    public function update(Request $request, Empresa $empresa, EmpresaDireccion $direccion)
    {
        $validated = $request->validate([
            'direccion_detalle' => 'required|string|max:255',
            'iframe_mapa' => 'nullable|string',
        ]);

        $direccion->update($validated);

        return response()->json($direccion);
    }

    public function destroy(Empresa $empresa, EmpresaDireccion $direccion)
    {
        $direccion->delete();

        return response()->json(null, 204);
    }
}
