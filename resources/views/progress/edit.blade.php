@extends('layout.app')

@section('title', 'Settings')

@section('content')
@php $stats = $stats ?? null; @endphp

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4">User Settings</h1>
    <a href="{{ route('progress.index') }}" class="btn btn-secondary">Cancel</a>
</div>

<form action="{{ route('progress.update', ['stats' => $stats]) }}" method="POST" class="card p-4">
    @csrf
    @method('PUT')

    <div class="row g-3">
        <div class="col-md-4">
            <label for="weight" class="form-label">Weight (kg)</label>
            <input type="number" name="weight" id="weight" class="form-control" value="{{ old('weight', $stats->weight ?? '') }}">
            @error('weight') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4">
            <label for="height" class="form-label">Height (cm)</label>
            <input type="number" name="height" id="height" class="form-control" value="{{ old('height', $stats->height ?? '') }}">
            @error('height') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4">
            <label for="gender" class="form-label">Gender</label>
            <select name="gender" id="gender" class="form-select">
                <option value="M" {{ old('gender', $stats->gender ?? '') == 'M' ? 'selected' : '' }}>Male</option>
                <option value="F" {{ old('gender', $stats->gender ?? '') == 'F' ? 'selected' : '' }}>Female</option>
            </select>
            @error('gender') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4">
            <label for="age" class="form-label">Age</label>
            <input type="number" name="age" id="age" class="form-control" value="{{ old('age', $stats->age ?? '') }}">
            @error('age') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4">
            <label for="daily_calorie_goal" class="form-label">Daily Calorie Goal (kcal)</label>
            <input type="number" name="daily_calorie_goal" id="daily_calorie_goal" class="form-control" value="{{ old('daily_calorie_goal', $stats->daily_calorie_goal ?? '') }}">
            @error('daily_calorie_goal') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4">
            <label for="daily_protein_goal" class="form-label">Daily Protein Goal (g)</label>
            <input type="number" name="daily_protein_goal" id="daily_protein_goal" class="form-control" value="{{ old('daily_protein_goal', $stats->daily_protein_goal ?? '') }}">
            @error('daily_protein_goal') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="col-12 d-flex justify-content-end mt-2">
            <button class="btn btn-primary">Save Settings</button>
        </div>
    </div>
</form>

@endsection