<?php

namespace App\Http\Controllers;

use App\Models\Workouts;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    public function index()
    {
        $workouts = Workouts::all();
        return view('workouts.index', ['workouts' => $workouts]);
    }

    public function create()
    {
        return view('workouts.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:50',
            'type' => 'required',
            'duration' => 'required',
            'calories_burned' => 'required'
        ]);

        $workouts = new Workouts();
        $workouts->name = $validateData['name'];
        $workouts->type = $validateData['type'];
        $workouts->duration = $validateData['duration'];
        $workouts->calories_burned = $validateData['calories_burned'];
        $workouts->save();

        return redirect()->route('workouts.index');
    }

    public function destroy(Workouts $workouts)
    {
        $workouts->delete();
        return redirect()->route('workouts.index');
    }
}
