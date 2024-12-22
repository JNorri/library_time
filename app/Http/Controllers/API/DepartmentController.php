<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Models\Process;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource for API.
     */
    public function index()
    {
        // Проверка прав доступа
        $this->authorize('viewAny', Department::class);

        $departments = Department::all();
        return response()->json($departments);
    }

    public function json()
    {
        // Проверка прав доступа
        $this->authorize('viewAny', Department::class);

        $departments = Department::all();
        return response()->json($departments);
    }

    /**
     * Display a listing of the resource for web interface.
     */
    public function webIndex()
    {
        // Проверка прав доступа
        $this->authorize('viewAny', Department::class);

        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Проверка прав доступа
        $this->authorize('create', Department::class);

        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Проверка прав доступа
        $this->authorize('create', Department::class);

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

        // Проверка прав доступа
        $this->authorize('view', $department);

        return new DepartmentResource($department);
    }

    public function getDepartmentsWithEmployees()
    {
        // Проверка прав доступа
        $this->authorize('viewAny', Department::class);

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

        // Проверка прав доступа
        $this->authorize('update', $department);

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

        // Проверка прав доступа
        $this->authorize('update', $department);

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
            'message' => 'Отдел успешно обновлен.',
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
            return response()->json(['message' => 'Отдел не найден'], 404);
        }

        // Проверка прав доступа
        $this->authorize('delete', $department);

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
        // Проверка прав доступа
        $this->authorize('assign', Department::class);

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
        // Проверка прав доступа
        $this->authorize('unassign', Department::class);

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

    /**
     * Display a listing of the resource for API, including trashed.
     */
    public function indexWithTrashed()
    {
        // Проверка прав доступа
        $this->authorize('viewAny', Department::class);

        $departments = Department::withTrashed()->get();
        return response()->json($departments);
    }

    /**
     * Display a listing of the resource for API, only trashed.
     */
    public function indexOnlyTrashed()
    {
        // Проверка прав доступа
        $this->authorize('viewAny', Department::class);

        $departments = Department::onlyTrashed()->get();
        return response()->json($departments);
    }

    /**
     * Restore a trashed department.
     */
    public function restore($id)
    {
        $department = Department::withTrashed()->find($id);

        if (!$department) {
            return response()->json(['message' => 'Отдел не найден'], 404);
        }

        // Проверка прав доступа
        $this->authorize('restore', $department);

        $department->restore();

        return response()->json(['message' => 'Отдел успешно восстановлен'], 200);
    }

    /**
     * Force delete a department.
     */
    public function forceDelete($id)
    {
        $department = Department::withTrashed()->find($id);

        if (!$department) {
            return response()->json(['message' => 'Отдел не найден'], 404);
        }

        // Проверка прав доступа
        $this->authorize('forceDelete', $department);

        $department->forceDelete();

        return response()->json(['message' => 'Отдел удален без возможности восстановления'], 200);
    }
}
