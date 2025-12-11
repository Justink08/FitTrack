<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA=Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>FitTrack - Calories</title>
</head>
<body>
    @include('layout.header')
    @php
        $totalCal = 0;
        $totalProtein = 0;
        $totalCarbs = 0;
        $totalFats = 0;
        $x = 0;
    @endphp
    <div class="container-fluid">
    <div>
        <h1>Today's Intake</h1>
    </div>
    <div>
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
        <div class="row">
            <div class="col-md-1">Calories: {{$totalCal}} kcal</div>
            <div class="col-md-1">Protein: {{$totalProtein}} g</div>
            <div class="col-md-1">Carbs: {{$totalCarbs}} g</div>
            <div class="col-md-1">Fats: {{$totalFats}} g</div>
        </div>
        <div>
            <a href="/calories/create">+ Add Meal</a>
        </div>
        <div>
            <hr>
            <h4>Today's Meal</h4>
        </div>
        @forelse($calories as $cal)
        <div>
            @if($cal->created_at->format('d F Y') == date('d F Y'))
                @php
                    $x++;
                @endphp
                <div>
                    <strong>{{$cal->name}}</strong>
                </div>
                <div>
                  <strong>{{$cal->calorie}} kcal</strong> | P : {{$cal->protein}} g | C : {{$cal->carbs}} g | F : {{$cal->fats}} g | <strong>{{$cal->type}}</strong>
                </div>
                <div>
                    <form action="/calories/{{$cal->id}}" method="POST">
                        @csrf 
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </div>
            @else
                @if($loop->last)
                    @if($x == 0)
                        <div>No meals logged.</div>
                    @endif
                @endif
            @endif
        </div>
        <br>
        @empty
            <div>No meals logged.</div>
        @endforelse
    </div>
    </div>
</body>
</html>