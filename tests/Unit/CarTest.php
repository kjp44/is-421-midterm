<?php

namespace Tests\Unit;

use Faker\Factory as Faker;
use Tests\TestCase;
use App\Car;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;


class CarTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCarInsert()
    {
        $faker = Faker::create();
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));
        $car = new Car();
        $car->make = $faker->randomElement($array = array ('Ford','Toyota','Honda'));
        $car->model = $faker->vehicleModel;
        $car->year = $faker->biasedNumberBetween(1950, 2018, 'sqrt');
        $car->created_at = now();
        $car->updated_at = now();
        $this->assertTrue($car->save());
    }

    public function testCarYearUpdate()
    {
        $car = Car::inRandomOrder()->first();
        $car->year = 2000;
        $this->assertTrue($car->save());
    }

    public function testCarDelete()
    {
        $car = Car::inRandomOrder()->first();
        $this->assertTrue($car->delete());
    }

    public function testTableSeederCount()
    {
        Artisan::call('migrate:refresh');
        $this->seed('CarsTableSeeder');
        $this->assertTrue(Car::count() == 50);
    }

    public function testCarYearIsInteger()
    {
        $car = Car::inRandomOrder()->first();
        $this->assertInternalType('int', (int)$car->year);
    }

    public function testCarMakeIsValid()
    {
        $car = Car::inRandomOrder()->first();
        $this->assertTrue(in_array($car->make, array('Ford', 'Toyota', 'Honda')));
    }

    public function testCarModelIsString()
    {
        $car = Car::inRandomOrder()->first();
        $this->assertInternalType('string', $car->model);
    }
}
