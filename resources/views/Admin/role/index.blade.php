@extends('Dashboard.layouts.app')

@section('title', 'Role & Permission')
@section('page_title', 'Role & Permission')
@section('breadcrumb', 'Role & Permission')

@section('content')

    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50 text-violet-600">
                    <i class="bi bi-shield-lock-fill text-xl"></i>
                </div>

                <div>
                    <h1 class="text-xl font-bold text-slate-800">
                        Role & Permission
                    </h1>

                    <p class="mt-0.5 text-sm text-slate-500">
                        Kelola role dan hak akses pengguna SADARIN
                    </p>
                </div>

            </div>

            <a href="{{ route('sadarin.admin.role.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[oklch(29.3%_0.136_325.661)] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:opacity-90">

                <i class="bi bi-plus-lg"></i>
                Tambah Role

            </a>

        </div>


        {{-- SUCCESS --}}
        @if (session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">

                <div class="flex items-center gap-3">
                    <i class="bi bi-check-circle-fill"></i>

                    <span>
                        {{ session('success') }}
                    </span>
                </div>

            </div>
        @endif


        {{-- SEARCH --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <form method="GET" action="{{ route('sadarin.admin.role.index') }}" class="flex flex-col gap-3 sm:flex-row">

                <div class="relative flex-1">

                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                    <input type="text" name="search" value="{{ $search }}"
                        placeholder="Cari nama atau deskripsi role..."
                        class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-sm text-slate-700 outline-none transition focus:border-[oklch(29.3%_0.136_325.661)] focus:ring-2 focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                </div>

                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[oklch(29.3%_0.136_325.661)] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:opacity-90">

                    <i class="bi bi-search"></i>
                    Cari

                </button>

            </form>

        </div>


        {{-- TABLE --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="border-b border-slate-100 bg-slate-50">

                        <tr>

                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                #
                            </th>

                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Role
                            </th>

                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Deskripsi
                            </th>

                            <th class="px-5 py-3 text-center text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Status
                            </th>

                            <th class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse ($roles as $role)
                            @php
                                $roleName = strtolower($role->role_name);

                                $style = match ($roleName) {
                                    'administrator' => [
                                        'icon' => 'bi-shield-fill-check',
                                        'bg' => 'bg-violet-50',
                                        'icon_bg' => 'bg-violet-100 text-violet-600',
                                        'text' => 'text-violet-700',
                                    ],

                                    'arsiparis' => [
                                        'icon' => 'bi-archive-fill',
                                        'bg' => 'bg-blue-50',
                                        'icon_bg' => 'bg-blue-100 text-blue-600',
                                        'text' => 'text-blue-700',
                                    ],

                                    'pegawai' => [
                                        'icon' => 'bi-person-fill',
                                        'bg' => 'bg-emerald-50',
                                        'icon_bg' => 'bg-emerald-100 text-emerald-600',
                                        'text' => 'text-emerald-700',
                                    ],

                                    default => [
                                        'icon' => 'bi-shield-fill',
                                        'bg' => 'bg-slate-50',
                                        'icon_bg' => 'bg-slate-100 text-slate-600',
                                        'text' => 'text-slate-700',
                                    ],
                                };
                            @endphp

                            <tr class="transition hover:bg-slate-50">

                                <td class="px-5 py-4 text-sm text-slate-500">
                                    {{ $roles->firstItem() + $loop->index }}
                                </td>


                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-xl {{ $style['icon_bg'] }}">
                                            <i class="bi {{ $style['icon'] }}"></i>
                                        </div>

                                        <div>
                                            <div class="text-sm font-semibold {{ $style['text'] }}">
                                                {{ $role->role_name }}
                                            </div>

                                            <div class="mt-0.5 text-xs text-slate-400">
                                                Role ID: {{ $role->role_id }}
                                            </div>
                                        </div>

                                    </div>

                                </td>


                                <td class="max-w-md px-5 py-4">

                                    <span class="text-sm text-slate-600">
                                        {{ $role->role_description ?: '-' }}
                                    </span>

                                </td>


                                <td class="px-5 py-4 text-center">

                                    @if ($role->role_is_active)
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Aktif
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-500">
                                            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                            Nonaktif
                                        </span>
                                    @endif

                                </td>


                                <td class="px-5 py-4">

                                    <div class="flex justify-end">

                                        <div class="flex justify-end gap-2">

                                            <a href="{{ route('sadarin.admin.role.permission.edit', $role->role_id) }}"
                                                class="inline-flex items-center gap-2 rounded-lg border border-indigo-200 bg-indigo-50 px-3 py-2 text-xs font-semibold text-indigo-600 transition hover:bg-indigo-100">

                                                <i class="bi bi-key-fill"></i>
                                                Permission

                                            </a>

                                            <a href="{{ route('sadarin.admin.role.edit', $role->role_id) }}"
                                                class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-600 transition hover:border-[oklch(29.3%_0.136_325.661)] hover:text-[oklch(29.3%_0.136_325.661)]">

                                                <i class="bi bi-pencil-square"></i>
                                                Edit

                                            </a>

                                        </div>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="px-5 py-12 text-center">

                                    <div class="flex flex-col items-center">

                                        <div
                                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                                            <i class="bi bi-shield-slash text-2xl"></i>
                                        </div>

                                        <h3 class="mt-4 text-sm font-semibold text-slate-700">
                                            Role tidak ditemukan
                                        </h3>

                                        <p class="mt-1 text-xs text-slate-400">
                                            Belum ada role yang sesuai dengan pencarian.
                                        </p>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- MANUAL PAGINATION --}}
            @if ($roles->hasPages())

                <div class="flex justify-center border-t border-slate-100 px-5 py-4">

                    <div
                        class="inline-flex items-center overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

                        @if ($roles->onFirstPage())
                            <span
                                class="flex h-9 w-9 items-center justify-center border-r border-slate-200 bg-slate-50 text-slate-300">
                                <i class="bi bi-chevron-left text-xs"></i>
                            </span>
                        @else
                            <a href="{{ $roles->previousPageUrl() }}"
                                class="flex h-9 w-9 items-center justify-center border-r border-slate-200 text-slate-500 transition hover:bg-slate-50 hover:text-[oklch(29.3%_0.136_325.661)]">
                                <i class="bi bi-chevron-left text-xs"></i>
                            </a>
                        @endif


                        @foreach ($roles->getUrlRange(max(1, $roles->currentPage() - 4), min($roles->lastPage(), $roles->currentPage() + 4)) as $page => $url)
                            @if ($page == $roles->currentPage())
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


                        @if ($roles->hasMorePages())
                            <a href="{{ $roles->nextPageUrl() }}"
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
