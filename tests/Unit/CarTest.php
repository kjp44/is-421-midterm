<?php

namespace Tests\Unit;

use Faker\Factory as Faker;
use Tests\TestCase;
use App\Car;
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
        $this->assertTrue(
            DB::table('cars')->insert(
                [
                    'make' => $car->make,
                    'model' => $car->model,
                    'year' => $car->year,
                    'created_at' => $car->created_at,
                    'updated_at' => $car->updated_at
                ]
            )
        );
    }

    public function testCarYearUpdate()
    {
        $car = Car::inRandomOrder()->first();
        $this->assertTrue(
            (DB::table('cars')
                ->where('id', $car->id)
                ->update(['year' => 2000])) == 1
        );
    }

    public function testCarDelete()
    {
        $car = Car::inRandomOrder()->first();
        $this->assertTrue(( DB::table('cars')->where('id', $car->id)->delete())==1);
    }

    public function testTableSeederCount()
    {
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
