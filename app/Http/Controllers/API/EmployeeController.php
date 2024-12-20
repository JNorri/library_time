<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\ProcessResource;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource for API.
     */
    public function index()
    {
        $employees = Employee::all();
        // dd($employees); // Check if employees are retrieved
        return view('/dashboard', compact('employees'));
    }

    public function json()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }

    public function getActiveEmployees()
    {
        // Получаем активных сотрудников, у которых end_date равно null
        $activeEmployees = Employee::whereHas('departments', function ($query) {
            $query->whereNull('end_date');
        })->get();

        return response()->json($activeEmployees);
    }

    public function getActiveEmployeeProcesses(Employee $employee)
    {
        // Проверяем, что сотрудник активен (end_date равно null)
        if ($employee->end_date !== null) {
            return response()->json(['message' => 'Сотрудник не активен'], 404);
        }

        // Получаем все процессы активного сотрудника
        $processes = $employee->processes;

        return ProcessResource::collection($processes);
    }

    /**
     * Display a listing of the resource for web interface.
     */
    public function webIndex()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
            'message' => 'The employee was successfully added.',
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

        $employee->delete();

        return response()->json(['message' => 'Сотрудник успешно удален.'], 200);
    }
}
