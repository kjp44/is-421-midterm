<?php

namespace Tests\Unit;

use Faker\Factory as Faker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Console\Factories;

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
        $this->assertTrue(
            DB::table('users')->insert(
                [
                    'name' => $user->name,
                    'email' => $user->email,
                    'email_verified_at' => $user->email_verified_at,
                    'password' => $user->password,
                    'remember_token' => $user->remember_token
                ]
            )
        );
    }

    public function testUserNameUpdate()
    {
        $user = User::inRandomOrder()->first();
        $this->assertTrue(
            (DB::table('users')
            ->where('id', $user->id)
            ->update(['name' => 'Steve Smith'])) == 1
        );
    }

    public function testUserDelete()
    {
        $user = User::inRandomOrder()->first();
        $this->assertTrue(( DB::table('users')->where('id', $user->id)->delete())==1);
        dd($user->id);
    }
}
