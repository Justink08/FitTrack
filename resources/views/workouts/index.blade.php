@extends('layout.app')

@section('title', 'Workouts')

@section('content')
@php
    $workouts = $workouts ?? collect();
    $todayWorkouts = $workouts->filter(function($w){ return $w->created_at->format('d F Y') == date('d F Y'); });
    $totalWorkouts = $todayWorkouts->count();
    $totalDuration = $todayWorkouts->sum('duration');
    $totalCalBurned = $todayWorkouts->sum('calories_burned');
    $x = $todayWorkouts->count();
@endphp

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Today's Workouts</h1>
    <a href="{{ route('workouts.create') }}" class="btn btn-primary">+ Log Workout</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card h-100 p-3 text-center">
            <div class="muted">Total Workouts</div>
            <h3 class="text-info">{{ $totalWorkouts }} session(s)</h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 p-3 text-center">
            <div class="muted">Total Duration</div>
            <h3 class="text-danger">{{ $totalDuration }} min</h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 p-3 text-center">
            <div class="muted">Total Calories Burned</div>
            <h3 class="text-warning">{{ $totalCalBurned }} kcal</h3>
        </div>
    </div>

<div>
    <hr>
    <h4>Today's Activity</h4>
</div>

@if($todayWorkouts->isEmpty())
    <div class="muted">No workouts logged yet. Start tracking your fitness journey!</div>
@else
    <ul class="list-group">
        @foreach($todayWorkouts as $w)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $w->name }}</strong><br>
                    <small class="muted">{{ $w->created_at->format('d M Y H:i') }}</small>
                </div>
                <div>
                    <span>Duration: <strong>{{ $w->duration }} min</strong></span>
                    <form action="{{ route('workouts.destroy', ['workouts' => $w->id]) }}" method="POST" class="d-inline ms-3">
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