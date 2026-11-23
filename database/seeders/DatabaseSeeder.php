<?php

namespace Database\Seeders;

use App\Models\Band;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Default Admin Account
        User::firstOrCreate(
            ['email' => 'admin@bandroster.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin@bandroster.com'),
                'user_type' => User::TYPE_ADMIN,
            ]
        );

        // 2. Default Generic User Account
        User::firstOrCreate(
            ['email' => 'user@bandroster.com'],
            [
                'name' => 'Standard User',
                'password' => Hash::make('user@bandroster.com'),
                'user_type' => User::TYPE_GENERIC_USER,
            ]
        );

        // 3. Sample Bands & Albums
        $metallica = Band::firstOrCreate(['name' => 'Metallica']);
        $metallica->albums()->firstOrCreate(
            ['name' => 'Master of Puppets'],
            ['release_date' => '1986-03-03']
        );
        $metallica->albums()->firstOrCreate(
            ['name' => 'Ride the Lightning'],
            ['release_date' => '1984-07-27']
        );

        $daftPunk = Band::firstOrCreate(['name' => 'Daft Punk']);
        $daftPunk->albums()->firstOrCreate(
            ['name' => 'Discovery'],
            ['release_date' => '2001-03-12']
        );
        $daftPunk->albums()->firstOrCreate(
            ['name' => 'Random Access Memories'],
            ['release_date' => '2013-05-17']
        );

        $radiohead = Band::firstOrCreate(['name' => 'Radiohead']);
        $radiohead->albums()->firstOrCreate(
            ['name' => 'OK Computer'],
            ['release_date' => '1997-05-21']
        );
    }
}
