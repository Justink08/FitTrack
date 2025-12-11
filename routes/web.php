<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CalorieController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\StatController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', ['calories' => $calories]);
});

Route::prefix('/calories')->group(function () {
    Route::get('', [CalorieController::class, 'index'])->name('calories.index');
    Route::get('/create', [CalorieController::class, 'create'])->name('calories.create');
    Route::post('', [CalorieController::class, 'store'])->name('calories.store');
    Route::delete('/{calories}', [CalorieController::class, 'destroy'])->name('calories.destroy');
});

Route::prefix('/workouts')->group(function () {
    Route::get('', [WorkoutController::class, 'index'])->name('workouts.index');
    Route::get('/create', [WorkoutController::class, 'create'])->name('workouts.create');
    Route::post('', [WorkoutController::class, 'store'])->name('workouts.store');
    Route::delete('/{workouts}', [WorkoutController::class, 'destroy'])->name('workouts.destroy');
});

Route::get('', [StatController::class, 'create']);

Route::prefix('/progress')->group(function () {
    Route::get('', [StatController::class, 'index'])->name('progress.index');
    Route::get('/{stats}/edit', [StatController::class, 'edit'])->name('progress.edit');
    Route::put('/{stats}', [StatController::class, 'update'])->name('progress.update');
});

?>