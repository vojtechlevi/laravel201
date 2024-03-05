<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithoutMiddleware;

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
        //create a new user instance
        $user = new User();
        $user->name = "Test Testsson";//and assign it some test values
        $user->email = "example@yrgo.se";
        $user->password = Hash::make('123');
        $user->save();
        $response = $this->followingRedirects()->post('login', ['email' => 'example@yrgo.se', 'password' => '123',]);//try to post the credentials via the logincontroller
        $response->assertSeeText('Welcome Test Testsson!');//check to see if the succes msg gets displayed

    }

    public function test_login_user_without_password(): void
    {
        //try to log in without password
        $response = $this
        ->followingRedirects()
        ->post('login', [
            'email' => 'example@yrgo.se',//only email
        ]);
        $response->assertSeeText('Invalid email or password. Please try again.');//check to see if the error msg gets displayed
    }

    public function test_user_with_incorrect_password(): void
    {
        //create a test user
        $user = User::create(['name' => 'Testperson', 'email' => 'testPerson@yrgo.se', 'password' => Hash::make('correct-password')]);
        $response =$this->post('login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);
        $code = $this->followRedirects($response)->getStatusCode();
        $this->assertEquals(200, $code);
        $this->assertGuest();
    }

}