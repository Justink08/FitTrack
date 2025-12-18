@extends('layout.app')

@section('title', 'Calories')

@section('content')
@php
    $calories = $calories ?? collect();
    $todayMeals = $calories->filter(function($c){ return $c->created_at->format('d F Y') == date('d F Y'); });
    $totalCal = $todayMeals->sum('calorie');
    $totalProtein = $todayMeals->sum('protein');
    $totalCarbs = $todayMeals->sum('carbs');
    $totalFats = $todayMeals->sum('fats');
    $x = $todayMeals->count();
@endphp

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Today's Intake</h1>
    <a href="{{ route('calories.create') }}" class="btn btn-primary">+ Add Meal</a>
</div>

<div class="row mb-3">
    <div class="col-md-3">Calories: <strong>{{ $totalCal }} kcal</strong></div>
    <div class="col-md-3">Protein: <strong>{{ $totalProtein }} g</strong></div>
    <div class="col-md-3">Carbs: <strong>{{ $totalCarbs }} g</strong></div>
    <div class="col-md-3">Fats: <strong>{{ $totalFats }} g</strong></div>
</div>

<div>
    <hr>
    <h4>Today's Meals</h4>
</div>

@if($todayMeals->isEmpty())
    <div class="muted">No meals logged.</div>
@else
    <ul class="list-group">
        @foreach($todayMeals as $cal)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $cal->name }}</strong><br>
                    <small class="muted">{{ $cal->created_at->format('d M Y H:i') }}</small>
                </div>
                <div>
                    <strong>{{ $cal->calorie }} kcal</strong>
                    <form action="{{ route('calories.destroy', ['calories' => $cal->id]) }}" method="POST" class="d-inline ms-3">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
@endif

@endsection