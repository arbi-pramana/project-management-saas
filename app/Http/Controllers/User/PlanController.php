<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    public function index()
    {
        $user = Auth::guard('users')->user();
        $data['plans'] = Plan::get()->map(function($q) use ($user){
            $replace1 = str_replace("_nama_",$user->name,$q->url);
            $replace2 = str_replace("_email_",$user->email,$replace1);
            $q->url = $replace2;
            return $q;
        });
        dd($data);
        return view('users.plan.index',$data);
    }
}
