<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $data['user'] = User::find(Auth::guard('users')->id());
        return view('users.profile.index',$data);
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::guard('users')->id());
        
        $request->validate([
            'name'=>'required',
            'phone'=>'required',
        ]);

        if(!empty($request->password)){
            $request->validate([
                'password' => [
                    'required',
                    'min:8',
                ],
                'confirm_password' => 'required_with:password|same:password'
            ]);
            $user->password = bcrypt($request->password); 
        }

        $user->name = $request->name; 
        $user->phone = $request->phone; 
        $user->save();

        return redirect()->back()->with('success','Data has been updated');
    }
}
