<?php

namespace Tests\Unit\Core\Application\Services;

use Core\Application\Services\UserCreator;
use Core\Domain\Entities\User;
use Core\Domain\Interfaces\UserRepositoryInterface;
use PHPUnit\Framework\TestCase;

class UserCreatorTest extends TestCase
{
    /** @test */
    public function testItShouldCreateAUser()
    {
        // Creamos un mock del repositorio
        $userRepositoryMock = $this->createMock(UserRepositoryInterface::class);

        // Configuramos el mock para que devuelva el usuario creado cuando se llame al método 'save'
        $userRepositoryMock->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(User::class))
            ->willReturnCallback(function (User $user) {
                // Simulamos la persistencia devolviendo el usuario
                return $user;
            });

        // Creamos la instancia de UserCreator pasando el repositorio mockeado
        $userCreator = new UserCreator($userRepositoryMock);

        // Definimos los datos del usuario a crear
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com'
        ];

        // Llamamos al método 'create' de UserCreator
        $user = $userCreator->create($data);

        // Realizamos las aserciones necesarias
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('John Doe', $user->name);
        $this->assertEquals('john@example.com', $user->email);
    }
}
