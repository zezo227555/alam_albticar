<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Grade;
use App\Models\Season;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function select_section()
    {
        $sections = Section::all();
        $courses = Course::all();
        return view('student.select_section', ['sections' => $sections, 'courses' => $courses]);
    }

    public function index(Request $request)
    {
        $students = Student::where('graduated', '=', 0)->where('section_id', '=', $request->section_id)->get();
        $section = Section::find($request->section_id);
        return view("student.student", ["students"=> $students, 'section' => $section]);
    }

    public function get_students_by_course(Request $request)
    {
        $courses = Course::where('name', '=', $request->course_name)->get();
        $all_students = [];
        foreach($courses as $course) {
            $grades = Grade::where('course_id', '=', $course->id)->where('active', '=', 1)->get();
            array_push($all_students, $grades);
        }

        return view("student.get_students_by_course", ["all_students"=> $all_students, 'course' => $course]);
    }

    public function get_students_by_level(Request $request)
    {
        $sections = [];

        if ($request->level == 'متوسط') {
            $sections = Section::where('level', '=', 'متوسط')->get();
        }
        if ($request->level == 'عالي') {
            $sections = Section::where('level', '=', 'عالي')->get();
        }
        if ($request->level == 'بكالوريس') {
            $sections = Section::where('level', '=', 'بكالوريس')->get();
        }

        return view("student.get_students_by_level", ['sections' => $sections, 'level' => $request->level]);
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
            'st_id' => 'required',
            'nationla_id' => 'required|unique:student,nationla_id',
            'phone' => 'unique:student,phone',
            'perant_phone' => 'unique:student,perant_phone',
            'gender' => 'required',
            'nationality' => 'required',
            'section_id' => 'required',
            'attendance_type' => 'required',
        ]);

        $season = Season::where('active', '=', 1)->first();

        if(!isset($season->id)) {
            return redirect()->back()->with('error', 'لا يوجد فصل دراسي');
        }

        Student::create([
            'name' => $request->name,
            'st_id' => $request->st_id,
            'nationla_id' => $request->nationla_id,
            'phone' => $request->phone,
            'perant_phone' => $request->perant_phone,
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'section_id' => $request->section_id,
            'attendance_type' => $request->attendance_type,
            'season_id' => $season->id,
            'fees' => $request->fees,
            'student_semester' => $request->semester,
        ]);

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
                'phone' => 'unique:student,phone',
            ]);
            $student->update([
                'phone' => $request->phone,
            ]);
        }
        if($student->perant_phone != $request->perant_phone){
            $request->validate([
                'perant_phone' => 'unique:student,phone',
            ]);
            $student->update([
                'perant_phone' => $request->perant_phone,
            ]);
        }
        if($student->nationla_id != $request->nationla_id){
            $request->validate([
                'nationla_id' => 'required|unique:student,nationla_id|min:12|max:12',
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
            'fees' => $request->fees,
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
        $request->validate([
            'student_id' => 'required',
        ]);
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

    public function grade_equation_section_select_form()
    {
        $seasons = Season::orderBy('created_at', 'desc');
        $sections = Section::all();
        return view('student.grade_equation_section_select_form', ['seasons' => $seasons, 'sections' => $sections]);
    }

    public function grade_equation_form(Request $request)
    {
        $section = Section::find($request->section_id);
        $students = Student::where('graduated', '=', 0)->where('section_id', '=', $request->section_id)->get();
        return view('student.grade_equation_form', ['students' => $students, 'section' => $section]);
    }

    public function grade_equation(Request $request)
    {
        $student = Student::find($request->student_id);
        $section = Section::find($request->section_id);
        $courses = Course::where('section_id', '=', $section->id)->orderBy('semester')->get();

        $grades = Grade::where('student_id', '=', $student->id)->get();

        return view('student.grade_equation', [
            'student' => $student,
            'section' => $section,
            'courses' => $courses,
            'grades' => $grades,
        ]);
    }

    public function grade_equation_create(Request $request)
    {
        $season = Season::latest()->first();
        $student = Student::find($request->student_id);
        $section = Section::find($request->section_id);

        if(isset($request->semester_work)) {
            foreach($request->semester_work as $key => $value) {
                if(isset($value)) {
                    $request->validate([
                        "final.$key" => 'required',
                    ]);

                    Grade::create([
                        'course_id' => $key,
                        'student_id' => $student->id,
                        'section_id' => $section->id,
                        'season_id' => $season->id,
                        'active' => false,
                        'semester_work' => $value,
                        'final' => $request->final[$key],
                        'total' => $value + $request->final[$key],
                        'user_id' => Auth::user()->id,
                    ]);
                }
            }
        }

        if(isset($request->old_semester_work)) {
            foreach($request->old_semester_work as $old_key => $old_value) {
                if(isset($old_value)) {
                    $request->validate([
                        "old_final.$old_key" => 'required',
                    ]);

                    $grade = Grade::find($old_key);
                    $grade->update([
                        'semester_work' => $old_value,
                        'final' => $request->old_final[$old_key],
                    ]);
                }
            }
        }

        $student->update([
            'student_semester' => $request->semester
        ]);

        if($student->student_semester > 6 && ($student->section->level == 'متوسط' || $student->section->level == 'عالي')) {
            $student->update([
                'graduated' => true,
            ]);
        }

        if ($student->student_semester > 8 && $student->section->level == 'بكالوريس') {
            $student->update([
                'graduated' => true,
            ]);
        }

        return redirect()->back()->with('success', 'تم الاضافة بنجاح');
    }

    public function graduated_students()
    {
        $students = Student::where('graduated', '=', 1)->get();
        return view('student.student', ['students' => $students]);
    }
}
