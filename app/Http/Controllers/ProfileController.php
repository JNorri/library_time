<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $user = $request->user();
        // dd($user);
        $departments = Department::all();
        $roles = Role::all();

        // Получаем текущий департамент, где end_date равен null
        $currentDepartment = $user->departments()
            ->wherePivot('end_date', null)
            ->first();

        // Получаем текущую роль
        $currentRole = $user->roles()->first();

        return view('profile.edit', compact('user', 'departments', 'roles', 'currentDepartment', 'currentRole'));
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'phone' => ['required', 'string', 'max:255'],
            'department_id' => ['required', 'integer'],
            'role_id' => ['required', 'integer'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        // Обновляем департамент и роль
        $user->departments()->sync([$request->department_id]);
        $user->roles()->sync([$request->role_id]);

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
