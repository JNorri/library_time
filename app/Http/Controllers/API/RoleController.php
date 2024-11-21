<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    // protected $DashboardController;

    // public function __construct(DashboardController $DashboardController)
    // {
    //     $this->DashboardController = $DashboardController;
    // }

    // public function index()
    // {
    //     $data = $this->DashboardController->getAllData();
    //     return view('dashboard', $data);
    // }

    public function json()
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        return new RoleResource($role);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:roles',
            'role_description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $role = Role::create($request->all());

        return response()->json([
            'message' => 'The role was successfully added.',
            'data' => new RoleResource($role),
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'role_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:roles,slug,' . $role->role_id . ',role_id',
            'role_description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $role->update($request->all());

        return response()->json([
            'message' => 'The role was successfully updated.',
            'data' => new RoleResource($role),
        ], 200);
    }

    public function destroy(string $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $role->delete();

        return response()->json(['message' => 'The role was successfully deleted.'], 200);
    }
}
