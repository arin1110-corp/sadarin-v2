@extends('dashboard.layouts.app')

@section('title', 'SADARIN - Dashboard')

@section('content')

    {{-- ============================================================
        PAGE HEADING
    ============================================================ --}}
    <div class="mb-7 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">

        <div>
            <p class="mb-1 text-sm font-medium text-[oklch(29.3%_0.136_325.661)]">
                Overview
            </p>

            <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                Selamat datang, Administrator
            </h2>

            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
                Pantau arsip, proses verifikasi, klasifikasi, dan aktivitas sistem
                SADARIN dari satu tempat.
            </p>
        </div>


        <div class="flex items-center gap-2">

            {{-- Export --}}
            <button
                type="button"
                class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:bg-slate-50">

                <i class="bi bi-download"></i>

                <span class="hidden sm:inline">
                    Export
                </span>

            </button>


            {{-- Tambah Arsip --}}
            <a
                href="{{ route('sadarin.admin.archive.create') }}"
                class="inline-flex items-center gap-2 rounded-xl bg-[oklch(29.3%_0.136_325.661)] px-4 py-2.5 text-sm font-semibold text-white shadow-sm shadow-[oklch(29.3%_0.136_325.661)]/20 transition hover:opacity-90">

                <i class="bi bi-plus-lg"></i>

                <span>
                    Tambah Arsip
                </span>

            </a>

        </div>

    </div>


    {{-- ============================================================
        STATISTIC CARDS
    ============================================================ --}}
    <div class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">


        {{-- TOTAL ARSIP --}}
        <div class="stat-card rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Total Arsip
                    </p>

                    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">
                        {{ number_format($totalArsip, 0, ',', '.') }}
                    </p>

                    <div class="mt-3 flex items-center gap-1.5 text-xs font-medium text-blue-600">

                        <i class="bi bi-archive"></i>

                        <span>
                            {{ number_format($arsipBulanIni, 0, ',', '.') }}
                        </span>

                        <span class="font-normal text-slate-400">
                            bulan ini
                        </span>

                    </div>

                </div>


                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600">

                    <i class="bi bi-archive-fill text-xl"></i>

                </div>

            </div>

        </div>


        {{-- MENUNGGU VERIFIKASI --}}
        <div class="stat-card rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Menunggu Verifikasi
                    </p>

                    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">
                        {{ number_format($menungguVerifikasi, 0, ',', '.') }}
                    </p>

                    <div class="mt-3 flex items-center gap-1.5 text-xs font-medium text-amber-600">

                        <i class="bi bi-clock"></i>

                        <span>
                            Perlu ditinjau
                        </span>

                    </div>

                </div>


                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-600">

                    <i class="bi bi-hourglass-split text-xl"></i>

                </div>

            </div>

        </div>


        {{-- TERVERIFIKASI --}}
        <div class="stat-card rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Terverifikasi
                    </p>

                    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">
                        {{ number_format($terverifikasi, 0, ',', '.') }}
                    </p>

                    <div class="mt-3 flex items-center gap-1.5 text-xs font-medium text-emerald-600">

                        <i class="bi bi-check-circle"></i>

                        <span>
                            {{ $persentaseTerverifikasi }}%
                        </span>

                        <span class="font-normal text-slate-400">
                            dari total
                        </span>

                    </div>

                </div>


                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                    <i class="bi bi-patch-check-fill text-xl"></i>

                </div>

            </div>

        </div>


        {{-- DIKEMBALIKAN --}}
        <div class="stat-card rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Dikembalikan
                    </p>

                    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">
                        {{ number_format($dikembalikan, 0, ',', '.') }}
                    </p>

                    <div class="mt-3 flex items-center gap-1.5 text-xs font-medium text-rose-600">

                        <i class="bi bi-arrow-return-left"></i>

                        <span>
                            Perlu perbaikan
                        </span>

                    </div>

                </div>


                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-rose-50 text-rose-600">

                    <i class="bi bi-file-earmark-x-fill text-xl"></i>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
        MAIN GRID
    ============================================================ --}}
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">


        {{-- ========================================================
            ARSIP TERBARU
        ========================================================= --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm xl:col-span-2">

            <div class="flex items-center justify-between border-b border-slate-100 px-5 py-5">

                <div>

                    <h3 class="font-bold text-slate-900">
                        Arsip Terbaru
                    </h3>

                    <p class="mt-1 text-xs text-slate-400">
                        Arsip yang baru ditambahkan ke sistem
                    </p>

                </div>


                <a
                    href="{{ route('sadarin.admin.archive.index') }}"
                    class="text-sm font-semibold text-[oklch(29.3%_0.136_325.661)] hover:underline">

                    Lihat semua

                </a>

            </div>


            <div class="divide-y divide-slate-100">

                @forelse ($arsipTerbaru as $arsip)

                    <a
                        href="{{ route('sadarin.admin.archive.show', $arsip->archive_id) }}"
                        class="flex items-center gap-4 px-5 py-4 transition hover:bg-slate-50">

                        {{-- ICON --}}
                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600">

                            <i class="bi bi-file-earmark-text-fill text-lg"></i>

                        </div>


                        {{-- CONTENT --}}
                        <div class="min-w-0 flex-1">

                            <p class="truncate text-sm font-semibold text-slate-800">

                                {{ $arsip->archive_title
                                    ?? $arsip->archive_name
                                    ?? 'Arsip tanpa judul' }}

                            </p>


                            <div class="mt-1 flex flex-wrap items-center gap-x-2 gap-y-1 text-xs text-slate-400">

                                @if (!empty($arsip->archive_year))
                                    <span>
                                        {{ $arsip->archive_year }}
                                    </span>

                                    <span>
                                        •
                                    </span>
                                @endif

                                <span>
                                    {{ optional($arsip->archive_created_at)->diffForHumans() }}
                                </span>

                            </div>

                        </div>


                        {{-- STATUS --}}
                        @php

                            $status = $arsip->archive_status ?? null;

                            $statusConfig = match ($status) {

                                'verified' => [
                                    'label' => 'Terverifikasi',
                                    'class' => 'bg-emerald-50 text-emerald-600',
                                ],

                                'pending' => [
                                    'label' => 'Menunggu',
                                    'class' => 'bg-amber-50 text-amber-600',
                                ],

                                'returned' => [
                                    'label' => 'Dikembalikan',
                                    'class' => 'bg-rose-50 text-rose-600',
                                ],

                                default => [
                                    'label' => ucfirst($status ?? 'Belum ditentukan'),
                                    'class' => 'bg-slate-100 text-slate-600',
                                ],

                            };

                        @endphp


                        <span
                            class="hidden rounded-full px-2.5 py-1 text-[11px] font-semibold sm:inline-flex {{ $statusConfig['class'] }}">

                            {{ $statusConfig['label'] }}

                        </span>

                    </a>

                @empty

                    {{-- EMPTY --}}
                    <div class="px-5 py-12 text-center">

                        <div
                            class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">

                            <i class="bi bi-archive text-xl"></i>

                        </div>

                        <p class="mt-4 text-sm font-semibold text-slate-700">
                            Belum ada arsip
                        </p>

                        <p class="mt-1 text-xs text-slate-400">
                            Arsip yang ditambahkan akan muncul di sini.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>


        {{-- ========================================================
            AKTIVITAS TERBARU
        ========================================================= --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="flex items-center justify-between border-b border-slate-100 px-5 py-5">

                <div>

                    <h3 class="font-bold text-slate-900">
                        Aktivitas Terbaru
                    </h3>

                    <p class="mt-1 text-xs text-slate-400">
                        Aktivitas pengguna sistem
                    </p>

                </div>


                <a
                    href="{{ route('sadarin.admin.access-log.index') }}"
                    class="text-sm font-semibold text-[oklch(29.3%_0.136_325.661)] hover:underline">

                    Semua

                </a>

            </div>


            <div class="p-5">

                <div class="space-y-6">

                    @forelse ($aktivitasTerbaru as $aktivitas)

                        <div class="flex gap-3">

                            {{-- ICON --}}
                            <div
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-blue-50 text-blue-600">

                                <i class="bi bi-activity text-sm"></i>

                            </div>


                            <div class="min-w-0 flex-1">

                                <p class="text-sm leading-5 text-slate-600">

                                    <span class="font-semibold text-slate-800">

                                        {{ $aktivitas->access_log_user_type
                                            ?? 'Pengguna' }}

                                    </span>

                                    {{ $aktivitas->access_log_action
                                        ?? 'melakukan aktivitas pada sistem.' }}

                                </p>


                                <p class="mt-1 text-xs text-slate-400">

                                    {{ optional($aktivitas->access_log_created_at)->diffForHumans() }}

                                </p>

                            </div>

                        </div>

                    @empty

                        <div class="py-8 text-center">

                            <div
                                class="mx-auto flex h-11 w-11 items-center justify-center rounded-full bg-slate-100 text-slate-400">

                                <i class="bi bi-clock-history"></i>

                            </div>

                            <p class="mt-3 text-sm font-semibold text-slate-700">
                                Belum ada aktivitas
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Aktivitas sistem akan muncul di sini.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
        KLASIFIKASI ARSIP
    ============================================================ --}}
    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">

        <div class="mb-5 flex items-center justify-between">

            <div>

                <h3 class="font-bold text-slate-900">
                    Klasifikasi Arsip
                </h3>

                <p class="mt-1 text-xs text-slate-400">
                    Ringkasan master yang digunakan untuk pengelompokan arsip
                </p>

            </div>

        </div>


        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-6">


            {{-- UNIT --}}
            <a
                href="{{ route('sadarin.admin.master.unit.index') }}"
                class="group rounded-xl border border-slate-100 bg-slate-50 p-4 transition hover:border-blue-100 hover:bg-blue-50">

                <div
                    class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 text-blue-600">

                    <i class="bi bi-building-fill"></i>

                </div>

                <p class="text-sm font-semibold text-slate-800">
                    Unit
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    {{ number_format($jumlahUnit, 0, ',', '.') }} unit
                </p>

            </a>


            {{-- PROGRAM --}}
            <a
                href="{{ route('sadarin.admin.master.program.index') }}"
                class="group rounded-xl border border-slate-100 bg-slate-50 p-4 transition hover:border-emerald-100 hover:bg-emerald-50">

                <div
                    class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">

                    <i class="bi bi-diagram-3-fill"></i>

                </div>

                <p class="text-sm font-semibold text-slate-800">
                    Program
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    {{ number_format($jumlahProgram, 0, ',', '.') }} program
                </p>

            </a>


            {{-- KEGIATAN --}}
            <a
                href="{{ route('sadarin.admin.master.kegiatan.index') }}"
                class="group rounded-xl border border-slate-100 bg-slate-50 p-4 transition hover:border-indigo-100 hover:bg-indigo-50">

                <div
                    class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">

                    <i class="bi bi-list-check"></i>

                </div>

                <p class="text-sm font-semibold text-slate-800">
                    Kegiatan
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    {{ number_format($jumlahKegiatan, 0, ',', '.') }} kegiatan
                </p>

            </a>


            {{-- SUB KEGIATAN --}}
            <a
                href="{{ route('sadarin.admin.master.sub-kegiatan.index') }}"
                class="group rounded-xl border border-slate-100 bg-slate-50 p-4 transition hover:border-orange-100 hover:bg-orange-50">

                <div
                    class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-orange-100 text-orange-600">

                    <i class="bi bi-list-nested"></i>

                </div>

                <p class="text-sm font-semibold text-slate-800">
                    Sub Kegiatan
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    {{ number_format($jumlahSubKegiatan, 0, ',', '.') }} sub kegiatan
                </p>

            </a>


            {{-- JENIS DOKUMEN --}}
            <a
                href="{{ route('sadarin.admin.master.document-type.index') }}"
                class="group rounded-xl border border-slate-100 bg-slate-50 p-4 transition hover:border-rose-100 hover:bg-rose-50">

                <div
                    class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-rose-100 text-rose-600">

                    <i class="bi bi-file-earmark-text-fill"></i>

                </div>

                <p class="text-sm font-semibold text-slate-800">
                    Jenis Dokumen
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    {{ number_format($jumlahJenisDokumen, 0, ',', '.') }} jenis
                </p>

            </a>


            {{-- TAG --}}
            <a
                href="{{ route('sadarin.admin.master.tag.index') }}"
                class="group rounded-xl border border-slate-100 bg-slate-50 p-4 transition hover:border-amber-100 hover:bg-amber-50">

                <div
                    class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-amber-100 text-amber-600">

                    <i class="bi bi-tags-fill"></i>

                </div>

                <p class="text-sm font-semibold text-slate-800">
                    Tag
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    {{ number_format($jumlahTag, 0, ',', '.') }} tag
                </p>

            </a>

        </div>

    </div>


    {{-- ============================================================
        FOOTER INFO
    ============================================================ --}}
    <div class="mt-6 rounded-2xl border border-slate-200 bg-white px-5 py-4 shadow-sm">

        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

                <div
                    class="flex h-9 w-9 items-center justify-center rounded-lg bg-[oklch(29.3%_0.136_325.661)]/10 text-[oklch(29.3%_0.136_325.661)]">

                    <i class="bi bi-shield-check"></i>

                </div>

                <div>

                    <p class="text-sm font-semibold text-slate-800">
                        SADARIN
                    </p>

                    <p class="text-xs text-slate-400">
                        Sistem Arsip Data dan Berkas Internal
                    </p>

                </div>

            </div>


            <p class="text-xs text-slate-400">
                Data dashboard diperbarui berdasarkan data sistem.
            </p>

        </div>

    </div>

@endsection