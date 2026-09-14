@extends('UserPage.layouts.app')

@section('title', 'Beranda - SADARIN')

@section('meta_description')
    SADARIN - Sistem Arsip Data dan Berkas Internal
@endsection

@section('content')

    <div class="min-h-screen bg-white">

        {{-- ============================================================
        HERO
    ============================================================= --}}

        <section id="arsip"
            class="relative overflow-hidden border-b border-slate-200 bg-gradient-to-br from-white via-sadarin-50/40 to-blue-100/60">

            {{-- Decorative background --}}
            <div class="pointer-events-none absolute inset-0 overflow-hidden">

                <div class="absolute -left-32 top-20 h-80 w-80 rounded-full bg-blue-100/40 blur-3xl"></div>

                <div class="absolute right-[25%] top-10 h-96 w-96 rounded-full bg-sadarin-100/50 blur-3xl"></div>

                <div class="absolute -bottom-40 right-0 h-[500px] w-[500px] rounded-full bg-blue-100/60 blur-3xl"></div>

            </div>


            <div
                class="relative mx-auto grid max-w-7xl items-center gap-6 px-5 py-10 sm:px-8 lg:grid-cols-[0.9fr_1.1fr] lg:gap-4 lg:py-8">

                {{-- ========================================================
                HERO CONTENT
            ========================================================= --}}

                <div class="relative z-10 max-w-2xl">

                    {{-- Label --}}
                    <div
                        class="mb-5 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-white/80 px-3 py-1.5 text-xs font-medium text-blue-700 shadow-sm">
                        <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>

                        Arsip Data dan Berkas Digital
                    </div>


                    {{-- Heading --}}
                    <h1
                        class="max-w-[620px] text-4xl font-semibold leading-[1.08] tracking-[-2px] text-navy-900 sm:text-5xl lg:text-[48px] xl:text-[54px]">
                        Temukan arsip yang
                        <span class="text-sadarin-500">
                            Anda butuhkan.
                        </span>
                    </h1>


                    {{-- Description --}}
                    <p class="mt-5 max-w-xl text-base leading-7 text-navy-500 sm:text-[17px]">
                        Kelola, cari, dan akses arsip dengan lebih cepat,
                        mudah, dan aman dalam satu sistem terintegrasi.
                    </p>


                    {{-- Search --}}
                    <form action="#" method="GET" class="mt-7">

                        <div
                            class="flex flex-col gap-2 rounded-2xl border border-slate-200 bg-white/95 p-2 shadow-[0_12px_40px_rgba(29,78,216,0.10)] sm:flex-row">

                            <div class="relative min-w-0 flex-1">

                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-navy-400">
                                    <i class="bi bi-search text-lg"></i>
                                </div>


                                <input type="text" name="q" value="{{ request('q') }}"
                                    placeholder="Cari judul arsip, unit, tag, atau kata kunci..."
                                    class="w-full rounded-xl bg-slate-50 py-3.5 pl-11 pr-4 text-sm text-navy-700 outline-none transition placeholder:text-navy-400 focus:bg-white focus:ring-4 focus:ring-sadarin-500/10">

                            </div>


                            <button type="submit"
                                class="flex items-center justify-center gap-2 rounded-xl bg-sadarin-600 px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-sadarin-700">
                                <i class="bi bi-search"></i>

                                <span>
                                    Cari Arsip
                                </span>
                            </button>

                        </div>

                    </form>


                    {{-- Search examples --}}
                    <div class="mt-4 flex flex-wrap items-center gap-2">

                        <span class="text-xs text-navy-400">
                            Contoh pencarian:
                        </span>

                        <a href="#"
                            class="rounded-full border border-blue-200 bg-white/70 px-3 py-1 text-[11px] font-medium text-blue-700 transition hover:bg-white">
                            laporan
                        </a>

                        <a href="#"
                            class="rounded-full border border-blue-200 bg-white/70 px-3 py-1 text-[11px] font-medium text-blue-700 transition hover:bg-white">
                            kebudayaan
                        </a>

                        <a href="#"
                            class="rounded-full border border-blue-200 bg-white/70 px-3 py-1 text-[11px] font-medium text-blue-700 transition hover:bg-white">
                            surat
                        </a>

                        <a href="#"
                            class="rounded-full border border-blue-200 bg-white/70 px-3 py-1 text-[11px] font-medium text-blue-700 transition hover:bg-white">
                            2026
                        </a>

                        <a href="#"
                            class="rounded-full border border-blue-200 bg-white/70 px-3 py-1 text-[11px] font-medium text-blue-700 transition hover:bg-white">
                            UPTD
                        </a>

                    </div>

                </div>


                {{-- ========================================================
                HERO IMAGE
            ========================================================= --}}

                <div class="relative flex min-h-[300px] items-center justify-center lg:min-h-[390px]">

                    <img src="{{ asset('assets/images/hero-page.png') }}" alt="Ilustrasi sistem arsip SADARIN"
                        class="relative z-10 h-auto w-full max-w-[760px] object-contain lg:-mr-10">

                </div>

            </div>

        </section>


        {{-- ============================================================
        KLASIFIKASI
    ============================================================= --}}

        <section id="klasifikasi" class="bg-slate-50">

            <div class="mx-auto max-w-7xl px-5 py-10 sm:px-8 lg:py-12">

                <div class="mb-7 flex items-end justify-between gap-4">

                    <div>

                        <h2 class="text-xl font-semibold tracking-[-0.5px] text-navy-900">
                            Telusuri Arsip
                        </h2>

                        <p class="mt-1 text-sm text-navy-400">
                            Temukan arsip berdasarkan unit, klasifikasi, dan metadata.
                        </p>

                    </div>


                    <a href="#"
                        class="hidden items-center gap-2 text-sm font-semibold text-sadarin-600 transition hover:text-sadarin-700 sm:flex">
                        Lihat semua kategori
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>


                <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">

                    {{-- UNIT --}}
                    <a href="#"
                        class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-card transition hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-soft">

                        <div class="flex items-start justify-between">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                                <i class="bi bi-building text-xl"></i>
                            </div>

                            <i class="bi bi-arrow-up-right text-slate-300 transition group-hover:text-blue-500"></i>

                        </div>


                        <h3 class="mt-5 font-semibold text-navy-800">
                            Unit
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-navy-400">
                            Telusuri arsip berdasarkan Bidang atau UPTD.
                        </p>

                    </a>


                    {{-- PROGRAM --}}
                    <a href="#"
                        class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-card transition hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-soft">

                        <div class="flex items-start justify-between">

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                <i class="bi bi-diagram-3 text-xl"></i>
                            </div>

                            <i class="bi bi-arrow-up-right text-slate-300 transition group-hover:text-emerald-500"></i>

                        </div>


                        <h3 class="mt-5 font-semibold text-navy-800">
                            Program
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-navy-400">
                            Program Pengembangan Kebudayaan.
                        </p>

                    </a>


                    {{-- KEGIATAN --}}
                    <a href="#"
                        class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-card transition hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow-soft">

                        <div class="flex items-start justify-between">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                                <i class="bi bi-diagram-2 text-xl"></i>
                            </div>

                            <i class="bi bi-arrow-up-right text-slate-300 transition group-hover:text-indigo-500"></i>

                        </div>


                        <h3 class="mt-5 font-semibold text-navy-800">
                            Kegiatan
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-navy-400">
                            Pelestarian dan Pengembangan Kebudayaan.
                        </p>

                    </a>


                    {{-- SUB KEGIATAN --}}
                    <a href="#"
                        class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-card transition hover:-translate-y-0.5 hover:border-orange-200 hover:shadow-soft">

                        <div class="flex items-start justify-between">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                                <i class="bi bi-diagram-3-fill text-xl"></i>
                            </div>

                            <i class="bi bi-arrow-up-right text-slate-300 transition group-hover:text-orange-500"></i>

                        </div>


                        <h3 class="mt-5 font-semibold text-navy-800">
                            Sub Kegiatan
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-navy-400">
                            Pelindungan, Pengembangan, Pemanfaatan,
                            dan Pembinaan Kebudayaan.
                        </p>

                    </a>


                    {{-- JENIS DOKUMEN --}}
                    <a href="#"
                        class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-card transition hover:-translate-y-0.5 hover:border-red-200 hover:shadow-soft">

                        <div class="flex items-start justify-between">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-50 text-red-500">
                                <i class="bi bi-file-earmark-text text-xl"></i>
                            </div>

                            <i class="bi bi-arrow-up-right text-slate-300 transition group-hover:text-red-500"></i>

                        </div>


                        <h3 class="mt-5 font-semibold text-navy-800">
                            Jenis Dokumen
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-navy-400">
                            Laporan, surat, keputusan, dan dokumen lainnya.
                        </p>

                    </a>


                    {{-- TAG --}}
                    <a href="#"
                        class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-card transition hover:-translate-y-0.5 hover:border-amber-200 hover:shadow-soft">

                        <div class="flex items-start justify-between">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                                <i class="bi bi-tags text-xl"></i>
                            </div>

                            <i class="bi bi-arrow-up-right text-slate-300 transition group-hover:text-amber-500"></i>

                        </div>


                        <h3 class="mt-5 font-semibold text-navy-800">
                            Tag Arsip
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-navy-400">
                            Temukan arsip berdasarkan tag dan kata kunci.
                        </p>

                    </a>


                    {{-- SEMUA ARSIP --}}
                    <a href="#"
                        class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-card transition hover:-translate-y-0.5 hover:border-sky-200 hover:shadow-soft">

                        <div class="flex items-start justify-between">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-sky-50 text-sky-600">
                                <i class="bi bi-archive text-xl"></i>
                            </div>

                            <i class="bi bi-arrow-up-right text-slate-300 transition group-hover:text-sky-500"></i>

                        </div>


                        <h3 class="mt-5 font-semibold text-navy-800">
                            Semua Arsip
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-navy-400">
                            Lihat seluruh arsip yang tersedia sesuai hak akses.
                        </p>

                    </a>

                </div>

            </div>

        </section>


        {{-- ============================================================
        ARSIP TERBARU
    ============================================================= --}}

        <section id="terbaru" class="bg-white">

            <div class="mx-auto max-w-7xl px-5 py-12 sm:px-8 lg:py-14">

                <div class="flex items-end justify-between gap-4">

                    <div>

                        <h2 class="text-xl font-semibold tracking-[-0.5px] text-navy-900">
                            Arsip Terbaru
                        </h2>

                        <p class="mt-1 text-sm text-navy-400">
                            Beberapa arsip yang baru tersedia.
                        </p>

                    </div>


                    <a href="#"
                        class="hidden items-center gap-2 text-sm font-semibold text-sadarin-600 transition hover:text-sadarin-700 sm:flex">
                        Lihat semua arsip
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>


                <div class="mt-6 grid gap-4 lg:grid-cols-3">

                    {{-- ARSIP 1 --}}
                    <a href="#"
                        class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-card transition hover:-translate-y-0.5 hover:border-red-200 hover:shadow-soft">

                        <div class="flex items-start justify-between gap-4">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-50 text-red-500">
                                <i class="bi bi-file-earmark-pdf text-xl"></i>
                            </div>


                            <span
                                class="rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-semibold text-emerald-600">
                                Publik
                            </span>

                        </div>


                        <h3
                            class="mt-5 line-clamp-2 font-semibold leading-6 text-navy-800 transition group-hover:text-sadarin-600">
                            Laporan Pelaksanaan Kegiatan Kebudayaan
                        </h3>


                        <p class="mt-2 text-xs text-navy-400">
                            Laporan
                            <span class="mx-1 text-slate-300">•</span>
                            2026
                        </p>


                        <div class="mt-5 flex flex-wrap gap-2 text-xs text-navy-400">

                            <span class="inline-flex items-center gap-1.5">
                                <i class="bi bi-building text-blue-500"></i>
                                Bidang Kebudayaan
                            </span>

                            <span class="inline-flex items-center gap-1.5">
                                <i class="bi bi-layers text-sadarin-500"></i>
                                Program Pengembangan Kebudayaan
                            </span>

                        </div>


                        <div class="mt-5 flex flex-wrap gap-2">

                            <span class="rounded-full bg-slate-100 px-2.5 py-1 text-[11px] text-navy-500">
                                laporan
                            </span>

                            <span class="rounded-full bg-slate-100 px-2.5 py-1 text-[11px] text-navy-500">
                                kegiatan
                            </span>

                            <span class="rounded-full bg-slate-100 px-2.5 py-1 text-[11px] text-navy-500">
                                2026
                            </span>

                        </div>

                    </a>


                    {{-- ARSIP 2 --}}
                    <a href="#"
                        class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-card transition hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-soft">

                        <div class="flex items-start justify-between gap-4">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                                <i class="bi bi-file-earmark-text text-xl"></i>
                            </div>


                            <span class="rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-semibold text-navy-500">
                                Internal
                            </span>

                        </div>


                        <h3
                            class="mt-5 line-clamp-2 font-semibold leading-6 text-navy-800 transition group-hover:text-sadarin-600">
                            Dokumen Pelaksanaan Kegiatan
                        </h3>


                        <p class="mt-2 text-xs text-navy-400">
                            Dokumen
                            <span class="mx-1 text-slate-300">•</span>
                            2026
                        </p>


                        <div class="mt-5 flex flex-wrap gap-2 text-xs text-navy-400">

                            <span class="inline-flex items-center gap-1.5">
                                <i class="bi bi-building text-blue-500"></i>
                                Bidang Kebudayaan
                            </span>

                            <span class="inline-flex items-center gap-1.5">
                                <i class="bi bi-layers text-sadarin-500"></i>
                                Program Pengembangan Kebudayaan
                            </span>

                        </div>


                        <div class="mt-5 flex flex-wrap gap-2">

                            <span class="rounded-full bg-slate-100 px-2.5 py-1 text-[11px] text-navy-500">
                                internal
                            </span>

                            <span class="rounded-full bg-slate-100 px-2.5 py-1 text-[11px] text-navy-500">
                                dokumen
                            </span>

                        </div>

                    </a>


                    {{-- ARSIP 3 --}}
                    <a href="#"
                        class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-card transition hover:-translate-y-0.5 hover:border-amber-200 hover:shadow-soft">

                        <div class="flex items-start justify-between gap-4">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                                <i class="bi bi-folder2-open text-xl"></i>
                            </div>


                            <span
                                class="rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-semibold text-emerald-600">
                                Publik
                            </span>

                        </div>


                        <h3
                            class="mt-5 line-clamp-2 font-semibold leading-6 text-navy-800 transition group-hover:text-sadarin-600">
                            Dokumentasi Kegiatan Kebudayaan
                        </h3>


                        <p class="mt-2 text-xs text-navy-400">
                            Koleksi
                            <span class="mx-1 text-slate-300">•</span>
                            2026
                        </p>


                        <div class="mt-5 flex flex-wrap gap-2 text-xs text-navy-400">

                            <span class="inline-flex items-center gap-1.5">
                                <i class="bi bi-building text-blue-500"></i>
                                UPTD Taman Budaya
                            </span>

                            <span class="inline-flex items-center gap-1.5">
                                <i class="bi bi-layers text-sadarin-500"></i>
                                Pelestarian dan Pengembangan Kebudayaan
                            </span>

                        </div>


                        <div class="mt-5 flex flex-wrap gap-2">

                            <span class="rounded-full bg-slate-100 px-2.5 py-1 text-[11px] text-navy-500">
                                kebudayaan
                            </span>

                            <span class="rounded-full bg-slate-100 px-2.5 py-1 text-[11px] text-navy-500">
                                dokumentasi
                            </span>

                        </div>

                    </a>

                </div>


                {{-- MOBILE --}}
                <div class="mt-6 sm:hidden">

                    <a href="#"
                        class="flex items-center justify-center gap-2 rounded-xl border border-slate-200 py-3 text-sm font-semibold text-sadarin-600">
                        Lihat semua arsip

                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

            </div>

        </section>


        {{-- ============================================================
        FOOTER
    ============================================================= --}}

        <footer class="border-t border-slate-200 bg-slate-50">

            <div
                class="mx-auto flex max-w-7xl flex-col gap-3 px-5 py-8 sm:px-8 md:flex-row md:items-center md:justify-between">

                <div class="text-xs text-navy-400">
                    © {{ date('Y') }} SADARIN
                </div>

                <div class="text-xs text-navy-400">
                    Sistem Arsip Data dan Berkas Internal
                </div>

            </div>

        </footer>

    </div>

@endsection
