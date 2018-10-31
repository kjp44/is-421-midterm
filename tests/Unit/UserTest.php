<?php

namespace Tests\Unit;

use Faker\Factory as Faker;
use Tests\TestCase;
use App\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserInsert()
    {
        $faker = Faker::create();
        $user = new User();
        $user->name = $faker->name;
        $user->email = $faker->unique()->safeEmail;
        $user->email_verified_at = now();
        $user->password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm';
        $user->remember_token = str_random(10);
        $this->assertTrue($user->save());
    }

    public function testUserNameUpdate()
    {
        $user = User::inRandomOrder()->first();
        $user->name = 'Steve Smith';
        $this->assertTrue($user->save());
    }

    public function testUserDelete()
    {
        $user = User::inRandomOrder()->first();
        $this->assertTrue($user->delete());
    }

    public function testTableSeederCount()
    {
        Artisan::call('migrate:refresh');
        $this->seed('UsersTableSeeder');
        $this->assertTrue(User::count() == 50);
    }
}
