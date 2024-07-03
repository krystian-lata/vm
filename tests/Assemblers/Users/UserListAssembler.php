<?php

namespace Tests\Assemblers\Users;

use App\Models\User;

class UserListAssembler
{
    public static function assemble(int $count = 20): void
    {
        User::factory()->count($count)->create();
    }

    public static function assembleWithThisWeekBirthdate(int $count): void
    {
        for ($i = 0; $i < $count; $i++) {
            User::factory()
                ->create([
                    'birth_date' => now()->startOfWeek()->addDays(rand(0, 6))->subYears(rand(18, 60))
                ]);
        }
    }

    public static function assembleWithNotThisWeekBirthdate(int $count): void
    {
        for ($i = 0; $i < $count; $i++) {
            User::factory()
                ->create([
                    'birth_date' => now()->startOfWeek()->subDays(rand(7, 365))->subYears(rand(18, 60))
                ]);
        }
    }
}
