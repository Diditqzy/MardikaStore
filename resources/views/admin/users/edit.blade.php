<x-app-layout>

    <div class="bg-red-600 text-white py-10 shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl font-extrabold tracking-wide">Edit Pengguna</h1>
            <p class="text-red-100 mt-2 text-lg">Perbarui informasi pengguna</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-10 px-4">

        <a href="{{ route('admin.users.index') }}"
           class="flex items-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-xl shadow-sm w-fit">
                <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19l-7-7 7-7"/>
                </svg>
            Kembali
        </a>

        <div class="bg-white p-8 rounded-2xl shadow-md max-w-xl mt-8">

            <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-semibold mb-2">Nama</label>
                    <input type="text" name="name" value="{{ $user->name }}"
                           class="w-full p-3 border rounded-xl focus:ring-red-400">
                </div>

                <div>
                    <label class="block font-semibold mb-2">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}"
                           class="w-full p-3 border rounded-xl focus:ring-red-400">
                </div>

                <div>
                    <label class="block font-semibold mb-2">Password Baru</label>
                    <input type="password" name="password"
                           placeholder="Kosongkan jika tidak ingin diganti"
                           class="w-full p-3 border rounded-xl focus:ring-red-400">
                </div>

                <div>
                    <label class="block font-semibold mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation"
                           class="w-full p-3 border rounded-xl focus:ring-red-400">
                </div>

                <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl shadow-md">
                    Perbarui Pengguna
                </button>
            </form>

        </div>

    </div>

</x-app-layout>
