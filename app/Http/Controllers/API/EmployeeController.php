<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\ProcessResource;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EmployeeController extends Controller
{
    use AuthorizesRequests;

    // public function __construct()
    // {
    //     $this->authorizeResource(Employee::class, 'employee');
    // }
    /**
     * Display a listing of the resource for API.
     */
    public function index()
    {
        // Проверка прав доступа
        $this->authorize('viewAny', Employee::class);

        $employees = Employee::all();
        return response()->json($employees, 200);
    }

    public function json()
    {
        try {
            // Проверка прав доступа
            $this->authorize('viewAny', Employee::class);

            $employees = Employee::all();
            return response()->json($employees, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getActiveEmployees()
    {
        // Проверка прав доступа
        $this->authorize('viewAny', Employee::class);

        $activeEmployees = Employee::whereHas('departments', function ($query) {
            $query->whereNull('end_date');
        })->get();

        return response()->json($activeEmployees);
    }

    public function getActiveEmployeeProcesses(Employee $employee)
    {
        // Проверка прав доступа
        $this->authorize('view', $employee);

        if ($employee->end_date !== null) {
            return response()->json(['message' => 'Сотрудник не активен'], 404);
        }

        $processes = $employee->processes;

        return ProcessResource::collection($processes);
    }

    /**
     * Display a listing of the resource for web interface.
     */
    public function webIndex()
    {
        // Проверка прав доступа
        $this->authorize('viewAny', Employee::class);

        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Проверка прав доступа
        $this->authorize('create', Employee::class);

        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Проверка прав доступа
        $this->authorize('create', Employee::class);

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'email' => 'required|string|email|max:255|unique:employees',
            'phone' => 'required|string|max:255|unique:employees',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $employee = Employee::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Сотрудник успешно добавлен.',
            'data' => new EmployeeResource($employee),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Сотрудник не найден'], 404);
        }

        // Проверка прав доступа
        $this->authorize('view', $employee);

        return new EmployeeResource($employee);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Сотрудник не найден'], 404);
        }

        // Проверка прав доступа
        $this->authorize('update', $employee);

        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Сотрудник не найден'], 404);
        }

        // Проверка прав доступа
        $this->authorize('update', $employee);

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'email' => 'required|string|email|max:255|unique:employees,email,' . $employee->employee_id . ',employee_id',
            'phone' => 'required|string|max:255|unique:employees,phone,' . $employee->employee_id . ',employee_id',
            'password' => 'nullable|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $employee->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        if ($request->has('password')) {
            $employee->update(['password' => Hash::make($request->password)]);
        }

        return response()->json([
            'message' => 'Сотрудник успешно обновлен.',
            'data' => new EmployeeResource($employee),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Сотрудник не найден'], 404);
        }

        // Проверка прав доступа
        $this->authorize('delete', $employee);

        $employee->delete();

        return response()->json(['message' => 'Сотрудник успешно удален.'], 200);
    }

    /**
     * Display a listing of the resource for API, including trashed.
     */
    public function indexWithTrashed()
    {
        // Проверка прав доступа
        $this->authorize('viewAny', Employee::class);

        $employees = Employee::withTrashed()->get();
        return response()->json($employees, 200);
    }

    /**
     * Display a listing of the resource for API, only trashed.
     */
    public function indexOnlyTrashed()
    {
        // Проверка прав доступа
        $this->authorize('viewAny', Employee::class);

        $employees = Employee::onlyTrashed()->get();
        return response()->json($employees, 200);
    }

    /**
     * Restore a trashed employee.
     */
    public function restore($id)
    {
        $employee = Employee::withTrashed()->find($id);

        if (!$employee) {
            return response()->json(['message' => 'Сотрудник не найден'], 404);
        }

        // Проверка прав доступа
        $this->authorize('restore', $employee);

        $employee->restore();

        return response()->json(['message' => 'Сотрудник успешно восстановлен'], 200);
    }

    /**
     * Force delete an employee.
     */
    public function forceDelete($id)
    {
        $employee = Employee::withTrashed()->find($id);

        if (!$employee) {
            return response()->json(['message' => 'Сотрудник не найден'], 404);
        }

        // Проверка прав доступа
        $this->authorize('forceDelete', $employee);

        $employee->forceDelete();

        return response()->json(['message' => 'Сотрудник удален без возможности восстановления'], 200);
    }
}
