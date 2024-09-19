<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Section;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($section_id)
    {
        $courses = Course::where("section_id", '=', $section_id)->get();
        $section = Section::where('id','=', $section_id)->first();
        return view('course.course', ['course'=> $courses, 'section' => $section]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $section_id)
    {
        $request->validate([
            'name' => 'required',
            'semester' => 'required'
        ]);

        Course::create([
            'name' => $request->name,
            'semester' => $request->semester,
            'section_id' => $section_id,
        ]);

        return redirect()->back()->with('success','تمت الاضافة بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course_id)
    {
        return view('course.course_edit', ['course'=> $course_id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course_id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $course_id->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success','تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course_id)
    {
        $course_id->delete();
        return redirect()->back()->with('success','تم الحذف بنجاح');
    }
}
