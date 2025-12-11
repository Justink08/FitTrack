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
    @php
        $weeklyAvgCal = 0;
        $weeklyAvgBurned = 0;
        $weeklyAvgProtein = 0;
        $netCalories = 0;
        $totalCal = 0;
        $totalProtein = 0;
        $totalCarbs = 0;
        $totalFats = 0;
        $totalWorkouts = 0;
        $totalDuration = 0;
        $totalCalBurned = 0;
        $caloriesRemaining = 0;
        $statHeight = 0;
        $statWeight = 0;
        $statBMI = 0;
        $DCG = 0;
        $DPG = 0;
        $BMI = 0;
    @endphp
    @foreach($calories as $cal)
        <div>
            @if($cal->created_at->format('d F Y') == date('d F Y'))
                @php
                    $totalCal = $totalCal + $cal->calorie;
                    $totalProtein = $totalProtein + $cal->protein;
                    $totalCarbs = $totalCarbs + $cal->carbs;
                    $totalFats = $totalFats + $cal->fats;
                @endphp
            @endif
        </div>
    @endforeach
    @foreach($workouts as $w)
        <div>
            @if($w->created_at->format('d F Y') == date('d F Y'))
                @php
                    $totalWorkouts++;
                    $totalDuration = $totalDuration + $w->duration;
                    $totalCalBurned = $totalCalBurned + $w->calories_burned;
                @endphp
            @endif
        </div>
    @endforeach
    @foreach($stats as $s)
        @if($loop->first)
            @php
                $DCG = $s->daily_calorie_goal;
                $DPG = $s->daily_protein_goal;
                $caloriesRemaining = $s->daily_calorie_goal - $totalCal;
            @endphp
        @endif
    @endforeach
    <div class="container-fluid">
        <div>
        <h1>Welcome!</h1>
        @forelse($stats as $s)
            @if($loop->first)
                <strong>You have {{$caloriesRemaining}} calories remaining for today</strong>  
            @endif
        @empty
        @endforelse
    </div>
    <div>
        @php
            $netCalories = $totalCal - $totalCalBurned;
        @endphp
        <br>
        <strong>Calories Consumed: {{$totalCal}} kcal</strong><br>
        <strong>Calories Burned: {{$totalCalBurned}} kcal</strong><br>
        <strong>Net Calories: {{$netCalories}} kcal</strong><br>
        <strong>Workout Time: {{$totalDuration}} min</strong><br>
    </div>
    <br>
    <div>
        <hr>
        <h3>Recent Meal</h3>
    </div>
    <br>
        @forelse($calories as $cal)
            @if($loop->last)
                <div>
                    <strong>{{$cal->name}}</strong> | {{$cal->created_at->format('d F Y')}} | {{$cal->calorie}} kcal | P : {{$cal->protein}} g | C : {{$cal->carbs}} g | F : {{$cal->fats}} g | {{$cal->type}}
                </div>
            @endif
        @empty
            <div>No meals logged.</div>
        @endforelse
        <br>
    <div>
        <hr>
        <h3>Recent Workout</h3>
    </div>
    <br>
        @forelse($workouts as $w)
            @if($loop->last)
                <div>
                    <strong>{{$w->name}}</strong> | {{$w->created_at->format('d F Y')}} | Duration : {{$w->duration}} min | Calories Burned : {{$w->calories_burned}} kcal | {{$w->type}}
                </div>
            @endif
        @empty
            <div>No workout history yet!</div>
        @endforelse
        <br>
    <div>
        <hr>
        <h2>Progress & Analytics</h2>
        <strong>Track your fitness journey</strong>
    </div>
    <br>
    <div>
        @forelse($stats as $s)
            @if($loop->first)
                <a href="/progress/{{$s->id}}/edit">Settings</a>  
            @endif
        @empty
        @endforelse
    </div>
    <div>
        @foreach($stats as $s)
            @if($loop->first)
                @php
                    $statHeight = $s->height / 100;
                    $statWeight = $s->weight;
                    $statBMI = $statWeight / pow($statHeight, 2);
                    $BMI = number_format($statBMI, 1);
                @endphp
            @endif
        @endforeach
    </div>
    <br>
    <div>
        <hr>
        <h3>Your Stats</h3>
        <p><strong>Weight: </strong>{{$statWeight}} kg</p>
        <p><strong>Height: </strong>{{$statHeight * 100}} cm</p>
        <p><strong>Daily Calorie Goal: </strong>{{$DCG}} kcal</p>
        <p><strong>Daily Protein Goal: </strong>{{$DPG}} g</p>
        <p><strong>BMI: </strong>{{$BMI}}</p>
    </div>
    </div>

    
</body>
</html>