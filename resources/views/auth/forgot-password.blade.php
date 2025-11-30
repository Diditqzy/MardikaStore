<x-guest-layout>

    <div class="min-h-screen w-full bg-red-700 relative overflow-hidden">

        <!-- PAGE CONTENT -->
        <div class="relative z-10 flex justify-center px-4 py-16">

            <div class="bg-white shadow-2xl rounded-2xl p-6 sm:p-10 w-full max-w-xl">

                {{-- TITLE --}}
                <h1 class="text-center text-3xl font-bold text-red-700">Reset Password</h1>
                <p class="text-center text-gray-500 mb-8">Masukkan email Anda untuk mendapatkan tautan reset</p>

                {{-- SUCCESS MESSAGE --}}
                @if (session('status'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- ERROR MESSAGE --}}
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-300 text-red-700 rounded-lg text-sm">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- FORM --}}
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    {{-- EMAIL --}}
                    <div class="mb-6">
                        <label class="block font-semibold mb-1">Email</label>

                        <div class="flex items-center bg-gray-100 rounded-xl px-4 py-3 gap-3
                                    transition border-2 border-transparent focus-within:border-red-600">

                            <!-- ICON EMAIL -->
                            <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 8l9 6 9-6" />
                                <rect x="3" y="5" width="18" height="14" rx="2" ry="2" />
                            </svg>

                            <input
                                type="email"
                                name="email"
                                class="w-full bg-transparent border-0 outline-none ring-0 focus:ring-0 focus:border-0"
                                placeholder="Masukkan email Anda"
                                required />
                        </div>
                    </div>

                    {{-- BUTTON --}}
                    <button
                        class="w-full mt-4 bg-red-600 hover:bg-red-700 transition text-white font-semibold py-3 rounded-xl shadow-lg">
                        Kirim Tautan Reset
                    </button>

                    {{-- BACK TO LOGIN --}}
                    <p class="text-center text-sm mt-4 text-gray-700">
                        Kembali ke
                        <a href="{{ route('login') }}" class="text-red-600 font-bold hover:underline">
                            Halaman Login
                        </a>
                    </p>
                </form>
            </div>

        </div>
    </div>

</x-guest-layout>
