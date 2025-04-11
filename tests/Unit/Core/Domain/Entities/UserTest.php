<?php

namespace Tests\Unit\Core\Domain\Entities;

use Core\Domain\Entities\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function it_should_create_a_user()
    {
        $user = new User('1', 'John Doe', 'john@example.com');

        $this->assertEquals('John Doe', $user->name);
        $this->assertEquals('john@example.com', $user->email);
    }

    /** @test */
    public function it_should_throw_exception_for_invalid_email()
    {
        // Intentar crear un usuario con un email inválido
        $this->expectException(\InvalidArgumentException::class);
        new User('1', 'John Doe fail', 'invalid-email');
    }
}
