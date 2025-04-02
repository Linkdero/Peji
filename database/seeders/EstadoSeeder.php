<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estados = [
            ['estado_detalle' => 'Activo'],
            ['estado_detalle' => 'Inactivo'],
            ['estado_detalle' => 'Pendiente'],
            ['estado_detalle' => 'Eliminado'],
        ];

        foreach ($estados as $estado) {
            Estado::create($estado);
        }
    }
}
