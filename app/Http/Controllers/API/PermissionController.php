<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    // protected $dataController;

    // public function __construct(DataController $dataController)
    // {
    //     $this->dataController = $dataController;
    // }

    // public function index()
    // {
    //     $data = $this->dataController->getAllData();
    //     return view('dashboard', $data);
    // }

    public function json()
    {
        $permissions = Permission::all();
        return response()->json($permissions);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return response()->json(['message' => 'Permission not found'], 404);
        }

        return new PermissionResource($permission);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'permission_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:permissions',
            'permission_description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $permission = Permission::create($request->all());

        return response()->json([
            'message' => 'The permission was successfully added.',
            'data' => new PermissionResource($permission),
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return response()->json(['message' => 'Permission not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'permission_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:permissions,slug,' . $permission->permission_id . ',permission_id',
            'permission_description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $permission->update($request->all());

        return response()->json([
            'message' => 'The permission was successfully updated.',
            'data' => new PermissionResource($permission),
        ], 200);
    }

    public function destroy(string $id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return response()->json(['message' => 'Permission not found'], 404);
        }

        $permission->delete();

        return response()->json(['message' => 'The permission was successfully deleted.'], 200);
    }
}
