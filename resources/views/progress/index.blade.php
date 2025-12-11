<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
                $caloriesRemaining = $s->daily_calorie_goal - $totalCal;
            @endphp
        @endif
    @endforeach
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
    <div>
        <h4>Recent Meal</h4>
    </div>
        @forelse($calories as $cal)
            @if($loop->last)
                <div>
                    <strong>{{$cal->name}}</strong> | {{$cal->created_at->format('d F Y')}} | {{$cal->calorie}} kcal | P : {{$cal->protein}} g | C : {{$cal->carbs}} g | F : {{$cal->fats}} g | {{$cal->type}}
                </div>
            @endif
        @empty
            <div>No meals logged.</div>
        @endforelse
    <div>
        <h4>Recent Workout</h4>
    </div>
        @forelse($workouts as $w)
            @if($loop->last)
                <div>
                    <strong>{{$w->name}}</strong> | {{$w->created_at->format('d F Y')}} | Duration : {{$w->duration}} min | Calories Burned : {{$w->calories_burned}} kcal | {{$w->type}}
                </div>
            @endif
        @empty
            <div>No workout history yet!</div>
        @endforelse
    <div>
        <h2>Progress & Analytics</h2>
        <strong>Track your fitness journey</strong>
    </div>
    <div>
        @forelse($stats as $s)
            @if($loop->first)
                <a href="/progress/{{$s->id}}/edit">Settings</a>  
            @endif
        @empty
        @endforelse
    </div>
    <div>
        
    </div>
</body>
</html>