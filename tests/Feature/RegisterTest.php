<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Testing\Fakes\Fake;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class RegisterTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_view_register(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200); //assert that we get statuscode 'OK'
    }

    public function test_register_form_displayed(): void
    {
        $response = $this->get('/register');
        $response->assertSee('Register');//assert that the register button are being displayed
    }
    public function test_register_new_user(): void
    {

         // Generate fake user data
         $userData = [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/register', $userData);
        //check to see that redirection after registration works
        $response->assertRedirect(route('login'));
        //check the db for the newly registrated user
        $this->assertDatabaseHas('users', [
            'name' => $userData['name'],
            'email' => $userData['email'],
        ]);
        // Assert that the password is hashed in the database
        $this->assertTrue(Hash::check($userData['password'], User::where('email', $userData['email'])->first()->password));
    }
}
