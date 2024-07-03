<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Interfaces\User\GetsUsersList;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ListUsersController extends Controller
{
//    We pass interface as DI to easily be able to swap implementations in case we need to change the logic
    public function __construct(
        private readonly GetsUsersList $getUsersList
    )
    {

    }
    public function __invoke(Request $request)
    {
//        Could be validated inside Request to prevent unwanted sorts/filters
        $sort = $request->query('sort');
        $filter = $request->query('filter');

        return Inertia::render('User/Index', [
            'users' => $this->getUsersList->withLatestPurchase($sort, $filter),
        ]);
    }
}
