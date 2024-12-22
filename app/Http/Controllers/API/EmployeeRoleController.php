<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EmployeeRoleController extends Controller
{
    use AuthorizesRequests;
    /**
     * Назначить роль сотруднику.
     *
     * @param Request $request
     * @param Employee $employee
     * @param Role $role
     * @return JsonResponse
     */
    public function assignRole(Request $request, Employee $employee, Role $role): JsonResponse
    {
        // Проверка прав доступа
        $this->authorize('assign', $employee);

        // Валидация входных данных
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,employee_id',
            'role_id' => 'required|exists:roles,role_id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Проверка, что роль еще не назначена сотруднику
        $existingRole = DB::table('employee_log_role')
            ->where('employee_id', $employee->employee_id)
            ->where('role_id', $role->role_id)
            ->first();

        if ($existingRole) {
            return response()->json(['message' => 'Роль уже назначена сотруднику.'], 422);
        }

        // Назначение роли сотруднику
        DB::table('employee_log_role')->insert([
            'employee_id' => $employee->employee_id,
            'role_id' => $role->role_id,
        ]);

        return response()->json(['message' => 'Роль успешно назначена сотруднику.'], 200);
    }

    /**
     * Снять роль с сотрудника.
     *
     * @param Request $request
     * @param Employee $employee
     * @param Role $role
     * @return JsonResponse
     */
    public function unassignRole(Request $request, Employee $employee, Role $role): JsonResponse
    {
        // Проверка прав доступа
        $this->authorize('unassign', $employee);

        // Валидация входных данных
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,employee_id',
            'role_id' => 'required|exists:roles,role_id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Проверка, что роль назначена сотруднику
        $existingRole = DB::table('employee_log_role')
            ->where('employee_id', $employee->employee_id)
            ->where('role_id', $role->role_id)
            ->first();

        if (!$existingRole) {
            return response()->json(['message' => 'Роль не назначена сотруднику.'], 422);
        }

        // Снятие роли с сотрудника
        DB::table('employee_log_role')
            ->where('employee_id', $employee->employee_id)
            ->where('role_id', $role->role_id)
            ->delete();

        return response()->json(['message' => 'Роль успешно снята с сотрудника.'], 200);
    }
}
