@extends('LoginPage.layouts.app')

@section('title', 'Verifikasi OTP - SADARIN')

@section('content')

    <div class="min-h-screen bg-white">

        <div class="flex min-h-screen items-center justify-center px-5 py-10 sm:px-8">

            <div class="w-full max-w-md">

                {{-- Logo --}}
                <div class="mb-8 flex justify-center">
                    <a href="{{ route('sadarin.home') }}">
                        <img src="{{ asset('assets/images/logo-sadarin.png') }}" alt="SADARIN"
                            class="h-20 w-auto object-contain sm:h-24">
                    </a>
                </div>


                {{-- Heading --}}
                <div class="mb-8 text-center">

                    <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                        Verifikasi Login
                    </h1>

                    <p class="mt-3 text-sm leading-6 text-slate-500">
                        Masukkan kode OTP untuk melanjutkan
                        ke sistem SADARIN.
                    </p>

                </div>


                {{-- Success --}}
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


                {{-- Error --}}
                @if (session('error'))
                    <div class="mb-5 flex gap-3 rounded-xl border border-rose-200 bg-rose-50 p-4">

                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-rose-100 text-rose-600">
                            <i class="bi bi-exclamation-circle"></i>
                        </div>

                        <div>

                            <p class="text-sm font-semibold text-rose-800">
                                Verifikasi gagal
                            </p>

                            <p class="mt-0.5 text-xs leading-5 text-rose-600">
                                {{ session('error') }}
                            </p>

                        </div>

                    </div>
                @endif


                {{-- User Info --}}
                <div class="mb-6 rounded-xl border border-slate-100 bg-slate-50 p-4">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[oklch(29.3%_0.136_325.661)]/10 text-[oklch(29.3%_0.136_325.661)]">

                            <i class="bi bi-person-check"></i>

                        </div>

                        <div class="min-w-0">

                            <p class="truncate text-sm font-semibold text-slate-800">
                                {{ $pegawai['nama'] ?? '-' }}
                            </p>

                            <p class="mt-0.5 text-xs text-slate-500">
                                {{ $pegawai['nip'] ?? '-' }}
                            </p>

                        </div>

                    </div>

                    @if (!empty($pegawai['email']))
                        <div class="mt-3 border-t border-slate-200 pt-3">

                            <p class="text-xs text-slate-500">
                                Kode OTP dikirim ke
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-700">
                                {{ $pegawai['email'] }}
                            </p>

                        </div>
                    @endif

                </div>


                {{-- OTP Form --}}
                <form action="{{ route('sadarin.login.otp.verify') }}" method="POST" class="space-y-5">

                    @csrf

                    <div>

                        <label for="otp" class="mb-2 block text-sm font-semibold text-slate-700">
                            Kode OTP
                        </label>

                        <input type="text" id="otp" name="otp" value="{{ old('otp') }}" inputmode="numeric"
                            autocomplete="one-time-code" maxlength="6" placeholder="000000" required autofocus
                            class="h-14 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 text-center text-2xl font-bold tracking-[0.5em] text-slate-800 outline-none transition placeholder:text-slate-300 focus:border-[oklch(29.3%_0.136_325.661)] focus:bg-white focus:ring-4 focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                        @error('otp')
                            <p class="mt-1.5 text-xs font-medium text-rose-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <button type="submit"
                        class="flex h-12 w-full items-center justify-center gap-2 rounded-xl bg-[oklch(29.3%_0.136_325.661)] px-5 text-sm font-bold text-white shadow-lg shadow-[oklch(29.3%_0.136_325.661)]/15 transition hover:-translate-y-0.5 hover:opacity-95 focus:outline-none focus:ring-4 focus:ring-[oklch(29.3%_0.136_325.661)]/15">

                        <span>Verifikasi OTP</span>

                        <i class="bi bi-arrow-right"></i>

                    </button>

                </form>


                {{-- Security Info --}}
                <div class="mt-8 rounded-xl border border-slate-100 bg-slate-50 p-4">

                    <div class="flex gap-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                            <i class="bi bi-shield-lock"></i>
                        </div>

                        <div>

                            <p class="text-xs font-semibold text-slate-700">
                                Kode OTP berlaku 10 menit
                            </p>

                            <p class="mt-1 text-xs leading-5 text-slate-500">
                                Jangan bagikan kode OTP kepada siapa pun.
                                Kode hanya dapat digunakan satu kali.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Back --}}
                <div class="mt-6 text-center">

                    <a href="{{ route('sadarin.login') }}"
                        class="text-xs font-semibold text-[oklch(29.3%_0.136_325.661)] hover:underline">
                        <i class="bi bi-arrow-left"></i>
                        Kembali ke login
                    </a>

                </div>


                {{-- Footer --}}
                <div class="mt-8 text-center">

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

@endsection
