<?php

namespace Database\Seeders;

use App\Infrastructure\Database\Eloquent\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'nama_lengkap' => 'Test User',
            'email' => 'test@example.com',
            'no_whatsapp' => '6281804228935',
            'password' => Hash::make('12345'),
        ]);
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
