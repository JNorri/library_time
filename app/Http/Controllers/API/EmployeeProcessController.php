<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class EmployeeProcessController extends Controller
{
    use AuthorizesRequests;
    /**
     * Assign a process to an employee.
     */
    public function assignProcess(Request $request, Employee $employee, Process $process)
    {
        // Проверка прав доступа
        $this->authorize('assignToEmployee', $process);

        // Проверка, что процесс еще не назначен сотруднику
        $existingProcess = DB::table('employee_log_process')
            ->where('employee_id', $employee->employee_id)
            ->where('process_id', $process->process_id)
            ->whereNull('end_date')
            ->first();

        if ($existingProcess) {
            return response()->json(['message' => 'Процесс уже назначен сотруднику'], 422);
        }

        // Назначение процесса сотруднику
        DB::table('employee_log_process')->insert([
            'employee_id' => $employee->employee_id,
            'process_id' => $process->process_id,
            'start_date' => now(),
            'end_date' => null,
        ]);

        return response()->json(['message' => 'Процесс назначен сотруднику'], 200);
    }

    /**
     * Unassign a process from an employee.
     */
    public function unassignProcess(Request $request, Employee $employee, Process $process)
    {
        // Проверка прав доступа
        $this->authorize('unassignFromEmployee', $process);

        // Проверка, что процесс назначен сотруднику
        $existingProcess = DB::table('employee_log_process')
            ->where('employee_id', $employee->employee_id)
            ->where('process_id', $process->process_id)
            ->whereNull('end_date')
            ->first();

        if (!$existingProcess) {
            return response()->json(['message' => 'Процесс не назначен сотруднику'], 422);
        }

        // Снятие процесса с сотрудника
        DB::table('employee_log_process')
            ->where('employee_id', $employee->employee_id)
            ->where('process_id', $process->process_id)
            ->update(['end_date' => now()]);

        return response()->json(['message' => 'Процесс снят с сотрудника'], 200);
    }
}
