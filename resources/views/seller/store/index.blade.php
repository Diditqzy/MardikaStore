<x-app-layout title="Edit Toko">

    {{-- STRIP MERAH --}}
    <div class="bg-red-600 text-white px-10 py-8 shadow">
        <h1 class="text-3xl font-bold tracking-wide flex items-center gap-3">
            {{-- ICON STORE TOP --}}
            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 9l1-5h16l1 5M4 9h16v11H4V9zm4 4h4m-4 4h8" />
            </svg>

            Informasi Toko
        </h1>

        <p class="text-red-100 mt-1">Perbarui data toko Anda di sini.</p>
    </div>
    


    {{-- WRAPPER --}}
    <div class="max-w-4xl mx-auto px-4 mt-10 mb-20">

                {{-- ERROR MESSAGE --}}
        @if ($errors->any())
            <div class="mb-6 bg-red-100 border border-red-300 text-red-700 p-4 rounded-xl">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- ALERT SUKSES --}}
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl shadow flex items-center gap-3">

                {{-- ICON CHECK --}}
                <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5 13l4 4L19 7" />
                </svg>

                {{ session('success') }}

                {{-- BUTTON KEMBALI --}}
                <a href="{{ route('seller.dashboard') }}"
                    class="ml-auto bg-green-600 hover:bg-green-700 text-white px-4 py-1.5 rounded-lg text-sm shadow">
                    Kembali ke Dashboard
                </a>

            </div>
        @endif
            {{-- TOMBOL KEMBALI --}}
    <a href="{{ route('seller.dashboard') }}"
       class="inline-flex items-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-xl shadow-md mb-6 transition">

        {{-- ICON ARROW LEFT --}}
        <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15 19l-7-7 7-7" />
        </svg>

        Kembali
    </a>



        {{-- CARD --}}
        <div class="bg-white shadow-md border rounded-xl p-10">

            <form action="{{ route('seller.store.update') }}" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  class="space-y-6">

                @csrf

                {{-- STORE NAME --}}
                <div>
                    <label class="block font-semibold mb-1 flex items-center gap-2">
                        {{-- ICON --}}
                        <svg class="w-7 h-7 text-red-600 " fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 5h18v14H3V5zm4 4h4M7 13h6m4-4h2m-2 4h2" />
                        </svg>
                        Nama Toko
                    </label>

                    <input 
                        type="text" 
                        name="name"
                        value="{{ $store->name ?? '' }}"
                        class="w-full border-gray-300 rounded-xl p-3 shadow-sm
                               focus:ring-red-400 focus:border-red-400"
                        required
                        placeholder="Nama toko anda">
                </div>

                {{-- DESKRIPSI --}}
                <div>
                    <label class="block font-semibold mb-1 flex items-center gap-2">
                        {{-- ICON --}}
                        <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 12h8m-8 4h5m2-8h-7m10-6H6a2 2 0 00-2 2v14l4-2 4 2 4-2 4 2V4a2 2 0 00-2-2z"/>
                        </svg>
                        Deskripsi Toko
                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        class="w-full border-gray-300 rounded-xl p-3 shadow-sm
                               focus:ring-red-400 focus:border-red-400">{{ $store->description ?? '' }}
                        </textarea>
                </div>

                {{-- STORE IMAGE --}}
              
                <div>
                    <label class="block font-semibold mb-2 flex items-center gap-2">
                        <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 5v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2zm3 3l3 3 2-2 4 4 3-3"/>
                        </svg>
                        Foto Toko (jpg, jpeg, png)
                    </label>

                    <input 
                        type="file"
                        name="image"
                        accept=".jpg,.jpeg,.png"
                        class="block w-full text-sm border border-gray-300 rounded-xl p-2 cursor-pointer"
                    >

                    {{-- PREVIEW TERBARU --}}
                    @if ($store && $store->image)
                        <div class="mt-4">
                            <p class="text-gray-700 mb-2 font-medium">Foto Toko Sekarang:</p>

                            <img 
                                src="{{ asset('storage/' . $store->image) }}"
                                class="h-44 w-full max-w-sm object-cover border rounded-xl shadow"
                            >
                        </div>
                    @endif
                </div>

                {{-- BUTTON SAVE --}}
                <div>
                    <button 
                        class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white 
                               px-6 py-3 rounded-lg font-semibold shadow transition">

                        {{-- ICON SAVE --}}
                        <svg class="w-7 h-7 text-white" fill="none" 
                             stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round"
                                   d="M5 13l4 4L19 7" />
                        </svg>

                        Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>

    </div>

</x-app-layout>
