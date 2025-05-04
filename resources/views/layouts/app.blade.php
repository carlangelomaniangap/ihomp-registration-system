<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-screen flex">
    <nav class="sticky top-0">
        @include('layouts.navigation')
    </nav>

    <main class="flex-1 overflow-y-auto">
        @yield('content')
    </main>
</body>
</html>