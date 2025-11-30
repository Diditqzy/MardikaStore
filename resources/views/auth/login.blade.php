<x-guest-layout>

    <div class="min-h-screen w-full bg-red-700 flex items-center justify-center">

        <div class="w-full max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 px-4 py-12">

            <!-- LEFT: Red splash with heading (DESKTOP) -->
            <div class="hidden lg:flex flex-col justify-center text-white px-8">
                <h2 class="text-4xl font-extrabold mb-4">Selamat Datang di Mardika Store</h2>
                <p class="text-lg text-red-100/90 max-w-md leading-relaxed">
                    Yuk masuk dan lanjutkan belanja kamu. Pengalaman yang aman, cepat, dan nyaman sudah nunggu.
                </p>

                <div class="mt-8">
                    <p class="text-lg text-red-100/80">Belum punya akun?</p>
                    <a href="{{ route('register') }}" class="inline-block mt-2 px-5 py-2.5 bg-white text-red-700 rounded-lg font-semibold shadow-sm">
                        Buat Akun
                    </a>
                </div>
            </div>

            <!-- RIGHT: Form card -->
            <div class="flex items-center justify-center">
                <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-10 w-full max-w-md">

                    <!-- Heading -->
                    <h1 class="text-2xl font-bold text-red-700 text-center">Masuk ke Mardika</h1>
                    <p class="text-center text-gray-500 mt-1 mb-6">Masukkan email dan kata sandi Anda</p>

                    <!-- Success message (session) -->
                    @if(session('success'))
                        <div class="mb-4 p-3 bg-green-100 border border-green-200 text-green-800 rounded-lg text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Validation errors general block -->
                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form -->
                    <form method="POST" action="{{ route('login') }}" x-data="{ show:false }" novalidate>
                        @csrf

                        <!-- Email -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>

                            <div class="flex items-center bg-gray-100 rounded-xl px-4 gap-3
                                        transition border-2 border-transparent focus-within:border-red-600 h-14">
                                <!-- icon mail (fixed width) -->
                                <div class="w-10 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l9 6 9-6" />
                                        <rect x="3" y="5" width="18" height="14" rx="2" ry="2" />
                                    </svg>
                                </div>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    class="flex-1 bg-transparent border-0 outline-none focus:outline-none focus:ring-0 focus:border-transparent"
                                    placeholder="anda@example.com"
                                >
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>

                            <div class="flex items-center bg-gray-100 rounded-xl px-4 gap-3
                                        transition border-2 border-transparent focus-within:border-red-600 h-14">
                                <!-- icon lock -->
                                <div class="w-10 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                                         viewBox="0 0 24 24">
                                        <rect x="5" y="11" width="14" height="10" rx="2" ry="2"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 16v-2m-4-5V7a4 4 0 118 0v2" />
                                    </svg>
                                </div>

                                <input
                                    :type="show ? 'text' : 'password'"
                                    name="password"
                                    required
                                    class="flex-1 bg-transparent border-0 outline-none focus:outline-none focus:ring-0 focus:border-transparent"
                                    placeholder="Masukkan kata sandi"
                                >

                                
                            </div>
                        </div>

                        <!-- Remember & Forgot -->
                        <div class="flex items-center justify-between mb-5 text-sm">
                            <label class="inline-flex items-center gap-2">
                                <input type="checkbox" name="remember" class="h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500" />
                                <span class="text-gray-600">Ingat saya</span>
                            </label>

                            <div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-red-600 hover:underline">Lupa password?</a>
                                @endif
                            </div>
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="w-full py-3 rounded-xl bg-red-600 hover:bg-red-700 text-white font-semibold shadow">
                            Masuk
                        </button>

                        



                        <!-- Footer links -->
                        <p class="mt-6 text-center text-sm text-gray-600">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="text-red-600 font-medium hover:underline">Daftar sekarang</a>
                        </p>

                        {{-- PEMISAH "ATAU" --}}
                        <div class="flex items-center justify-center my-4">
                            <span class="text-gray-400 text-sm">——— atau ———</span>
                        </div>

                        {{-- LOGIN AS GUEST --}}
                        <div class="text-center">
                            <a href="{{ url('/') }}"
                            class="text-red-600 font-semibold text-sm hover:underline">
                                Masuk sebagai guest
                            </a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

</x-guest-layout>
