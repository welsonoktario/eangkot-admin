<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
  @inertia

  @env('local')
  <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
  @endenv

  @foreach ($mk as $m) {
    @if (in_array($m, $lowongan_kerjas->keahlians))
      <option value="{{ $m->id }}" selected>{{ $m->nama }}</option>
    @else
    <option value="{{ $m->id }}">{{ $m->nama }}</option>
    @endif
  }
  @endforeach

  <!-- Scripts -->
  @routes
  <script src="{{ mix('js/app.js') }}" defer></script>
</body>

</html>
