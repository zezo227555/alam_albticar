<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Season;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view("auth.login");
    }

    public function student_login_form()
    {
        return view("auth.student_login");
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
        Auth::login($user);
        return redirect()->route('main');
    }

    public function student_login(Request $request)
    {
        $request->validate([
            "st_id" => "required",
            "phone" => "required",
        ], [
            "st_id.required"=> "رقم القيد مطلوب",
            "phone.required"=> "كلمة المرور مطلوبة",
        ]);

        $student = Student::where('st_id', '=', $request->st_id)->first();

        if (!$student){
            return redirect()->back()->with("login_error","لايوجد مستخدم بهذا الاسم");
        }
        if ($student->active == 0){
            return redirect()->back()->with("login_error","تم ايقاف رقمك الدراسي، يرجى مراجعة الادارة");
        }
        if ($student->phone != $request->phone) {
            return redirect()->back()->with("login_error","خطأ في  كلمة المرور");
        }

        Session::put('student', $student);

        return redirect()->route('student_main');
    }

    public function main(){
        $sections = Section::withCount('student')->get();

        $teachers = count(Teacher::all());
        $employee = count(Employee::all());
        $users = count(User::all());

        $season = Season::where('active', '=', 1)->first();

        return view('dashboard', [
            'teachers' => $teachers,
            'employee' => $employee,
            'users' => $users,
            'sections' => $sections,
            'season' => $season,
        ]);
    }

    public function student_main(){
        return view('student_dashboard');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('loginForm');
    }

    public function student_logout()
    {
        Session::forget('student');
        return redirect()->route('student_login_form');
    }
}
