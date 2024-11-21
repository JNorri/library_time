<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;

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
}
