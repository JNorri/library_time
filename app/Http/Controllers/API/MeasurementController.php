<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MeasurementResource;
use App\Models\Measurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MeasurementController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource for API.
     */
    public function index()
    {
        // Проверка прав доступа
        $this->authorize('viewAny', Measurement::class);

        $measurements = Measurement::all();
        return response()->json($measurements);
    }

    public function json()
    {
        // Проверка прав доступа
        $this->authorize('viewAny', Measurement::class);

        $measurements = Measurement::all();
        return response()->json($measurements);
    }

    /**
     * Display a listing of the resource for web interface.
     */
    public function webIndex()
    {
        // Проверка прав доступа
        $this->authorize('viewAny', Measurement::class);

        $measurements = Measurement::all();
        return view('measurements.index', compact('measurements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Проверка прав доступа
        $this->authorize('create', Measurement::class);

        return view('measurements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Проверка прав доступа
        $this->authorize('create', Measurement::class);

        $validator = Validator::make($request->all(), [
            'measurement_name' => 'required|string|max:255',
            'measurement_description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $measurement = Measurement::create($request->all());

        return response()->json([
            'message' => 'Измерение успешно добавлено.',
            'data' => new MeasurementResource($measurement),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $measurement = Measurement::find($id);

        if (!$measurement) {
            return response()->json(['message' => 'Измерение не найдено'], 404);
        }

        // Проверка прав доступа
        $this->authorize('view', $measurement);

        return new MeasurementResource($measurement);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $measurement = Measurement::find($id);

        if (!$measurement) {
            return response()->json(['message' => 'Измерение не найдено'], 404);
        }

        // Проверка прав доступа
        $this->authorize('update', $measurement);

        return view('measurements.edit', compact('measurement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $measurement = Measurement::find($id);

        if (!$measurement) {
            return response()->json(['message' => 'Измерение не найдено'], 404);
        }

        // Проверка прав доступа
        $this->authorize('update', $measurement);

        $validator = Validator::make($request->all(), [
            'measurement_name' => 'required|string|max:255',
            'measurement_description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $measurement->update($request->all());

        return response()->json([
            'message' => 'Измерение успешно обновлено.',
            'data' => new MeasurementResource($measurement),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $measurement = Measurement::find($id);

        if (!$measurement) {
            return response()->json(['message' => 'Измерение не найдено'], 404);
        }

        // Проверка прав доступа
        $this->authorize('delete', $measurement);

        $measurement->delete();

        return response()->json(['message' => 'Измерение успешно удалено.'], 200);
    }
}
