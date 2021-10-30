<?php

namespace App\Http\Controllers\Specialist;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('specialist.auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (auth('specialist')->attempt($request->validated())) {
            return redirect()->route('specialist.dashboard.index');
        }
        return back()
            ->with('error', 'E-mail ou senha incorretos')
            ->withInput();
    }

    public function logout()
    {
        auth('specialist')->logout();
        return redirect('/specialist/login');
    }
}
