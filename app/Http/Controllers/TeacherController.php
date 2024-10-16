<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Season;
use App\Models\Teacher;
use App\Models\TeacherCourses;
use App\Models\Treasury;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();

        return view('teacher.teacher', ['teachers' => $teachers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'degree' => 'required',
        ]);

        Teacher::create($request->all());

        return redirect()->back()->with('success', 'تم الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        return view('teacher.teacher_show', ['teacher' => $teacher]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return view('teacher.teacher_edit', ['teacher' => $teacher]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'degree' => 'required',
        ]);

        $teacher->update($request->all());

        return redirect()->back()->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->back()->with('success', 'تم الحذف بنجاح');
    }

    public function courses($teacher_id)
    {
        $teacher = Teacher::find($teacher_id);
        $courses = Course::all();
        $teacher_courses = TeacherCourses::where('teacher_id', '=', $teacher_id)->get();

        return view('teacher.teacher_courses', [
            'teacher_courses' => $teacher_courses,
            'courses' => $courses,
            'teacher' => $teacher,
        ]);
    }

    public function teacherCoursesCreate(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
        ]);

        $course = Course::find($request->course_id);
        $teacher_courses = TeacherCourses::where('teacher_id', '=', $request->teacher_id)->get();

        foreach ($teacher_courses as $teacher_course) {
            if ($teacher_course->course_id == $course->id) {
                return redirect()->back()->with('error', 'المادة موجودة مسبقا');
            }
        }

        TeacherCourses::create([
            'course_id' => $course->id,
            'section_id' => $course->section->id,
            'teacher_id' => $request->teacher_id,
        ]);

        return redirect()->back()->with('success', 'تم الاضافة بنجاح');
    }

    public function teacherCoursesDestroy(Request $request)
    {
        if(!isset($request->course_id)) {
            return redirect()->back()->with('info', 'لا يوجد سجلات');
        }
        $course = null;
        foreach ($request->course_id as $id) {
            $course = TeacherCourses::find($id);
            $course->delete();
        }

        return redirect()->back()->with('success', 'تم الحذف بنجاح');
    }

    public function teacherSalary($teacher_id)
    {
        $seasons = Season::all();
        $teacher = Teacher::find($teacher_id);
        $teacher_courses = TeacherCourses::where('teacher_id', '=', $teacher_id)->get();
        return view('teacher.teacher_salary', ['teacher' => $teacher, 'teacher_courses' => $teacher_courses, 'seasons' => $seasons]);
    }

    public function teacherSalaryCreate(Request $request)
    {
        if(!isset($request->lecturs)) {
            return redirect()->back()->with('info', 'لا يوجد سجلات');
        }

        $course = null;
        $low_level_salary = 0;
        $high_level_salary = 0;
        $full_salary = 0;
        $teacher = Teacher::find($request->teacher_id);
        $course = null;

        $treasury = Treasury::where('teacher_id', '=', $teacher->id)->where('season_id', '=', $request->season_id)->get();
        if ($treasury->isNotEmpty()) {
            return redirect()->back()->with('error', 'يوجد ايصال لهذا الفصل');
        }

        switch ($teacher->degree) {
            case 'بكالوريس':
                $low_level_salary = 15;
                $high_level_salary = 20;
            break;

            case 'ماجستير':
                $low_level_salary = 17;
                $high_level_salary = 20;
            break;

            case 'دكتوراة':
                $low_level_salary = 23;
                $high_level_salary = 35;
            break;
        }

        foreach ($request->lecturs as $key => $value) {
            $course = TeacherCourses::find($key);

            if ($course->section->level == 'متوسط') {
                $full_salary += $value * $low_level_salary;
            } else {
                $full_salary += $value * $high_level_salary;
            }
        }

        $receipt = Treasury::create([
            'type' => 'مرتبات',
            'season_id' => $request->season_id,
            'teacher_id' => $request->teacher_id,
            'value' => -$full_salary,
            'user_id' => Auth::user()->id
        ]);

        return view('receipts.teacher_salary', ['receipt' => $receipt]);
    }
}
