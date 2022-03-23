<?php

namespace Tests\Feature;

use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testOrder()
    {
        // create user and get token
        $user = createUserForTest();

        $token = $user["token"];
        $user_id = $user["user_id"];

        // Simulated landing
        $response = $this->json(
            'POST',
            "/api/order",
            [
                'recipe_id' => 1,
                'stock' => 1,
                'user_id' => $user_id
            ],
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
