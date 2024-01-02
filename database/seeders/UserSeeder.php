<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::whereName('Super-Admin')->first();

        if (empty($user)) {
            User::create([
                'name' => 'Mohammad',
                'email' => 'mail@gmail.com',
                'password' => Hash::make('password'),
                'remember_token' => Str::random(20),
            ]);
        }
    }
}
