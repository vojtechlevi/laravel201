<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cars;
use App\Models\User;
use Faker\Generator as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CarsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $models = ['XC60', 'V90', '940', '240'];
        $company = ['Volvo'];
        $year = [2016, 2020, 2021, 2022];
        $fuel = ['Gasoline', 'Diesel', 'Electric'];
        return [//instead of $this->faker  Hans used fake()->randomElement etc
            'model' => $this->faker->randomElement($models),
            'manufacturer' => $this->faker->randomElement($company),
            'year' => $this->faker->randomElement($year),
            'fueltype' => $this->faker->randomElement($fuel),
            //'userId' => User::factory()->create()->id,
            'userId' => $this->faker->randomElement(User::pluck('id')),

        ];
    }
}
