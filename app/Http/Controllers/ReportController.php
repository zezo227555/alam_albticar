<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Section;
use App\Models\Student;
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
}
