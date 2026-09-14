@extends('dashboard.layouts.app')

@section('title', 'SADARIN - Dashboard')

@section('content')

    {{-- Page Heading --}}
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

            <button type="button"
                class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm hover:bg-slate-50">

                <i class="bi bi-download"></i>

                <span class="hidden sm:inline">
                    Export
                </span>

            </button>

            <a href="#"
                class="inline-flex items-center gap-2 rounded-xl bg-[oklch(29.3%_0.136_325.661)] px-4 py-2.5 text-sm font-semibold text-white shadow-sm shadow-[oklch(29.3%_0.136_325.661)]/20 transition hover:opacity-90">

                <i class="bi bi-plus-lg"></i>

                <span>
                    Tambah Arsip
                </span>

            </a>

        </div>

    </div>


    {{-- Statistic Cards --}}
    <div class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">


        {{-- Total Arsip --}}
        <div class="stat-card rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Total Arsip
                    </p>

                    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">
                        1.248
                    </p>

                    <div class="mt-3 flex items-center gap-1.5 text-xs font-medium text-emerald-600">
                        <i class="bi bi-arrow-up-right"></i>
                        <span>8,2%</span>
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


        {{-- Pending --}}
        <div class="stat-card rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Menunggu Verifikasi
                    </p>

                    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">
                        32
                    </p>

                    <div class="mt-3 flex items-center gap-1.5 text-xs font-medium text-amber-600">
                        <i class="bi bi-clock"></i>
                        <span>Perlu ditinjau</span>
                    </div>
                </div>


                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                    <i class="bi bi-hourglass-split text-xl"></i>
                </div>

            </div>

        </div>


        {{-- Verified --}}
        <div class="stat-card rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Terverifikasi
                    </p>

                    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">
                        1.180
                    </p>

                    <div class="mt-3 flex items-center gap-1.5 text-xs font-medium text-emerald-600">
                        <i class="bi bi-check-circle"></i>
                        <span>94,6%</span>
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


        {{-- Rejected --}}
        <div class="stat-card rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Dikembalikan
                    </p>

                    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">
                        36
                    </p>

                    <div class="mt-3 flex items-center gap-1.5 text-xs font-medium text-rose-600">
                        <i class="bi bi-arrow-return-left"></i>
                        <span>Perlu perbaikan</span>
                    </div>
                </div>


                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-rose-50 text-rose-600">
                    <i class="bi bi-file-earmark-x-fill text-xl"></i>
                </div>

            </div>

        </div>

    </div>


    {{-- Main Grid --}}
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">


        {{-- Arsip Terbaru --}}
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

                <a href="#" class="text-sm font-semibold text-[oklch(29.3%_0.136_325.661)] hover:underline">
                    Lihat semua
                </a>

            </div>


            <div class="divide-y divide-slate-100">


                {{-- Item --}}
                <div class="flex items-center gap-4 px-5 py-4">

                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <i class="bi bi-file-earmark-text-fill text-lg"></i>
                    </div>

                    <div class="min-w-0 flex-1">

                        <p class="truncate text-sm font-semibold text-slate-800">
                            Laporan Pelaksanaan Kegiatan
                        </p>

                        <div class="mt-1 flex flex-wrap items-center gap-x-2 gap-y-1 text-xs text-slate-400">
                            <span>Program Kebudayaan</span>
                            <span>•</span>
                            <span>2026</span>
                        </div>

                    </div>

                    <span
                        class="hidden rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-semibold text-emerald-600 sm:inline-flex">
                        Terverifikasi
                    </span>

                    <span class="hidden text-xs text-slate-400 md:block">
                        5 menit lalu
                    </span>

                </div>


                {{-- Item --}}
                <div class="flex items-center gap-4 px-5 py-4">

                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                        <i class="bi bi-file-earmark-pdf-fill text-lg"></i>
                    </div>

                    <div class="min-w-0 flex-1">

                        <p class="truncate text-sm font-semibold text-slate-800">
                            Dokumen Perencanaan Program
                        </p>

                        <div class="mt-1 flex flex-wrap items-center gap-x-2 gap-y-1 text-xs text-slate-400">
                            <span>Dokumen Perencanaan</span>
                            <span>•</span>
                            <span>2026</span>
                        </div>

                    </div>

                    <span
                        class="hidden rounded-full bg-amber-50 px-2.5 py-1 text-[11px] font-semibold text-amber-600 sm:inline-flex">
                        Menunggu
                    </span>

                    <span class="hidden text-xs text-slate-400 md:block">
                        18 menit lalu
                    </span>

                </div>


                {{-- Item --}}
                <div class="flex items-center gap-4 px-5 py-4">

                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                        <i class="bi bi-folder-fill text-lg"></i>
                    </div>

                    <div class="min-w-0 flex-1">

                        <p class="truncate text-sm font-semibold text-slate-800">
                            Berita Acara Kegiatan
                        </p>

                        <div class="mt-1 flex flex-wrap items-center gap-x-2 gap-y-1 text-xs text-slate-400">
                            <span>Administrasi Kegiatan</span>
                            <span>•</span>
                            <span>2026</span>
                        </div>

                    </div>

                    <span
                        class="hidden rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-semibold text-emerald-600 sm:inline-flex">
                        Terverifikasi
                    </span>

                    <span class="hidden text-xs text-slate-400 md:block">
                        1 jam lalu
                    </span>

                </div>


                {{-- Item --}}
                <div class="flex items-center gap-4 px-5 py-4">

                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-rose-50 text-rose-600">
                        <i class="bi bi-file-earmark-richtext-fill text-lg"></i>
                    </div>

                    <div class="min-w-0 flex-1">

                        <p class="truncate text-sm font-semibold text-slate-800">
                            Dokumentasi Kegiatan
                        </p>

                        <div class="mt-1 flex flex-wrap items-center gap-x-2 gap-y-1 text-xs text-slate-400">
                            <span>Dokumentasi</span>
                            <span>•</span>
                            <span>2026</span>
                        </div>

                    </div>

                    <span
                        class="hidden rounded-full bg-rose-50 px-2.5 py-1 text-[11px] font-semibold text-rose-600 sm:inline-flex">
                        Dikembalikan
                    </span>

                    <span class="hidden text-xs text-slate-400 md:block">
                        2 jam lalu
                    </span>

                </div>

            </div>

        </div>


        {{-- Aktivitas Terbaru --}}
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

                <a href="#" class="text-sm font-semibold text-[oklch(29.3%_0.136_325.661)] hover:underline">
                    Semua
                </a>

            </div>


            <div class="p-5">

                <div class="space-y-6">


                    {{-- Activity --}}
                    <div class="flex gap-3">

                        <div class="relative">

                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-50 text-blue-600">
                                <i class="bi bi-upload text-sm"></i>
                            </div>

                        </div>

                        <div class="min-w-0 flex-1">

                            <p class="text-sm leading-5 text-slate-600">
                                <span class="font-semibold text-slate-800">
                                    Administrator
                                </span>
                                menambahkan arsip baru.
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                5 menit lalu
                            </p>

                        </div>

                    </div>


                    {{-- Activity --}}
                    <div class="flex gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-50 text-emerald-600">
                            <i class="bi bi-check-lg text-sm"></i>
                        </div>

                        <div class="min-w-0 flex-1">

                            <p class="text-sm leading-5 text-slate-600">
                                <span class="font-semibold text-slate-800">
                                    Arsiparis
                                </span>
                                memverifikasi sebuah arsip.
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                18 menit lalu
                            </p>

                        </div>

                    </div>


                    {{-- Activity --}}
                    <div class="flex gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-amber-50 text-amber-600">
                            <i class="bi bi-pencil-square text-sm"></i>
                        </div>

                        <div class="min-w-0 flex-1">

                            <p class="text-sm leading-5 text-slate-600">
                                <span class="font-semibold text-slate-800">
                                    Pengguna Internal
                                </span>
                                memperbarui metadata arsip.
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                42 menit lalu
                            </p>

                        </div>

                    </div>


                    {{-- Activity --}}
                    <div class="flex gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-violet-50 text-violet-600">
                            <i class="bi bi-person-plus-fill text-sm"></i>
                        </div>

                        <div class="min-w-0 flex-1">

                            <p class="text-sm leading-5 text-slate-600">
                                <span class="font-semibold text-slate-800">
                                    Administrator
                                </span>
                                menambahkan pengguna baru.
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                1 jam lalu
                            </p>

                        </div>

                    </div>


                    {{-- Activity --}}
                    <div class="flex gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-rose-50 text-rose-600">
                            <i class="bi bi-x-lg text-sm"></i>
                        </div>

                        <div class="min-w-0 flex-1">

                            <p class="text-sm leading-5 text-slate-600">
                                Sebuah arsip
                                <span class="font-semibold text-slate-800">
                                    dikembalikan
                                </span>
                                untuk diperbaiki.
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                2 jam lalu
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Classification --}}
    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">

        <div class="mb-5 flex items-center justify-between">

            <div>
                <h3 class="font-bold text-slate-900">
                    Klasifikasi Arsip
                </h3>

                <p class="mt-1 text-xs text-slate-400">
                    Ringkasan arsip berdasarkan klasifikasi
                </p>
            </div>

            <a href="#" class="text-sm font-semibold text-[oklch(29.3%_0.136_325.661)] hover:underline">
                Kelola klasifikasi
            </a>

        </div>


        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-6">


            {{-- Unit --}}
            <a href="#"
                class="group rounded-xl border border-slate-100 bg-slate-50 p-4 transition hover:border-blue-100 hover:bg-blue-50">

                <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                    <i class="bi bi-building-fill"></i>
                </div>

                <p class="text-sm font-semibold text-slate-800">
                    Unit
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    12 unit
                </p>

            </a>


            {{-- Program --}}
            <a href="#"
                class="group rounded-xl border border-slate-100 bg-slate-50 p-4 transition hover:border-emerald-100 hover:bg-emerald-50">

                <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                    <i class="bi bi-diagram-3-fill"></i>
                </div>

                <p class="text-sm font-semibold text-slate-800">
                    Program
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    8 program
                </p>

            </a>


            {{-- Kegiatan --}}
            <a href="#"
                class="group rounded-xl border border-slate-100 bg-slate-50 p-4 transition hover:border-indigo-100 hover:bg-indigo-50">

                <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                    <i class="bi bi-list-check"></i>
                </div>

                <p class="text-sm font-semibold text-slate-800">
                    Kegiatan
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    24 kegiatan
                </p>

            </a>


            {{-- Sub Kegiatan --}}
            <a href="#"
                class="group rounded-xl border border-slate-100 bg-slate-50 p-4 transition hover:border-orange-100 hover:bg-orange-50">

                <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-orange-100 text-orange-600">
                    <i class="bi bi-list-nested"></i>
                </div>

                <p class="text-sm font-semibold text-slate-800">
                    Sub Kegiatan
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    47 sub kegiatan
                </p>

            </a>


            {{-- Dokumen --}}
            <a href="#"
                class="group rounded-xl border border-slate-100 bg-slate-50 p-4 transition hover:border-rose-100 hover:bg-rose-50">

                <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-rose-100 text-rose-600">
                    <i class="bi bi-file-earmark-text-fill"></i>
                </div>

                <p class="text-sm font-semibold text-slate-800">
                    Dokumen
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    18 jenis
                </p>

            </a>


            {{-- Tag --}}
            <a href="#"
                class="group rounded-xl border border-slate-100 bg-slate-50 p-4 transition hover:border-amber-100 hover:bg-amber-50">

                <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-amber-100 text-amber-600">
                    <i class="bi bi-tags-fill"></i>
                </div>

                <p class="text-sm font-semibold text-slate-800">
                    Tag
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    96 tag
                </p>

            </a>

        </div>

    </div>

@endsection
