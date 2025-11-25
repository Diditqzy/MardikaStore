<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Catalog' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <!-- NAVBAR -->
    <nav class="bg-white shadow mb-6">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="text-xl font-bold text-blue-600">MardikaStore</a>

            <div class="flex items-center gap-4">
                @guest
                    <a href="/login" class="text-gray-700 hover:text-black">Login</a>
                    <a href="/register" class="text-gray-700 hover:text-black">Register</a>
                @else
                    @php
                        $dashboardRoute = match(auth()->user()->role ?? null) {
                            'admin' => 'admin.dashboard',
                            'seller' => 'seller.dashboard',
                            'buyer' => 'buyer.dashboard',
                            default => null,
                        };
                    @endphp

                    @if ($dashboardRoute)
                        <a href="{{ route($dashboardRoute) }}" 
                        class="text-gray-700 hover:text-black">Dashboard</a>
                    @endif
                @endguest
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <main>
        {{ $slot }}
    </main>

</body>
</html>
