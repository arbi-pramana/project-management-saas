<?php

namespace App\Services\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginService{
    public function auth($request)
    {
        $user = User::where('email',$request->email)->first();
        if (!empty($user) 
            && Hash::check($request->password, $user->password) 
            && $user->is_active == 1 
            && $user->type == 'users' 
            && $user->plan_expire_date > now()
        ) {
            Auth::guard('users')->login($user);
            return redirect()->route('users.dashboard.executive');
        } else if($user->is_active == 0) {
            return redirect('/login')->with("danger", "Please verify your email");
        } else if($user->plan_expire_date <= now()) {
            return redirect('/login')->with("danger", "Your Account is Expired, Please contact support");
        } else {
            return redirect('/login')->with("danger", "Username or Password Didn't Match");
        }
    }
}