<?php

namespace App\Interfaces\User;

use Illuminate\Support\Collection;

interface GetsUsersList
{
    public function withLatestPurchase(?string $sort, ?string $filter): Collection;
}
