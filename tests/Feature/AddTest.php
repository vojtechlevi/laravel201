<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AddTest extends TestCase
{
   use RefreshDatabase;
   use WithFaker;

    public function test_view_add_page(): void
    {
        $response = $this->get('/add');

        $response->assertStatus(200);
    }

    public function test_display_add_form(): void
    {

         $user = User::factory()->create();
         $this->actingAs($user);

         $response = $this->get('/add');
         $response->assertStatus(200)
             ->assertSee('Submit'); // we check to see if the submit button on the form are being displayed since we dont use labels only placeholder text wich doesnt work on assertSee

    }

    public function test_add_car(): void
    {

        $user = User::factory()->create();
        $this->actingAs($user);

        // Generate fake car data
        $carData = [
            'model' => $this->faker->word,
            'manufacturer' => $this->faker->company,
            'year' => $this->faker->numberBetween(1900, 2022),
            'fueltype' => $this->faker->randomElement(['Gasoline', 'Diesel', 'Electric']),
        ];
        $response = $this->post('/cars', $carData);//the route for the formsubmission isnt 'add' its /cars

        // check that the user is redirected after adding the car
        $response->assertRedirect('dashboard');

        // control the database is populated with the correct data that we created
        $this->assertDatabaseHas('cars', $carData);
    }
}
