<x-app-layout>

    {{-- HEADER MERAH --}}
    <div class="bg-red-600 text-white py-10 shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl font-extrabold tracking-wide">User Management</h1>
            <p class="text-red-100 mt-2 text-lg">Kelola seluruh user pada sistem</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-10 px-4">

        {{-- BACK --}}
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-xl shadow-sm w-fit">
                <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19l-7-7 7-7"/>
                </svg>
            Kembali
        </a>

        {{-- SUCCESS ALERT --}}
        @if(session('success'))
            <div class="mt-6 mb-6 px-4 py-3 rounded-xl bg-green-100 border border-green-200 text-green-800 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- TABLE --}}
        <div class="bg-white shadow-md rounded-2xl overflow-hidden mt-8">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[800px]">
                    <thead class="bg-red-600 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold">Name</th>
                            <th class="px-6 py-4 text-left font-semibold">Email</th>
                            <th class="px-6 py-4 text-left font-semibold">Peran</th>
                            <th class="px-6 py-4 text-left font-semibold">Status</th>
                            <th class="px-6 py-4 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $u)
                            <tr class="border-t hover:bg-red-50 transition">

                                <td class="px-6 py-4">{{ $u->name }}</td>
                                <td class="px-6 py-4">{{ $u->email }}</td>
                                <td class="px-6 py-4 capitalize">{{ $u->role }}</td>
                                <td class="px-6 py-4 capitalize">{{ $u->status }}</td>

                                <td class="px-6 py-4 text-center">

                                    @if ($u->role !== 'admin')
                                        <div class="flex justify-center gap-4">

                                            {{-- EDIT --}}
                                            <a href="{{ route('admin.users.edit', $u->id) }}"
                                            class="text-blue-600 hover:text-blue-800">
                                                Edit
                                            </a>

                                            {{-- DELETE --}}
                                            <form action="{{ route('admin.users.destroy', $u->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Hapus pengguna ini secara permanen?')">

                                                @csrf
                                                @method('DELETE')

                                                <button class="text-red-600 hover:text-red-800">
                                                    Hapus
                                                </button>
                                            </form>

                                        </div>

                                    @else
                                        {{-- Jika Admin, tampilkan saja tanda strip --}}
                                        <span class="text-gray-400">—</span>
                                    @endif

                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    </div>

</x-app-layout>
