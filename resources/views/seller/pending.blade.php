<x-app-layout>

    {{-- HEADER MERAH --}}
    <div class="bg-red-600 text-white py-12 shadow-md">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h1 class="text-4xl font-extrabold tracking-wide">
                Akun Anda Sedang Ditinjau
            </h1>
            <p class="text-red-100 text-lg mt-2">
                Admin sedang memverifikasi akun Anda.
            </p>
        </div>
    </div>


    {{-- MAIN CONTENT --}}
    <div class="max-w-3xl mx-auto px-6 py-16">

        <div class="bg-white shadow-md rounded-2xl p-10 text-center border">

            <div class="flex justify-center mb-6">
                <div class="bg-red-100 border border-red-300 text-red-600 w-20 h-20 rounded-full 
                            flex items-center justify-center">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6l4 2"/>
                    </svg>
                </div>
            </div>

            <h2 class="text-2xl font-bold mb-4 text-gray-800">
                Mohon Menunggu Verifikasi
            </h2>

            <p class="text-gray-600 leading-relaxed mb-6">
                Tim admin kami sedang melakukan verifikasi terhadap data akun Anda.
                Setelah proses selesai, Anda akan dapat mengakses halaman penjual sepenuhnya.
            </p>

            <p class="text-gray-500 text-sm">
                Waktu verifikasi biasanya 1 sampai 2 jam. 
            </p>
            <br>
            <p class="text-gray-500 text-sm">
                Terima Kasih
            </p>


        </div>

    </div>

</x-app-layout>
