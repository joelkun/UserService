<?php

namespace Core\Domain\Entities;

class User
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email
    ) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Invalid email address.");
        }
    }
}
