<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'admin' => 1
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Client User',
            'email' => 'client@example.com',
        ]);


        \App\Models\Status::factory()->create([
            'status' => 'Pendente',
        ]);
        \App\Models\Status::factory()->create([
            'status' => 'Em análise',
        ]);
        \App\Models\Status::factory()->create([
            'status' => 'Aprovado',
        ]);
    }
}
