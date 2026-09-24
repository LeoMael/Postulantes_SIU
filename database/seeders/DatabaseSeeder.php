<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@unap.edu.pe'],
            [
                'name' => 'Administrador OTI',
                'password' => 'admin123',
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'operador@unap.edu.pe'],
            [
                'name' => 'Operador UNAP',
                'password' => 'operador123',
                'role' => 'operador',
                'is_active' => true,
            ]
        );
    }
}
