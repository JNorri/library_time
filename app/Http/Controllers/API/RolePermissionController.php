<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RolePermissionController extends Controller
{
    use AuthorizesRequests;

    /**
     * Назначить разрешение роли.
     *
     * @param Request $request
     * @param Role $role
     * @param Permission $permission
     * @return JsonResponse
     */
    public function assignPermissionToRole(Request $request, Role $role, Permission $permission): JsonResponse
    {
        // Проверка прав доступа
        $this->authorize('assign', $role);

        // Проверка, что разрешение еще не назначено роли
        $existingAssignment = DB::table('role_log_permission')
            ->where('role_id', $role->role_id)
            ->where('permission_id', $permission->permission_id)
            ->first();

        if ($existingAssignment) {
            return response()->json(['message' => 'Разрешение уже назначено этой роли.'], 422);
        }

        // Назначение разрешения роли
        DB::table('role_log_permission')->insert([
            'role_id' => $role->role_id,
            'permission_id' => $permission->permission_id,
        ]);

        return response()->json(['message' => 'Разрешение успешно назначено роли.'], 200);
    }

    /**
     * Снять разрешение с роли.
     *
     * @param Request $request
     * @param Role $role
     * @param Permission $permission
     * @return JsonResponse
     */
    public function unassignPermissionFromRole(Request $request, Role $role, Permission $permission): JsonResponse
    {
        // Проверка прав доступа
        $this->authorize('unassign', $role);

        // Проверка, что разрешение назначено роли
        $existingAssignment = DB::table('role_log_permission')
            ->where('role_id', $role->role_id)
            ->where('permission_id', $permission->permission_id)
            ->first();

        if (!$existingAssignment) {
            return response()->json(['message' => 'Разрешение не назначено этой роли.'], 422);
        }

        // Снятие разрешения с роли
        DB::table('role_log_permission')
            ->where('role_id', $role->role_id)
            ->where('permission_id', $permission->permission_id)
            ->delete();

        return response()->json(['message' => 'Разрешение успешно снято с роли.'], 200);
    }

    /**
     * Получить все разрешения, назначенные роли.
     *
     * @param Role $role
     * @return JsonResponse
     */
    public function getRolePermissions(Role $role): JsonResponse
    {
        // Проверка прав доступа
        $this->authorize('view', $role);

        // Получение всех разрешений, назначенных роли
        $permissions = DB::table('role_log_permission')
            ->join('permissions', 'permissions.permission_id', '=', 'role_log_permission.permission_id')
            ->where('role_log_permission.role_id', $role->role_id)
            ->select('permissions.*')
            ->get();

        return response()->json($permissions, 200);
    }

    /**
     * Назначить несколько разрешений роли.
     *
     * @param Request $request
     * @param Role $role
     * @return JsonResponse
     */
    public function assignMultiplePermissionsToRole(Request $request, Role $role): JsonResponse
    {
        // Проверка прав доступа
        $this->authorize('assign', $role);

        $validator = Validator::make($request->all(), [
            'permission_ids' => 'required|array',
            'permission_ids.*' => 'exists:permissions,permission_id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $permissionIds = $request->input('permission_ids');

        // Назначение разрешений роли
        foreach ($permissionIds as $permissionId) {
            DB::table('role_log_permission')->insertOrIgnore([
                'role_id' => $role->role_id,
                'permission_id' => $permissionId,
            ]);
        }

        return response()->json(['message' => 'Разрешения успешно назначены роли.'], 200);
    }

    /**
     * Снять несколько разрешений с роли.
     *
     * @param Request $request
     * @param Role $role
     * @return JsonResponse
     */
    public function unassignMultiplePermissionsFromRole(Request $request, Role $role): JsonResponse
    {
        // Проверка прав доступа
        $this->authorize('unassign', $role);

        $validator = Validator::make($request->all(), [
            'permission_ids' => 'required|array',
            'permission_ids.*' => 'exists:permissions,permission_id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $permissionIds = $request->input('permission_ids');

        // Снятие разрешений с роли
        DB::table('role_log_permission')
            ->where('role_id', $role->role_id)
            ->whereIn('permission_id', $permissionIds)
            ->delete();

        return response()->json(['message' => 'Разрешения успешно сняты с роли.'], 200);
    }
}