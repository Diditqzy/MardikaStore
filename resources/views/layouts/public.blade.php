<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'MardikaStore' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700" rel="stylesheet" />
</head>

<body class="bg-white min-h-screen flex flex-col">

    {{-- NAVBAR --}}
    <header class="w-full bg-white border-b shadow-sm sticky top-0 z-40">
        <nav class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">
            
            {{-- LOGO --}}
                        <div class="flex items-center gap-3">
                <div class="bg-red-600 p-2 rounded-xl">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <circle cx="9" cy="20" r="1" />
                        <circle cx="16" cy="20" r="1" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 4h2l3 12h10l3-8H6" />
                    </svg>
                </div>

                <a href="/" class="text-2xl tracking-wide font-medium text-gray-800">
                    Mardika<span class="text-red-600">Store</span>
                </a>
            </div>

            {{-- MENU --}}
            <div class="flex items-center gap-6">
                <a href="/login" class="text-gray-600 flex items-center gap-1 hover:text-red-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.5 20.25a8.25 8.25 0 0115 0" />
                    </svg>
                    Login
                </a>

                <a href="/register" class="bg-red-600 text-white px-4 py-2 rounded-xl hover:bg-red-700 transition shadow">
                    Daftar
                </a>
            </div>
        </nav>
    </header>

    {{-- MAIN CONTENT --}}
    <main class="max-w-8xl mx-auto px-6 py-10 flex-1">
        {{ $slot }}
    </main>

    {{-- FOOTER --}}
    <footer class="py-6 text-center text-gray-500 font-medium text-sm px-6 ">
        MardikaStore © {{ date('Y') }} – Dibuat oleh Ditqzy dengan semangat kemerdekaan
    </footer>

    

</body>
</html>
