<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\EmpresaHorario;

class EmpresaHorarioController extends Controller
{
    public function index(Empresa $empresa)
    {
        return response()->json($empresa->horarios()->with('dia')->get());
    }

    public function store(Request $request, Empresa $empresa)
    {
        $validated = $request->validate([
            'id_dia' => 'required|exists:tbl_dia,id_dia',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_final' => 'required|date_format:H:i|after:hora_inicio',
        ]);

        $horario = $empresa->horarios()->create($validated);

        return response()->json($horario->load('dia'), 201);
    }

    public function show(Empresa $empresa, EmpresaHorario $horario)
    {
        return response()->json($horario->load('dia'));
    }

    public function update(Request $request, Empresa $empresa, EmpresaHorario $horario)
    {
        $validated = $request->validate([
            'id_dia' => 'sometimes|required|exists:tbl_dia,id_dia',
            'hora_inicio' => 'sometimes|required|date_format:H:i',
            'hora_final' => 'sometimes|required|date_format:H:i|after:hora_inicio',
        ]);

        $horario->update($validated);

        return response()->json($horario->load('dia'));
    }

    public function destroy(Empresa $empresa, EmpresaHorario $horario)
    {
        $horario->delete();

        return response()->json(null, 204);
    }
}
