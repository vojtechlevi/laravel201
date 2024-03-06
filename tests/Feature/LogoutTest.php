<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_view_logout(): void
    {
        // Create a test user to log out with
        $user = new User();
        $user->name = "Test Testsson";
        $user->email = "example@yrgo.se";
        $user->password = Hash::make('123');
        $user->save();
        $this->actingAs($user);

       //try to log out the user
        $response = $this->get('logout');

        // check to see that the "user" gets redireted to the login page
        $response->assertRedirect('/');
        $this->assertGuest();
    }
}
