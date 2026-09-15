@extends('Dashboard.layouts.app')

@section('content')
    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <div class="flex items-center gap-2 text-sm text-slate-400">

                    <span>Master Data</span>

                    <i class="bi bi-chevron-right text-xs"></i>

                    <span class="text-slate-600">
                        Kegiatan
                    </span>

                </div>

                <h1 class="mt-2 text-2xl font-bold text-slate-800">
                    Kegiatan
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Kelola data kegiatan yang digunakan dalam pengelompokan arsip.
                </p>

            </div>


            <a href="{{ route('sadarin.admin.master.kegiatan.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[oklch(29.3%_0.136_325.661)] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:opacity-90">

                <i class="bi bi-plus-lg"></i>

                Tambah Kegiatan

            </a>

        </div>


        {{-- Success --}}
        @if (session('success'))
            <div
                class="flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-700">

                <i class="bi bi-check-circle-fill mt-0.5"></i>

                <div class="text-sm font-medium">
                    {{ session('success') }}
                </div>

            </div>
        @endif


        {{-- Error --}}
        @if (session('error'))
            <div class="flex items-start gap-3 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-rose-700">

                <i class="bi bi-exclamation-circle-fill mt-0.5"></i>

                <div class="text-sm font-medium">
                    {{ session('error') }}
                </div>

            </div>
        @endif


        {{-- Search --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

            <form method="GET" action="{{ route('sadarin.admin.master.kegiatan.index') }}">

                <div class="flex flex-col gap-3 sm:flex-row">

                    <div class="relative flex-1">

                        <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari kegiatan, kode, atau program..."
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-11 pr-4 text-sm text-slate-700 outline-none transition focus:border-[oklch(29.3%_0.136_325.661)] focus:bg-white focus:ring-2 focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                    </div>


                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-800 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700">

                        <i class="bi bi-search"></i>

                        Cari

                    </button>


                    @if (request('search'))
                        <a href="{{ route('sadarin.admin.master.kegiatan.index') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">

                            <i class="bi bi-x-lg"></i>

                            Reset

                        </a>
                    @endif

                </div>

            </form>

        </div>


        {{-- Table --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div
                class="flex flex-col gap-2 border-b border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <h2 class="text-sm font-bold text-slate-800">
                        Daftar Kegiatan
                    </h2>

                    <p class="mt-0.5 text-xs text-slate-400">
                        Total {{ $kegiatans->total() }} kegiatan
                    </p>

                </div>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full min-w-[950px] text-left">

                    <thead class="bg-slate-50">

                        <tr class="border-b border-slate-200">

                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-slate-400">
                                #
                            </th>

                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Kegiatan
                            </th>

                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Program
                            </th>

                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Kode
                            </th>

                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Status
                            </th>

                            <th class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse($kegiatans as $kegiatan)
                            <tr class="transition hover:bg-slate-50/70">

                                {{-- Number --}}
                                <td class="px-5 py-4 text-sm text-slate-400">

                                    {{ $kegiatans->firstItem() + $loop->index }}

                                </td>


                                {{-- Kegiatan --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-600">

                                            <i class="bi bi-list-check"></i>

                                        </div>


                                        <div class="min-w-0">

                                            <p class="truncate text-sm font-semibold text-slate-800">
                                                {{ $kegiatan->kegiatan_name }}
                                            </p>

                                            @if ($kegiatan->kegiatan_description)
                                                <p class="mt-0.5 max-w-md truncate text-xs text-slate-400">
                                                    {{ $kegiatan->kegiatan_description }}
                                                </p>
                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Program --}}
                                <td class="px-5 py-4">

                                    @if ($kegiatan->program_name)
                                        <span
                                            class="inline-flex items-center gap-2 rounded-lg bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-600">

                                            <i class="bi bi-diagram-3"></i>

                                            {{ $kegiatan->program_name }}

                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400">
                                            Program tidak ditemukan
                                        </span>
                                    @endif

                                </td>


                                {{-- Code --}}
                                <td class="px-5 py-4">

                                    @if ($kegiatan->kegiatan_code)
                                        <span
                                            class="rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">
                                            {{ $kegiatan->kegiatan_code }}
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400">
                                            —
                                        </span>
                                    @endif

                                </td>


                                {{-- Status --}}
                                <td class="px-5 py-4">

                                    @if ($kegiatan->kegiatan_is_active)
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-600">

                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                            Aktif

                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-500">

                                            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>

                                            Nonaktif

                                        </span>
                                    @endif

                                </td>


                                {{-- Action --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center justify-end gap-2">

                                        <a href="{{ route('sadarin.admin.master.kegiatan.edit', $kegiatan->kegiatan_id) }}"
                                            title="Edit"
                                            class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-500 transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-600">

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                        @if ($kegiatan->kegiatan_is_active)
                                            <form
                                                action="{{ route('sadarin.admin.master.kegiatan.destroy', $kegiatan->kegiatan_id) }}"
                                                method="POST" onsubmit="return confirm('Nonaktifkan kegiatan ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" title="Nonaktifkan"
                                                    class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-500 transition hover:border-rose-200 hover:bg-rose-50 hover:text-rose-600">

                                                    <i class="bi bi-power"></i>

                                                </button>

                                            </form>
                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="px-5 py-16 text-center">

                                    <div class="flex flex-col items-center">

                                        <div
                                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                                            <i class="bi bi-list-check text-2xl"></i>

                                        </div>

                                        <h3 class="mt-4 text-sm font-semibold text-slate-700">
                                            Belum ada kegiatan
                                        </h3>

                                        <p class="mt-1 text-xs text-slate-400">
                                            Silakan tambahkan kegiatan pertama.
                                        </p>

                                        <a href="{{ route('sadarin.admin.master.kegiatan.create') }}"
                                            class="mt-4 text-sm font-semibold text-[oklch(29.3%_0.136_325.661)] hover:underline">

                                            + Tambah Kegiatan

                                        </a>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            @if ($kegiatans->hasPages())
                <div class="border-t border-slate-200 px-5 py-4">

                    {{ $kegiatans->links() }}

                </div>
            @endif

        </div>

    </div>
@endsection
