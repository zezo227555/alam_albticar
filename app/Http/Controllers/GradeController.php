<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Grade;
use App\Models\Season;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\assertNotTrue;

class GradeController extends Controller
{
    public function index($student_id)
    {
        $student = Student::find($student_id);
        $season = Season::where('active', '=', 1)->first();
        $grades = Grade::where('student_id', '=', $student_id)->where('season_id', '=', $season->id)->get();

        return view('grade.grade', ['grades' => $grades, 'student' => $student,]);
    }

    public function create_grade_sheet(Request $request)
    {
        $season = Season::find($request->season_id);

        $student = Student::find($request->student_id);

        $grades = Grade::where('student_id', '=', $request->student_id)
        ->where('season_id', '=', $season->id)->get();

        $courses = Course::where('section_id', '=', $student->section_id)
        ->where('semester', '=', $student->student_semester)->get();

        if($grades->isNotEmpty()) {
            return redirect()->back()->with('error', 'يوجد كشف مسبقا للطالب');
        }

        foreach($courses as $course){
            Grade::create([
                'student_id' => $request->student_id,
                'season_id' => $season->id,
                'course_id' => $course->id,
                'section_id' => $course->section->id,
                'active' => true,
                'user_id' => Auth::user()->id
            ]);
        }

        return redirect()->back()->with('success', 'تم الاضافة بنجاح');
    }

    public function update_grade_sheet(Request $request)
    {
        foreach($request->semester_work as $key => $semester_work)
        {
            $grade = Grade::find($key);
            $grade->update([
                'semester_work' => $semester_work,
                'user_id' => Auth::user()->id
            ]);
            $grade->update([
                'total' => $grade->semester_work + $grade->final,
                'user_id' => Auth::user()->id
            ]);
        }

        foreach($request->final as $key => $final)
        {
            $grade = Grade::find($key);
            $grade->update([
                'final' => $final,
                'user_id' => Auth::user()->id
            ]);
            $grade->update([
                'total' => $grade->semester_work + $grade->final,
                'user_id' => Auth::user()->id
            ]);
        }

        return redirect()->back()->with('success', 'تم التعديل بنجاح');
    }

    public function old_grade_sheet_form()
    {
        $seasons = Season::orderBy('created_at', 'desc')->get();
        $sections = Section::all();
        return view('grade.old_grade_sheet_form', [
            'seasons' => $seasons, 'sections' => $sections
        ]);
    }

    public function old_grade_sheet(Request $request)
    {
        $students = Student::where('section_id', '=', $request->section_id)->where('graduated', '=', 0)->get();
        $season = Season::find($request->season_id);
        return view('grade.old_grade_sheet', ['students' => $students, 'season' => $season]);
    }

    public function old_grade_sheet_search($student_id, $section_id, $season_id)
    {
        $student = Student::find($student_id);
        $season = Season::find($season_id);
        $grades = Grade::where('student_id', '=', $student_id)->where('section_id', '=', $section_id)->where('season_id', '=', $season_id)->get();
        return view('grade.grade', ['grades' => $grades, 'student' => $student, 'season' => $season]);
    }
}
