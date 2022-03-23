<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function testRegister()
    {
        $response = $this->json(
            'POST',
            '/api/register',
            [
                'name'  =>  $name = 'Test',
                'email'  =>  $email = time().'test@example.com',
                'password'  =>  $password = '123456789',
                'confirm_password'  =>  $password = '123456789',
            ]
        );

        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);

    }
}
