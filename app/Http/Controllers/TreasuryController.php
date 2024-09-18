<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Section;
use App\Models\Student;
use App\Models\Treasury;
use Illuminate\Http\Request;

class TreasuryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $treasury = Treasury::paginate(25);
        return view('treasury.treasury', ['treasury' => $treasury]);
    }

    public function select_season_and_section()
    {
        $seasons = Season::orderBy('created_at', 'desc')->get();
        $sections = Section::all();
        return view('treasury.select_season_and_section', ['seasons' => $seasons, 'sections' => $sections]);
    }

    public function student_enroll(Request $request)
    {
        $season = Season::find($request->season_id);
        $students = Student::where('section_id', '=', $request->section_id)->with('treasury', function($query) use ($request){
            $query->where('season_id', '=', $request->season_id);
        })->get();

        return view('treasury.student_enroll', ['season' => $season, 'students' => $students]);
    }

    /**
     * ايصال القبض العادي
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'value' => 'required',
        ]);

        $season = Season::where('active', '=', 1)->first();

        if($request->value_type == 'صرف'){
            Treasury::create([
                'type' => $request->type,
                'season_id' => $season->id,
                'value' => -$request->value,
            ]);
        }else{
            Treasury::create([
                'type' => $request->type,
                'season_id' => $season->id,
                'value' => $request->value,
            ]);
        }

        return redirect()->back()->with('success', 'تمت الاضافة بنجاح');
    }

    // تجديد قيد الطلبة انشاء
    public function create_student_inroll(Request $request)
    {
        Treasury::create([
            'type' => 'تجديد قيد',
            'season_id' => $request->season_id,
            'section_id' => $request->section_id,
            'student_id' => $request->student_id,
            'value' => $request->value
        ]);

        return redirect()->back()->with('success', 'تمت الاضافة بنجاح');
    }

    // تجديد قيد الطلبة تعديل
    public function update_student_inroll(Request $request)
    {
        $student_treasury = Treasury::find($request->student_treasury_id);

        $student_treasury->update([
            'value' => $request->value
        ]);

        return redirect()->back()->with('success', 'تمت التعديل بنجاح');
    }

    public function student_enroll_receipt(Request $request)
    {
        $receipt = Treasury::find($request->receipt_id);
        return view('receipts.student_enroll', ['receipt' => $receipt]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Treasury $treasury)
    {
        $treasury->delete();
        return redirect()->back()->with('success', 'تم الحذف بنجاح');
    }
}
