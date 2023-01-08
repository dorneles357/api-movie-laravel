<?php

namespace Tests\Feature\Api\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CutomizationTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->createOne();
    }
    /**
     * list user by id
     * @return void
     */
    public function test_list_user_by_id(): void
    {
        $response = $this->getJson('/api/users/1');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->whereAll([
                'data.id' => 1,
                'data.name' => $this->user->name,
                'data.email' => $this->user->email,
            ]);
        });
    }

    /**
     * updade user
     *
     * @return void
     */
    public function test_update_user(): void
    {
        $user = [
            'name' => 'Kratos',
            'email' => 'bomdeguerra@gmail.com'
        ];

        $response = $this->putJson('/api/users/update/' . $this->user->id, $user);

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->whereAll([
                'data.id' => $this->user->id,
                'data.name' => 'Kratos',
                'data.email' => 'bomdeguerra@gmail.com',
            ]);
        });
    }

    /**
     * destroy user
     *
     * @return void
     */
    public function test_destroy_user(): void
    {
        $id = $this->user->id;

        $response = $this->deleteJson('/api/users/delete/' . $id);
        $responseNull = $this->getJson('/api/users/' . $id);

        $response->assertStatus(200);
        $responseNull->assertStatus(404);
    }
}
