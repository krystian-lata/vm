<?php

namespace Database\Seeders;

use App\Models\Purchase;
use App\Models\User;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    public function run(): void
    {
        User::all()->each(function (User $user) {
            $user->purchases()->saveMany(Purchase::factory()->count(10)->make());
        });
    }
}
