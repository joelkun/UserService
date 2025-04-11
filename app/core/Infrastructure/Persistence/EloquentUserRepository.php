<?php

namespace Core\Infrastructure\Persistence;

use Core\Domain\Entities\User as DomainUser;
use Core\Domain\Interfaces\UserRepositoryInterface;
use App\Models\User as EloquentUser;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function findById(int $id): ?DomainUser
    {
        $user = EloquentUser::find($id);
        return $user ? new DomainUser($user->id, $user->name, $user->email) : null;
    }

    public function save(DomainUser $user): DomainUser
    {
        $eloquent = EloquentUser::create([
            'name' => $user->name,
            'email' => $user->email
        ]);
        return new DomainUser($eloquent->id, $eloquent->name, $eloquent->email);
    }
}
