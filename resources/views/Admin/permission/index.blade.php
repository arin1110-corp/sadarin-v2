@extends('Dashboard.layouts.app')

@section('title', 'Permission')
@section('page_title', 'Permission')
@section('breadcrumb', 'Role & Permission / Permission')

@section('content')

    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                    <i class="bi bi-key-fill text-xl"></i>
                </div>

                <div>
                    <h1 class="text-xl font-bold text-slate-800">
                        Permission
                    </h1>

                    <p class="mt-0.5 text-sm text-slate-500">
                        Kelola hak akses yang tersedia di SADARIN
                    </p>
                </div>

            </div>


            <a href="{{ route('sadarin.admin.permission.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[oklch(29.3%_0.136_325.661)] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:opacity-90">

                <i class="bi bi-plus-lg"></i>
                Tambah Permission

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

            <form method="GET" action="{{ route('sadarin.admin.permission.index') }}"
                class="flex flex-col gap-3 sm:flex-row">

                <div class="relative flex-1">

                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari permission..."
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
                                Permission
                            </th>

                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Label
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

                        @forelse ($permissions as $permission)
                            <tr class="transition hover:bg-slate-50">

                                <td class="px-5 py-4 text-sm text-slate-500">
                                    {{ $permissions->firstItem() + $loop->index }}
                                </td>


                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                                            <i class="bi bi-key-fill"></i>
                                        </div>

                                        <div>

                                            <div class="font-mono text-sm font-semibold text-slate-700">
                                                {{ $permission->permission_name }}
                                            </div>

                                            <div class="mt-0.5 text-xs text-slate-400">
                                                ID: {{ $permission->permission_id }}
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <td class="px-5 py-4">

                                    <span class="text-sm font-medium text-slate-700">
                                        {{ $permission->permission_label }}
                                    </span>

                                </td>


                                <td class="max-w-md px-5 py-4">

                                    <span class="text-sm text-slate-500">
                                        {{ $permission->permission_description ?: '-' }}
                                    </span>

                                </td>


                                <td class="px-5 py-4 text-center">

                                    @if ($permission->permission_is_active)
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

                                        <a href="{{ route('sadarin.admin.permission.edit', $permission->permission_id) }}"
                                            class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-600 transition hover:border-[oklch(29.3%_0.136_325.661)] hover:text-[oklch(29.3%_0.136_325.661)]">

                                            <i class="bi bi-pencil-square"></i>
                                            Kelola

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="px-5 py-12 text-center">

                                    <div class="flex flex-col items-center">

                                        <div
                                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                                            <i class="bi bi-key text-2xl"></i>
                                        </div>

                                        <h3 class="mt-4 text-sm font-semibold text-slate-700">
                                            Permission tidak ditemukan
                                        </h3>

                                        <p class="mt-1 text-xs text-slate-400">
                                            Belum ada permission yang sesuai.
                                        </p>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            @if ($permissions->hasPages())

                <div class="flex justify-center border-t border-slate-100 px-5 py-4">

                    <div
                        class="inline-flex items-center overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

                        @if ($permissions->onFirstPage())
                            <span
                                class="flex h-9 w-9 items-center justify-center border-r border-slate-200 bg-slate-50 text-slate-300">
                                <i class="bi bi-chevron-left text-xs"></i>
                            </span>
                        @else
                            <a href="{{ $permissions->previousPageUrl() }}"
                                class="flex h-9 w-9 items-center justify-center border-r border-slate-200 text-slate-500 transition hover:bg-slate-50 hover:text-[oklch(29.3%_0.136_325.661)]">

                                <i class="bi bi-chevron-left text-xs"></i>

                            </a>
                        @endif


                        @foreach ($permissions->getUrlRange(max(1, $permissions->currentPage() - 4), min($permissions->lastPage(), $permissions->currentPage() + 4)) as $page => $url)
                            @if ($page == $permissions->currentPage())
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


                        @if ($permissions->hasMorePages())
                            <a href="{{ $permissions->nextPageUrl() }}"
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
