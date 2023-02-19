<?php

namespace Tests\Feature\Api\Movies;

use App\Models\Movie;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CutomizationTest extends TestCase
{
    use RefreshDatabase;

    private Movie $movie;
    private Tag $tag;

    public function setUp(): void
    {
        parent::setUp();

        $this->movie = Movie::factory()->createOne();
        $this->tag = Tag::factory()->createOne();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_assign_tags()
    {
        $response = $this->postJson('/movies/assign/tags', [
            'movie_id' => $this->movie->id,
            'tag_ids' => [$this->tag->id],
        ]);

        $response->assertStatus(200);
    }

    /**
     * verifica os filmes existentes
     * 
     * @return void
     */
    public function test_list_movies(): void
    {
        $response = $this->getJson('/api/movies');

        $response->assertStatus(200);
    }

    /**
     * verifica se a listagem de filmes está em ordem ascendente
     * 
     * @return void
     */
    public function test_list_movies_asc(): void
    {
        $response = $this->getJson('/api/movies?asc=true');

        $response->assertStatus(200);
    }

    /**
     * verifica se a listagem de filmes está em ordem descendente
     * 
     * @return void
     */
    public function test_list_movies_desc(): void
    {
        $response = $this->getJson('/api/movies?desc=true');

        $response->assertStatus(200);
    }

    /**
     * verifica a procura de um filme por sua identificacão
     * 
     * @return void
     */
    public function test_find_movie_by_id(): void
    {
        $response = $this->getJson('/api/movies/' . $this->movie->id);

        $response->assertStatus(200);
    }
}
