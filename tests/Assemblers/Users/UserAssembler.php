<?php

namespace Tests\Assemblers\Users;

use App\Models\Purchase;
use App\Models\User;

class UserAssembler
{
    public static function assembleUserWithBirthdate(string $birthdate): void
    {
        User::factory()->create([
            'birth_date' => $birthdate,
        ]);
    }

    public static function assembleWithPurchaseDates(array $purchaseDates): void
    {
        $user = User::factory()->create();

        foreach ($purchaseDates as $purchaseDate) {
            $user->purchases()->create(Purchase::factory()->make([
                'created_at' => $purchaseDate,
            ])->toArray());
        }
    }
}
