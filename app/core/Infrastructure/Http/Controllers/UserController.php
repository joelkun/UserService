<?php

namespace Core\Infrastructure\Http\Controllers;

use Core\Application\Services\UserCreator;
use Illuminate\Http\Request;

class UserController
{
    protected $userCreator;

    public function __construct(UserCreator $userCreator)
    {
        $this->userCreator = $userCreator;
    }

    public function store(Request $request)
    {
        $user = $this->userCreator->create($request->only(['name', 'email']));
        return response()->json($user);
    }
}
