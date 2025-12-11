<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @php
        $totalWorkouts = 0;
        $totalDuration = 0;
        $totalCalBurned = 0;
        $x = 0;
    @endphp
    <div>
        <h1>Today's Workouts</h1>
    </div>
    <div>
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
        <div class="row">
            <div class="col-md-1">Workouts: {{$totalWorkouts}} session(s)</div>
            <div class="col-md-1">Duration: {{$totalDuration}} min</div>
            <div class="col-md-1">Calories Burned: {{$totalCalBurned}} kcal</div>
        </div>
        <br>
        <div>
            <a href="/workouts/create">+ Log Workout</a>
        </div>
        <div>
            <h4>Today's Activity</h4>
        </div>
        @forelse($workouts as $w)
        <div>
            @if($w->created_at->format('d F Y') == date('d F Y'))
                @php
                    $x++;
                @endphp
                <div>
                    <strong>{{$w->name}}</strong>
                </div>
                <div>
                    Duration : {{$w->duration}} min | Calories Burned : {{$w->calories_burned}} kcal | {{$w->type}}
                </div>
                <div>
                    <form action="/workouts/{{$w->id}}" method="POST">
                        @csrf 
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </div>
            @else
                @if($loop->last)
                    @if($x == 0)
                        <div>No workouts logged yet. Start tracking your fitness journey!</div>
                    @endif
                @endif
            @endif
        </div>
        @empty
            <div>No workouts logged yet. Start tracking your fitness journey!</div>
        @endforelse
        <div>
            <h4>Recent History</h4>
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
    </div>
</body>
</html>