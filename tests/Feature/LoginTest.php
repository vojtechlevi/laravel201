<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    public function test_view_login_form(): void
    {
        $response = $this->get('/');
        $response->assertSeeText('Login');//we dont actually have the words email and password in our loginpage,We only have those as placeholders
        $response->assertStatus(200);
    }

    public function test_login_user(): void
    {
        $user = new User();
        $user->name = "Test Testsson";
        $user->email = "example@yrgo.se";
        $user->password = Hash::make('123');
        $user->save();

        $response = $this
            ->followingRedirects()
            ->post('login', [
                'email' => 'example@yrgo.se',
                'password' => '123',
            ]);
            $response->assertSeeText('Welcome Test Testsson!');
    }

    public function test_login_user_without_password(): void
    {
        $response = $this
            ->followingRedirects()
            ->post('login', [
                'email' => 'example@yrgo.se',
            ]);
            $response->assertSeeText('Invalid email or password. Please try again.');
    }
}
