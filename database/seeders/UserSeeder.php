<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create([
            'name' => 'Anderson Morales',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'), // Asegurar contraseña hasheada
        ]);
    }
}
