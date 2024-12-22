<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Employee; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    // /**
    //  * Handle an incoming request.
    //  *
    //  * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    //  */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        // Укажите, что Auth::user() возвращает объект Employee
        /** @var Employee $user */
        $user = Auth::user();

        // Проверяем, авторизован ли пользователь
        if (!$user) {
            abort(403, 'Вы не авторизованы.');
        }

        // Проверяем, имеет ли пользователь указанное разрешение
        if (!$user->hasPermission($permission)) {
            abort(403, 'У вас нет доступа.');
        }

        return $next($request);
    }
}
