<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RoleController extends Controller
{
    use AuthorizesRequests;
    public function json()
    {
        // Проверка прав доступа
        $this->authorize('viewAny', Role::class);

        $roles = Role::all();
        return response()->json($roles);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['message' => 'Роль не найдена'], 404);
        }

        // Проверка прав доступа
        $this->authorize('view', $role);

        return new RoleResource($role);
    }

    public function store(Request $request)
    {
        // Проверка прав доступа
        $this->authorize('create', Role::class);

        $validator = Validator::make($request->all(), [
            'role_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:roles',
            'role_description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $role = Role::create($request->all());

        return response()->json([
            'message' => 'Роль успешно добавлена.',
            'data' => new RoleResource($role),
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['message' => 'Роль не найдена'], 404);
        }

        // Проверка прав доступа
        $this->authorize('update', $role);

        $validator = Validator::make($request->all(), [
            'role_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:roles,slug,' . $role->role_id . ',role_id',
            'role_description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $role->update($request->all());

        return response()->json([
            'message' => 'Роль успешно обновлена.',
            'data' => new RoleResource($role),
        ], 200);
    }

    public function destroy(string $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['message' => 'Роль не найдена'], 404);
        }

        // Проверка прав доступа
        $this->authorize('delete', $role);

        $role->delete();

        return response()->json(['message' => 'Роль успешно удалена.'], 200);
    }

    /**
     * Display a listing of the resource for API, including trashed.
     */
    public function indexWithTrashed()
    {
        // Проверка прав доступа
        $this->authorize('viewAny', Role::class);

        $roles = Role::withTrashed()->get();
        return response()->json($roles);
    }

    /**
     * Display a listing of the resource for API, only trashed.
     */
    public function indexOnlyTrashed()
    {
        // Проверка прав доступа
        $this->authorize('viewAny', Role::class);

        $roles = Role::onlyTrashed()->get();
        return response()->json($roles);
    }

    /**
     * Restore a trashed role.
     */
    public function restore($id)
    {
        $role = Role::withTrashed()->find($id);

        if (!$role) {
            return response()->json(['message' => 'Роль не найдена'], 404);
        }

        // Проверка прав доступа
        $this->authorize('restore', $role);

        $role->restore();

        return response()->json(['message' => 'Роль успешно восстановлена'], 200);
    }

    /**
     * Force delete a role.
     */
    public function forceDelete($id)
    {
        $role = Role::withTrashed()->find($id);

        if (!$role) {
            return response()->json(['message' => 'Роль не найдена'], 404);
        }

        // Проверка прав доступа
        $this->authorize('forceDelete', $role);

        $role->forceDelete();

        return response()->json(['message' => 'Роль удалена без возможности восстановления'], 200);
    }
}
