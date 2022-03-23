<?php

namespace Tests\Feature;

use Tests\TestCase;

class MenuTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMenu()
    {
        //create user and get token
        $user = createUserForTest();

        $token = $user["token"];
        $user_id = $user["user_id"];

        // Simulated landing
        $response = $this->json(
            'GET',
            "/api/menu",
            [],
            [
                'HTTP_Authorization' => $token
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
