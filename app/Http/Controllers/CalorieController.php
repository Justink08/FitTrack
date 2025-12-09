<?php

namespace App\Http\Controllers;

use App\Models\Calories;
use Illuminate\Http\Request;

class CalorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $calories = Calories::all();
        return view('calories.index', ['calories' => $calories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('calories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name'=> 'required|max:50',
            'calorie'=> 'required',
            'protein'=> 'required',
            'carbs'=> 'required',
            'fats'=> 'required',
            'type'=> 'required'
        ]);

        $calories = new Calories();
        $calories->name = $validateData['name'];
        $calories->calorie = $validateData['calorie'];
        $calories->protein = $validateData['protein'];
        $calories->carbs = $validateData['carbs'];
        $calories->fats = $validateData['fats'];
        $calories->type = $validateData['type'];
        $calories->save();

        return redirect()->route('calories.index');
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
    public function destroy(Calories $calories)
    {
        $calories->delete();
        return redirect()->route('calories.index');
    }
}
