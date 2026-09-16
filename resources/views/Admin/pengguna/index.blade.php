@extends('Dashboard.layouts.app')

@section('title', 'Pengguna')

@section('content')

    <div class="space-y-6">

        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50 text-violet-600">
                        <i class="bi bi-people-fill text-xl"></i>
                    </div>

                    <div>

                        <h1 class="text-xl font-bold text-slate-800">
                            Pengguna
                        </h1>

                        <p class="text-sm text-slate-500">
                            Kelola akses dan role pengguna SADARIN.
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- ALERT SUCCESS --}}
        {{-- ========================================================= --}}

        @if (session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">

                <div class="flex items-center gap-2">

                    <i class="bi bi-check-circle-fill"></i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            </div>
        @endif


        {{-- ========================================================= --}}
        {{-- ALERT ERROR --}}
        {{-- ========================================================= --}}

        @if (session('error'))
            <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">

                <div class="flex items-center gap-2">

                    <i class="bi bi-exclamation-triangle-fill"></i>

                    <span>
                        {{ session('error') }}
                    </span>

                </div>

            </div>
        @endif


        {{-- ========================================================= --}}
        {{-- SEARCH --}}
        {{-- ========================================================= --}}

        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

            <form method="GET" action="{{ route('sadarin.admin.pengguna.index') }}"
                class="flex flex-col gap-3 sm:flex-row">

                <div class="relative flex-1">

                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari NIP, NIK, nama, jabatan, atau unit..."
                        class="w-full rounded-xl border border-slate-200 py-2.5 pl-10 pr-4 text-sm outline-none transition focus:border-purple-400 focus:ring-2 focus:ring-purple-100">

                </div>


                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[oklch(29.3%_0.136_325.661)] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:opacity-90">

                    <i class="bi bi-search"></i>

                    Cari

                </button>


                @if (request('search'))
                    <a href="{{ route('sadarin.admin.pengguna.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">

                        <i class="bi bi-x-lg"></i>

                        Reset

                    </a>
                @endif

            </form>

        </div>


        {{-- ========================================================= --}}
        {{-- INFO --}}
        {{-- ========================================================= --}}

        <div class="rounded-xl border border-blue-100 bg-blue-50 px-4 py-3">

            <div class="flex gap-3">

                <i class="bi bi-info-circle-fill mt-0.5 text-blue-600"></i>

                <div class="text-sm text-blue-700">

                    <div class="font-semibold">
                        Data pengguna berasal dari SAMPERIN
                    </div>

                    <div class="mt-0.5 text-xs leading-5 text-blue-600">

                        Data identitas pegawai dikelola pada SAMPERIN.
                        SADARIN hanya mengatur role dan hak akses terhadap sistem arsip.

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- TABLE --}}
        {{-- ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="overflow-x-auto">

                <table class="min-w-[1000px] w-full text-sm">

                    <thead class="bg-slate-50">

                        <tr class="border-b border-slate-200">

                            <th class="px-5 py-3 text-left font-semibold text-slate-600">
                                #
                            </th>

                            <th class="px-5 py-3 text-left font-semibold text-slate-600">
                                Pengguna
                            </th>

                            <th class="px-5 py-3 text-left font-semibold text-slate-600">
                                NIP
                            </th>

                            <th class="px-5 py-3 text-left font-semibold text-slate-600">
                                Jabatan
                            </th>

                            <th class="px-5 py-3 text-left font-semibold text-slate-600">
                                Unit
                            </th>

                            <th class="px-5 py-3 text-left font-semibold text-slate-600">
                                Role SADARIN
                            </th>

                            <th class="px-5 py-3 text-center font-semibold text-slate-600">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse($users as $user)

                            <tr class="transition hover:bg-slate-50">

                                {{-- No --}}
                                <td class="whitespace-nowrap px-5 py-4 text-slate-500">

                                    {{ $users->firstItem() + $loop->index }}

                                </td>


                                {{-- Pengguna --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-3">

                                        {{-- Avatar --}}
                                        <div
                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-violet-50 font-semibold text-violet-600">

                                            {{ strtoupper(substr(trim($user['nama'] ?? 'U'), 0, 1)) }}

                                        </div>


                                        <div class="min-w-0">

                                            <div class="font-semibold text-slate-800">

                                                {{ $user['nama'] ?? '-' }}

                                            </div>

                                            @if (!empty($user['email']) && $user['email'] !== '-')
                                                <div class="mt-0.5 truncate text-xs text-slate-400">

                                                    {{ $user['email'] }}

                                                </div>
                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- NIP --}}
                                <td class="px-5 py-4">

                                    <span class="font-mono text-xs text-slate-600">

                                        {{ $user['nip'] ?? '-' }}

                                    </span>

                                </td>


                                {{-- Jabatan --}}
                                <td class="px-5 py-4">

                                    <div class="max-w-[220px] text-slate-600">

                                        {{ $user['jabatan'] ?? '-' }}

                                    </div>

                                </td>


                                {{-- Unit --}}
                                <td class="px-5 py-4">

                                    <div class="max-w-[180px] text-slate-600">

                                        {{ $user['bidang'] ?? '-' }}

                                    </div>

                                </td>


                                {{-- Role --}}
                                <td class="px-5 py-4">

                                    @php
                                        $userRoleIds = $user['role_ids'] ?? [];
                                    @endphp


                                    @if (count($userRoleIds) > 0)
                                        <div class="flex flex-wrap gap-1.5">

                                            @foreach ($roles as $role)
                                                @if (in_array($role->role_id, $userRoleIds))
                                                    @php
                                                        $roleColors = [
                                                            'Administrator' =>
                                                                'bg-purple-50 text-purple-700 border-purple-100',
                                                            'Arsiparis' => 'bg-blue-50 text-blue-700 border-blue-100',
                                                            'Pegawai' =>
                                                                'bg-emerald-50 text-emerald-700 border-emerald-100',
                                                        ];

                                                        $roleClass =
                                                            $roleColors[$role->role_name] ??
                                                            'bg-slate-50 text-slate-600 border-slate-200';
                                                    @endphp

                                                    <span
                                                        class="inline-flex items-center gap-1 rounded-lg border px-2.5 py-1 text-xs font-medium {{ $roleClass }}">

                                                        <i class="bi bi-shield-check"></i>

                                                        {{ $role->role_name }}

                                                    </span>
                                                @endif
                                            @endforeach

                                        </div>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-lg border border-rose-100 bg-rose-50 px-2.5 py-1 text-xs font-medium text-rose-600">

                                            <i class="bi bi-shield-x"></i>

                                            Belum ada role

                                        </span>
                                    @endif

                                </td>


                                {{-- Aksi --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center justify-center">

                                        <a href="{{ route('sadarin.admin.pengguna.edit', $user['id']) }}"
                                            title="Kelola Role"
                                            class="inline-flex h-9 items-center justify-center gap-2 rounded-lg bg-blue-50 px-3 text-xs font-semibold text-blue-600 transition hover:bg-blue-100">

                                            <i class="bi bi-shield-lock-fill"></i>

                                            Kelola Role

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="px-5 py-12 text-center">

                                    <div class="flex flex-col items-center justify-center">

                                        <div
                                            class="mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-violet-50 text-violet-500">

                                            <i class="bi bi-people text-2xl"></i>

                                        </div>


                                        <h3 class="font-semibold text-slate-700">

                                            Pengguna tidak ditemukan

                                        </h3>


                                        <p class="mt-1 text-sm text-slate-400">

                                            Tidak ada data pegawai yang sesuai dengan pencarian.

                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- ========================================================= --}}
            {{-- PAGINATION --}}
            {{-- ========================================================= --}}

            @if ($users->hasPages())

                <div class="flex justify-center border-t border-slate-100 px-5 py-4">

                    <div
                        class="inline-flex items-center overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

                        {{-- Previous --}}
                        @if ($users->onFirstPage())
                            <span
                                class="flex h-9 w-9 items-center justify-center border-r border-slate-200 bg-slate-50 text-slate-300">
                                <i class="bi bi-chevron-left text-xs"></i>
                            </span>
                        @else
                            <a href="{{ $users->previousPageUrl() }}"
                                class="flex h-9 w-9 items-center justify-center border-r border-slate-200 text-slate-500 transition hover:bg-slate-50 hover:text-[oklch(29.3%_0.136_325.661)]">

                                <i class="bi bi-chevron-left text-xs"></i>

                            </a>
                        @endif


                        {{-- Pages --}}
                        @foreach ($users->getUrlRange(max(1, $users->currentPage() - 4), min($users->lastPage(), $users->currentPage() + 4)) as $page => $url)
                            @if ($page == $users->currentPage())
                                <span
                                    class="flex h-9 min-w-[40px] items-center justify-center border-r border-[oklch(29.3%_0.136_325.661)] bg-[oklch(29.3%_0.136_325.661)] px-3 text-xs font-semibold text-white">

                                    {{ $page }}

                                </span>
                            @else
                                <a href="{{ $url }}"
                                    class="flex h-9 min-w-[40px] items-center justify-center border-r border-slate-200 px-3 text-xs font-medium text-slate-600 transition hover:bg-[oklch(29.3%_0.136_325.661)] hover:text-white">

                                    {{ $page }}

                                </a>
                            @endif
                        @endforeach


                        {{-- Next --}}
                        @if ($users->hasMorePages())
                            <a href="{{ $users->nextPageUrl() }}"
                                class="flex h-9 w-9 items-center justify-center text-slate-500 transition hover:bg-slate-50 hover:text-[oklch(29.3%_0.136_325.661)]">

                                <i class="bi bi-chevron-right text-xs"></i>

                            </a>
                        @else
                            <span class="flex h-9 w-9 items-center justify-center bg-slate-50 text-slate-300">

                                <i class="bi bi-chevron-right text-xs"></i>

                            </span>
                        @endif

                    </div>

                </div>

            @endif

        </div>

    </div>

@endsection
