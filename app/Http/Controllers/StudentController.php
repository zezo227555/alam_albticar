<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Student::all();
        return view("student.student", ["student"=> $student]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        return view("student.student_create", ["sections"=> $sections]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nationla_id' => 'required|unique:student,nationla_id',
            'phone' => 'required|unique:student,phone',
            'gender' => 'required',
            'nationality' => 'required',
            'section_id' => 'required',
            'attendance_type' => 'required',
            'student_semester' => 'required'
        ]);

        Student::create($request->all());

        return redirect()->back()->with('success','تمت الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $sections = Section::all();
        return view('student.student_edit', ['student' => $student, 'sections' => $sections]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        if($student->phone != $request->phone){
            $request->validate([
                'phone' => 'required|unique:student,phone',
            ]);
            $student->update([
                'phone' => $request->phone,
            ]);
        }
        if($student->nationla_id != $request->nationla_id){
            $request->validate([
                'nationla_id' => 'required|unique:student,nationla_id',
            ]);
            $student->update([
                'nationla_id' => $request->nationla_id,
            ]);
        }

        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'nationality' => 'required',
            'section_id' => 'required',
            'attendance_type' => 'required',
        ]);

        $student->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'section_id' => $request->section_id,
            'attendance_type' => $request->attendance_type,
        ]);

        return redirect()->back()->with('success','تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->back()->with('success','تم الحذف بنجاح');
    }
}
