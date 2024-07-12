<?php

namespace App\Actions;

use App\Interfaces\User\GetsUsersList;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UsersList implements GetsUsersList
{
    public function withLatestPurchase(?string $sort = null, ?string $filter = null): Collection
    {
//        If we were creating api we could use packages like Spatie Query Builder which makes it easier to filter and sort data
        $query = User::with(['purchases' => function ($query) {
            $query->latest();
        }]);

        if ($sort === 'birthdate') {
            $query->orderByRaw('MONTH(birth_date), DAY(birth_date)');
        }
//Normally this would probably be in a separate class like i mentioned above - Spatie Query Builder supports it really well
        if ($filter === 'this_week_birthdays') {
            $startOfWeek = Carbon::now()->startOfWeek();
            $endOfWeek = Carbon::now()->endOfWeek();

            if ($startOfWeek->year !== $endOfWeek->year) {
                // Handle the case where the week spans two years
                $query->where(function ($query) use ($startOfWeek, $endOfWeek) {
                    $query->whereBetween(DB::raw('DATE_FORMAT(birth_date, "%m-%d")'), [
                        $startOfWeek->format('m-d'),
                        '12-31'
                    ])->orWhereBetween(DB::raw('DATE_FORMAT(birth_date, "%m-%d")'), [
                        '01-01',
                        $endOfWeek->format('m-d')
                    ]);
                });
            } else {
                // Handle the case where the week is within the same year
                $query->whereBetween(DB::raw('DATE_FORMAT(birth_date, "%m-%d")'), [
                    $startOfWeek->format('m-d'),
                    $endOfWeek->format('m-d')
                ]);
            }
        }

        $users = $query->get();

        $users->each(function ($user) {
            $user->latest_purchase_date = $user->purchases->first() ? Carbon::parse($user->purchases->first()->created_at)->format('Y-m-d h:i') : null;
        });

        return $users;
    }
}
