<?php

namespace Tests\Feature\Api\Movies;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CutomizationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_assign_tags()
    {
        $response = $this->postJson('/movies/assign/tags', [
            'movie_id' => 1,
            'tag_ids' => [1],
        ]);

        $response->assertStatus(404);
    }
}
