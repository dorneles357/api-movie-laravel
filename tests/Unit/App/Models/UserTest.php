<?php

namespace Tests\Unit\App\Models;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;
    /**
     * variables for tests
     *      *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->user = new User();
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
            'email',
            'password',
        ];

        $this->assertEquals(
            $expectedFillable,
            $this->user->getFillable(),
            'O valor não é o esperado'
        );
    }

    /**
     * ckeck hidden
     *
     * @return void
     */
    public function test_hidden(): void
    {
        $expectedHidden = [
            'password',
        ];

        $this->assertEquals(
            $expectedHidden,
            $this->user->getHidden(),
            'O valor não é o esperado'
        );
    }
}
