@extends('LoginPage.layouts.app')

@section('title', 'Login Pegawai - SADARIN')

@section('content')

    <div class="min-h-screen bg-white">

        <div class="grid min-h-screen lg:grid-cols-2">

            {{-- =========================================================
                 LEFT SIDE
            ========================================================== --}}
            <div class="relative hidden overflow-hidden bg-slate-950 lg:flex">

                {{-- Background Image --}}
                <img src="{{ asset('assets/images/gedung-disbud.jpg') }}" alt="Gedung"
                    class="absolute inset-0 h-full w-full object-cover">

                {{-- Overlay --}}
                <div class="absolute inset-0 bg-slate-950/65"></div>

                {{-- Subtle Plum Glow --}}
                <div class="absolute -left-32 -top-32 h-96 w-96 rounded-full bg-[oklch(29.3%_0.136_325.661)]/30 blur-3xl">
                </div>

                <div
                    class="absolute -bottom-40 -right-20 h-96 w-96 rounded-full bg-[oklch(29.3%_0.136_325.661)]/25 blur-3xl">
                </div>


                {{-- Content --}}
                <div class="relative z-10 flex w-full flex-col justify-between p-10 xl:p-14">

                    {{-- Logo --}}
                    <div>

                        <a href="{{ route('sadarin.home') }}"
                            class="inline-flex rounded-xl bg-white/95 px-4 py-3 shadow-lg shadow-black/10">

                            <img src="{{ asset('assets/images/logo-sadarin-full.png') }}" alt="SADARIN"
                                class="h-20 w-auto object-contain">

                        </a>

                    </div>


                    {{-- Hero Text --}}
                    <div class="max-w-xl">

                        <div
                            class="mb-5 inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-3 py-1.5 backdrop-blur">

                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>

                            <span class="text-xs font-medium tracking-wide text-white/80">
                                SISTEM ARSIP DIGITAL
                            </span>

                        </div>


                        <h1 class="text-4xl font-bold leading-tight tracking-tight text-white xl:text-5xl">
                            Arsip untuk
                            <span class="text-sadarin-400">
                                Masa Depan.
                            </span>
                        </h1>


                        <p class="mt-5 max-w-lg text-base leading-7 text-white/70">
                            Kelola, temukan, dan akses arsip secara lebih terstruktur
                            dalam satu sistem informasi yang aman dan terintegrasi.
                        </p>


                        {{-- Feature --}}
                        <div class="mt-8 grid max-w-lg grid-cols-3 gap-3">

                            <div class="rounded-xl border border-white/10 bg-white/10 p-4 backdrop-blur">

                                <div
                                    class="mb-3 flex h-9 w-9 items-center justify-center rounded-lg bg-blue-500/20 text-blue-300">
                                    <i class="bi bi-search"></i>
                                </div>

                                <p class="text-xs font-semibold text-white">
                                    Mudah Dicari
                                </p>

                                <p class="mt-1 text-[11px] leading-4 text-white/50">
                                    Temukan arsip dengan cepat
                                </p>

                            </div>


                            <div class="rounded-xl border border-white/10 bg-white/10 p-4 backdrop-blur">

                                <div
                                    class="mb-3 flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-500/20 text-emerald-300">
                                    <i class="bi bi-shield-check"></i>
                                </div>

                                <p class="text-xs font-semibold text-white">
                                    Lebih Aman
                                </p>

                                <p class="mt-1 text-[11px] leading-4 text-white/50">
                                    Akses sesuai kewenangan
                                </p>

                            </div>


                            <div class="rounded-xl border border-white/10 bg-white/10 p-4 backdrop-blur">

                                <div
                                    class="mb-3 flex h-9 w-9 items-center justify-center rounded-lg bg-amber-500/20 text-amber-300">
                                    <i class="bi bi-cloud-check"></i>
                                </div>

                                <p class="text-xs font-semibold text-white">
                                    Terintegrasi
                                </p>

                                <p class="mt-1 text-[11px] leading-4 text-white/50">
                                    Arsip tersimpan terpusat internal
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Footer --}}
                    <div class="flex items-center justify-between gap-4 text-xs text-white/40">

                        <span>
                            © {{ date('Y') }} SADARIN
                        </span>

                        <span>
                            Sistem Arsip Data dan Berkas Internal
                        </span>

                    </div>

                </div>

            </div>


            {{-- =========================================================
                 RIGHT SIDE
            ========================================================== --}}
            <div class="flex min-h-screen items-center justify-center bg-white px-5 py-10 sm:px-8 lg:px-12 xl:px-20">

                <div class="w-full max-w-md">


                    {{-- Mobile Logo --}}
                    <div class="mb-10 lg:hidden">

                        <a href="{{ route('sadarin.home') }}" class="inline-flex">

                            <img src="{{ asset('assets/images/logo-sadarin.png') }}" alt="SADARIN"
                                class="h-14 w-auto object-contain">

                        </a>

                    </div>


                    {{-- Heading --}}
                    <div class="mb-8 text-center">

                        {{-- Logo --}}
                        <div class="mb-6 flex justify-center">
                            <img src="{{ asset('assets/images/logo-sadarin.png') }}" alt="SADARIN"
                                class="h-20 w-auto object-contain sm:h-24">
                        </div>


                        {{-- Brand --}}
                        <h2 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                            SADAR<span class="text-sadarin-500">IN</span>
                        </h2>


                        <p class="mt-3 text-sm leading-6 text-slate-500">
                            Masuk untuk mengelola dan mengakses
                            arsip internal Anda.
                        </p>

                    </div>

                    {{-- Alert --}}
                    @if (session('error'))
                        <div class="mb-5 flex gap-3 rounded-xl border border-rose-200 bg-rose-50 p-4">

                            <div
                                class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-rose-100 text-rose-600">
                                <i class="bi bi-exclamation-circle"></i>
                            </div>

                            <div>
                                <p class="text-sm font-semibold text-rose-800">
                                    Login gagal
                                </p>

                                <p class="mt-0.5 text-xs leading-5 text-rose-600">
                                    {{ session('error') }}
                                </p>
                            </div>

                        </div>
                    @endif


                    @if (session('success'))
                        <div class="mb-5 flex gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4">

                            <div
                                class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                                <i class="bi bi-check-circle"></i>
                            </div>

                            <div>
                                <p class="text-sm font-semibold text-emerald-800">
                                    Berhasil
                                </p>

                                <p class="mt-0.5 text-xs leading-5 text-emerald-600">
                                    {{ session('success') }}
                                </p>
                            </div>

                        </div>
                    @endif


                    {{-- Login Form --}}
                    <form action="{{ route('sadarin.login.internal') }}" method="POST" class="space-y-5">

                        @csrf


                        {{-- NIP --}}
                        <div>

                            <label for="nip" class="mb-2 block text-sm font-semibold text-slate-700">

                                NIP/NIK

                            </label>


                            <div class="relative">

                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">

                                    <i class="bi bi-person-vcard"></i>

                                </div>


                                <input type="text" id="nip" name="nip" value="{{ old('nip') }}"
                                    autocomplete="username" inputmode="numeric" placeholder="Masukkan NIP/NIK" required
                                    class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 pl-11 pr-4 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-[oklch(29.3%_0.136_325.661)] focus:bg-white focus:ring-4 focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                            </div>


                            @error('nip')
                                <p class="mt-1.5 text-xs font-medium text-rose-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Password --}}
                        <div>

                            <div class="mb-2 flex items-center justify-between">

                                <label for="password" class="block text-sm font-semibold text-slate-700">

                                    Password

                                </label>


                                <a href="#"
                                    class="text-xs font-semibold text-[oklch(29.3%_0.136_325.661)] hover:underline">

                                    Lupa password?

                                </a>

                            </div>


                            <div class="relative">

                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">

                                    <i class="bi bi-lock"></i>

                                </div>


                                <input type="password" id="password" name="password" autocomplete="current-password"
                                    placeholder="Masukkan password" required
                                    class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 pl-11 pr-12 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-[oklch(29.3%_0.136_325.661)] focus:bg-white focus:ring-4 focus:ring-[oklch(29.3%_0.136_325.661)]/10">


                                <button type="button" onclick="togglePassword()"
                                    class="absolute inset-y-0 right-0 flex w-12 items-center justify-center text-slate-400 transition hover:text-slate-700"
                                    aria-label="Tampilkan password">

                                    <i id="passwordIcon" class="bi bi-eye"></i>

                                </button>

                            </div>


                            @error('password')
                                <p class="mt-1.5 text-xs font-medium text-rose-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        


                        {{-- Button --}}
                        <button type="submit"
                            class="flex h-12 w-full items-center justify-center gap-2 rounded-xl bg-[oklch(29.3%_0.136_325.661)] px-5 text-sm font-bold text-white shadow-lg shadow-[oklch(29.3%_0.136_325.661)]/15 transition hover:-translate-y-0.5 hover:opacity-95 focus:outline-none focus:ring-4 focus:ring-[oklch(29.3%_0.136_325.661)]/15">

                            <span>
                                Masuk ke SADARIN
                            </span>

                            <i class="bi bi-arrow-right"></i>

                        </button>

                    </form>


                    {{-- Security Info --}}
                    <div class="mt-8 rounded-xl border border-slate-100 bg-slate-50 p-4">

                        <div class="flex gap-3">

                            <div
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600">

                                <i class="bi bi-info-circle"></i>

                            </div>


                            <div>

                                <p class="text-xs font-semibold text-slate-700">
                                    Akses Pegawai
                                </p>

                                <p class="mt-1 text-xs leading-5 text-slate-500">
                                    Gunakan NIP dan password SAMPERIN Anda.
                                    Setelah login berhasil, sistem dapat meminta
                                    verifikasi tambahan untuk keamanan akun.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Mobile Footer --}}
                    <div class="mt-8 text-center lg:hidden">

                        <p class="text-xs text-slate-400">
                            © {{ date('Y') }} SADARIN
                        </p>

                        <p class="mt-1 text-[11px] text-slate-300">
                            Sistem Arsip Data dan Berkas Internal
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


    @push('scripts')
        <script>
            function togglePassword() {

                const password = document.getElementById('password');
                const icon = document.getElementById('passwordIcon');

                if (password.type === 'password') {

                    password.type = 'text';

                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');

                } else {

                    password.type = 'password';

                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');

                }
            }
        </script>
    @endpush

@endsection
