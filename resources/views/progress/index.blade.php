@extends('layout.app')

@section('title', 'Progress')

@section('content')
@php
    $calories = $calories ?? collect();
    $workouts = $workouts ?? collect();
    $stats = $stats ?? collect();

    // Today's totals
    $todayCal = $calories->filter(function($c){ return $c->created_at->format('Y-m-d') == date('Y-m-d'); });
    $totalCal = $todayCal->sum('calorie');
    $totalProtein = $todayCal->sum('protein');
    $totalCarbs = $todayCal->sum('carbs');
    $totalFats = $todayCal->sum('fats');

    $todayWorkouts = $workouts->filter(function($w){ return $w->created_at->format('Y-m-d') == date('Y-m-d'); });
    $totalWorkouts = $todayWorkouts->count();
    $totalDuration = $todayWorkouts->sum('duration');
    $totalCalBurned = $todayWorkouts->sum('calories_burned');

    $DCG = $stats->first()->daily_calorie_goal ?? 2000;
    $DPG = $stats->first()->daily_protein_goal ?? 150;
    $caloriesRemaining = $DCG - $totalCal + $totalCalBurned;
    $netCalories = $totalCal - $totalCalBurned;
    $totalCalPercent = $DCG ? round($totalCal * 100 / $DCG) : 0;
@endphp

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1>Progress & Analytics</h1>
        <div class="muted">Track your fitness journey!</div><br>
    </div>
    <div>
        @if($stats->first())
            <a class="btn btn-outline-secondary" href="{{ route('progress.edit', ['stats' => $stats->first()->id]) }}">Settings</a>
        @endif
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card h-100 p-3 text-center">
            <div class="muted">Calories Consumed</div>
            <h3 class="text-success">{{ $totalCal }} kcal</h3>
            <small class="muted">Goal: {{ $DCG }} kcal</small>
            <div class="progress mt-2">
                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $totalCalPercent }}%">{{ $totalCalPercent }}%</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card h-100 p-3 text-center">
            <div class="muted">Calories Burned</div>
            <h3 class="text-warning">{{ $totalCalBurned }} kcal</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card h-100 p-3 text-center">
            <div class="muted">Net Calories</div>
            <h3 class="text-primary">{{ $netCalories }} kcal</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card h-100 p-3 text-center">
            <div class="muted">Workout Time</div>
            <h3 class="text-danger">{{ $totalDuration }} min</h3>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card p-3 mb-4">
            <h5 class="card-title">7-Day Calorie Trend</h5>
            <div style="height:300px;">
                <canvas id="calorieTrendChart" style="height:100%; width:100%; display:block;"></canvas>
            </div>
        </div>
    </div>
</div>

@php
    $trend = collect();
    for ($i = 6; $i >= 0; $i--) {
        $d = date('Y-m-d', strtotime("-$i days"));
        $label = date('D', strtotime($d));
        $consumed = $calories->filter(function($c) use ($d) { return $c->created_at->format('Y-m-d') == $d; })->sum('calorie');
        $burned = $workouts->filter(function($w) use ($d) { return $w->created_at->format('Y-m-d') == $d; })->sum('calories_burned');
        $protein = $calories->filter(function($c) use ($d) { return $c->created_at->format('Y-m-d') == $d; })->sum('protein');
        $trend->push(['date'=>$d,'label'=>$label,'consumed'=>$consumed,'burned'=>$burned,'net'=>$consumed - $burned,'protein'=>$protein]);
    }
@endphp

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    (function(){
        const labels = {!! json_encode($trend->pluck('label')) !!};
        const consumed = {!! json_encode($trend->pluck('consumed')) !!};
        const burned = {!! json_encode($trend->pluck('burned')) !!};
        const net = {!! json_encode($trend->pluck('net')) !!};
        const ctx = document.getElementById('calorieTrendChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        { label: 'Consumed', data: consumed, borderColor: '#198754', backgroundColor: 'rgba(25,135,84,0.1)', tension: 0.4 },
                        { label: 'Burned', data: burned, borderColor: '#ffc107', backgroundColor: 'rgba(255,193,7,0.1)', tension: 0.4 },
                        { label: 'Net', data: net, borderColor: '#0d6efd', backgroundColor: 'rgba(13,110,253,0.1)', tension: 0.4 }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'top' } },
                    scales: { y: { beginAtZero: true } }
                }
            });
        }
    })();
</script>

<div class="row mb-4">
    <div class="col-12">
        <div class="card p-3 mb-4">
            <h5 class="card-title">Protein Intake</h5>
            <div style="height:220px;">
                <canvas id="proteinBarChart" style="height:100%; width:100%; display:block;"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    (function(){
        const labels = {!! json_encode($trend->pluck('label')) !!};
        const protein = {!! json_encode($trend->pluck('protein')) !!};
        const ctx2 = document.getElementById('proteinBarChart');
        if (ctx2) {
            new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Protein (g)',
                        data: protein,
                        backgroundColor: 'rgba(141, 13, 253, 0.6)',
                        borderColor: '#950dfdff',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: true, position: 'top' } },
                    scales: { y: { beginAtZero: true } }
                }
            });
        }
    })();
</script>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Recent Meals</h5>
                @if($calories->isEmpty())
                    <div class="muted">No meals logged yet.</div>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($calories->slice(-5) as $cal)
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <strong>{{ $cal->name }}</strong><br>
                                    <small class="muted">{{ $cal->created_at->format('d M Y H:i') }}</small>
                                </div>
                                <div>{{ $cal->calorie }} kcal</div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Recent Workouts</h5>
                @if($workouts->isEmpty())
                    <div class="muted">No workouts logged yet.</div>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($workouts->slice(-5) as $w)
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <strong>{{ $w->name }}</strong><br>
                                    <small class="muted">{{ $w->created_at->format('d M Y H:i') }}</small>
                                </div>
                                <div>{{ $w->duration }} min</div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Your Stats</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Weight:</strong> {{ $stats->first()->weight ?? '-' }} kg</li>
                <li class="list-group-item"><strong>Height:</strong> {{ $stats->first()->height ?? '-' }} cm</li>
                <li class="list-group-item"><strong>Daily Calorie Goal:</strong> {{ $DCG }} kcal</li>
                <li class="list-group-item"><strong>Daily Protein Goal:</strong> {{ $DPG }} g</li>
                <li class="list-group-item"><strong>BMI:</strong> @php $h = ($stats->first()->height ?? 0); $w = ($stats->first()->weight ?? 0); $bmi = ($h && $w) ? number_format(($w / (($h/100)*($h/100))),1) : '-'; echo $bmi; @endphp</li>
            </ul>
        </div>
    </div>
</div>
<br>
@endsection
</html>