<?php

namespace Tests\Unit\Core\Infrastructure\Persistence;

use Core\Infrastructure\Persistence\EloquentUserRepository;
use Core\Domain\Entities\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    /** @test */
    public function it_should_save_a_user_in_the_database()
    {
        // Crear el repositorio
        $repository = new EloquentUserRepository();

        // Crear un nuevo usuario (usando la clase de entidad)
        $user = new User(1, 'Jane Doe', 'jane@example.com');

        // Guardar el usuario usando el repositorio
        $savedUser = $repository->save($user);

        // Verificar que el usuario se haya guardado correctamente
        $this->assertEquals('Jane Doe', $savedUser->name);
        $this->assertEquals('jane@example.com', $savedUser->email);

        // Verificar que el usuario también esté en la base de datos
        $storedUser = \App\Models\User::find($savedUser->id);
        $this->assertEquals('Jane Doe', $storedUser->name);
        $this->assertEquals('jane@example.com', $storedUser->email);
    }
}
