<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','FitTrack')</title>
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f8fafc; }
    .muted { color: #6c757d; }
    .card { box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); }
  </style>
</head>
<body>
  @include('layout.header')
  <div class="container mt-4">
    @yield('content')
  </div>
  <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>