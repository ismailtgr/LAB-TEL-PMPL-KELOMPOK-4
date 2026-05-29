<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@labtel.test'],
            [
                'name' => 'Admin Lab TEL',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'dosen@labtel.test'],
            [
                'name' => 'Dosen Lab TEL',
                'password' => Hash::make('password'),
                'role' => 'dosen',
            ]
        );

        User::updateOrCreate(
            ['email' => 'mahasiswa@labtel.test'],
            [
                'name' => 'Mahasiswa Lab TEL',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
            ]
        );
    }
}