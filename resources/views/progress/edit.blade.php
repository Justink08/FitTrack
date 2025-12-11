<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA=Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>FitTrack</title>
</head>
<body>
    @include('layout.header')
    <div class="container-fluid">
        <br><h2>User Settings</h2><br>
        <form action="{{route('progress.update', ['stats' => $stats])}}" method="POST">
        @csrf
        @method('PUT')
        <div>
        <label for="weight">Weight (kg)</label><br>
        <input type="number" name="weight" id="weight" value="{{$stats->weight}}"><br>
    </div>
    <div>
        <label for="height">Height (cm)</label><br>
        <input type="number" name="height" id="height" value="{{$stats->height}}"><br>
    </div>
    <div>
        <label for="gender">Gender</label><br>
        <select name="gender" id="gender" value="{{$stats->gender}}">
            <option value="M" 
            {{ old('gender')=='M' ? 'selected': '' }}>
                Male
            </option>
            <option value="F" 
            {{ old('gender')=='F' ? 'selected': '' }}>
                Female
            </option>
        </select><br>
    </div>
    <div>
        <label for="age">Age</label><br>
        <input type="number" name="age" id="age" value="{{$stats->age}}"><br>
    </div>
    <div>
        <label for="daily_calorie_goal">Daily Calorie Goal (kcal)</label><br>
        <input type="number" name="daily_calorie_goal" id="daily_calorie_goal" value="{{$stats->daily_calorie_goal}}"><br>
    </div>
    <div>
        <label for="daily_protein_goal">Daily Protein Goal (g)</label><br>
        <input type="number" name="daily_protein_goal" id="daily_protein_goal" value="{{$stats->daily_protein_goal}}"><br>
    </div>
    <div>
        <a href="/progress">Cancel</a><br>
    </div>
    <div>
        <button type="submit">Save Settings</button><br>
    </div>
    </form>
    </div>
</body>
</html>