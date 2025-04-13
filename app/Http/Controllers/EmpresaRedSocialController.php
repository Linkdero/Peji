<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\EmpresaRedSocial;
use App\Models\RedSocial;
class EmpresaRedSocialController extends Controller
{
    public function index(Empresa $empresa)
    {
        return response()->json($empresa->redesSociales);
    }

    public function store(Request $request, Empresa $empresa)
    {
        $validated = $request->validate([
            'id_red_social' => 'required|exists:tbl_red_social,id_red_social',
            'link' => 'required|url|max:255',
        ]);

        $redSocial = $empresa->redesSociales()->attach($validated['id_red_social'], ['link' => $validated['link']]);

        return response()->json($empresa->redesSociales()->find($validated['id_red_social']), 201);
    }

    public function show(Empresa $empresa, EmpresaRedSocial $redSocial)
    {
        return response()->json($redSocial->load('redSocial'));
    }

    public function update(Request $request, Empresa $empresa, EmpresaRedSocial $redSocial)
    {
        $validated = $request->validate([
            'link' => 'required|url|max:255',
        ]);

        $redSocial->update($validated);

        return response()->json($redSocial->load('redSocial'));
    }

    public function destroy(Empresa $empresa, EmpresaRedSocial $redSocial)
    {
        $redSocial->delete();

        return response()->json(null, 204);
    }
}
