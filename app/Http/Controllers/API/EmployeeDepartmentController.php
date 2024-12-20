<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeDepartmentController extends Controller
{
    /**
     * Назначить сотрудника в отдел.
     *
     * @param Request $request
     * @param Employee $employee
     * @param Department $department
     * @return JsonResponse
     */
    public function assignEmployeeToDepartment(Request $request, Department $department, Employee $employee): JsonResponse
    {
        // Проверки
        $validationResponse = $this->validateEmployeeAndDepartment($employee->employee_id, $department->department_id);
        if ($validationResponse) {
            return $validationResponse;
        }

        $alreadyAssignedResponse = $this->checkIfEmployeeAlreadyInDepartment($employee->employee_id, $department->department_id);
        if ($alreadyAssignedResponse) {
            return $alreadyAssignedResponse;
        }

        // Проверяем, работает ли сотрудник уже в каком-либо отделе
        $currentAssignment = DB::table('employee_log_department')
            ->where('employee_id', $employee->employee_id)
            ->whereNull('end_date')
            ->first();

        if ($currentAssignment) {
            // Если сотрудник уже работает в каком-либо отделе, обновляем end_date
            DB::table('employee_log_department')
                ->where('employee_id', $employee->employee_id)
                ->whereNull('end_date')
                ->update(['end_date' => now()]);
        }

        // Назначаем сотрудника в новый отдел
        DB::table('employee_log_department')->insert([
            'employee_id' => $employee->employee_id,
            'department_id' => $department->department_id,
            'start_date' => now(),
            'end_date' => null,
        ]);

        // return response()->json(['message' => 'Сотрудник успешно назначен в отдел.'], 200);
        return response()->json(['message' => 'Employee successfully assigned to department.'], 200);
    }

    /**
     * Снять сотрудника с отдела.
     *
     * @param Request $request
     * @param Employee $employee
     * @param Department $department
     * @return JsonResponse
     */
    public function unassignEmployeeFromDepartment(Request $request, Department $department, Employee $employee): JsonResponse
    {
        // Проверки
        $validationResponse = $this->validateEmployeeAndDepartment($employee->employee_id, $department->department_id);
        if ($validationResponse) {
            return $validationResponse;
        }

        $isAssignedResponse = $this->checkIfEmployeeIsAssignedToDepartment($employee->employee_id, $department->department_id);
        if ($isAssignedResponse) {
            return $isAssignedResponse;
        }

        // Снимаем сотрудника с отдела
        DB::table('employee_log_department')
            ->where('employee_id', $employee->employee_id)
            ->where('department_id', $department->department_id)
            ->whereNull('end_date')
            ->update(['end_date' => now()]);

        // return response()->json(['message' => 'Сотрудник успешно снят с отдела.'], 200);
        return response()->json(['message' => 'Employee successfully unassigned from department.'], 200);
    }

    /**
     * Проверка, что сотрудник и отдел существуют.
     *
     * @param int $employeeId
     * @param int $departmentId
     * @return JsonResponse|null
     */
    private function validateEmployeeAndDepartment(int $employeeId, int $departmentId): ?JsonResponse
    {
        $employee = Employee::find($employeeId);
        $department = Department::find($departmentId);

        if (!$employee) {
            // return response()->json(['message' => 'Сотрудник не найден.'], 404);
            return response()->json(['message' => 'Employee not found.'], 404);
        }

        if (!$department) {
            // return response()->json(['message' => 'Отдел не найден.'], 404);
            return response()->json(['message' => 'Department not found.'], 404);
        }

        return null;
    }

    /**
     * Проверка, что сотрудник уже работает в указанном отделе.
     *
     * @param int $employeeId
     * @param int $departmentId
     * @return JsonResponse|null
     */
    private function checkIfEmployeeAlreadyInDepartment(int $employeeId, int $departmentId): ?JsonResponse
    {
        $existingAssignment = DB::table('employee_log_department')
            ->where('employee_id', $employeeId)
            ->where('department_id', $departmentId)
            ->whereNull('end_date')
            ->first();

        if ($existingAssignment) {
            // return response()->json(['message' => 'Сотрудник уже работает в этом отделе.'], 422);
            return response()->json(['message' => 'Employee already works in this department.'], 422);
        }

        return null;
    }

    /**
     * Проверка, что сотрудник работает в указанном отделе.
     *
     * @param int $employeeId
     * @param int $departmentId
     * @return JsonResponse|null
     */
    private function checkIfEmployeeIsAssignedToDepartment(int $employeeId, int $departmentId): ?JsonResponse
    {
        $existingAssignment = DB::table('employee_log_department')
            ->where('employee_id', $employeeId)
            ->where('department_id', $departmentId)
            ->whereNull('end_date')
            ->first();

        if (!$existingAssignment) {
            // return response()->json(['message' => 'Сотрудник не работает в этом отделе.'], 422);
            return response()->json(['message' => 'Employee does not work in this department.'], 422);
        }

        return null;
    }
}

