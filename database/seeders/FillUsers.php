<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FillUsers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ]);

        \App\Models\User::factory(5)->create();
    }
}
