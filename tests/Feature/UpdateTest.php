<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Cars;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_view_update_form_page(): void
    {
        // Create a user and a car
        $user = User::factory()->create();
        $car = Cars::factory()->create(['userId' => $user->id]);
        //update the calues with the form
        $response = $this->actingAs($user)->post("/update", ['id' => $car->id]);
        $response->assertStatus(200);
    }

    public function test_update_form_contains_correct_data(): void
    {
        //same as before, create a test user and car
        $user = User::factory()->create();
        $car = Cars::factory()->create(['userId' => $user->id]);
        //try to update the values with the form
        $response = $this->actingAs($user)->get("/update?id={$car->id}");
        // Assert that the response contains the updated car data
        $response->assertSee($car->model);
        $response->assertSee($car->manufacturer);
        $response->assertSee((string)$car->year);
        $response->assertSee($car->fueltype);
    }



    public function test_user_redirected_to_dashboard_with_invalid_car_id()
    {

        $user = User::factory()->create();
        $carModels = Cars::factory()->count(3)->create(['userId' => $user->id]);

        // try and update a car with an invalid car ID
        $invalidCarId = 9999;
        $response = $this->actingAs($user)->post("/update", ['id' => $invalidCarId]);
        // According to the controller the user should be redirected back to dashboard along with a error message
        $response->assertStatus(302);
        $response->assertRedirect('dashboard');
        
    }
}
