<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()
            ->count(20)
            ->create();

        //Create users with birthdays in the current week
        for ($i = 0; $i < 10; $i++) {
            User::factory()
                ->create([
                    'birth_date' => now()->startOfWeek()->addDays(rand(0, 6))->subYears(rand(18, 60))
                ]);
        }
    }
}
