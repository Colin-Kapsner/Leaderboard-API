<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Time;
use illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()
            ->has(Time::factory()->count(10))
            ->create([
                'username' => 'ColinK',
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ]);

        User::factory(30)
            ->has(Time::factory()->count(10))
            ->create();
    }
}
