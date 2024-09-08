<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view("auth.login");
    }

    public function login(Request $request)
    {
        $request->validate([
            "username"=> "required",
            "password"=> "required",
        ], [
            "username.required"=> "اسم المستخدم مطلوب",
            "password.required"=> "كلمة المرور مطلوبة",
        ]);

        $user = User::where('username', '=', $request->username)->first();

        if (!$user){
            return redirect()->back()->with("login_error","لايوجد مستخدم بهذا الاسم");
        }
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with("login_error","خطأ في  كلمة المرور");
        }
        auth()->login($user);
        return redirect()->route('main');
    }

    public function main(){
        return view('dashboard');
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('loginForm');
    }
}
