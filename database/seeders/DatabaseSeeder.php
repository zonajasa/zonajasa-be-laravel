<?php

namespace Database\Seeders;

use App\Infrastructure\Database\Eloquent\Role;
use App\Infrastructure\Database\Eloquent\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Role::insert([
            [
                'name' => 'Pencari Jasa',
                'description' => 'role ini untuk pencari jasa',
                'created_at' => now()->timezone(config('app.timezone'))
            ],
            [
                'name' => 'Pemilik Jasa',
                'description' => 'role ini untuk pemilik jasa',
                'created_at' => now()->timezone(config('app.timezone'))
            ],
            [
                'name' => 'Admin',
                'description' => 'role ini untuk admin zonajasa',
                'created_at' => now()->timezone(config('app.timezone'))
            ]
        ]);

        User::create([
            'nama_lengkap' => 'Test User',
            'no_whatsapp' => '6281804228935',
            'password' => Hash::make('12345678'),
            'role_id' => 1,
            'created_at' => now()->timezone(config('app.timezone')),
            'status' => 'Y'
        ]);

        DB::table('headers')->insert([
            'platform' => 'mobile',
            'version' => '1',
            'client_key' => Str::random(12),
            'created_at' => now()->timezone(config('app.timezone'))
        ]);
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
