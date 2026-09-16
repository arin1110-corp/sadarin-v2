@extends('Dashboard.layouts.app')

@section('title', 'Kelola Role Pengguna')
@section('page_title', 'Kelola Role Pengguna')
@section('breadcrumb', 'Pengguna / Kelola Role')

@section('content')

    <div class="space-y-6">

        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50 text-violet-600">
                        <i class="bi bi-person-gear text-xl"></i>
                    </div>

                    <div>
                        <h1 class="text-xl font-bold text-slate-800">
                            Kelola Role Pengguna
                        </h1>

                        <p class="mt-0.5 text-sm text-slate-500">
                            Atur hak akses pengguna di SADARIN
                        </p>
                    </div>
                </div>
            </div>

            <a href="{{ route('sadarin.admin.pengguna.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 shadow-sm transition hover:bg-slate-50">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

        </div>


        {{-- ========================================================= --}}
        {{-- ERROR --}}
        {{-- ========================================================= --}}

        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <div class="flex items-start gap-3">
                    <i class="bi bi-exclamation-circle-fill mt-0.5"></i>

                    <div>
                        <div class="font-semibold">
                            Terdapat kesalahan
                        </div>

                        <ul class="mt-1 list-disc space-y-1 pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif


        {{-- ========================================================= --}}
        {{-- DATA PEGAWAI --}}
        {{-- ========================================================= --}}

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-5 py-4">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                        <i class="bi bi-person-vcard"></i>
                    </div>

                    <div>
                        <h2 class="text-sm font-bold text-slate-800">
                            Informasi Pengguna
                        </h2>

                        <p class="text-xs text-slate-500">
                            Data berasal dari SAMPERIN
                        </p>
                    </div>
                </div>
            </div>


            <div class="grid grid-cols-1 gap-5 p-5 md:grid-cols-2 lg:grid-cols-3">

                {{-- Nama --}}
                <div>
                    <div class="mb-1.5 text-xs font-medium text-slate-500">
                        Nama Lengkap
                    </div>

                    <div class="text-sm font-semibold text-slate-800">
                        {{ $user['nama'] ?? ($user['user_nama'] ?? '-') }}
                    </div>
                </div>


                {{-- NIP --}}
                <div>
                    <div class="mb-1.5 text-xs font-medium text-slate-500">
                        NIP
                    </div>

                    <div class="text-sm font-medium text-slate-700">
                        {{ $user['nip'] ?? ($user['user_nip'] ?? '-') }}
                    </div>
                </div>


                {{-- NIK --}}
                <div>
                    <div class="mb-1.5 text-xs font-medium text-slate-500">
                        NIK
                    </div>

                    <div class="text-sm font-medium text-slate-700">
                        {{ $user['nik'] ?? ($user['user_nik'] ?? '-') }}
                    </div>
                </div>


                {{-- Jabatan --}}
                <div>
                    <div class="mb-1.5 text-xs font-medium text-slate-500">
                        Jabatan
                    </div>

                    <div class="text-sm font-medium text-slate-700">
                        {{ $user['jabatan'] ?? ($user['jabatan_nama'] ?? '-') }}
                    </div>
                </div>


                {{-- Unit --}}
                <div>
                    <div class="mb-1.5 text-xs font-medium text-slate-500">
                        Unit Kerja
                    </div>

                    <div class="text-sm font-medium text-slate-700">
                        {{ $user['bidang'] ?? ($user['bidang_nama'] ?? ($user['unit'] ?? '-')) }}
                    </div>
                </div>


                {{-- Email --}}
                <div>
                    <div class="mb-1.5 text-xs font-medium text-slate-500">
                        Email
                    </div>

                    <div class="break-all text-sm font-medium text-slate-700">
                        {{ $user['user_email'] ?? '-' }}
                    </div>
                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- ROLE SADARIN --}}
        {{-- ========================================================= --}}

        <form action="{{ route('sadarin.admin.pengguna.update', $user['id'] ?? $user['user_id']) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 px-5 py-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-violet-50 text-violet-600">
                            <i class="bi bi-shield-lock-fill"></i>
                        </div>

                        <div>
                            <h2 class="text-sm font-bold text-slate-800">
                                Role SADARIN
                            </h2>

                            <p class="text-xs text-slate-500">
                                Pilih role yang dimiliki pengguna
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-5">

                    @if ($roles->count())

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                            @foreach ($roles as $role)
                                @php
                                    $roleName = strtolower($role->role_name);

                                    $roleStyle = match ($roleName) {
                                        'administrator' => [
                                            'icon' => 'bi-shield-fill-check',
                                            'box' => 'border-violet-200 bg-violet-50',
                                            'icon_box' => 'bg-violet-100 text-violet-600',
                                            'text' => 'text-violet-700',
                                        ],

                                        'arsiparis' => [
                                            'icon' => 'bi-archive-fill',
                                            'box' => 'border-blue-200 bg-blue-50',
                                            'icon_box' => 'bg-blue-100 text-blue-600',
                                            'text' => 'text-blue-700',
                                        ],

                                        'pegawai' => [
                                            'icon' => 'bi-person-fill',
                                            'box' => 'border-emerald-200 bg-emerald-50',
                                            'icon_box' => 'bg-emerald-100 text-emerald-600',
                                            'text' => 'text-emerald-700',
                                        ],

                                        default => [
                                            'icon' => 'bi-shield-fill',
                                            'box' => 'border-slate-200 bg-slate-50',
                                            'icon_box' => 'bg-slate-100 text-slate-600',
                                            'text' => 'text-slate-700',
                                        ],
                                    };
                                @endphp


                                <label class="group relative cursor-pointer">

                                    <input type="checkbox" name="role_ids[]" value="{{ $role->role_id }}"
                                        class="peer sr-only" @checked(in_array($role->role_id, $userRoleIds ?? []))>

                                    <div
                                        class="rounded-2xl border p-5 transition
                                        {{ $roleStyle['box'] }}
                                        peer-checked:border-[oklch(29.3%_0.136_325.661)]
                                        peer-checked:ring-2
                                        peer-checked:ring-[oklch(29.3%_0.136_325.661)]/20
                                    ">

                                        <div class="flex items-start justify-between gap-4">

                                            <div class="flex items-center gap-3">

                                                <div
                                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl {{ $roleStyle['icon_box'] }}">
                                                    <i class="bi {{ $roleStyle['icon'] }} text-lg"></i>
                                                </div>

                                                <div>
                                                    <div class="text-sm font-bold {{ $roleStyle['text'] }}">
                                                        {{ $role->role_name }}
                                                    </div>

                                                    <div class="mt-1 text-xs text-slate-500">
                                                        {{ $role->role_description ?: 'Tidak ada deskripsi role.' }}
                                                    </div>
                                                </div>

                                            </div>


                                            {{-- CHECK --}}
                                            <div
                                                class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full border-2 border-slate-300 bg-white text-transparent transition
                                                peer-checked:border-[oklch(29.3%_0.136_325.661)]
                                                peer-checked:bg-[oklch(29.3%_0.136_325.661)]
                                                peer-checked:text-white
                                            ">
                                                <i class="bi bi-check text-sm"></i>
                                            </div>

                                        </div>

                                    </div>

                                </label>
                            @endforeach

                        </div>
                    @else
                        <div class="rounded-xl border border-amber-200 bg-amber-50 px-4 py-4 text-sm text-amber-700">
                            <div class="flex items-center gap-3">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                <span>
                                    Belum ada role aktif yang tersedia.
                                </span>
                            </div>
                        </div>

                    @endif

                </div>


                {{-- FOOTER --}}
                <div
                    class="flex flex-col-reverse gap-3 border-t border-slate-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                    <div class="text-xs text-slate-500">
                        <i class="bi bi-info-circle mr-1"></i>
                        Perubahan role akan langsung diterapkan pada akun SADARIN.
                    </div>


                    <div class="flex items-center gap-2">

                        <a href="{{ route('sadarin.admin.pengguna.index') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                            Batal
                        </a>

                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[oklch(29.3%_0.136_325.661)] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:opacity-90">
                            <i class="bi bi-check2-circle"></i>
                            Simpan Role
                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>

@endsection
