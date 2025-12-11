<?php

namespace App\Http\Controllers;

use App\Models\Stats;
use App\Models\Workouts;
use App\Models\Calories;
use Illuminate\Http\Request;

class StatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stats = Stats::all();
        $workouts = Workouts::all();
        $calories = Calories::all();
        return view('progress.index', ['stats' => $stats], ['workouts' => $workouts], ['calories' => $calories],);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stats = new Stats;
        $stats->weight = 70;
        $stats->height = 170;
        $stats->age = 30;
        $stats->gender = 'M';
        $stats->daily_calorie_goal = 2000;
        $stats->daily_protein_goal = 150;
        $stats->save();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Stats $stats)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stats $stats)
    {
        $stats = Stats::findOrFail($stats->id);
        return view('progress.edit', compact('stats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stats $stats)
    {
        $validateData = $request->validate([
            'weight' => 'required',
            'height' => 'required',
            'age' => 'required',
            'gender' => 'required|in:M,F',
            'daily_calorie_goal' => 'required',
            'daily_protein_goal' => 'required',
        ]);

        $stats = Stats::findOrFail($stats->id);
        $stats->update($validateData);

        return redirect()->route('progress.index', ['stats'=>$stats->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stats $stats)
    {
        //
    }
}
