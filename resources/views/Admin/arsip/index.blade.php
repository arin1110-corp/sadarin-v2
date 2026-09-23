@extends('Dashboard.layouts.app')

@section('title', 'Arsip')
@section('page_title', 'Arsip')
@section('breadcrumb', 'Administrasi Sistem / Arsip')

@section('content')

    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <i class="bi bi-archive-fill text-xl"></i>
                    </div>

                    <div>
                        <h1 class="text-xl font-bold text-slate-800">
                            Arsip
                        </h1>

                        <p class="mt-0.5 text-sm text-slate-500">
                            Kelola arsip dan dokumen internal SADARIN.
                        </p>
                    </div>

                </div>
            </div>

            <a href="{{ route('sadarin.admin.archive.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl
                       bg-[oklch(29.3%_0.136_325.661)] px-4 py-2.5
                       text-sm font-semibold text-white shadow-sm
                       transition hover:opacity-90">

                <i class="bi bi-plus-lg"></i>

                Tambah Arsip

            </a>

        </div>


        {{-- SUCCESS --}}
        @if (session('success'))
            <div
                class="flex items-start gap-3 rounded-xl border border-emerald-200
                       bg-emerald-50 px-4 py-3 text-sm text-emerald-700">

                <i class="bi bi-check-circle-fill mt-0.5"></i>

                <span>
                    {{ session('success') }}
                </span>

            </div>
        @endif


        {{-- ERROR --}}
        @if ($errors->any())

            <div class="rounded-xl border border-red-200 bg-red-50
                       px-4 py-3 text-sm text-red-700">

                <div class="flex items-center gap-2 font-semibold">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    Terjadi kesalahan.
                </div>

                <ul class="mt-2 list-inside list-disc text-xs">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        {{-- SEARCH --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

            <form method="GET" action="{{ route('sadarin.admin.archive.index') }}">

                <div class="flex flex-col gap-3 sm:flex-row">

                    <div class="relative flex-1">

                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">

                            <i class="bi bi-search text-slate-400"></i>

                        </div>

                        <input type="text" name="search" value="{{ $search }}"
                            placeholder="Cari judul atau deskripsi arsip..."
                            class="w-full rounded-xl border border-slate-200
                                   bg-slate-50 py-2.5 pl-10 pr-4
                                   text-sm text-slate-700 outline-none
                                   transition
                                   focus:border-[oklch(29.3%_0.136_325.661)]
                                   focus:bg-white focus:ring-2
                                   focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                    </div>

                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl
                               bg-slate-800 px-5 py-2.5
                               text-sm font-semibold text-white
                               transition hover:bg-slate-700">

                        <i class="bi bi-search"></i>

                        Cari

                    </button>

                    @if ($search)
                        <a href="{{ route('sadarin.admin.archive.index') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl
                                   border border-slate-200 bg-white px-5 py-2.5
                                   text-sm font-semibold text-slate-600
                                   transition hover:bg-slate-50">

                            <i class="bi bi-x-lg"></i>

                            Reset

                        </a>
                    @endif

                </div>

            </form>

        </div>


        {{-- TABLE --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="overflow-x-auto">

                <table class="min-w-[1000px] w-full">

                    <thead class="border-b border-slate-100 bg-slate-50">

                        <tr>

                            <th
                                class="w-16 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                #
                            </th>

                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Arsip
                            </th>

                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Jenis Dokumen
                            </th>

                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Tanggal
                            </th>

                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Akses
                            </th>

                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Status
                            </th>

                            <th
                                class="w-32 px-5 py-3 text-center text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse ($archives as $archive)
                            <tr class="transition hover:bg-slate-50">

                                {{-- NO --}}
                                <td class="px-5 py-4 text-sm text-slate-400">

                                    {{ $archives->firstItem() + $loop->index }}

                                </td>


                                {{-- ARSIP --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-start gap-3">

                                        <div
                                            class="flex h-10 w-10 shrink-0 items-center justify-center
                                                   rounded-xl bg-blue-50 text-blue-600">

                                            <i class="bi bi-file-earmark-text-fill"></i>

                                        </div>

                                        <div class="min-w-0">

                                            <div class="font-semibold text-slate-700">
                                                {{ $archive->archive_title }}
                                            </div>

                                            @if ($archive->archive_description)
                                                <div class="mt-1 max-w-[380px] truncate text-xs text-slate-400">
                                                    {{ $archive->archive_description }}
                                                </div>
                                            @endif

                                            @if ($archive->archive_year)
                                                <div class="mt-1 text-xs text-slate-400">

                                                    <i class="bi bi-calendar3 mr-1"></i>

                                                    Tahun {{ $archive->archive_year }}

                                                </div>
                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- JENIS DOKUMEN --}}
                                <td class="px-5 py-4">

                                    @if ($archive->documentType)
                                        <span
                                            class="inline-flex items-center rounded-lg
                                                   bg-violet-50 px-2.5 py-1
                                                   text-xs font-semibold text-violet-700">

                                            {{ $archive->documentType->document_type_name }}

                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400">
                                            -
                                        </span>
                                    @endif

                                </td>


                                {{-- TANGGAL --}}
                                <td class="whitespace-nowrap px-5 py-4">

                                    @if ($archive->archive_date)
                                        <div class="text-sm font-medium text-slate-700">

                                            {{ $archive->archive_date->format('d M Y') }}

                                        </div>
                                    @else
                                        <span class="text-xs text-slate-400">
                                            -
                                        </span>
                                    @endif

                                </td>


                                {{-- AKSES --}}
                                <td class="px-5 py-4">

                                    @php
                                        $accessClass = match ($archive->archive_access_level) {
                                            'public' => 'bg-emerald-50 text-emerald-700',
                                            'internal' => 'bg-blue-50 text-blue-700',
                                            'restricted' => 'bg-red-50 text-red-700',
                                            default => 'bg-slate-100 text-slate-600',
                                        };

                                        $accessLabel = match ($archive->archive_access_level) {
                                            'public' => 'Publik',
                                            'internal' => 'Internal',
                                            'restricted' => 'Terbatas',
                                            default => ucfirst($archive->archive_access_level),
                                        };
                                    @endphp

                                    <span
                                        class="inline-flex items-center rounded-lg px-2.5 py-1
                                               text-xs font-semibold {{ $accessClass }}">

                                        {{ $accessLabel }}

                                    </span>

                                </td>


                                {{-- STATUS --}}
                                <td class="px-5 py-4">

                                    @php
                                        $statusClass = match ($archive->archive_status) {
                                            'draft' => 'bg-slate-100 text-slate-600',
                                            'pending' => 'bg-amber-50 text-amber-700',
                                            'verified' => 'bg-emerald-50 text-emerald-700',
                                            'rejected' => 'bg-red-50 text-red-700',
                                            default => 'bg-slate-100 text-slate-600',
                                        };

                                        $statusLabel = match ($archive->archive_status) {
                                            'draft' => 'Draft',
                                            'pending' => 'Menunggu Verifikasi',
                                            'verified' => 'Terverifikasi',
                                            'rejected' => 'Ditolak',
                                            default => ucfirst($archive->archive_status),
                                        };
                                    @endphp

                                    <span
                                        class="inline-flex items-center rounded-lg px-2.5 py-1
                                               text-xs font-semibold {{ $statusClass }}">

                                        {{ $statusLabel }}

                                    </span>

                                </td>


                                {{-- AKSI --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center justify-center gap-1">

                                        {{-- SHOW --}}
                                        <a href="{{ route('sadarin.admin.archive.show', $archive->archive_id) }}"
                                            title="Lihat"
                                            class="flex h-9 w-9 items-center justify-center rounded-lg
                                                   text-blue-600 transition hover:bg-blue-50">

                                            <i class="bi bi-eye-fill"></i>

                                        </a>


                                        {{-- EDIT --}}
                                        <a href="{{ route('sadarin.admin.archive.edit', $archive->archive_id) }}"
                                            title="Edit"
                                            class="flex h-9 w-9 items-center justify-center rounded-lg
                                                   text-amber-600 transition hover:bg-amber-50">

                                            <i class="bi bi-pencil-fill"></i>

                                        </a>


                                        {{-- DELETE --}}
                                        <form action="{{ route('sadarin.admin.archive.destroy', $archive->archive_id) }}"
                                            method="POST" onsubmit="return confirm('Yakin ingin menghapus arsip ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" title="Hapus"
                                                class="flex h-9 w-9 items-center justify-center rounded-lg
                                                       text-red-600 transition hover:bg-red-50">

                                                <i class="bi bi-trash-fill"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="px-5 py-16 text-center">

                                    <div
                                        class="mx-auto flex h-14 w-14 items-center justify-center
                                               rounded-2xl bg-slate-100 text-slate-400">

                                        <i class="bi bi-archive text-2xl"></i>

                                    </div>

                                    <div class="mt-4 text-sm font-semibold text-slate-700">
                                        Belum ada arsip
                                    </div>

                                    <p class="mt-1 text-xs text-slate-400">
                                        Belum ada data arsip yang tersimpan.
                                    </p>

                                    <a href="{{ route('sadarin.admin.archive.create') }}"
                                        class="mt-4 inline-flex items-center gap-2 rounded-xl
                                               bg-[oklch(29.3%_0.136_325.661)]
                                               px-4 py-2 text-xs font-semibold text-white
                                               hover:opacity-90">

                                        <i class="bi bi-plus-lg"></i>

                                        Tambah Arsip

                                    </a>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            @if ($archives->hasPages())
                <div class="flex justify-center border-t border-slate-100 px-5 py-4">

                    {{ $archives->links() }}

                </div>
            @endif

        </div>

    </div>

@endsection
