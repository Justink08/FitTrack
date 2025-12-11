<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @php
        $totalCal = 0;
        $totalProtein = 0;
        $totalCarbs = 0;
        $totalFats = 0;
        $x = 0;
    @endphp
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
        <br>
        <div>
            <a href="/calories/create">+ Add Meal</a>
        </div>
        <div>
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
        @empty
            <div>No meals logged.</div>
        @endforelse
    </div>
</body>
</html>