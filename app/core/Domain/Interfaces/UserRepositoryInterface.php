<?php

namespace Core\Domain\Interfaces;

use Core\Domain\Entities\User;

interface UserRepositoryInterface
{
    public function findById(int $id): ?User;
    public function save(User $user): User;
}
