<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\Users\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $login;
    public function __construct(LoginService $login)
    {
        $this->login = $login;
    }

    public function login()
    {
        return view('users.login');
    }

    public function auth(Request $request)
    {
        return $this->login->auth($request);
    }

    public function logout()
    {
        Auth::guard('users')->logout();
        return redirect('/login');
    }
}
