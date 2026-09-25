<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Verificar que la vista de login sea accesible para invitados.
     */
    public function test_login_page_is_accessible_to_guests(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /**
     * Verificar que los usuarios no autenticados sean redirigidos al login.
     */
    public function test_unauthenticated_users_are_redirected_to_login(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/login');
    }

    /**
     * Verificar que un usuario autenticado pueda acceder al listado principal.
     */
    public function test_authenticated_user_can_access_postulantes_index(): void
    {
        $user = new User([
            'name' => 'Usuario Test',
            'email' => 'test@unap.edu.pe',
            'role' => 'admin',
            'is_active' => true,
        ]);
        $user->id = 999;

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }
}
