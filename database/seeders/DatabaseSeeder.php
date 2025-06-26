<?php

namespace Database\Seeders;

use App\Models\Creatures;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
          'name' => 'Administrateur',
          'role' => 'ADMIN',
          'email' => 'admin@pokedex.com',
          'password' => Hash::make('test123'),
          'email_verified_at' => now(),
        ]);

        User::create([
          'name' => 'Utilisateur',
          'role' => 'USER',
          'email' => 'user@pokedex.com',
          'password' => Hash::make('test123'),
          'email_verified_at' => now(),
        ]);

        User::factory(10)->create();
        Creatures::factory(50)->create();
    }
}
