<x-guest-layout>

    <div class="min-h-screen w-full bg-red-700 relative overflow-hidden">

        <!-- PAGE CONTENT -->
        <div class="relative z-10 flex justify-center px-4 py-16">

            <div class="bg-white shadow-2xl rounded-2xl p-6 sm:p-10 w-full max-w-xl">

                <!-- Title -->
                <h1 class="text-center text-3xl font-bold text-red-700">Buat Akun</h1>
                <p class="text-center text-gray-500 mb-8">Belanja & Jual dengan Semangat Merdeka</p>
                {{-- ERROR MESSAGE --}}
                @if ($errors->any())
                    <div class="mb-5 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 border border-green-300 rounded-xl text-center font-semibold">
                        {{ session('success') }}
                    </div>
                @endif


                <!-- FORM -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- =========================
                        INPUT NAMA
                    ========================== --}}
                    <div class="mb-5">
                        <label class="block font-semibold mb-1">Nama Lengkap</label>

                        <div class="flex items-center bg-gray-100 rounded-xl px-4 py-3 gap-3 
                                    transition border-2 border-transparent focus-within:border-red-600">
                            
                            <!-- ICON USER -->
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.5 20.25a8.25 8.25 0 0115 0" />
                            </svg>

                            <input
                                type="text"
                                name="name"
                                class="w-full bg-transparent border-0 outline-none ring-0 focus:ring-0 focus:border-0"   
                                placeholder="Nama lengkap anda" 
                                required>
                        </div>
                    </div>

                    {{-- =========================
                        INPUT EMAIL
                    ========================== --}}
                    <div class="mb-5">
                        <label class="block font-semibold mb-1">Email</label>

                        <div class="flex items-center bg-gray-100 rounded-xl px-4 py-3 gap-3
                                    transition border-2 border-transparent focus-within:border-red-600">

                            <!-- ICON EMAIL -->
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l9 6 9-6" />
                                <rect x="3" y="5" width="18" height="14" rx="2" ry="2" />
                            </svg>

                            <input
                                type="email"
                                name="email"
                                class="w-full bg-transparent border-0 outline-none ring-0 focus:ring-0 focus:border-0"
                                placeholder="anda@example.com"
                                required>
                                
                        </div>
                    </div>

                    {{-- =========================
                        ROLE + PASSWORD GRID
                    ========================== --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                        {{-- ROLE --}}
                    <div >
                        <label class="block font-semibold mb-1">Daftar Sebagai</label>

                        <div 
                            x-data="{ open: false, value: 'buyer', label: 'Pembeli' }"
                            class="relative">

                            <!-- wrapper input -->
                            <button type="button"
                                @click="open = !open"
                                class="w-full flex items-center bg-gray-100 rounded-xl px-4 h-16 gap-3
                                    transition border-2 border-transparent focus:border-red-600"
                                :class="open ? 'border-red-600' : ''">

                                <!-- ICON USER SWITCH -->
                                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 20v-2a4 4 0 00-3-3.87M7 20v-2a4 4 0 013-3.87" />
                                    <circle cx="12" cy="7" r="4" />
                                </svg>

                                <!-- TEXT LABEL -->
                                <span class="flex-1 text-left font-medium" x-text="label"></span>

                                <!-- ICON ARROW -->
                                <svg class="w-8 h-8 text-gray-500 transition"
                                    :class="open ? 'rotate-180' : ''"
                                    fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <!-- DROPDOWN MENU -->
                            <div 
                                x-show="open"
                                @click.outside="open = false"
                                class="absolute left-0 right-0 mt-2 bg-white rounded-xl shadow-lg border border-gray-200 z-20 overflow-hidden"
                                x-transition>
                                
                                <div class="cursor-pointer px-4 py-3 hover:bg-red-50 hover:text-red-600"
                                    @click="value='buyer'; label='Pembeli'; open=false">
                                    Pembeli
                                </div>

                                <div class="cursor-pointer px-4 py-3 hover:bg-red-50 hover:text-red-600"
                                    @click="value='seller'; label='Penjual'; open=false">
                                    Penjual
                                </div>
                            </div>

                            <!-- HIDDEN INPUT (REAL VALUE FOR BACKEND) -->
                            <input type="hidden" name="role" x-model="value">
                        </div>
                    </div>

                        {{-- PASSWORD --}}
                        <div>
                            <label class="block font-semibold mb-1">Password</label>

                            <div class="flex items-center bg-gray-100 rounded-xl px-4 h-16 gap-3
                                        transition border-2 border-transparent focus-within:border-red-600">

                                <!-- ICON LOCK -->
                                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <rect x="5" y="11" width="14" height="10" rx="2" ry="2" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 16v-2m-4-5V7a4 4 0 118 0v2" />
                                </svg>

                                <input
                                    type="password"
                                    name="password"
                                    class="w-full bg-transparent border-0 outline-none ring-0 focus:ring-0 focus:border-0"
                                    placeholder="Minimal 8 karakter"
                                    required>
                            </div>
                        </div>

                    </div>


                    {{-- =========================
                        KONFIRMASI PASSWORD
                    ========================== --}}
                    <div class="mt-5">
                        <label class="block font-semibold mb-1">Konfirmasi Password</label>

                        <div class="flex items-center bg-gray-100 rounded-xl px-4 py-3 gap-3
                                    transition border-2 border-transparent focus-within:border-red-600">

                            <!-- ICON SHIELD CHECK -->
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 2l8 4v6c0 5-4 9-8 10-4-1-8-5-8-10V6l8-4z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4" />
                            </svg>

                            <input
                                type="password"
                                name="password_confirmation"
                                class="w-full bg-transparent border-0 outline-none ring-0 focus:ring-0 focus:border-0"
                                placeholder="Masukkan kata sandi"
                                required>
                        </div>
                    </div>

                    {{-- BUTTON --}}
                    <button
                        class="w-full mt-7 bg-red-600 hover:bg-red-700 transition text-white font-semibold py-3 rounded-xl shadow-lg">
                        Daftar Sekarang
                    </button>

                    <p class="text-center text-sm mt-4 text-gray-700">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-red-600 font-bold hover:underline">
                            Masuk di sini
                        </a>
                    </p>

                </form>
            </div>

        </div>
    </div>

</x-guest-layout>
