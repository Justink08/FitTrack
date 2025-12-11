<?php

namespace App\Http\Controllers;

use App\Models\Calories;
use Illuminate\Http\Request;

class CalorieController extends Controller
{
    public function index()
    {
        $calories = Calories::all();
        return view('calories.index', ['calories' => $calories]);
    }

    public function create()
    {
        return view('calories.create');
    }

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

    public function destroy(Calories $calories)
    {
        $calories->delete();
        return redirect()->route('calories.index');
    }
}
