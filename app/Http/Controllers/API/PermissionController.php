<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use Illuminate\Http\Request;

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
}
