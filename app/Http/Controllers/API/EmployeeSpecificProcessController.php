<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EmployeeSpecificProcessController extends Controller
{
    use AuthorizesRequests;
    /**
     * Assign a specific process to an employee.
     */
    public function assignSpecificProcess(Request $request, Employee $employee, Process $process)
    {
        try {
            // Проверка прав доступа
            $this->authorize('assign', $process);

            // Проверка статуса сотрудника
            $this->checkEmployeeStatus($employee);

            DB::beginTransaction();

            // Валидация входных данных
            $validator = Validator::make($request->all(), $this->getValidationRules($process));

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            // Проверка, что процесс еще не назначен сотруднику
            $existingProcess = DB::table('employee_specific_process')
                ->where('employee_id', $employee->employee_id)
                ->where('process_id', $process->process_id)
                ->first();

            if ($existingProcess) {
                return response()->json(['message' => 'Процесс уже назначен сотруднику'], 422);
            }

            // Получение количества и описания из запроса
            $quantity = $request->input('quantity');
            $description = $request->input('description', null);

            // Назначение процесса сотруднику
            DB::table('employee_specific_process')->insert([
                'employee_id' => $employee->employee_id,
                'process_id' => $process->process_id,
                'date' => now(),
                'quantity' => $quantity,
                'description' => $description,
            ]);

            DB::commit();
            Log::info('Process assigned', [
                'employee_id' => $employee->employee_id,
                'process_id' => $process->process_id,
            ]);
            return response()->json(['message' => 'Процесс назначен сотруднику'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Unassign a specific process from an employee.
     */
    public function unassignSpecificProcess(Request $request, Employee $employee, Process $process)
    {
        // Проверка прав доступа
        $this->authorize('unassign', $process);

        // Проверка статуса сотрудника
        $this->checkEmployeeStatus($employee);

        // Проверка, что процесс назначен сотруднику
        $existingProcess = DB::table('employee_specific_process')
            ->where('employee_id', $employee->employee_id)
            ->where('process_id', $process->process_id)
            ->first();

        if (!$existingProcess) {
            return response()->json(['message' => 'Процесс не назначен сотруднику'], 422);
        }

        // Удаление записи о процессе
        DB::table('employee_specific_process')
            ->where('employee_id', $employee->employee_id)
            ->where('process_id', $process->process_id)
            ->delete();

        return response()->json(['message' => 'Процесс снят с сотрудника'], 200);
    }

    /**
     * Get validation rules based on process type.
     */
    private function getValidationRules(Process $process): array
    {
        $rules = [
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'date' => 'required|date|after_or_equal:today',
        ];

        if ($process->require_description) {
            $rules['description'] = 'required|string|min:10';
        }

        return $rules;
    }

    private function checkEmployeeStatus(Employee $employee)
    {
        if (!$employee->is_active) {
            throw new \Exception('Сотрудник неактивен');
        }
    }

    public function getEmployeeProcesses(Employee $employee)
    {
        // Проверка прав доступа
        $this->authorize('view', $employee);

        // Проверка статуса сотрудника
        $this->checkEmployeeStatus($employee);

        $processes = DB::table('employee_specific_process')
            ->where('employee_id', $employee->employee_id)
            ->join('processes', 'processes.process_id', '=', 'employee_specific_process.process_id')
            ->select('processes.*', 'employee_specific_process.date', 'employee_specific_process.quantity')
            ->get();

        return response()->json($processes);
    }

    public function updateSpecificProcess(Request $request, Employee $employee, Process $process)
    {
        // Проверка прав доступа
        $this->authorize('update', $process);

        // Проверка статуса сотрудника
        $this->checkEmployeeStatus($employee);

        $validator = Validator::make($request->all(), $this->getValidationRules($process));

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        DB::table('employee_specific_process')
            ->where('employee_id', $employee->employee_id)
            ->where('process_id', $process->process_id)
            ->update([
                'quantity' => $request->input('quantity'),
                'description' => $request->input('description')
            ]);

        return response()->json(['message' => 'Процесс успешно обновлен.']);
    }
}
