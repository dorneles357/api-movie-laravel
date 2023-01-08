<?php

namespace Tests\Feature\Api\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ResgisterTest extends TestCase
{
    use RefreshDatabase;

    private array $user;
    private array $userMissing;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = [
            'name' => 'kleitim',
            'email' => 'bomdeguerra@gmail.com',
            'password' => 'olimpo123',
            'password_conf' => 'olimpo123'
        ];

        $this->userMissing = [
            'name' => 'kleitim',
            'email' => 'bomdeguerra@gmail.com',
            'password' => 'olimpo123',
        ];
    }
    /**
     * user create OK
     *
     * @return void
     */
    public function test_register_user()
    {
        $response = $this->postJson('/api/auth/register', $this->user);

        $response->assertStatus(201);

        $response->assertJson(function (AssertableJson $json) {
            $json->whereAll([
                'data.id' => 1,
                'data.name' => $this->user['name'],
                'data.email' => $this->user['email']
            ]);
        });
    }

    /**
     * missing atribbute fo create user
     *
     * @return void
     */
    public function test_missing_attribute(): void
    {
        $response = $this->postJson('/api/auth/register', $this->userMissing);

        $response->assertStatus(422);
    }
}
