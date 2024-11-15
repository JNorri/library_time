<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProcessResource;
use App\Models\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource for API.
     */
    public function index()
    {
        $processes = Process::all();
        return ProcessResource::collection($processes);
    }

    /**
     * Display a listing of the resource for web interface.
     */
    public function webIndex()
    {
        $processes = Process::all();
        return view('processes.index', compact('processes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('processes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'process_name' => 'required|string|max:255',
            'process_description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $process = Process::create($request->all());

        return new ProcessResource($process);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $process = Process::find($id);

        if (!$process) {
            return response()->json(['message' => 'Process not found'], 404);
        }

        return new ProcessResource($process);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $process = Process::find($id);

        if (!$process) {
            return response()->json(['message' => 'Process not found'], 404);
        }

        return view('processes.edit', compact('process'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $process = Process::find($id);

        if (!$process) {
            return response()->json(['message' => 'Process not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'process_name' => 'required|string|max:255',
            'process_description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $process->update($request->all());

        return new ProcessResource($process);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $process = Process::find($id);

        if (!$process) {
            return response()->json(['message' => 'Process not found'], 404);
        }

        $process->delete();

        return response()->json(['message' => 'Process deleted'], 200);
    }
}
