<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Section;
use App\Models\Student;
use App\Models\Treasury;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function students_inroll_form()
    {
        $seasons = Season::all();
        $sections = Section::all();
        return view('reports.students_inroll_form', ['seasons' => $seasons, 'sections' => $sections]);
    }

    public function students_inroll(Request $request)
    {
        $request->validate([
            'season_id' => 'required',
            'section_id' => 'required',
        ]);

        $season = Season::find($request->season_id);
        $section = Season::find($request->section_id);

        if($request->section_id == 'all'){
            $students = Student::where('season_id', '=', $request->season_id)->get();
        }else{
            $students = Student::where('season_id', '=', $request->season_id)->where('section_id', '=', $request->section_id)->get();
        }

        return view('reports.students_inroll', ['season' => $season, 'students' => $students, 'section' => $section]);
    }

    public function student_payments_form()
    {
        $seasons = Season::all();
        $sections = Section::all();
        return view('reports.student_payments_form', ['seasons' => $seasons, 'sections' => $sections]);
    }

    public function student_payments(Request $request)
    {
        $request->validate([
            'section_id' => 'required',
            'season_id' => 'required',
        ]);

        $season = Season::find($request->season_id);
        $section = Section::find($request->section_id);
        $students = Student::where('section_id', '=', $request->section_id)->with('treasury', function($query) use ($request){
            $query->where('season_id', '=', $request->season_id);
        })->get();

        return view('reports.student_payments', ['students' => $students, 'season' => $season, 'section' => $section]);
    }

    public function season_resault_search_form()
    {
        $sections = Section::all();
        $seasons = Season::all();
        return view('reports.season_resualt_search', ['sections' => $sections, 'seasons' => $seasons]);
    }

    public function season_resault_search(Request $request)
    {
        $request->validate([
            'section_id' => 'required',
            'season_id' => 'required',
        ]);

        if($request->section_id == 'all') {
            $sections = Section::all();
            $students = Student::with(['grade' => function ($query) use ($request){
                $query->where('season_id', '=', $request->season_id);
            }])->get();
        } else {
            $sections = Section::find($request->section_id);
            $students = Student::where('section_id', '=', $request->section_id)->with('grade', function ($query) use ($request){
                $query->where('season_id', '=', $request->season_id);
            })->get();
        }

        return view('student.season_resault_search', ['sections' => $sections, 'students' => $students]);
    }
}
