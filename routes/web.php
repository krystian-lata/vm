<?php

use App\Http\Controllers\Web\ListUsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', ListUsersController::class)->name('users.index');
