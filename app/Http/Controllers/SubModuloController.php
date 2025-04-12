<?php

namespace App\Http\Controllers;

use App\Models\SubModulo;
use Illuminate\Http\Request;

class SubModuloController extends Controller
{
    public function index()
    {
        $subModulos = SubModulo::with('modulo')->get();
        return response()->json($subModulos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_modulo' => 'required|exists:tbl_modulo,id_modulo',
            'sub_modulo_detalle' => 'required|string|max:100',
            'activo' => 'boolean'
        ]);

        $subModulo = SubModulo::create($request->all());
        return response()->json($subModulo, 201);
    }

    public function show(SubModulo $subModulo)
    {
        return response()->json($subModulo->load('modulo'));
    }

    public function update(Request $request, SubModulo $subModulo)
    {
        $request->validate([
            'id_modulo' => 'exists:tbl_modulo,id_modulo',
            'sub_modulo_detalle' => 'string|max:100',
            'activo' => 'boolean'
        ]);

        $subModulo->update($request->all());
        return response()->json($subModulo);
    }

    public function destroy(SubModulo $subModulo)
    {
        $subModulo->delete();
        return response()->json(null, 204);
    }
}
