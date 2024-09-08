<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Grade;
use App\Models\Season;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index($student_id)
    {
        $student = Student::find($student_id);
        $season = Season::where('active', '=', 1)->first();
        $grades = Grade::where('student_id', '=', $student_id)->where('season_id', '=', $season->id)->get();

        return view('grade.grade', ['grades' => $grades, 'student' => $student,]);
    }

    public function create_grade_sheet($student_id)
    {
        $season = Season::where('active', '=', 1)->first();
        $student = Student::find($student_id);
        $grades = Grade::where('student_id', '=', $student_id)->where('season_id', '=', $season->id)->get();
        $courses = Course::where('section_id', '=', $student->section_id)->get();

        if($grades->isNotEmpty()) {
            return redirect()->back()->with('error', 'يوجد كشف مسبقا للطالب');
        }

        foreach($courses as $course){
            Grade::create([
                'student_id' => $student_id,
                'season_id' => $season->id,
                'course_id' => $course->id,
                'section_id' => $course->section->id
            ]);
        }

        return redirect()->back()->with('success', 'تم الاضافة بنجاح');
    }

    public function update_grade_sheet(Request $request)
    {
        foreach($request->resault as $key => $resault)
        {
            $grade = Grade::find($key);
            $grade->update([
                'resault' => $resault
            ]);
        }

        return redirect()->back()->with('success', 'تم التعديل بنجاح');
    }

    public function old_grade_sheet_form()
    {
        $seasons = Season::orderBy('created_at', 'asc')->get();
        $sections = Section::all();
        return view('grade.old_grade_sheet_form', [
            'seasons' => $seasons, 'sections' => $sections
        ]);
    }

    public function old_grade_sheet(Request $request)
    {
        $students = Student::where('section_id', '=', $request->section_id)->get();
        $season = Season::find($request->season_id);
        return view('grade.old_grade_sheet', ['students' => $students, 'season' => $season]);
    }

    public function old_grade_sheet_search($student_id, $section_id, $season_id)
    {
        $student = Student::find($student_id);
        $grades = Grade::where('student_id', '=', $student_id)->where('section_id', '=', $section_id)->where('season_id', '=', $season_id)->get();
        return view('grade.grade', ['grades' => $grades, 'student' => $student]);
    }
}
