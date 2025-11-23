<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <nav class="bg-white shadow p-4 flex justify-between items-center">
        <div class="font-bold text-xl">
            {{ $title ?? 'Dashboard' }}
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                type="submit">
                Logout
            </button>
        </form>
    </nav>

    <main class="p-6">
        {{ $slot }}
    </main>

</body>
</html>
