<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (auth('admin')->attempt($request->validated())) {
            return redirect()->route('admin.dashboard.index');
        }
        return back()
            ->with('error', 'E-mail ou senha incorretos')
            ->withInput();
    }

    public function logout()
    {
        auth('admin')->logout();
        return redirect('/admin/login');
    }
}
