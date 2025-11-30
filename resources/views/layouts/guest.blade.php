<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <!-- GLOBAL BACKGROUND (NO WHITE) -->
    <div class="min-h-screen w-full bg-red-700 flex justify-center items-start py-10">

        <!-- CONTENT -->
        <div class="w-full max-w-4xl px-4">
            {{ $slot }}
        </div>

    </div>

</body>
</html>
