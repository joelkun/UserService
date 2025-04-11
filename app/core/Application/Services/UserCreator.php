<?php

namespace Core\Application\Services;

use Core\Domain\Entities\User;
use Core\Domain\Interfaces\UserRepositoryInterface;

class UserCreator
{
    public function __construct(private UserRepositoryInterface $repository) {}

    public function create(array $data): User
    {
        $user = new User(0, $data['name'], $data['email']);
        return $this->repository->save($user);
    }
}
