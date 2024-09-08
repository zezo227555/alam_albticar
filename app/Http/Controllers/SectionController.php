<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        return view("section.secion", ["section"=> $sections]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'level' => 'required'
        ], [
            'name.required' => 'الاسم مطلوب',
            'level.required' => 'النوع مطلوب'
        ]);

        Section::create([
            'name' => $request->name,
            'level' => $request->level,
        ]);

        return redirect()->back()->with("success", 'تم الاضافة بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        return view("section.section_edit", ["section"=> $section]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        $request->validate([
            'name' => 'required',
            'level' => 'required'
        ], [
            'name.required' => 'الاسم مطلوب',
            'level.required' => 'النوع مطلوب'
        ]);

        if($section->name != $request->name){
            $section->name = $request->name;
        }
        if($section->level != $request->level){
            $section->level = $request->level;
        }

        $section->save();
        return redirect()->back()->with("success", 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->back()->with("success", 'تم الحذف بنجاح');
    }
}
