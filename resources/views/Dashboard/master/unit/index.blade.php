@extends('Dashboard.layouts.app')

@section('content')
    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <div class="flex items-center gap-2 text-sm text-slate-400">
                    <span>Master Data</span>
                    <i class="bi bi-chevron-right text-xs"></i>
                    <span class="text-slate-600">Unit</span>
                </div>

                <h1 class="mt-2 text-2xl font-bold text-slate-800">
                    Unit
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Kelola data unit atau organisasi yang digunakan dalam pengarsipan.
                </p>
            </div>

            <a href="{{ route('sadarin.admin.master.unit.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[oklch(29.3%_0.136_325.661)] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:opacity-90">

                <i class="bi bi-plus-lg"></i>

                Tambah Unit
            </a>

        </div>


        {{-- Alert --}}
        @if (session('success'))
            <div
                class="flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-700">

                <i class="bi bi-check-circle-fill mt-0.5"></i>

                <div class="text-sm font-medium">
                    {{ session('success') }}
                </div>

            </div>
        @endif


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

            <form method="GET" action="{{ route('sadarin.admin.master.unit.index') }}">

                <div class="flex flex-col gap-3 sm:flex-row">

                    <div class="relative flex-1">

                        <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama atau kode unit..."
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-11 pr-4 text-sm text-slate-700 outline-none transition focus:border-[oklch(29.3%_0.136_325.661)] focus:bg-white focus:ring-2 focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                    </div>

                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-800 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700">

                        <i class="bi bi-search"></i>

                        Cari

                    </button>

                    @if (request('search'))
                        <a href="{{ route('sadarin.master.unit.index') }}"
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

            {{-- Table Header --}}
            <div
                class="flex flex-col gap-2 border-b border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <h2 class="text-sm font-bold text-slate-800">
                        Daftar Unit
                    </h2>

                    <p class="mt-0.5 text-xs text-slate-400">
                        Total {{ $units->total() }} unit
                    </p>
                </div>

            </div>


            {{-- Responsive Table --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[850px] text-left">

                    <thead class="bg-slate-50">

                        <tr class="border-b border-slate-200">

                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-slate-400">
                                #
                            </th>

                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Unit
                            </th>

                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Kode
                            </th>

                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Tipe
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

                        @forelse($units as $unit)
                            <tr class="transition hover:bg-slate-50/70">

                                {{-- Number --}}
                                <td class="px-5 py-4 text-sm text-slate-400">

                                    {{ $units->firstItem() + $loop->index }}

                                </td>


                                {{-- Unit --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl
                                        {{ $unit->unit_type === 'bidang' ? 'bg-blue-50 text-blue-600' : 'bg-amber-50 text-amber-600' }}">

                                            <i
                                                class="bi
                                            {{ $unit->unit_type === 'bidang' ? 'bi-building' : 'bi-buildings' }}">
                                            </i>

                                        </div>

                                        <div class="min-w-0">

                                            <p class="truncate text-sm font-semibold text-slate-800">
                                                {{ $unit->unit_name }}
                                            </p>

                                            @if ($unit->unit_description)
                                                <p class="mt-0.5 max-w-md truncate text-xs text-slate-400">
                                                    {{ $unit->unit_description }}
                                                </p>
                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Code --}}
                                <td class="px-5 py-4">

                                    @if ($unit->unit_code)
                                        <span
                                            class="rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">
                                            {{ $unit->unit_code }}
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400">
                                            —
                                        </span>
                                    @endif

                                </td>


                                {{-- Type --}}
                                <td class="px-5 py-4">

                                    @if ($unit->unit_type === 'induk')
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-600">

                                            <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>

                                            Induk

                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-600">

                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                            UPTD

                                        </span>
                                    @endif

                                </td>


                                {{-- Status --}}
                                <td class="px-5 py-4">

                                    @if ($unit->unit_is_active)
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

                                        {{-- Edit --}}
                                        <a href="{{ route('sadarin.admin.master.unit.edit', $unit->unit_id) }}" title="Edit"
                                            class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-500 transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-600">

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                        {{-- Deactivate --}}
                                        @if ($unit->unit_is_active)
                                            <form action="{{ route('sadarin.admin.master.unit.destroy', $unit->unit_id) }}"
                                                method="POST" onsubmit="return confirm('Nonaktifkan unit ini?')">

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

                                            <i class="bi bi-building text-2xl"></i>

                                        </div>

                                        <h3 class="mt-4 text-sm font-semibold text-slate-700">
                                            Belum ada unit
                                        </h3>

                                        <p class="mt-1 text-xs text-slate-400">
                                            Silakan tambahkan unit pertama.
                                        </p>

                                        <a href="{{ route('sadarin.admin.master.unit.create') }}"
                                            class="mt-4 text-sm font-semibold text-[oklch(29.3%_0.136_325.661)] hover:underline">

                                            + Tambah Unit

                                        </a>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            @if ($units->hasPages())
                <div class="border-t border-slate-200 px-5 py-4">

                    {{ $units->links() }}

                </div>
            @endif

        </div>

    </div>
@endsection
