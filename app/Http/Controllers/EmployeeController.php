<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Season;
use App\Models\Section;
use App\Models\Treasury;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee = Employee::all();
        $season = Season::where('active', '=', 1)->first();
        $receipts = Treasury::where('type', '=', 'مرتبات')->where('season_id', '=', $season->id)->get();
        return view('employee.employee', ['employee' => $employee, 'receipts' => $receipts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        return view('employee.employee_create', ['sections' => $sections]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'phone' => 'required|regex:/^09[0-5]-[0-9]{7}/',
            'salary' => 'required|min:0',
            'section_id' => 'required',
        ]);

        Employee::create([
            'name' => $request->name,
            'type' => $request->type,
            'salary' => $request->salary,
            'phone' => $request->phone,
            'section_id' => $request->section_id,
        ]);

        return redirect()->back()->with('success','تمت الاضافة بنجاح');
    }

    public function show(Employee $employee)
    {
        return view('employee.employee_show', ['employee' => $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $sections = Section::all();
        return view('employee.employee_edit', ['employee' => $employee, 'sections' => $sections]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        if($employee->name != $request->name){
            $request->validate([
                'name' => 'required'
            ]);
            $employee->update([
                'name' => $request->name
            ]);
        }
        if($employee->type != $request->type){
            $request->validate([
                'type' => 'required'
            ]);
            $employee->update([
                'type' => $request->type
            ]);
        }
        if($employee->salary != $request->salary){
            $request->validate([
                'salary' => 'required|min:0'
            ]);
            $employee->update([
                'salary' => $request->salary
            ]);
        }
        if($employee->section_id != $request->section_id){
            $request->validate([
                'section_id' => 'required'
            ]);
            $employee->update([
                'section_id' => $request->section_id
            ]);
        }
            return redirect()->back()->with('success','تمت التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->back()->with('success','تمت الحذف بنجاح');
    }

    public function salary_create($employee_id)
    {
        $seasons = Season::orderBy('created_at', 'desc')->get();
        $employee = Employee::find($employee_id);
        return view('employee.salary_create', ['employee' => $employee, 'seasons' => $seasons]);
    }

    public function salary_store(Request $request)
    {
        $request->validate([
            'ammount' => 'required|min:0',
            'season_id' => 'required',
            'employee_id' => 'required',
        ]);

        $receipt = Treasury::create([
            'type' => 'مرتبات',
            'season_id' => $request->season_id,
            'employee_id' => $request->employee_id,
            'value' => $request->ammount,
            'user_id' => Auth::user()->id
        ]);

        return view('receipts.employee_salary', ['receipt' => $receipt]);
    }

    public function salary_update(Request $request)
    {
        $receipt = Treasury::find($request->receipt_id);

        $receipt->update([
            'value' => $request->ammount,
        ]);

        return view('receipts.employee_salary', ['receipt' => $receipt]);
    }
}
