<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\EmpresaCorreo;

class EmpresaCorreoController extends Controller
{
    public function index(Empresa $empresa)
    {
        return response()->json($empresa->correos);
    }

    public function store(Request $request, Empresa $empresa)
    {
        $validated = $request->validate([
            'correo_detalle' => 'required|email|max:100',
        ]);

        $correo = $empresa->correos()->create($validated);

        return response()->json($correo, 201);
    }

    public function show(Empresa $empresa, EmpresaCorreo $correo)
    {
        return response()->json($correo);
    }

    public function update(Request $request, Empresa $empresa, EmpresaCorreo $correo)
    {
        $validated = $request->validate([
            'correo_detalle' => 'required|email|max:100',
        ]);

        $correo->update($validated);

        return response()->json($correo);
    }

    public function destroy(Empresa $empresa, EmpresaCorreo $correo)
    {
        $correo->delete();

        return response()->json(null, 204);
    }
}
