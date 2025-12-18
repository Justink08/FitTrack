@extends('layout.app')

@section('title', 'Add Meal')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4">Add Meal</h1>
    <a href="{{ route('calories.index') }}" class="btn btn-secondary">Cancel</a>
</div>

<form action="{{ route('calories.store') }}" method="POST" class="card p-4">
    @csrf
    <div class="row g-3">
        <div class="col-md-6">
            <label for="name" class="form-label">Meal Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label for="type" class="form-label">Meal Type</label>
            <select name="type" id="type" class="form-select">
                <option value="Breakfast" {{ old('type')== 'Breakfast' ? 'selected': '' }}>Breakfast</option>
                <option value="Lunch" {{ old('type')== 'Lunch' ? 'selected': '' }}>Lunch</option>
                <option value="Dinner" {{ old('type')== 'Dinner' ? 'selected': '' }}>Dinner</option>
                <option value="Snack" {{ old('type')== 'Snack' ? 'selected': '' }}>Snack</option>
            </select>
            @error('type') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-3">
            <label for="calorie" class="form-label">Calories (kcal)</label>
            <input type="number" name="calorie" id="calorie" class="form-control" value="{{ old('calorie') }}">
            @error('calorie') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-3">
            <label for="protein" class="form-label">Protein (g)</label>
            <input type="number" name="protein" id="protein" class="form-control" value="{{ old('protein') }}">
            @error('protein') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-3">
            <label for="carbs" class="form-label">Carbs (g)</label>
            <input type="number" name="carbs" id="carbs" class="form-control" value="{{ old('carbs') }}">
            @error('carbs') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-3">
            <label for="fats" class="form-label">Fats (g)</label>
            <input type="number" name="fats" id="fats" class="form-control" value="{{ old('fats') }}">
            @error('fats') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>
        <div class="col-12 d-flex justify-content-end mt-2">
            <button class="btn btn-primary">Add Meal</button>
        </div>
    </div>
</form>

@endsection