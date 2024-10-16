<?php

namespace App\Http\Controllers;

use App\Models\Mangement;
use Illuminate\Http\Request;

class MangementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mangements = Mangement::all();
        return view('mangement.mangement', ['mangements' => $mangements]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Mangement::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'تم الاضافة بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mangement $mangement)
    {
        return view('mangement.mangement_edit', ['mangement' => $mangement]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mangement $mangement)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $mangement->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mangement $mangement)
    {
        $mangement->delete();
        return redirect()->back()->with('success', 'تم الحذف بنجاح');
    }
}
