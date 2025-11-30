<x-app-layout>

    {{-- HEADER MERAH --}}
    <div class="bg-red-600 text-white py-12 shadow-md">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h1 class="text-4xl font-extrabold tracking-wide">
                Akun Anda Ditolak
            </h1>
            <p class="text-red-100 text-lg mt-2">
                Kami tidak dapat menyetujui akun Anda.
            </p>
        </div>
    </div>


    {{-- MAIN CONTENT --}}
    <div class="max-w-3xl mx-auto px-6 py-16">

        <div class="bg-white shadow-md rounded-2xl p-10 text-center border">

            {{-- ICON --}}
            <div class="flex justify-center mb-6">
                <div class="bg-red-100 border border-red-300 text-red-600 w-20 h-20 rounded-full 
                            flex items-center justify-center">
                            <svg class="w-12 h-12 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>

                </div>
            </div>

            {{-- TITLE --}}
            <h2 class="text-2xl font-bold mb-4 text-gray-800">
                Maaf, Akun Anda Tidak Disetujui
            </h2>

            {{-- DESCRIPTION --}}
            <p class="text-gray-600 leading-relaxed mb-6">
                Admin telah meninjau permintaan Anda dan memutuskan untuk menolak pendaftaran akun Anda.
                Jika Anda merasa ini adalah kesalahan, Anda dapat mencoba mendaftar ulang menggunakan akun baru.
            </p>

            {{-- DELETE ACCOUNT BUTTON --}}
            <form action="{{ route('seller.delete.account') }}"
                  method="POST"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini secara permanen?')">
                @csrf
                @method('DELETE')

                <button class="bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-lg font-semibold transition">
                    Hapus Akun Permanen
                </button>
            </form>

        </div>

    </div>

</x-app-layout>
