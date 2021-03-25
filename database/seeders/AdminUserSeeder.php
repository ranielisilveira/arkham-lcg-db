<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ranieli',
            'email' => 'ranielisilveira@hotmail.com',
            'password' => Hash::make('12345678'),
            'is_admin' => true,
            'is_verified' => true,
        ]);

        }
    }
