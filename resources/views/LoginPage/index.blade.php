@extends('LoginPage.layouts.app')

@section('title', 'Masuk - SADARIN')

@section('content')

    <div class="min-h-screen bg-white">
        <div class="flex min-h-screen flex-col lg:flex-row">

            {{-- LEFT SIDE --}}
            <section class="relative hidden min-h-screen overflow-hidden bg-white lg:flex lg:w-[40%] xl:w-[39%]">

                {{-- FOTO BALI --}}
                {{-- FOTO BALI --}}
                <div class="absolute inset-x-0 bottom-0 h-[76%]">

                    <img src="{{ asset('assets/images/gedung-disbud.jpg') }}" alt="Arsitektur Bali"
                        class="absolute inset-0 h-full w-full object-cover object-center">

                    {{-- Putih dari atas --}}
                    <div class="absolute inset-x-0 top-0 h-[55%] bg-gradient-to-b from-white via-white/75 to-transparent">
                    </div>

                    {{-- Putih dari kanan --}}
                    <div class="absolute inset-y-0 right-0 w-[50%] bg-gradient-to-l from-white via-white/65 to-transparent">
                    </div>

                    {{-- Putih dari kiri bawah --}}
                    <div class="absolute inset-0 bg-gradient-to-tr from-white/70 via-transparent to-transparent"></div>

                    {{-- Putih tipis merata --}}
                    <div class="absolute inset-0 bg-white/10"></div>

                    {{-- Putih dari bawah --}}
                    <div
                        class="absolute inset-x-0 bottom-0 h-[20%] bg-gradient-to-t from-white via-white/45 to-transparent">
                    </div>

                </div>

                {{-- LEFT CONTENT --}}
                <div class="relative z-10 flex min-h-screen w-full flex-col">

                    {{-- LOGO --}}
                    <div class="px-12 pt-12 xl:px-16">
                        <div class="flex items-start gap-4">

                            {{-- ICON --}}
                            <div class="relative h-[66px] w-[58px] shrink-0">

                                <div
                                    class="absolute left-3 top-0 h-[54px] w-[42px] rounded-[6px] bg-gradient-to-br from-sky-400 to-blue-600 shadow-sm">
                                    <div class="absolute right-0 top-0 h-[15px] w-[15px] bg-sky-200/80"
                                        style="clip-path: polygon(0 0, 100% 100%, 100% 0);"></div>
                                </div>

                                <div
                                    class="absolute left-0 top-[28px] h-[54px] w-[44px] rounded-[6px] bg-gradient-to-br from-blue-500 to-blue-700 shadow-md">
                                    <div
                                        class="absolute left-[12px] top-[24px] h-[4px] w-[20px] rounded-full bg-blue-400/70">
                                    </div>
                                    <div
                                        class="absolute left-[12px] top-[32px] h-[4px] w-[14px] rounded-full bg-blue-400/50">
                                    </div>
                                </div>

                            </div>

                            {{-- BRAND --}}
                            <div>
                                <div class="text-[40px] font-extrabold leading-none tracking-[-2px] text-navy-900">
                                    SADAR<span class="text-sadarin-500">IN</span>
                                </div>

                                <div class="mt-2 text-[13px] leading-5 tracking-[0.6px] text-navy-500">
                                    Sistem Arsip Data dan Berkas Internal
                                    <br>
                                    Dinas Kebudayaan Provinsi Bali
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- HERO --}}
                    <div class="px-12 pt-24 xl:px-16 xl:pt-28">

                        <div class="mb-12 h-1 w-11 rounded-full bg-sadarin-500"></div>

                        <h1 class="text-[46px] font-light leading-[1.08] tracking-[-2px] text-navy-800 xl:text-[52px]">
                            Arsip
                            <br>
                            untuk
                            <br>
                            Masa Depan
                        </h1>

                        <p class="mt-7 max-w-[330px] text-[18px] leading-7 text-navy-500 rounded-lg bg-white/55 px-4 py-2 backdrop-blur-[2px]">
                            Dokumen hari ini,
                            <br>
                            warisan untuk generasi mendatang.
                        </p>

                    </div>

                    {{-- BUDAYA / IDENTITAS / KEBERLANJUTAN --}}
                    <div class="absolute bottom-[105px] left-0 z-30 px-12 xl:px-16">
                        <div class="ml-[185px] rounded-lg bg-white/55 px-4 py-2 backdrop-blur-[2px] xl:ml-[220px]">
                            <div class="text-[10px] font-medium leading-7 tracking-[5px] text-navy-700">
                                BUDAYA
                            </div>

                            <div class="text-[10px] font-medium leading-7 tracking-[5px] text-navy-700">
                                IDENTITAS
                            </div>

                            <div class="text-[10px] font-medium leading-7 tracking-[5px] text-navy-700">
                                KEBERLANJUTAN
                            </div>
                        </div>
                    </div>

                    {{-- FOOTER LEFT --}}
                    <footer class="absolute bottom-0 left-0 right-0 z-40 bg-white/90 px-12 py-7 backdrop-blur-sm xl:px-16">
                        <div class="flex items-center gap-3 text-[13px] text-navy-500">
                            <span>SADARIN</span>
                            <span class="text-slate-300">|</span>
                            <span>Dinas Kebudayaan Provinsi Bali</span>
                        </div>
                    </footer>

                </div>

            </section>

            {{-- RIGHT SIDE --}}
            <section class="relative flex min-h-screen flex-1 flex-col bg-white">

                {{-- TENTANG SADARIN --}}
                <div class="absolute right-0 top-0 px-8 py-8 lg:px-12">
                    <button type="button"
                        class="group flex items-center gap-3 text-[15px] font-medium text-navy-500 transition hover:text-sadarin-600">
                        <span
                            class="flex h-[22px] w-[22px] items-center justify-center rounded-full bg-navy-500 text-white">
                            <i class="bi bi-info text-[13px]"></i>
                        </span>

                        <span>Tentang SADARIN</span>
                    </button>
                </div>

                {{-- LOGIN WRAPPER --}}
                <div class="flex flex-1 items-center justify-center px-5 pb-8 pt-20 sm:px-8">

                    <div class="w-full max-w-[690px]">

                        {{-- LOGIN CARD --}}
                        <div
                            class="rounded-[18px] border border-slate-200/80 bg-white px-7 py-9 shadow-panel sm:px-10 sm:py-11 lg:px-9">

                            {{-- HEADING --}}
                            <div class="text-center">

                                <h2
                                    class="text-[34px] font-bold leading-tight tracking-[-1.5px] text-navy-900 sm:text-[40px]">
                                    Masuk ke
                                    <span class="text-sadarin-500">SADARIN</span>
                                </h2>

                                <p class="mt-3 text-[16px] text-navy-500">
                                    Pilih jenis akses untuk melanjutkan.
                                </p>

                            </div>

                            {{-- LOGIN TYPE --}}
                            <div class="mt-8 grid grid-cols-2 gap-2">

                                <button type="button" data-login-type="internal"
                                    class="flex h-[60px] items-center justify-center gap-3 rounded-[10px] border border-transparent text-[16px] font-semibold transition-all">
                                    <i class="bi bi-person-fill text-[23px]"></i>
                                    <span>Pegawai</span>
                                </button>

                                <button type="button" data-login-type="public"
                                    class="flex h-[60px] items-center justify-center gap-3 rounded-[10px] border border-slate-200 bg-white text-[16px] font-semibold text-navy-500 transition-all">
                                    <i class="bi bi-globe2 text-[22px]"></i>
                                    <span>Publik</span>
                                </button>

                            </div>

                            {{-- SUCCESS --}}
                            @if (session('success'))
                                <div
                                    class="mt-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                                    <div class="flex gap-3">
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span>{{ session('success') }}</span>
                                    </div>
                                </div>
                            @endif

                            {{-- ERROR --}}
                            @if (session('error'))
                                <div class="mt-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                                    <div class="flex gap-3">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ session('error') }}</span>
                                    </div>
                                </div>
                            @endif

                            {{-- VALIDATION ERROR --}}
                            @if ($errors->any())
                                <div class="mt-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                                    <div class="flex gap-3">
                                        <i class="bi bi-exclamation-circle-fill"></i>

                                        <div>
                                            @foreach ($errors->all() as $error)
                                                <div>{{ $error }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- INTERNAL LOGIN --}}
                            <form method="POST" action="{{ route('sadarin.login.internal') }}" data-login-form="internal"
                                class="mt-8">

                                @csrf

                                {{-- IDENTIFIER --}}
                                <div
                                    class="flex h-[62px] overflow-hidden rounded-[10px] border border-slate-300 bg-white transition focus-within:border-sadarin-500 focus-within:ring-4 focus-within:ring-sadarin-500/10">

                                    <div
                                        class="flex w-[64px] shrink-0 items-center justify-center border-r border-slate-200 text-navy-400">
                                        <i class="bi bi-person-fill text-[22px]"></i>
                                    </div>

                                    <input type="text" name="identifier" value="{{ old('identifier') }}"
                                        placeholder="NIP, NIK, atau Email Dinas" autocomplete="username"
                                        class="min-w-0 flex-1 bg-transparent px-5 text-[16px] text-navy-700 outline-none placeholder:text-navy-400">

                                </div>

                                {{-- OTP --}}
                                <div
                                    class="mt-5 flex h-[62px] overflow-hidden rounded-[10px] border border-slate-300 bg-white transition focus-within:border-sadarin-500 focus-within:ring-4 focus-within:ring-sadarin-500/10">

                                    <div
                                        class="flex w-[64px] shrink-0 items-center justify-center border-r border-slate-200 text-navy-400">
                                        <i class="bi bi-lock-fill text-[21px]"></i>
                                    </div>

                                    <input type="text" name="otp" inputmode="numeric" maxlength="6"
                                        placeholder="Kode OTP" autocomplete="one-time-code"
                                        class="min-w-0 flex-1 bg-transparent px-5 text-[16px] text-navy-700 outline-none placeholder:text-navy-400">

                                    <button type="button"
                                        class="whitespace-nowrap px-5 font-semibold text-sadarin-600 transition hover:text-sadarin-700">
                                        Kirim OTP
                                    </button>

                                </div>

                                {{-- SUBMIT --}}
                                <button type="submit"
                                    class="mt-10 flex h-[61px] w-full items-center justify-center gap-4 rounded-[10px] bg-gradient-to-r from-sadarin-500 to-blue-600 text-[18px] font-semibold text-white shadow-sm transition hover:from-sadarin-600 hover:to-blue-700">
                                    <span>Masuk</span>
                                    <i class="bi bi-arrow-right text-[24px]"></i>
                                </button>

                            </form>

                            {{-- PUBLIC LOGIN --}}
                            <form method="POST" action="{{ route('sadarin.login.public') }}" data-login-form="public"
                                class="mt-8 hidden">

                                @csrf

                                {{-- EMAIL --}}
                                <div
                                    class="flex h-[62px] overflow-hidden rounded-[10px] border border-slate-300 bg-white transition focus-within:border-sadarin-500 focus-within:ring-4 focus-within:ring-sadarin-500/10">

                                    <div
                                        class="flex w-[64px] shrink-0 items-center justify-center border-r border-slate-200 text-navy-400">
                                        <i class="bi bi-envelope-fill text-[21px]"></i>
                                    </div>

                                    <input type="email" name="email" value="{{ old('email') }}"
                                        placeholder="Alamat email" autocomplete="email"
                                        class="min-w-0 flex-1 bg-transparent px-5 text-[16px] text-navy-700 outline-none placeholder:text-navy-400">

                                </div>

                                {{-- OTP --}}
                                <div
                                    class="mt-5 flex h-[62px] overflow-hidden rounded-[10px] border border-slate-300 bg-white transition focus-within:border-sadarin-500 focus-within:ring-4 focus-within:ring-sadarin-500/10">

                                    <div
                                        class="flex w-[64px] shrink-0 items-center justify-center border-r border-slate-200 text-navy-400">
                                        <i class="bi bi-lock-fill text-[21px]"></i>
                                    </div>

                                    <input type="text" name="otp" inputmode="numeric" maxlength="6"
                                        placeholder="Kode OTP" autocomplete="one-time-code"
                                        class="min-w-0 flex-1 bg-transparent px-5 text-[16px] text-navy-700 outline-none placeholder:text-navy-400">

                                    <button type="button"
                                        class="whitespace-nowrap px-5 font-semibold text-sadarin-600 transition hover:text-sadarin-700">
                                        Kirim OTP
                                    </button>

                                </div>

                                {{-- SUBMIT --}}
                                <button type="submit"
                                    class="mt-10 flex h-[61px] w-full items-center justify-center gap-4 rounded-[10px] bg-gradient-to-r from-sadarin-500 to-blue-600 text-[18px] font-semibold text-white shadow-sm transition hover:from-sadarin-600 hover:to-blue-700">
                                    <span>Masuk</span>
                                    <i class="bi bi-arrow-right text-[24px]"></i>
                                </button>

                            </form>

                            {{-- SECURITY INFO --}}
                            <div class="mt-8 border-t border-slate-200 pt-6">

                                <div
                                    class="flex items-start justify-center gap-3 text-center text-[13px] leading-5 text-navy-500">

                                    <i class="bi bi-info-circle-fill shrink-0 text-[19px] text-navy-400"></i>

                                    <p>
                                        Kode OTP akan dikirim ke email yang terdaftar di SAMPERIN.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- RIGHT FOOTER --}}
                <footer class="px-6 pb-7 text-center">

                    <p class="text-[13px] text-navy-500">
                        © {{ date('Y') }} SADARIN
                        <span class="mx-1 text-slate-300">—</span>
                        Dinas Kebudayaan Provinsi Bali
                    </p>

                    <p class="mt-2 text-[13px] text-navy-500">
                        Arsip
                        <span class="mx-2 text-slate-300">•</span>
                        Akses
                        <span class="mx-2 text-slate-300">•</span>
                        Pengetahuan
                        <span class="mx-2 text-slate-300">•</span>
                        Masa Depan
                    </p>

                </footer>

            </section>

        </div>
    </div>

@endsection
