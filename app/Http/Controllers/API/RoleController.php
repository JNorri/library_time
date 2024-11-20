<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
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

    // public function json()
    // {
    //     $roles = Role::all();
    //     return response()->json($roles);
    // }
}
