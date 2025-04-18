<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Anderson Morales',
            'email' => 'anderson@gmail.com',
            'password' =>  Hash::make('password'),
        ]);

        $this->call([
            EstadoSeeder::class, // Asegúrate de tener este seeder para los estados
            CategoriaSeeder::class,
            TagSeeder::class,
            NoticiaSeeder::class,
            ModuloSeeder::class,
            SubModuloSeeder::class,
            DiaSeeder::class,
            RedSocialSeeder::class,
            EmpresaSeeder::class,
            UsuarioPaginaSeeder::class,
        ]);
    }
}
