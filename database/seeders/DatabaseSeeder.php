<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::beginTransaction();
        try {
            DB::table('roles')->insert([
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
                    'name' => 'Superadmin',
                    'description' => 'role ini untuk admin zonajasa',
                    'created_at' => now()->timezone(config('app.timezone'))
                ]
            ]);

            DB::table('account_levels')->insert([[
                'name' => 'Free',
                'description' => 'akun gratis dengan fitur terbatas',
                'min_points' => 0,
                'created_at' => now()->timezone(config('app.timezone'))
            ], [
                'name' => 'Silver',
                'description' => 'akun silver dengan fitur lebih banyak',
                'min_points' => 100,
                'created_at' => now()->timezone(config('app.timezone'))
            ], [
                'name' => 'Gold',
                'description' => 'akun gold dengan fitur lengkap',
                'min_points' => 500,
                'created_at' => now()->timezone(config('app.timezone'))
            ], [
                'name' => 'Platinum',
                'description' => 'akun platinum dengan fitur premium',
                'min_points' => 1000,
                'created_at' => now()->timezone(config('app.timezone'))
            ], [
                'name' => 'Diamond',
                'description' => 'akun diamond dengan fitur eksklusif',
                'min_points' => 5000,
                'created_at' => now()->timezone(config('app.timezone'))
            ]]);

            DB::table('users')->insert([
                'id' => Str::random(20),
                'roles_id' => 1, //pencari jasa
                'account_levels_id' => 1, //free
                'status_account' => 1,
                'status_service' => 0, //belum punya jasa
                'full_name' => 'La bengki',
                'whatsapp' => "6281804228935",
                'password' => Hash::make('12345678'),
                'created_at' => now()->timezone(config('app.timezone')),
            ]);

            DB::table('headers')->insert([
                'platform' => 'mobile',
                'version' => '1',
                'client_key' => Str::random(12),
                'created_at' => now()->timezone(config('app.timezone'))
            ]);
            DB::commit();
            Log::info('Database seeding completed successfully.');
        } catch (\Exception $e) {
            DB::rollBack(); //kalo gagal jangan dimasukin datanya
            Log::error('Error seeding database: ' . $e->getMessage());
        }
    }
}
