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
        $user = new User();
        $user->name = "Test Testsson";
        $user->email = "example@yrgo.se";
        $user->password = Hash::make('123');
        $user->save();
        $response = $this->followingRedirects()->post('login', ['email' => 'example@yrgo.se', 'password' => '123',]);
        $response->assertSeeText('Welcome Test Testsson!');

        /* $testUser = User::create(['name' => 'Testperson', 'email' => 'testPerson@yrgo.se', 'password' => Hash::make('12345678')]);
        $response = $this->post('login', [
            'email' => $testUser->email,
            'password' => '12345678',
        ]);
        $code = $this->followRedirects($response)->getStatusCode(); //get the statuscode of the redirection
        $this->assertEquals(200, $code); //check to see if the statuscode we get back is equal to 200
        $this->assertAuthenticatedAs($testUser);//assert that the authenticated user is our testuser
 */


      /*   $user = User::create(['name' => 'Testperson', 'email' => 'testPerson@yrgo.se', 'password' => Hash::make('correct-password')]);
        $response =$this->post('login', [
            'email' => $user->email,
            'password' => $user->password,
        ]);
        $code = $this->followRedirects($response)->getStatusCode();
        $this->assertEquals(200, $code);
        $this->assertAuthenticatedAs($user);
 */
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

    public function test_guest_user(): void
    {
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
