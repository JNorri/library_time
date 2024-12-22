<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PermissionController extends Controller
{
    use AuthorizesRequests;
    public function json()
    {
        // Проверка прав доступа
        $this->authorize('viewAny', Permission::class);

        $permissions = Permission::all();
        return response()->json($permissions);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return response()->json(['message' => 'Разрешение не найдено'], 404);
        }

        // Проверка прав доступа
        $this->authorize('view', $permission);

        return new PermissionResource($permission);
    }

    public function store(Request $request)
    {
        // Проверка прав доступа
        $this->authorize('create', Permission::class);

        $validator = Validator::make($request->all(), [
            'permission_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:permissions',
            'permission_description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $permission = Permission::create($request->all());

        return response()->json([
            'message' => 'Разрешение успешно добавлено.',
            'data' => new PermissionResource($permission),
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return response()->json(['message' => 'Разрешение не найдено'], 404);
        }

        // Проверка прав доступа
        $this->authorize('update', $permission);

        $validator = Validator::make($request->all(), [
            'permission_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:permissions,slug,' . $permission->permission_id . ',permission_id',
            'permission_description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $permission->update($request->all());

        return response()->json([
            'message' => 'Разрешение успешно обновлено.',
            'data' => new PermissionResource($permission),
        ], 200);
    }

    public function destroy(string $id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return response()->json(['message' => 'Разрешение не найдено'], 404);
        }

        // Проверка прав доступа
        $this->authorize('delete', $permission);

        $permission->delete();

        return response()->json(['message' => 'Разрешение успешно удалено.'], 200);
    }
}
