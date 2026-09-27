<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Megyék és Városok')</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <header class="site-header">
        <h1>🗺️ Megyék &amp; Városok</h1>
        <nav class="site-nav">
            <a href="{{ route('counties.index') }}" class="{{ request()->routeIs('counties.*') ? 'active' : '' }}">Megyék</a>
            <a href="{{ route('cities.index') }}" class="{{ request()->routeIs('cities.*') ? 'active' : '' }}">Városok</a>
        </nav>
    </header>

    <main class="content">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-warning">
                <ul style="margin:0; padding-left:1.1rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
