<?php

namespace Tests\Unit\App\Models;

use App\Models\Tag;
use PHPUnit\Framework\TestCase;

class TagTest extends TestCase
{
    private Tag $tag;
    /**
     * variables for tests
     *      *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->tag = new Tag();
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
        ];

        $this->assertEquals(
            $expectedFillable,
            $this->tag->getFillable(),
            'O valor não é o esperado'
        );
    }
}
