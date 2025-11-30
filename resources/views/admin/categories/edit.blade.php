<x-app-layout>

    {{-- HEADER MERAH --}}
    <div class="bg-red-600 text-white py-10 shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-wide">Edit Kategori</h1>
            <p class="text-red-100 mt-2 text-base sm:text-lg">
                Perbarui informasi kategori yang sudah ada
            </p>
        </div>
    </div>


    {{-- CONTENT AREA --}}
    <div class="max-w-7xl mx-auto py-10 px-4">

        {{-- BACK BUTTON --}}
        <a href="{{ route('admin.categories.index') }}"
           class="flex items-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-xl shadow-sm transition w-fit text-sm sm:text-base">

                <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19l-7-7 7-7"/>
                </svg>
            Kembali
        </a>


        {{-- FORM WRAPPER --}}
        <div class="bg-white mt-8 p-6 sm:p-10 rounded-2xl shadow-md max-w-xl">

            <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Data Kategori</h2>

            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="space-y-6">
                @csrf
                

                {{-- NAME --}}
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Nama Kategori</label>
                    <input type="text" name="name"
                        value="{{ $category->name }}"
                        class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-red-400 focus:outline-none"
                        placeholder="Masukkan nama kategori" required>
                </div>

                {{-- DESCRIPTION --}}
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="4"
                        class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-red-400 focus:outline-none"
                        placeholder="Deskripsi kategori (opsional)">{{ $category->description }}</textarea>
                </div>

                {{-- BUTTON --}}
                <button
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl shadow-md transition font-semibold">
                    Perbarui Kategori
                </button>

            </form>

        </div>

    </div>

</x-app-layout>
