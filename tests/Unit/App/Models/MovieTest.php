<?php

namespace Tests\Unit\App\Models;

use App\Models\Movie;
use PHPUnit\Framework\TestCase;

class MovieTest extends TestCase
{
    private Movie $movie;
    /**
     * variables for tests
     * 
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->movie = new Movie();
    }

    /**
     * ckeck fillable
     *
     * @return void
     */
    public function test_fillable(): void
    {
        $expectedFillable = [
            'name',
            'path',
            'type',
            'size',
        ];

        $this->assertEquals(
            $expectedFillable,
            $this->movie->getFillable(),
            'O valor não é o esperado'
        );
    }
}
