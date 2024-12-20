<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Models\Process;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource for API.
     */
    public function index()
    {
        $processes = Department::all();
        return view('dashboard', compact('departments'));
    }

    public function json()
    {
        $processes = Department::all();
        return response()->json($processes);
    }

    /**
     * Display a listing of the resource for web interface.
     */
    public function webIndex()
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department_name' => 'required|string|max:255',
            'department_description' => 'required|string',
            'parent_id' => 'nullable|exists:departments,department_id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $department = Department::create($request->all());

        return response()->json([
            'message' => 'Отдел успешно добавлен',
            'data' => new DepartmentResource($department),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::find($id);

        if (!$department) {
            return response()->json(['message' => 'Отдел не найден'], 404);
        }

        return new DepartmentResource($department);
    }


    public function getDepartmentsWithEmployees()
    {
        // Получаем все отделы с их сотрудниками
        $departments = Department::with(['employees' => function ($query) {
            $query->wherePivot('end_date', null);
        }])->get();

        return response()->json($departments);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $department = Department::find($id);

        if (!$department) {
            return response()->json(['message' => 'Отдел не найден'], 404);
        }

        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $department = Department::find($id);

        if (!$department) {
            return response()->json(['message' => 'Отдел не найден'], 404);
        }

        $validator = Validator::make($request->all(), [
            'department_name' => 'required|string|max:255',
            'department_description' => 'required|string',
            'parent_id' => 'nullable|exists:departments,department_id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $department->update($request->all());

        return response()->json([
            'message' => 'The department was successfully updated.',
            'data' => new DepartmentResource($department),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::find($id);

        if (!$department) {
            return response()->json(['message' => 'Отделне найден'], 404);
        }

        $department->delete();

        return response()->json(['message' => 'Отдел успешно удален'], 200);
    }

    /**
     * Назначить процесс отделу
     * @param Request $request
     * @return JsonResponse
     */
    public function assignProcess(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'department_id' => 'required|exists:departments,department_id',
            'process_id' => 'required|exists:processes,process_id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $process = Process::findOrFail($request->process_id);
        
        // Обновляем department_id у процесса
        $process->update([
            'department_id' => $request->department_id
        ]);

        return response()->json([
            'message' => 'Процесс успешно назначен отделу',
            'data' => $process
        ], 200);
    }

    /**
     * Снять процесс с отдела и назначить на "Научную библиотеку"
     * @param Request $request
     * @return JsonResponse
     */
    public function unassignProcess(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'process_id' => 'required|exists:processes,process_id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $process = Process::findOrFail($request->process_id);
        
        // Находим "Научную библиотеку"
        $mainLibrary = Department::where('department_name', 'Научная библиотека')->first();

        if (!$mainLibrary) {
            return response()->json(['message' => 'Научная библиотека не найдена'], 404);
        }

        // Обновляем department_id у процесса на id "Научной библиотеки"
        $process->update([
            'department_id' => $mainLibrary->department_id
        ]);

        return response()->json([
            'message' => 'Процесс успешно снят.',
            'data' => $process
        ], 200);
    }
    
}
