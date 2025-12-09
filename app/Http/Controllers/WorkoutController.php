<?php

namespace App\Http\Controllers;

use App\Models\Workouts;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workouts = Workouts::all();
        return view('workouts.index', ['workouts' => $workouts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('workouts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workouts $workouts)
    {
        $workouts->delete();
        return redirect()->route('workouts.index');
    }
}
