<?php

namespace Tests\Feature\Actions;

use App\Actions\UsersList;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Assemblers\Users\UserAssembler;
use Tests\Assemblers\Users\UserListAssembler;
use Tests\TestCase;

class UsersListTest extends TestCase
{
    use RefreshDatabase;

    private UsersList $usersList;

    protected function setUp(): void
    {
        parent::setUp();

        $this->usersList = app(UsersList::class);
    }

    public function test_it_lists_all(): void
    {
       UserListAssembler::assemble();

        $users = $this->usersList->withLatestPurchase();

        $this->assertCount(20, $users);
    }

    public function test_it_returns_none_for_no_users(): void
    {
        $users = $this->usersList->withLatestPurchase();

        $this->assertCount(0, $users);
    }

    public function test_it_lists_all_sorted_by_birth_date(): void
    {
        UserAssembler::assembleUserWithBirthdate('1985-01-01');
        UserAssembler::assembleUserWithBirthdate('1985-05-05');
        UserAssembler::assembleUserWithBirthdate('2000-12-12');

        $users = $this->usersList->withLatestPurchase(null, 'birthdate');

        $this->assertEquals('1985-01-01', $users->first()->birth_date);
        $this->assertEquals('2000-12-12', $users->last()->birth_date);
    }

    public function test_it_lists_all_with_birthdays_this_week(): void
    {
        UserListAssembler::assembleWithThisWeekBirthdate(10);
        UserListAssembler::assembleWithNotThisWeekBirthdate(10);

        $users = $this->usersList->withLatestPurchase(filter: 'this_week_birthdays');

        $this->assertCount(10, $users);
    }

    public function test_it_lists_with_latest_purchase(): void
    {
        UserAssembler::assembleWithPurchaseDates([
            '2021-01-01 12:00',
            '2021-01-02 12:00',
            '2021-01-03 12:00',
        ]);

        $users = $this->usersList->withLatestPurchase();

        $this->assertEquals('2021-01-03 12:00', $users->first()->latest_purchase_date);
    }

    public function test_it_lists_all_with_birthdays_this_week_across_year_boundary(): void
    {
        Carbon::setTestNow('2025-01-02'); // The week starts on 2024-12-30 and ends on 2025-01-05

        // Create users with birth dates in the week, spanning the year boundary
        User::factory()->create(['birth_date' => '1985-12-29']);
        User::factory()->create(['birth_date' => '1985-12-30']);
        User::factory()->create(['birth_date' => '1985-12-31']);
        User::factory()->create(['birth_date' => '1999-01-01']);
        User::factory()->create(['birth_date' => '2000-01-07']);

        $users = $this->usersList->withLatestPurchase(filter: 'this_week_birthdays');

        // Assert that only the users with birthdays this week are returned
        $this->assertCount(3, $users);
        $this->assertEquals('1985-12-30', $users[0]->birth_date);
        $this->assertEquals('1985-12-31', $users[1]->birth_date);
        $this->assertEquals('1999-01-01', $users[2]->birth_date);
    }
}
