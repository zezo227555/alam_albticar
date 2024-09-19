<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Season;
use App\Models\Section;
use App\Models\Student;
use App\Models\Treasury;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function students_inroll_form()
    {
        $seasons = Season::orderBy('created_at', 'desc')->get();
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
            $students = Student::where('graduated', '=', 0)->where('season_id', '=', $request->season_id)->get();
        }else{
            $students = Student::where('graduated', '=', 0)->where('season_id', '=', $request->season_id)->where('section_id', '=', $request->section_id)->get();
        }

        return view('reports.students_inroll', ['season' => $season, 'students' => $students, 'section' => $section]);
    }

    public function student_payments_form()
    {
        $seasons = Season::orderBy('created_at', 'desc')->get();
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
        $seasons = Season::orderBy('created_at', 'desc')->get();
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
            $sections = Section::where('id', '=', $request->section_id)->get();
            $students = Student::where('section_id', '=', $request->section_id)->with('grade', function ($query) use ($request){
                $query->where('season_id', '=', $request->season_id);
            })->get();
        }

        return view('student.season_resault_search', ['sections' => $sections, 'students' => $students]);
    }

    public function employee_season_salary_form()
    {
        $seasons = Season::orderBy('created_at', 'desc')->get();
        $sections = Section::all();
        return view('reports.employee_season_salary_form', ['seasons' => $seasons, 'sections' => $sections]);
    }

    public function employee_season_salary(Request $request)
    {
        $request->validate([
            'season_id' => 'required',
            'section_id' => 'required',
        ]);

        if($request->section_id == 'all') {
            $season = Season::all();
            $employees = Employee::with(['treasury' => function ($query) use ($request) {
                $query->where('season_id', '=', $request->season_id);
            }])->get();
        } else {
            $season = Season::find($request->season_id);
            $employees = Employee::where('section_id', '=', $request->section_id)->with('treasury', function ($query) use ($request) {
                $query->where('season_id', '=', $request->season_id);
            })->get();
        }

        return view('reports.employee_season_salary', ['season' => $season, 'employees' => $employees]);
    }

    public function account_statement_form()
    {
        $seasons = Season::orderBy('created_at', 'desc')->get();
        $sections = Section::all();
        return view('reports.account_statement_form', ['seasons' => $seasons, 'sections' => $sections]);
    }

    public function account_statement(Request $request)
    {
        $request->validate([
            'season_id' => 'required',
            'section_id' => 'required',
        ]);

        if($request->section_id == 'all' && $request->section_id != 'all') {
            $receipts = Treasury::where('season_id', '=', $request->season_id)->get();
        }

        if($request->section_id != 'all' && $request->section_id == 'all') {
            $receipts = Treasury::where('section_id', '=', $request->section_id)->get();
        }

        if($request->section_id == 'all' && $request->section_id == 'all') {
            $receipts = Treasury::all();
        }

        if($request->section_id != 'all' && $request->section_id != 'all') {
            $receipts = Treasury::where('section_id', '=', $request->section_id)->where('season_id', '=', $request->season_id)->get();
        }

        return view('reports.account_statement', ['receipts' => $receipts]);

    }
}
