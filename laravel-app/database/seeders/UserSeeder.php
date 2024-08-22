<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email', 'cesar@test.com')->first()) {
            User::create([
                'name' => 'Cesar',
                'email' => 'cesar@test.com',
                'password' => Hash::make('123456a', ['rounds' => 12]),
            ]);
        }
        if (!User::where('email', 'ana@test.com')->first()) {
            User::create([
                'name' => 'Ana',
                'email' => 'ana@test.com',
                'password' => Hash::make('123456b', ['rounds' => 12]),
            ]);
        }
        if (!User::where('email', 'raquel@test.com')->first()) {
            User::create([
                'name' => 'Raquel',
                'email' => 'raquel@test.com',
                'password' => Hash::make('123456a', ['rounds' => 12]),
            ]);
        }
        if (!User::where('email', 'sara@test.com')->first()) {
            User::create([
                'name' => 'Sara',
                'email' => 'sara@test.com',
                'password' => Hash::make('123456a', ['rounds' => 12]),
            ]);
        }
    }
}
