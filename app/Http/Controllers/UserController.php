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
        $users = User::all();
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
            'username' => 'required',
            'phone' => 'required|regex:/^09[0-5]-[0-9]{7}/',
            'role' => 'required',
            'password' => 'required|min:8',
        ], [
            'name.required'=> 'الاسم مطلوب',
            'username.required'=> 'اسم المستخدم مطلوب',
            'role.required'=> 'الصلاحية مطلوبة',
            'phone.required'=> 'رقم الهاتف مطلوب',
            'phone.regex' => 'يجب على رقم الهاتف ان يكون بالصيغة التالية (09X-XXXXXXX)',
            'password.required'=> 'كلمة المرور مطلوب',
            'password.min'=> 'كلمة المرور يجب ان تكون 8 احرف',
        ]);

        User::create([
            'name'=> $request->name,
            'username'=> $request->username,
            'phone'=> $request->phone,
            'role'=> $request->role,
            'password'=> Hash::make($request->password),
        ]);

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
            'username' => 'required',
            'phone' => 'required|regex:/^09[0-5]-[0-9]{7}/',
            'role' => 'required',
            'password' => 'required|min:8',
        ], [
            'name.required'=> 'الاسم مطلوب',
            'username.required'=> 'اسم المستخدم مطلوب',
            'role.required'=> 'الصلاحية مطلوبة',
            'phone.required'=> 'رقم الهاتف مطلوب',
            'phone.regex' => 'يجب على رقم الهاتف ان يكون بالصيغة التالية (09X-XXXXXXX)',
            'password.required'=> 'كلمة المرور مطلوب',
            'password.min'=> 'كلمة المرور يجب ان تكون 8 احرف',
        ]);

        if($user->name != $request->name){
            $user->name = $request->name;
        }
        if($user->username != $request->username){
            $user->username = $request->username;
        }
        if($user->phone != $request->phone){
            $user->phone = $request->phone;
        }
        if($user->role != $request->role){
            $user->role = $request->role;
        }
        if(!Hash::check($request->password, $user->password)){
            $user->password = $request->password;
        }

        $user->save();
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
