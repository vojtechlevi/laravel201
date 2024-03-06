<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Session;
class AccountTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_can_access_account_page(): void
    {
        $user = User::factory()->create();
        Session::put('user', $user); //since we in the controller get the current user from the session variable we need to put our test user as the session"user" here aswell
        $response = $this->actingAs($user)->get('/account');
        $response->assertStatus(200);
    }

    public function test_user_can_update_account(): void
    {
        $user = User::factory()->create();
        Session::put('user', $user);
        $newName = 'New Name';
        $newEmail = 'newemail@example.com';
        $response = $this->actingAs($user)->post('/account', [
            'name' => $newName,
            'email' => $newEmail,
        ]);
        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $newName,
            'email' => $newEmail,
        ]);
    }

    public function test_user_can_remove_account()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        Session::put('user', $user);
        $response = $this->post('removeAccount', ['id' => $user->id]);
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
        $response->assertRedirect('/');
    }

    public function test_remove_nonexisting_user(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        Session::put('user', $user);
        $response = $this->post('/removeAccount', ['id' => 999]);
        $response->assertRedirect('/');

    }
}
