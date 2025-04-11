<?php

namespace Tests\Unit\Core\Infrastructure\Http\Controllers;

use Core\Infrastructure\Http\Controllers\UserController;
use Core\Application\Services\UserCreator;
use Core\Domain\Interfaces\UserRepositoryInterface;
use Core\Domain\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Mockery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Log;

class UserApiServiceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function testStore()
    {
        // Crear un mock para el repositorio de usuarios
        $userRepositoryMock = Mockery::mock(UserRepositoryInterface::class);

        // Configurar la expectativa para el método save
        $userRepositoryMock->shouldReceive('save')
            ->once()
            ->with(Mockery::type(User::class)) // Asegúrate de que recibe una instancia de User
            ->andReturnUsing(function (User $user) {
                return new User(1, 'Jane Doe3', 'jane3@example.com'); // Simulamos la persistencia
            });

        // Crear el servicio de creación de usuarios con el repositorio mockeado
        $userCreator = new UserCreator($userRepositoryMock);

        // Crear el controlador y pasarle el servicio mockeado
        $userController = new UserController($userCreator);

        // Crear la solicitud simulada
        $request = new Request(['name' => 'Jane Doe3', 'email' => 'jane3@example.com']);

        // Llamar al método store del controlador
        $response = $userController->store($request);

        // Verificar que la respuesta es un JsonResponse
        $this->assertInstanceOf(JsonResponse::class, $response);

        // Verificar que la respuesta contiene los datos esperados
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals('Jane Doe3', $responseData['name']);
        $this->assertEquals('jane3@example.com', $responseData['email']);
    }
}
