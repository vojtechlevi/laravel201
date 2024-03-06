<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Cars;
use Illuminate\Support\Facades\Session;

class RemoveTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_remove_car()
    {

        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a car for the user
        $car = Cars::factory()->create(['userId' => $user->id]);
        //then try to remove that car
        $response = $this->post('/remove', ['id' => $car->id]);
        //after the removal of the car the user shold still be in the dashboard page
        $response->assertRedirect('dashboard');
        // check to see that the car is no longer in the database
        $this->assertDatabaseMissing('cars', ['id' => $car->id]);
    }

    public function test_attempt_to_remove_nonexistent_car()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a car ID that doesn't exist in the database
        $nonExistentCarId = 9999;
        $response = $this->post('/remove', ['id' => $nonExistentCarId]);

        // the user shoould STILL be directed back to the dashboard
        $response->assertRedirect('dashboard');
        // but this time with a error msg
        $this->assertTrue(Session::has('error'));
        $this->assertEquals('Car not found.', Session::get('error'));
    }
}
