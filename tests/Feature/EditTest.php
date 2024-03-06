<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Cars;
use App\Models\User;


class EditTest extends TestCase
{

    use RefreshDatabase;

    public function test_user_can_update_car_with_valid_input()
    {
        $user = User::factory()->create();
        $car = Cars::factory()->create(['userId' => $user->id]);
        $newData = [
            'id' => $car->id,
            'model' => 'New Model',
            'manufacturer' => 'New Manufacturer',
            'year' => 2022,
            'fueltype' => 'New Fuel Type',
        ];
        $response = $this->actingAs($user)->post('/edit', $newData);
        $response->assertRedirect('dashboard');
        $this->assertDatabaseHas('cars', $newData);
    }

    
}
