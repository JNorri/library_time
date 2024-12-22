<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProcessResource;
use App\Models\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProcessController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource for API.
     */
    public function index()
    {
        // Проверка прав доступа
        $this->authorize('viewAny', Process::class);

        $processes = Process::all();
        return ProcessResource::collection($processes);
    }

    public function json()
    {
        // Проверка прав доступа
        $this->authorize('viewAny', Process::class);

        $processes = Process::all();
        return response()->json($processes);
    }

    /**
     * Display a listing of the resource for web interface.
     */
    public function webIndex()
    {
        // Проверка прав доступа
        $this->authorize('viewAny', Process::class);

        $processes = Process::all();
        return view('processes.index', compact('processes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Проверка прав доступа
        $this->authorize('create', Process::class);

        return view('processes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Проверка прав доступа
        $this->authorize('create', Process::class);

        $validator = Validator::make($request->all(), [
            'process_name' => 'required|string|max:255',
            'measurement_id' => 'nullable|exists:measurements,measurement_id',
            'is_daily' => 'boolean',
            'require_description' => 'boolean',
            'department_id' => 'required|exists:departments,department_id',
            'process_duration' => 'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $process = Process::create($request->all());

        return response()->json([
            'message' => 'Процесс успешно добавлен.',
            'data' => new ProcessResource($process),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $process = Process::find($id);

        if (!$process) {
            return response()->json(['message' => 'Процесс не найден'], 404);
        }

        // Проверка прав доступа
        $this->authorize('view', $process);

        return new ProcessResource($process);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $process = Process::find($id);

        if (!$process) {
            return response()->json(['message' => 'Процесс не найден'], 404);
        }

        // Проверка прав доступа
        $this->authorize('update', $process);

        return view('processes.edit', compact('process'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $process = Process::find($id);

        if (!$process) {
            return response()->json(['message' => 'Процесс не найден'], 404);
        }

        // Проверка прав доступа
        $this->authorize('update', $process);

        $validator = Validator::make($request->all(), [
            'process_name' => 'required|string|max:255',
            'measurement_id' => 'required|exists:measurements,measurement_id',
            'is_daily' => 'boolean',
            'require_description' => 'boolean',
            'department_id' => 'required|exists:departments,department_id',
            'process_duration' => 'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $process->update($request->all());

        return response()->json([
            'message' => 'Процесс успешно обновлен.',
            'data' => new ProcessResource($process),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $process = Process::find($id);

        if (!$process) {
            return response()->json(['message' => 'Процесс не найден'], 404);
        }

        // Проверка прав доступа
        $this->authorize('delete', $process);

        $process->delete();

        return response()->json(['message' => 'Процесс успешно удален.'], 200);
    }
}
