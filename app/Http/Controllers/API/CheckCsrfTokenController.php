<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckCsrfTokenController extends Controller
{
    //
    public function checkCsrfToken(Request $request)
    {
        $csrfToken = $request->header('X-CSRF-TOKEN') ?? $request->input('_token');
        $sessionToken = Session::token();
        dd($csrfToken, $sessionToken);

        if ($csrfToken === $sessionToken) {
            dd('CSRF token matches');
        } else {
            dd('CSRF token mismatch');
        }
    }
}
