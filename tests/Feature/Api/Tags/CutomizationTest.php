<?php

namespace Tests\Feature\Api\Tags;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CutomizationTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    private Tag $tag;

    public function setUp(): void
    {
        parent::setUp();
        $this->tag = Tag::factory()->createOne();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->tag;
    }

    /**
     * criar tag
     * @return void
     */
    public function test_create_tags()
    {
        $response = $this->postJson('/api/tags/create', [
            'name' => 'terror'
        ]);

        $response->assertStatus(201);

        $response->assertJson(function (AssertableJson $json) {
            $json->whereAll([
                'data.name' => 'terror',
            ]);
        });
    }

    /**
     * deletar tag
     * @return void
     */
    public function test_delete_tags()
    {
        $response = $this->deleteJson('/api/tags/delete/' . $this->tag->id);

        $response->assertStatus(200);
    }
}
