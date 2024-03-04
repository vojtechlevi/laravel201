<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Cars;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_view_dashboard(): void
    {
        $user = User::factory()->create(); // we need a user due to the middleware'auth'
        $response = $this->actingAs($user)
                         ->get('dashboard');
        $response = $this->get('dashboard');
        $response->assertSeeText('Load Cars'); // check the button are loaded
        $response->assertStatus(200);
    }

    public function test_load_cars(): void
    {

        $user = User::factory()->create();
        $this->actingAs($user);

        //create a test car
        $cars = Cars::factory()->count(3)->create();

        // go to the dashboard page
        $response = $this->get('dashboard');
        // and check that the page loads
        $response->assertStatus(200);

        // check the data are loading from the db
        foreach ($cars as $car) {
            $response->assertSee($car->model);
            $response->assertSee($car->manufacturer);
        }
    }
}
