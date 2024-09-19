<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('super', '=', 0)->get();
        return view('users.users_index', ["users"=> $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.user_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username|regex:/^\S*$/',
            'phone' => 'required|regex:/^09[0-5]-[0-9]{7}/|unique:users,phone',
            'role' => 'required',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name'=> $request->name,
            'username'=> $request->username,
            'phone'=> $request->phone,
            'role'=> $request->role,
            'password'=> Hash::make($request->password),
        ]);

        foreach($request->role as $role) {
            if($role == 'add_sections_courses') {
                $user->update(['add_sections_courses' => true]);
            }
            if($role == 'add_students') {
                $user->update(['add_students' => true]);
            }
            if($role == 'stop_students') {
                $user->update(['stop_students' => true]);
            }
            if($role == 'student_marksheet_create') {
                $user->update(['student_marksheet_create' => true]);
            }
            if($role == 'student_marksheet_see') {
                $user->update(['student_marksheet_see' => true]);
            }
            if($role == 'add_employee') {
                $user->update(['add_employee' => true]);
            }
            if($role == 'employee_salary_create') {
                $user->update(['employee_salary_create' => true]);
            }
            if($role == 'treasury_main') {
                $user->update(['treasury_main' => true]);
            }
            if($role == 'student_inroll') {
                $user->update(['student_inroll' => true]);
            }
            if($role == 'new_students') {
                $user->update(['new_students' => true]);
            }
            if($role == 'student_inrollment') {
                $user->update(['student_inrollment' => true]);
            }
            if($role == 'employee_salary_see') {
                $user->update(['employee_salary_see' => true]);
            }
            if($role == 'treasury_all_report') {
                $user->update(['treasury_all_report' => true]);
            }
            if($role == 'mark_sheet_hide') {
                $user->update(['mark_sheet_hide' => true]);
            }
            if($role == 'season_colse_open') {
                $user->update(['season_colse_open' => true]);
            }
            if($role == 'grade_equation') {
                $user->update(['grade_equation' => true]);
            }
            if($role == 'show_graduated') {
                $user->update(['show_graduated' => true]);
            }
            if($role == 'users_mangement') {
                $user->update(['users_mangement' => true]);
            }

        }

        return redirect()->back()->with("success", 'تم الاضافة بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.user_edit', ['user'=> $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'password' => 'required|min:8',
        ]);

        if($user->name != $request->name){
            $user->name = $request->name;
        }
        if($user->username != $request->username){
            $request->validate([
                'username' => 'required|alpha_dash|regex:/^\S*$/|unique:users,username',
            ]);
            $user->username = $request->username;
        }
        if($user->phone != $request->phone){
            $request->validate([
                'phone' => 'required|unique:users,phone|regex:/^09[0-5]-[0-9]{7}/',
            ]);
            $user->phone = $request->phone;
        }
        if(!Hash::check($request->password, $user->password)){
            $user->password = $request->password;
        }

        $user->save();


            if(in_array('add_sections_courses', $request->role)) {
                $user->update(['add_sections_courses' => true]);
            } else {
                $user->update(['add_sections_courses' => false]);
            }
            if(in_array('add_students', $request->role)) {
                $user->update(['add_students' => true]);
            } else {
                $user->update(['add_students' => false]);
            }
            if(in_array('stop_students', $request->role)) {
                $user->update(['stop_students' => true]);
            } else {
                $user->update(['stop_students' => false]);
            }
            if(in_array('student_marksheet_create', $request->role)) {
                $user->update(['student_marksheet_create' => true]);
            } else {
                $user->update(['student_marksheet_create' => false]);
            }
            if(in_array('student_marksheet_see', $request->role)) {
                $user->update(['student_marksheet_see' => true]);
            } else {
                $user->update(['student_marksheet_see' => false]);
            }
            if(in_array('add_employee', $request->role)) {
                $user->update(['add_employee' => true]);
            } else {
                $user->update(['add_employee' => false]);
            }
            if(in_array('employee_salary_create', $request->role)) {
                $user->update(['employee_salary_create' => true]);
            } else {
                $user->update(['employee_salary_create' => false]);
            }
            if(in_array('treasury_main', $request->role)) {
                $user->update(['treasury_main' => true]);
            } else {
                $user->update(['treasury_main' => false]);
            }
            if(in_array('student_inroll', $request->role)) {
                $user->update(['student_inroll' => true]);
            } else {
                $user->update(['student_inroll' => false]);
            }
            if(in_array('new_students', $request->role)) {
                $user->update(['new_students' => true]);
            } else {
                $user->update(['new_students' => false]);
            }
            if(in_array('student_inrollment', $request->role)) {
                $user->update(['student_inrollment' => true]);
            } else {
                $user->update(['student_inrollment' => false]);
            }
            if(in_array('employee_salary_see', $request->role)) {
                $user->update(['employee_salary_see' => true]);
            } else {
                $user->update(['employee_salary_see' => false]);
            }
            if(in_array('treasury_all_report', $request->role)) {
                $user->update(['treasury_all_report' => true]);
            } else {
                $user->update(['treasury_all_report' => false]);
            }
            if(in_array('mark_sheet_hide', $request->role)) {
                $user->update(['mark_sheet_hide' => true]);
            } else {
                $user->update(['mark_sheet_hide' => false]);
            }
            if(in_array('season_colse_open', $request->role)) {
                $user->update(['season_colse_open' => true]);
            } else {
                $user->update(['season_colse_open' => false]);
            }
            if(in_array('grade_equation', $request->role)) {
                $user->update(['grade_equation' => true]);
            } else {
                $user->update(['grade_equation' => false]);
            }
            if(in_array('show_graduated', $request->role)) {
                $user->update(['show_graduated' => true]);
            } else {
                $user->update(['show_graduated' => false]);
            }
            if(in_array('users_mangement', $request->role)) {
                $user->update(['users_mangement' => true]);
            } else {
                $user->update(['users_mangement' => false]);
            }


        return redirect()->back()->with('success','تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success','تم الحذف بنجاح');
    }
}
