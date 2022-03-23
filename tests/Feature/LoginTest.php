<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLogin()
    {
        // Creating Users
        $user = createUserForTest();
        $email = $user["email"];
        $password = $user["password"];
        $user_id = $user["user_id"];

        // Simulated landing
        $response = $this->json(
            'POST',
            "/api/login",
            [
                'email' => $email,
                'password' => $password,
            ]
        );

        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        // Determine whether the login is successful
        $response->assertStatus(200);

        // Delete users
        deleteUserForTest($user_id);
    }
}
