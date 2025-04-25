<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;

class EmpresaController extends Controller
{
    public function getInformacionEmpresa()
    {
        $empresa = Empresa::with([
            'telefonos',
            'direcciones',
            'correos',
            'horarios.dia',
            'redesSociales.redSocial'
        ])->first();

        $data = [
            'empresa_nombre' => $empresa->empresa_nombre,
            'empresa_detalle' => $empresa->empresa_detalle,
            'empresa_logo' => $empresa->empresa_logo,
            'telefonos' => $empresa->telefonos->map(function ($telefono) {
                return [
                    'id_telefono' => $telefono->id_telefono,
                    'telefono_detalle' => $telefono->telefono_detalle
                ];
            }),
            'direcciones' => $empresa->direcciones->map(function ($direccion) {
                return [
                    'direccion_detalle' => $direccion->direccion_detalle,
                    'iframe_mapa' => $direccion->iframe_mapa
                ];
            }),
            'correos' => $empresa->correos->map(function ($correo) {
                return [
                    'id_correo' => $correo->id_correo,
                    'correo_detalle' => $correo->correo_detalle
                ];
            }),
            'horarios' => $empresa->horarios->map(function ($horario) {
                return [
                    'hora_inicio' => $horario->hora_inicio,
                    'hora_final' => $horario->hora_final,
                    'dia' => [
                        'dia_detalle' => $horario->dia->dia_detalle ?? null
                    ]
                ];
            }),
            'redes_sociales' => $empresa->redesSociales->map(function ($red) {
                return [
                    'id_red' => $red->id_red,
                    'link' => $red->link,
                    'red_social' => [
                        'red_social_detalle' => $red->redSocial->red_social_detalle ?? null,
                        'icon' => $red->redSocial->icon ?? null
                    ]
                ];
            }),
        ];

        return response()->json($data);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'empresa_nombre' => 'required|string|max:100',
            'empresa_detalle' => 'nullable|string',
            'empresa_logo' => 'nullable|string',
        ]);

        $empresa = Empresa::create($validated);

        return response()->json($empresa, 201);
    }

    public function show(Empresa $empresa)
    {
        return response()->json($empresa->load([
            'telefonos',
            'direcciones',
            'correos',
            'horarios.dia',
            'redesSociales'
        ]));
    }

    public function update(Request $request, Empresa $empresa)
    {
        $validated = $request->validate([
            'empresa_nombre' => 'sometimes|required|string|max:100',
            'empresa_detalle' => 'nullable|string',
            'empresa_logo' => 'nullable|string',
        ]);

        $empresa->update($validated);

        return response()->json($empresa);
    }

    public function destroy(Empresa $empresa)
    {
        $empresa->delete();

        return response()->json(null, 204);
    }
}
