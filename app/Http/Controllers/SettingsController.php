<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $season = Season::where('active', '=', 1)->first();

        return view('settings.settings', [
            'season' => $season,
        ]);
    }

    public function new_season_form()
    {
        $last_season = Season::latest()->first();
        $season = Season::where('active', '=', 1)->first();

        return view('settings.new_season_form', ['season' => $season, 'last_season' => $last_season]);
    }

    public function new_season(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $active_season = Season::where('active', '=', 1)->first();

        if(isset($active_season)){
            return redirect()->back()->with('error', 'لم يتم اغلاق احر فصل');
        }

        $all_seasons = Season::all();
        $now_date = Carbon::now()->format('Y');

        foreach($all_seasons as $season){
            if($request->name == $season->name && $season->created_at->format('Y') == $now_date){
                return redirect()->back()->with('error', 'يوجد فصل بنفس الاسم و السنة');
            }
        }

        Season::create([
            'name' => $request->name,
            'active' => true,
        ]);

        return redirect()->back()->with('success', 'تم الحفظ بنجاح');
    }

    public function season_close(Request $request)
    {
        $request->validate([
            'season_id' => 'required'
        ]);

        $season = Season::where('id', '=', $request->season_id)->first();
        $season->update([
            'active' => false,
            'end_date' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'تم الحفظ بنجاح');
    }
}
