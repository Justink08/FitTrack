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
    @endphp
    <div>
        <h1>Progress & Analytics</h1>
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
</body>
</html>