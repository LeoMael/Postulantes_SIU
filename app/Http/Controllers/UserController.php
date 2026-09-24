<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Verificar que el usuario autenticado sea Administrador
     */
    private function verificarAdmin(): void
    {
        if (! Auth::check() || ! Auth::user()->isAdmin()) {
            abort(403, 'Acceso no autorizado.');
        }
    }

    /**
     * Listar todos los usuarios para el panel de administración
     */
    public function index(): JsonResponse
    {
        $this->verificarAdmin();

        $users = User::orderBy('id', 'asc')
            ->get(['id', 'name', 'email', 'role', 'is_active', 'created_at']);

        return response()->json([
            'success' => true,
            'data' => $users,
            'current_user_id' => Auth::id(),
        ]);
    }

    /**
     * Registrar un nuevo usuario
     */
    public function store(Request $request): JsonResponse
    {
        $this->verificarAdmin();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'role' => ['required', Rule::in(['admin', 'operador'])],
        ], [
            'name.required' => 'El nombre completo es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingrese un correo electrónico válido.',
            'email.unique' => 'Ya existe un usuario registrado con este correo.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'role.required' => 'Debe seleccionar un rol para el usuario.',
            'role.in' => 'El rol seleccionado no es válido.',
        ]);

        $user = User::create([
            'name' => trim($validated['name']),
            'email' => strtolower(trim($validated['email'])),
            'password' => $validated['password'],
            'role' => $validated['role'],
            'is_active' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Usuario creado exitosamente.',
            'data' => $user,
        ], 201);
    }

    /**
     * Actualizar la contraseña de un usuario
     */
    public function updatePassword(Request $request, int $id): JsonResponse
    {
        $this->verificarAdmin();

        $validated = $request->validate([
            'password' => ['required', 'string', 'min:6'],
        ], [
            'password.required' => 'La nueva contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
        ]);

        $user = User::findOrFail($id);
        $user->password = $validated['password'];
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Contraseña actualizada correctamente.',
        ]);
    }

    /**
     * Alternar estado Activo / Inactivo del usuario
     */
    public function toggleStatus(int $id): JsonResponse
    {
        $this->verificarAdmin();

        if (Auth::id() === $id) {
            return response()->json([
                'success' => false,
                'message' => 'No puedes desactivar tu propia cuenta de administrador.',
            ], 422);
        }

        $user = User::findOrFail($id);
        $user->is_active = ! $user->is_active;
        $user->save();

        $estado = $user->is_active ? 'activado' : 'desactivado';

        return response()->json([
            'success' => true,
            'message' => "El usuario ha sido {$estado} correctamente.",
            'is_active' => $user->is_active,
        ]);
    }

    /**
     * Eliminar un usuario
     */
    public function destroy(int $id): JsonResponse
    {
        $this->verificarAdmin();

        if (Auth::id() === $id) {
            return response()->json([
                'success' => false,
                'message' => 'No puedes eliminar tu propia cuenta de administrador.',
            ], 422);
        }

        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Usuario eliminado correctamente.',
        ]);
    }
}
