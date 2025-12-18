@extends('layout.app')

@section('title', 'Log Workout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4">Log Workout Session</h1>
    <a href="{{ route('workouts.index') }}" class="btn btn-secondary">Cancel</a>
</div>

<form action="{{ route('workouts.store') }}" method="POST" class="card p-4">
    @csrf
    <div class="row g-3">
        <div class="col-md-6">
            <label for="name" class="form-label">Workout Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label for="type" class="form-label">Workout Type</label>
            <select name="type" id="type" class="form-select">
                <option value="Cardio" {{ old('type')== 'Cardio' ? 'selected': '' }}>Cardio</option>
                <option value="Strength Training" {{ old('type')== 'Strength Training' ? 'selected': '' }}>Strength Training</option>
                <option value="Yoga" {{ old('type')== 'Yoga' ? 'selected': '' }}>Yoga</option>
                <option value="Sports" {{ old('type')== 'Sports' ? 'selected': '' }}>Sports</option>
                <option value="Walking" {{ old('type')== 'Walking' ? 'selected': '' }}>Walking</option>
                <option value="Cycling" {{ old('type')== 'Cycling' ? 'selected': '' }}>Cycling</option>
                <option value="Swimming" {{ old('type')== 'Swimming' ? 'selected': '' }}>Swimming</option>
                <option value="Other" {{ old('type')== 'Other' ? 'selected': '' }}>Other</option>
            </select>
            @error('type') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4">
            <label for="duration" class="form-label">Duration (min)</label>
            <input type="number" name="duration" id="duration" class="form-control" value="{{ old('duration') }}">
            @error('duration') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4">
            <label for="calories_burned" class="form-label">Calories Burned</label>
            <input type="number" name="calories_burned" id="calories_burned" class="form-control" value="{{ old('calories_burned') }}">
            @error('calories_burned') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="col-12 d-flex justify-content-end mt-2">
            <button class="btn btn-primary">Log Workout</button>
        </div>
    </div>
</form>

@endsection