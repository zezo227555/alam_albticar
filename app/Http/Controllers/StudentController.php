<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Season;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function select_section()
    {
        $sections = Section::all();
        return view('student.select_section', ['sections' => $sections]);
    }

    public function index(Request $request)
    {
        $students = Student::where('section_id', '=', $request->section_id)->get();
        $section = Section::find($request->section_id);
        return view("student.student", ["students"=> $students, 'section' => $section]);
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
            'phone' => 'required|regex:/^09[0-5]-[0-9]{7}/',
            'preant_phone' => 'required|regex:/^09[0-5]-[0-9]{7}/',
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
        return view('student.student_show', ['student' => $student]);
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

    public function premot_student_form()
    {
        $sections = Section::all();
        return view('student.premot_student_form', ['sections' => $sections]);
    }

    public function premot_student(Request $request)
    {
        $students = Student::where('section_id', '=', $request->section_id)->get();
        return view('student.premot_student', ['students' => $students]);
    }

    public function get_student_season_resault_form()
    {
        $seasons = Season::orderBy('created_at', 'desc')->get();
        return view('student.get_student_season_resault_form', ['seasons' => $seasons]);
    }

    public function get_student_season_resault(Request $request)
    {
        $request->validate([
            'season_id' => 'required',
            'student_id' => 'required',
        ]);

        $student = Student::find($request->student_id);
        $grades = Grade::where('student_id', '=', $request->student_id)
        ->where('show_grades', '=', 0)->where('season_id', '=', $request->season_id)->get();
        return view('student.get_student_season_resault', ['student' => $student, 'grades' => $grades]);
    }

    public function deactivate_student(Request $request)
    {
        $student = Student::find($request->student_id);
        $student->update([
            'active' => false,
        ]);

        return redirect()->back()->with('success', 'تم ايقاف التفعيل');
    }

    public function activate_student(Request $request)
    {
        $student = Student::find($request->student_id);
        $student->update([
            'active' => true,
        ]);

        return redirect()->back()->with('success', 'تم التفعيل');
    }

    public function deactivate_multiple_student(Request $request)
    {
        foreach($request->stop_st_id as $st) {
            $student = Student::find($st);
            $student->update([
                'active' => false,
            ]);
        }

        return redirect()->back()->with('success', 'تم ايقاف التفعيل');
    }

    public function student_full_marksheet($student_id)
    {
        $student = Student::find($student_id);
        $grades = Grade::where('student_id', '=', $student_id)
        ->where('total', '>=', 50)->orderBy('created_at', 'asc')->get();

        return view('student.student_full_marksheet', ['grades' => $grades, 'student' => $student]);
    }
}
