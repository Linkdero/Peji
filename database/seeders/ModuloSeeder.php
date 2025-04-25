<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Modulo;

class ModuloSeeder extends Seeder
{
    public function run(): void
    {
        $modulos = [
            ['modulo_detalle' => 'Dashboard', 'icon' => 'ki-element-11', 'activo' => true],
            ['modulo_detalle' => 'Publicaciones', 'icon' => 'ki-pencil', 'activo' => true],
            ['modulo_detalle' => 'Referencias', 'icon' => 'ki-fasten', 'activo' => true],
            ['modulo_detalle' => 'Componentes', 'icon' => 'ki-code', 'activo' => true],
            ['modulo_detalle' => 'Empresa', 'icon' => 'ki-home', 'activo' => true],
        ];

        foreach ($modulos as $modulo) {
            Modulo::create($modulo);
        }

        $this->command->info('Tabla tbl_modulo poblada correctamente!');
    }
}
