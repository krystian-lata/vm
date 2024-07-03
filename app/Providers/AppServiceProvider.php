<?php

namespace App\Providers;

use App\Actions\UsersList;
use App\Interfaces\User\GetsUsersList;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GetsUsersList::class, UsersList::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
