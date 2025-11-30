<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="w-full bg-white shadow-md sticky top-0 z-50">
                    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

                        {{-- LEFT: LOGO --}}
                        <div class="flex items-center gap-3">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" 
                                    d="M3 7l9-4 9 4-9 4-9-4zm0 4l9 4 9-4m-9 4v6" />
                            </svg>

                            <h1 class="text-xl font-bold text-gray-800">
                                Admin Panel
                            </h1>
                        </div>


                        {{-- RIGHT: PROFILE + LOGOUT --}}
                        <div class="flex items-center gap-6">

                            {{-- ADMIN NAME --}}
                            <div class="flex items-center gap-2 cursor-pointer group">
                                <svg class="w-7 h-7 text-gray-600 group-hover:text-red-600 transition"
                                    fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 12a5 5 0 100-10 5 5 0 000 10zm-7 8c0-4 3-6 7-6s7 2 7 6v1H5v-1z"/>
                                </svg>

                                <span class="font-semibold text-gray-700 group-hover:text-red-600 transition">
                                    {{ Auth::user()->name }}
                                </span>
                            </div>

                            {{-- LOGOUT BUTTON --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button 
                                    class="flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded-xl
                                        hover:bg-red-700 transition shadow-md">
                                    
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>

                                    Logout
                                </button>
                            </form>

                        </div>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            <footer class="py-6 mt-20  text-center text-gray-500 font-medium text-sm px-6 ">
                MardikaStore © {{ date('Y') }} – Dibuat oleh Ditqzy dengan semangat kemerdekaan
            </footer>
        </div>
    </body>
</html>
