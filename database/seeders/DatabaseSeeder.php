<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::factory()->create([
            'name' => 'Cameron Noupoue',
            'email' => 'cameron@example.com',
            'password' => Hash::make('root'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Batman',
            'email' => 'batman@example.com',
            'password' => Hash::make('root'),
        ]);
        $this->call(FillChannels::class);
        $this->call(FillMessages::class);
        $this->call(FillPosts::class);


    }
}
