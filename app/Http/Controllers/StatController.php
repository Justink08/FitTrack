<?php

namespace App\Http\Controllers;

use App\Models\Stats;
use App\Models\Workouts;
use App\Models\Calories;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function index()
    {
        $stats = Stats::all();
        $calories = Calories::all();
        $workouts = Workouts::all();
        return view('progress.index', [
            'stats' => $stats,
            'calories' => $calories,
            'workouts' => $workouts
        ]);
    }

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

        // Return a redirect so the route returns a valid response and does not cause unexpected rendering issues
        return redirect()->route('progress.index');
    }

    public function edit(Stats $stats)
    {
        $stats = Stats::findOrFail($stats->id);
        return view('progress.edit', compact('stats'));
    }

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
}
