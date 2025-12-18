<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ route('progress.index') }}">FitTrack</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('progress.*') ? 'active' : '' }}" href="{{ route('progress.index') }}">Progress</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('calories.*') ? 'active' : '' }}" href="{{ route('calories.index') }}">Calories</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('workouts.*') ? 'active' : '' }}" href="{{ route('workouts.index') }}">Workouts</a></li>
      </ul>
    </div>
  </div>
</nav>