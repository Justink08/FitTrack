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

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card h-100 p-3 text-center">
            <div class="muted">Total Calories</div>
            <h3 class="text-success">{{ $totalCal }} kcal</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card h-100 p-3 text-center">
            <div class="muted">Total Protein</div>
            <h3 class="text" style="color: #c507ffff;">{{ $totalProtein }} g</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card h-100 p-3 text-center">
            <div class="muted">Total Carbs</div>
            <h3 class="text" style="color: #f66d04ff;">{{ $totalCarbs }} g</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card h-100 p-3 text-center">
            <div class="muted">Total Fats</div>
            <h3 class="text" style="color: #ff0191ff;">{{ $totalFats }} g</h3>
        </div>
    </div>
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