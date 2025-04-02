<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['categoria_detalle' => 'Bodas', 'id_estado' => 1],
            ['categoria_detalle' => '15 Años', 'id_estado' => 1],
            ['categoria_detalle' => 'Lanzamientos Corporativos', 'id_estado' => 1],
            ['categoria_detalle' => 'Cócteles', 'id_estado' => 1],
            ['categoria_detalle' => 'Fiestas Temáticas', 'id_estado' => 1],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}
