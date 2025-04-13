<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\EmpresaTelefono;
class EmpresaTelefonoController extends Controller
{
    public function index(Empresa $empresa)
    {
        return response()->json($empresa->telefonos);
    }

    public function store(Request $request, Empresa $empresa)
    {
        $validated = $request->validate([
            'telefono_detalle' => 'required|string|max:20',
        ]);

        $telefono = $empresa->telefonos()->create($validated);

        return response()->json($telefono, 201);
    }

    public function show(Empresa $empresa, EmpresaTelefono $telefono)
    {
        return response()->json($telefono);
    }

    public function update(Request $request, Empresa $empresa, EmpresaTelefono $telefono)
    {
        $validated = $request->validate([
            'telefono_detalle' => 'required|string|max:20',
        ]);

        $telefono->update($validated);

        return response()->json($telefono);
    }

    public function destroy(Empresa $empresa, EmpresaTelefono $telefono)
    {
        $telefono->delete();

        return response()->json(null, 204);
    }
}
