@extends('UserPage.layouts.app')

@section('title', 'SADARIN - Sistem Arsip Data dan Berkas Internal')

@section('meta_description')
    SADARIN - Sistem Arsip Data dan Berkas Internal
@endsection

@section('content')

    <div class="min-h-screen bg-white">

        {{-- ============================================================
            HERO
        ============================================================= --}}

        <section id="arsip"
            class="relative overflow-hidden border-b border-sadarin-200 bg-gradient-to-br from-white via-sadarin-50/50 to-sadarin-100/70">

            {{-- BACKGROUND --}}
            <div class="pointer-events-none absolute inset-0 overflow-hidden">

                <div class="absolute -left-32 top-16 h-80 w-80 rounded-full bg-sadarin-100/60 blur-3xl"></div>

                <div class="absolute right-[30%] top-0 h-96 w-96 rounded-full bg-sadarin-100/70 blur-3xl"></div>

                <div class="absolute -bottom-40 right-0 h-[500px] w-[500px] rounded-full bg-sadarin-200/50 blur-3xl"></div>

            </div>


            <div
                class="relative mx-auto grid max-w-7xl items-center gap-6 px-5 py-10 sm:px-8 lg:grid-cols-[0.9fr_1.1fr] lg:gap-4 lg:py-8">

                {{-- HERO CONTENT --}}
                <div class="relative z-10 max-w-2xl">

                    <div
                        class="mb-5 inline-flex items-center gap-2 rounded-full border border-sadarin-300 bg-sadarin-50/80 px-3 py-1.5 text-xs font-medium text-sadarin-800 shadow-sm">

                        <span class="h-1.5 w-1.5 rounded-full bg-sadarin-700"></span>

                        Arsip Data dan Berkas Digital

                    </div>


                    <h1
                        class="max-w-[620px] text-4xl font-semibold leading-[1.08] tracking-[-2px] text-navy-900 sm:text-5xl lg:text-[48px] xl:text-[54px]">

                        Temukan arsip yang

                        <span class="text-sadarin-600">
                            Anda butuhkan.
                        </span>

                    </h1>


                    <p class="mt-5 max-w-xl text-base leading-7 text-navy-500 sm:text-[17px]">

                        Kelola, cari, dan akses arsip dengan lebih cepat,
                        mudah, dan aman dalam satu sistem terintegrasi.

                    </p>


                    {{-- SEARCH --}}
                    <form action="{{ request()->url() }}" method="GET" class="mt-7">

                        <div
                            class="flex flex-col gap-2 rounded-2xl border border-sadarin-200 bg-white p-2 shadow-[0_12px_40px_rgba(91,36,72,0.10)] sm:flex-row">

                            <div class="relative min-w-0 flex-1">

                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-sadarin-500">

                                    <i class="bi bi-search text-lg"></i>

                                </div>


                                <input type="text" name="q" value="{{ $search ?? request('q') }}"
                                    placeholder="Cari judul arsip, unit, tag, atau kata kunci..."
                                    class="w-full rounded-xl bg-sadarin-50/60 py-3.5 pl-11 pr-4 text-sm text-navy-700 outline-none transition placeholder:text-sadarin-400 focus:bg-white focus:ring-4 focus:ring-sadarin-500/10">

                            </div>


                            <button type="submit"
                                class="flex items-center justify-center gap-2 rounded-xl bg-sadarin-700 px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-sadarin-800">

                                <i class="bi bi-search"></i>

                                Cari Arsip

                            </button>

                        </div>

                    </form>


                    {{-- SEARCH EXAMPLES --}}
                    <div class="mt-4 flex flex-wrap items-center gap-2">

                        <span class="mr-1 text-xs text-sadarin-700">
                            Contoh pencarian:
                        </span>

                        @foreach (['laporan', 'kebudayaan', 'surat', date('Y')] as $keyword)
                            <button type="button" onclick="searchKeyword(@js($keyword))"
                                class="rounded-full border border-sadarin-300 bg-white px-3 py-1 text-[11px] font-medium text-sadarin-700 transition hover:border-sadarin-400 hover:bg-sadarin-50">

                                {{ $keyword }}

                            </button>
                        @endforeach

                    </div>

                </div>


                {{-- HERO IMAGE --}}
                <div class="relative flex min-h-[280px] items-center justify-center lg:min-h-[390px]">

                    <div class="absolute right-[5%] top-[5%] h-[340px] w-[340px] rounded-full bg-sadarin-200/50 blur-3xl">
                    </div>

                    <img src="{{ asset('assets/images/hero-page.png') }}" alt="Ilustrasi sistem arsip SADARIN"
                        class="relative z-10 h-auto w-full max-w-[760px] object-contain lg:-mr-10">

                </div>

            </div>

        </section>


        {{-- ============================================================
            HASIL PENCARIAN
        ============================================================= --}}

        @if (!empty($search))

            <section class="border-b border-slate-200 bg-slate-50">

                <div class="mx-auto max-w-7xl px-5 py-10 sm:px-8">

                    <div class="mb-6">

                        <p class="text-xs font-semibold uppercase tracking-wider text-sadarin-600">
                            Hasil Pencarian
                        </p>

                        <h2 class="mt-1 text-xl font-semibold text-navy-900">
                            Hasil untuk "{{ $search }}"
                        </h2>

                        <p class="mt-1 text-sm text-navy-400">
                            Ditemukan {{ $searchResults->count() }} arsip.
                        </p>

                    </div>


                    @if ($searchResults->count())

                        <div class="grid gap-4 lg:grid-cols-3">

                            @foreach ($searchResults as $archive)
                                @include('UserPage.partials.archive-card', [
                                    'archive' => $archive,
                                ])
                            @endforeach

                        </div>
                    @else
                        <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-12 text-center">

                            <div
                                class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                                <i class="bi bi-search text-2xl"></i>

                            </div>

                            <h2 class="mt-4 text-lg font-semibold text-navy-800">
                                Arsip tidak ditemukan
                            </h2>

                            <p class="mt-1 text-sm text-navy-400">
                                Tidak ada arsip yang cocok dengan pencarian tersebut.
                            </p>

                        </div>

                    @endif

                </div>

            </section>

        @endif


        {{-- ============================================================
            KLASIFIKASI
        ============================================================= --}}

        <section id="klasifikasi" class="bg-slate-50">

            <div class="mx-auto max-w-7xl px-5 py-10 sm:px-8 lg:py-12">

                <div class="mb-7">

                    <h2 class="text-xl font-semibold tracking-[-0.5px] text-navy-900">
                        Telusuri Arsip
                    </h2>

                    <p class="mt-1 text-sm text-navy-400">
                        Pilih klasifikasi untuk melihat arsip berdasarkan kategori.
                    </p>

                </div>


                <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">


                    {{-- UNIT --}}
                    <button type="button" onclick="openClassificationModal('unit')"
                        class="group rounded-2xl border border-slate-200 bg-white p-5 text-left shadow-card transition hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-soft">

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
                            {{ $units->count() }} unit tersedia.
                        </p>

                    </button>


                    {{-- PROGRAM --}}
                    <button type="button" onclick="openClassificationModal('program')"
                        class="group rounded-2xl border border-slate-200 bg-white p-5 text-left shadow-card transition hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-soft">

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
                            {{ $programs->count() }} program tersedia.
                        </p>

                    </button>


                    {{-- KEGIATAN --}}
                    <button type="button" onclick="openClassificationModal('kegiatan')"
                        class="group rounded-2xl border border-slate-200 bg-white p-5 text-left shadow-card transition hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow-soft">

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
                            {{ $kegiatans->count() }} kegiatan tersedia.
                        </p>

                    </button>


                    {{-- SUB KEGIATAN --}}
                    <button type="button" onclick="openClassificationModal('sub-kegiatan')"
                        class="group rounded-2xl border border-slate-200 bg-white p-5 text-left shadow-card transition hover:-translate-y-0.5 hover:border-orange-200 hover:shadow-soft">

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
                            {{ $subKegiatans->count() }} sub kegiatan tersedia.
                        </p>

                    </button>


                    {{-- JENIS DOKUMEN --}}
                    <button type="button" onclick="openClassificationModal('document-type')"
                        class="group rounded-2xl border border-slate-200 bg-white p-5 text-left shadow-card transition hover:-translate-y-0.5 hover:border-red-200 hover:shadow-soft">

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
                            {{ $documentTypes->count() }} jenis dokumen tersedia.
                        </p>

                    </button>


                    {{-- TAG --}}
                    <button type="button" onclick="openClassificationModal('tag')"
                        class="group rounded-2xl border border-slate-200 bg-white p-5 text-left shadow-card transition hover:-translate-y-0.5 hover:border-amber-200 hover:shadow-soft">

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
                            {{ isset($tags) ? $tags->count() : 0 }} tag tersedia.
                        </p>

                    </button>


                    {{-- SEMUA ARSIP --}}
                    <button type="button" onclick="openArchiveModal()"
                        class="group rounded-2xl border border-slate-200 bg-white p-5 text-left shadow-card transition hover:-translate-y-0.5 hover:border-sky-200 hover:shadow-soft">

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
                            Lihat seluruh arsip yang tersedia.
                        </p>

                    </button>

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


                    <button type="button" onclick="openArchiveModal()"
                        class="hidden items-center gap-2 text-sm font-semibold text-sadarin-700 transition hover:text-sadarin-800 sm:flex">

                        Lihat semua arsip

                        <i class="bi bi-arrow-right"></i>

                    </button>

                </div>


                <div class="mt-6 grid gap-4 lg:grid-cols-3">

                    @forelse ($latestArchives as $archive)

                        <div
                            class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-card transition hover:-translate-y-0.5 hover:border-sadarin-200 hover:shadow-soft">

                            {{-- TOP --}}
                            <div class="flex items-start justify-between gap-4">

                                <div
                                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-sadarin-50 text-sadarin-600">

                                    <i class="bi bi-archive text-xl"></i>

                                </div>


                                <span
                                    class="rounded-full px-2.5 py-1 text-[11px] font-semibold
                                    {{ $archive->archive_is_public ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-navy-500' }}">

                                    {{ $archive->archive_is_public ? 'Publik' : 'Internal' }}

                                </span>

                            </div>


                            {{-- TITLE --}}
                            <h3
                                class="mt-5 line-clamp-2 font-semibold leading-6 text-navy-800 transition group-hover:text-sadarin-700">

                                {{ $archive->archive_title }}

                            </h3>


                            {{-- DOCUMENT TYPE --}}
                            <p class="mt-2 text-xs text-navy-400">

                                {{ $archive->documentType->document_type_name ?? 'Dokumen' }}

                                @if ($archive->archive_year)
                                    <span class="mx-1 text-slate-300">
                                        •
                                    </span>

                                    {{ $archive->archive_year }}
                                @endif

                            </p>


                            {{-- METADATA --}}
                            <div class="mt-5 flex flex-wrap gap-2 text-xs text-navy-400">

                                @if ($archive->unit)
                                    <span class="inline-flex items-center gap-1.5">

                                        <i class="bi bi-building text-blue-500"></i>

                                        {{ $archive->unit->unit_name }}

                                    </span>
                                @endif


                                @if ($archive->program)
                                    <span class="inline-flex items-center gap-1.5">

                                        <i class="bi bi-diagram-3 text-emerald-500"></i>

                                        {{ $archive->program->program_name }}

                                    </span>
                                @endif


                                @if ($archive->kegiatan)
                                    <span class="inline-flex items-center gap-1.5">

                                        <i class="bi bi-diagram-2 text-indigo-500"></i>

                                        {{ $archive->kegiatan->kegiatan_name }}

                                    </span>
                                @endif

                            </div>


                            {{-- TAGS DARI BERKAS --}}
                            @php

                                $archiveTags = collect();

                                foreach ($archive->files ?? [] as $file) {
                                    foreach ($file->tags ?? [] as $tag) {
                                        $archiveTags->push($tag);
                                    }
                                }

                                $archiveTags = $archiveTags->unique('tag_id')->take(5);

                            @endphp


                            @if ($archiveTags->count())
                                <div class="mt-5 flex flex-wrap gap-2">

                                    @foreach ($archiveTags as $tag)
                                        <span class="rounded-full bg-slate-100 px-2.5 py-1 text-[11px] text-navy-500">

                                            #{{ $tag->tag_name }}

                                        </span>
                                    @endforeach

                                </div>
                            @endif


                            {{-- FOOTER --}}
                            <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4">

                                <span class="text-[11px] text-slate-400">

                                    {{ $archive->files->count() }}
                                    berkas

                                </span>


                                <a href="{{ route('sadarin.user.archive.show', $archive->archive_id) }}"
                                    class="inline-flex items-center gap-1.5 text-xs font-semibold text-sadarin-700 hover:text-sadarin-800">

                                    Lihat detail

                                    <i class="bi bi-arrow-right"></i>

                                </a>

                            </div>

                        </div>

                    @empty

                        <div
                            class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-6 py-12 text-center">

                            <div
                                class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-slate-400 shadow-sm">

                                <i class="bi bi-archive text-2xl"></i>

                            </div>

                            <h3 class="mt-4 font-semibold text-navy-800">
                                Belum ada arsip
                            </h3>

                            <p class="mt-1 text-sm text-navy-400">
                                Arsip yang tersedia akan tampil di halaman ini.
                            </p>

                        </div>

                    @endforelse

                </div>


                <div class="mt-6 sm:hidden">

                    <button type="button" onclick="openArchiveModal()"
                        class="flex w-full items-center justify-center gap-2 rounded-xl border border-sadarin-200 py-3 text-sm font-semibold text-sadarin-700 transition hover:bg-sadarin-50">

                        Lihat semua arsip

                        <i class="bi bi-arrow-right"></i>

                    </button>

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


    {{-- ================================================================
        CLASSIFICATION MODAL
    ================================================================= --}}

    <div id="classificationModal" class="fixed inset-0 z-[100] hidden" aria-hidden="true">

        <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeClassificationModal()">
        </div>


        <div class="relative flex min-h-full items-center justify-center p-4">

            <div
                class="relative flex max-h-[85vh] w-full max-w-2xl flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-2xl">

                {{-- HEADER --}}
                <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4 sm:px-6">

                    <div>

                        <p id="classificationModalLabel"
                            class="text-[10px] font-bold uppercase tracking-wider text-sadarin-500">

                            Klasifikasi

                        </p>

                        <h2 id="classificationModalTitle" class="mt-0.5 text-lg font-bold text-navy-900">

                            Data

                        </h2>

                    </div>


                    <button type="button" onclick="closeClassificationModal()"
                        class="flex h-10 w-10 items-center justify-center rounded-xl text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">

                        <i class="bi bi-x-lg"></i>

                    </button>

                </div>


                {{-- SEARCH --}}
                <div class="border-b border-slate-100 px-5 py-3 sm:px-6">

                    <div class="relative">

                        <i
                            class="bi bi-search pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                        </i>

                        <input id="classificationSearch" type="text" placeholder="Cari..."
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-4 text-sm text-navy-700 outline-none transition focus:border-sadarin-300 focus:bg-white focus:ring-4 focus:ring-sadarin-500/10">

                    </div>

                </div>


                {{-- CONTENT --}}
                <div id="classificationContent" class="overflow-y-auto px-5 py-4 sm:px-6">
                </div>

            </div>

        </div>

    </div>


    {{-- ================================================================
        ALL ARCHIVES MODAL
    ================================================================= --}}

    <div id="archiveModal" class="fixed inset-0 z-[110] hidden" aria-hidden="true">

        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeArchiveModal()">
        </div>


        <div class="relative flex min-h-full items-center justify-center p-3 sm:p-6">

            <div
                class="relative flex h-[90vh] w-full max-w-6xl flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-2xl">

                {{-- HEADER --}}
                <div class="flex shrink-0 items-center justify-between border-b border-slate-100 px-5 py-4 sm:px-6">

                    <div>

                        <p class="text-[10px] font-bold uppercase tracking-wider text-sadarin-500">
                            Arsip
                        </p>

                        <h2 class="text-lg font-bold text-navy-900">
                            Semua Arsip
                        </h2>

                    </div>


                    <button type="button" onclick="closeArchiveModal()"
                        class="flex h-10 w-10 items-center justify-center rounded-xl text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">

                        <i class="bi bi-x-lg"></i>

                    </button>

                </div>


                {{-- BODY --}}
                <div class="flex min-h-0 flex-1">


                    {{-- SIDEBAR --}}
                    <aside class="hidden w-64 shrink-0 overflow-y-auto border-r border-slate-100 bg-slate-50 p-4 md:block">

                        <p class="mb-3 px-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Filter Arsip
                        </p>


                        <button type="button" onclick="filterAllArchives('all')"
                            class="archive-filter-btn active mb-1 flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-left text-sm font-medium text-sadarin-700">

                            <i class="bi bi-archive"></i>

                            Semua Arsip

                        </button>


                        <button type="button" onclick="filterAllArchives('unit')"
                            class="archive-filter-btn mb-1 flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-left text-sm text-navy-500 hover:bg-white">

                            <i class="bi bi-building"></i>

                            Unit

                        </button>


                        <button type="button" onclick="filterAllArchives('program')"
                            class="archive-filter-btn mb-1 flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-left text-sm text-navy-500 hover:bg-white">

                            <i class="bi bi-diagram-3"></i>

                            Program

                        </button>


                        <button type="button" onclick="filterAllArchives('kegiatan')"
                            class="archive-filter-btn mb-1 flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-left text-sm text-navy-500 hover:bg-white">

                            <i class="bi bi-diagram-2"></i>

                            Kegiatan

                        </button>


                        <button type="button" onclick="filterAllArchives('sub-kegiatan')"
                            class="archive-filter-btn mb-1 flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-left text-sm text-navy-500 hover:bg-white">

                            <i class="bi bi-diagram-3-fill"></i>

                            Sub Kegiatan

                        </button>


                        <button type="button" onclick="filterAllArchives('document-type')"
                            class="archive-filter-btn mb-1 flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-left text-sm text-navy-500 hover:bg-white">

                            <i class="bi bi-file-earmark-text"></i>

                            Jenis Dokumen

                        </button>


                        <button type="button" onclick="filterAllArchives('tag')"
                            class="archive-filter-btn flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-left text-sm text-navy-500 hover:bg-white">

                            <i class="bi bi-tags"></i>

                            Tag

                        </button>

                    </aside>


                    {{-- ARCHIVE CONTENT --}}
                    <div class="min-w-0 flex-1 overflow-y-auto">

                        {{-- MOBILE FILTER --}}
                        <div class="sticky top-0 z-10 border-b border-slate-100 bg-white p-3 md:hidden">

                            <select id="mobileArchiveFilter" onchange="filterAllArchives(this.value)"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm outline-none">

                                <option value="all">
                                    Semua Arsip
                                </option>

                                <option value="unit">
                                    Unit
                                </option>

                                <option value="program">
                                    Program
                                </option>

                                <option value="kegiatan">
                                    Kegiatan
                                </option>

                                <option value="sub-kegiatan">
                                    Sub Kegiatan
                                </option>

                                <option value="document-type">
                                    Jenis Dokumen
                                </option>

                                <option value="tag">
                                    Tag
                                </option>

                            </select>

                        </div>


                        <div class="border-b border-slate-100 px-5 py-4 sm:px-6">

                            <div class="relative">

                                <i
                                    class="bi bi-search pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                                </i>

                                <input id="archiveModalSearch" type="text" placeholder="Cari arsip..."
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-4 text-sm outline-none focus:border-sadarin-300 focus:bg-white">

                            </div>

                        </div>


                        <div id="allArchivesContent" class="grid gap-3 p-5 sm:grid-cols-2 sm:p-6 lg:grid-cols-2">

                            {{-- DIISI JAVASCRIPT --}}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ================================================================
        JAVASCRIPT DATA
    ================================================================= --}}

    <script>
        window.sadarinClassificationData = {

            unit: [
                @foreach ($units as $item)
                    {
                        id: @js($item->unit_id),
                        name: @js($item->unit_name),
                        description: @js($item->unit_description ?? ''),
                        url: @js(url('/arsip?unit_id=' . $item->unit_id))
                    },
                @endforeach
            ],

            program: [
                @foreach ($programs as $item)
                    {
                        id: @js($item->program_id),
                        name: @js($item->program_name),
                        description: @js($item->program_description ?? ''),
                        url: @js(url('/arsip?program_id=' . $item->program_id))
                    },
                @endforeach
            ],

            kegiatan: [
                @foreach ($kegiatans as $item)
                    {
                        id: @js($item->kegiatan_id),
                        name: @js($item->kegiatan_name),
                        description: @js($item->kegiatan_description ?? ''),
                        url: @js(url('/arsip?kegiatan_id=' . $item->kegiatan_id))
                    },
                @endforeach
            ],

            subKegiatan: [
                @foreach ($subKegiatans as $item)
                    {
                        id: @js($item->sub_kegiatan_id),
                        name: @js($item->sub_kegiatan_name),
                        description: @js($item->sub_kegiatan_description ?? ''),
                        url: @js(url('/arsip?sub_kegiatan_id=' . $item->sub_kegiatan_id))
                    },
                @endforeach
            ],

            documentType: [
                @foreach ($documentTypes as $item)
                    {
                        id: @js($item->document_type_id),
                        name: @js($item->document_type_name),
                        description: @js($item->document_type_description ?? ''),
                        url: @js(url('/arsip?document_type_id=' . $item->document_type_id))
                    },
                @endforeach
            ],

            tag: [
                @foreach ($tags ?? [] as $item)
                    {
                        id: @js($item->tag_id),
                        name: @js($item->tag_name),
                        description: @js($item->tag_description ?? ''),
                        url: @js(url('/arsip?tag_id=' . $item->tag_id))
                    },
                @endforeach
            ]

        };


        /*
        |--------------------------------------------------------------------------
        | SEMUA ARSIP
        |--------------------------------------------------------------------------
        */

        window.sadarinArchives = [

            @foreach ($archives ?? ($latestArchives ?? []) as $archive)

                {
                    id: @js($archive->archive_id),

                    title: @js($archive->archive_title),

                    year: @js($archive->archive_year),

                    public: @js((bool) $archive->archive_is_public),

                    unit: @js($archive->unit->unit_name ?? ''),

                    program: @js($archive->program->program_name ?? ''),

                    kegiatan: @js($archive->kegiatan->kegiatan_name ?? ''),

                    subKegiatan: @js($archive->subKegiatan->sub_kegiatan_name ?? ''),

                    documentType: @js($archive->documentType->document_type_name ?? 'Dokumen'),

                    unitId: @js($archive->archive_unit_id ?? null),

                    programId: @js($archive->archive_program_id ?? null),

                    kegiatanId: @js($archive->archive_kegiatan_id ?? null),

                    subKegiatanId: @js($archive->archive_sub_kegiatan_id ?? null),

                    documentTypeId: @js($archive->archive_document_type_id ?? null),

                    url: @js(route('sadarin.user.archive.show', $archive->archive_id))

                },
            @endforeach

        ];


        /*
        |--------------------------------------------------------------------------
        | MOBILE MENU
        |--------------------------------------------------------------------------
        */

        document.addEventListener('DOMContentLoaded', function() {

            const button = document.getElementById('mobileMenuButton');
            const menu = document.getElementById('mobileMenu');

            if (button && menu) {

                button.addEventListener('click', function() {

                    menu.classList.toggle('hidden');

                });

                menu.querySelectorAll('a').forEach(function(link) {

                    link.addEventListener('click', function() {

                        menu.classList.add('hidden');

                    });

                });

            }


            /*
            |--------------------------------------------------------------------------
            | CLASSIFICATION SEARCH
            |--------------------------------------------------------------------------
            */

            const classificationSearch =
                document.getElementById('classificationSearch');

            if (classificationSearch) {

                classificationSearch.addEventListener('input', function() {

                    const modal =
                        document.getElementById('classificationModal');

                    renderClassification(
                        modal.dataset.type
                    );

                });

            }


            /*
            |--------------------------------------------------------------------------
            | ARCHIVE SEARCH
            |--------------------------------------------------------------------------
            */

            const archiveSearch =
                document.getElementById('archiveModalSearch');

            if (archiveSearch) {

                archiveSearch.addEventListener('input', function() {

                    renderArchives(
                        window.currentArchiveFilter || 'all'
                    );

                });

            }


            /*
            |--------------------------------------------------------------------------
            | ESC
            |--------------------------------------------------------------------------
            */

            document.addEventListener('keydown', function(event) {

                if (event.key === 'Escape') {

                    closeClassificationModal();

                    closeArchiveModal();

                }

            });

        });


        /*
        |--------------------------------------------------------------------------
        | SEARCH KEYWORD
        |--------------------------------------------------------------------------
        */

        function searchKeyword(keyword) {

            const input =
                document.querySelector('input[name="q"]');

            if (!input) {
                return;
            }

            input.value = keyword;

            input.closest('form').submit();

        }


        /*
        |--------------------------------------------------------------------------
        | CLASSIFICATION MODAL
        |--------------------------------------------------------------------------
        */

        function openClassificationModal(type) {

            const modal =
                document.getElementById('classificationModal');

            const search =
                document.getElementById('classificationSearch');

            if (!modal) {
                return;
            }

            modal.dataset.type = type;

            modal.classList.remove('hidden');

            document.body.classList.add('overflow-hidden');

            if (search) {

                search.value = '';

            }

            updateClassificationTitle(type);

            renderClassification(type);

        }


        function closeClassificationModal() {

            const modal =
                document.getElementById('classificationModal');

            if (!modal) {
                return;
            }

            modal.classList.add('hidden');

            document.body.classList.remove('overflow-hidden');

        }


        /*
        |--------------------------------------------------------------------------
        | CLASSIFICATION TITLE
        |--------------------------------------------------------------------------
        */

        function updateClassificationTitle(type) {

            const title =
                document.getElementById('classificationModalTitle');

            const label =
                document.getElementById('classificationModalLabel');

            const titles = {

                unit: 'Unit',

                program: 'Program',

                kegiatan: 'Kegiatan',

                'sub-kegiatan': 'Sub Kegiatan',

                'document-type': 'Jenis Dokumen',

                tag: 'Tag Arsip'

            };

            label.textContent = 'Klasifikasi';

            title.textContent =
                titles[type] || 'Data';

        }


        /*
        |--------------------------------------------------------------------------
        | RENDER CLASSIFICATION
        |--------------------------------------------------------------------------
        */

        function renderClassification(type) {

            const content =
                document.getElementById('classificationContent');

            const searchInput =
                document.getElementById('classificationSearch');

            if (!content) {
                return;
            }


            const key =
                type === 'sub-kegiatan' ?
                'subKegiatan' :
                type === 'document-type' ?
                'documentType' :
                type;


            const data =
                window.sadarinClassificationData[key] || [];


            const keyword =
                searchInput ?
                searchInput.value.toLowerCase().trim() :
                '';


            const filtered =
                data.filter(function(item) {

                    return (
                        item.name.toLowerCase().includes(keyword) ||
                        (item.description || '')
                        .toLowerCase()
                        .includes(keyword)
                    );

                });


            if (!filtered.length) {

                content.innerHTML = `

                    <div class="py-12 text-center">

                        <div
                            class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                            <i class="bi bi-inbox text-xl"></i>

                        </div>

                        <p class="mt-3 text-sm font-semibold text-navy-700">
                            Data tidak ditemukan
                        </p>

                        <p class="mt-1 text-xs text-navy-400">
                            Tidak ada data yang sesuai.
                        </p>

                    </div>

                `;

                return;

            }


            let html = '';


            filtered.forEach(function(item) {

                html += `

                    <a
                        href="${escapeHtml(item.url)}"
                        class="group mb-2 flex items-center gap-3 rounded-2xl border border-slate-200 bg-white p-4 transition hover:border-sadarin-200 hover:bg-sadarin-50/40">

                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-sadarin-50 text-sadarin-600">

                            <i class="bi bi-folder2"></i>

                        </div>


                        <div class="min-w-0 flex-1">

                            <p class="truncate text-sm font-semibold text-navy-800">

                                ${escapeHtml(item.name)}

                            </p>


                            ${
                                item.description
                                    ? `
                                            <p class="mt-0.5 line-clamp-2 text-xs text-navy-400">

                                                ${escapeHtml(item.description)}

                                            </p>
                                        `
                                    : ''
                            }

                        </div>


                        <i
                            class="bi bi-arrow-right text-slate-300 transition group-hover:text-sadarin-600">
                        </i>

                    </a>

                `;

            });


            content.innerHTML = html;

        }


        /*
        |--------------------------------------------------------------------------
        | ALL ARCHIVE MODAL
        |--------------------------------------------------------------------------
        */

        function openArchiveModal() {

            const modal =
                document.getElementById('archiveModal');

            if (!modal) {
                return;
            }

            modal.classList.remove('hidden');

            document.body.classList.add('overflow-hidden');

            window.currentArchiveFilter = 'all';

            const search =
                document.getElementById('archiveModalSearch');

            if (search) {
                search.value = '';
            }

            renderArchives('all');

        }


        function closeArchiveModal() {

            const modal =
                document.getElementById('archiveModal');

            if (!modal) {
                return;
            }

            modal.classList.add('hidden');

            document.body.classList.remove('overflow-hidden');

        }


        /*
        |--------------------------------------------------------------------------
        | FILTER ALL ARCHIVES
        |--------------------------------------------------------------------------
        */

        function filterAllArchives(type) {

            window.currentArchiveFilter = type;

            document.querySelectorAll('.archive-filter-btn')
                .forEach(function(button) {

                    button.classList.remove(
                        'bg-white',
                        'font-semibold',
                        'text-sadarin-700',
                        'shadow-sm'
                    );

                    button.classList.add('text-navy-500');

                });


            const buttons =
                document.querySelectorAll('.archive-filter-btn');


            const index = {

                all: 0,

                unit: 1,

                program: 2,

                kegiatan: 3,

                'sub-kegiatan': 4,

                'document-type': 5,

                tag: 6

            };


            if (buttons[index[type]]) {

                buttons[index[type]].classList.add(
                    'bg-white',
                    'font-semibold',
                    'text-sadarin-700',
                    'shadow-sm'
                );

            }


            const mobile =
                document.getElementById('mobileArchiveFilter');

            if (mobile) {

                mobile.value = type;

            }


            renderArchives(type);

        }


        /*
        |--------------------------------------------------------------------------
        | RENDER ARCHIVES
        |--------------------------------------------------------------------------
        */

        function renderArchives(type) {

            const content =
                document.getElementById('allArchivesContent');

            const search =
                document.getElementById('archiveModalSearch');


            if (!content) {
                return;
            }


            const keyword =
                search ?
                search.value.toLowerCase().trim() :
                '';


            let archives =
                window.sadarinArchives || [];


            /*
            |--------------------------------------------------------------------------
            | FILTER
            |--------------------------------------------------------------------------
            */

            if (type !== 'all') {

                archives =
                    archives.filter(function(archive) {

                        if (type === 'unit') {

                            return archive.unitId !== null;

                        }

                        if (type === 'program') {

                            return archive.programId !== null;

                        }

                        if (type === 'kegiatan') {

                            return archive.kegiatanId !== null;

                        }

                        if (type === 'sub-kegiatan') {

                            return archive.subKegiatanId !== null;

                        }

                        if (type === 'document-type') {

                            return archive.documentTypeId !== null;

                        }

                        if (type === 'tag') {

                            return true;

                        }

                        return true;

                    });

            }


            /*
            |--------------------------------------------------------------------------
            | SEARCH
            |--------------------------------------------------------------------------
            */

            if (keyword) {

                archives =
                    archives.filter(function(archive) {

                        const text = [

                                archive.title,

                                archive.unit,

                                archive.program,

                                archive.kegiatan,

                                archive.subKegiatan,

                                archive.documentType,

                                archive.year

                            ]
                            .filter(Boolean)
                            .join(' ')
                            .toLowerCase();


                        return text.includes(keyword);

                    });

            }


            /*
            |--------------------------------------------------------------------------
            | EMPTY
            |--------------------------------------------------------------------------
            */

            if (!archives.length) {

                content.innerHTML = `

                    <div class="col-span-full py-16 text-center">

                        <div
                            class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                            <i class="bi bi-archive text-2xl"></i>

                        </div>

                        <h3 class="mt-4 font-semibold text-navy-800">
                            Arsip tidak ditemukan
                        </h3>

                        <p class="mt-1 text-sm text-navy-400">
                            Tidak ada arsip yang sesuai dengan filter.
                        </p>

                    </div>

                `;

                return;

            }


            let html = '';


            archives.forEach(function(archive) {

                html += `

                    <a
                        href="${escapeHtml(archive.url)}"
                        class="group rounded-2xl border border-slate-200 bg-white p-4 transition hover:-translate-y-0.5 hover:border-sadarin-200 hover:shadow-soft">

                        <div class="flex items-start justify-between gap-3">

                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-sadarin-50 text-sadarin-600">

                                <i class="bi bi-archive"></i>

                            </div>


                            <span
                                class="rounded-full px-2 py-1 text-[10px] font-semibold
                                ${
                                    archive.public
                                        ? 'bg-emerald-50 text-emerald-600'
                                        : 'bg-slate-100 text-slate-500'
                                }">

                                ${archive.public ? 'Publik' : 'Internal'}

                            </span>

                        </div>


                        <h3
                            class="mt-4 line-clamp-2 text-sm font-semibold leading-5 text-navy-800 group-hover:text-sadarin-700">

                            ${escapeHtml(archive.title)}

                        </h3>


                        <p class="mt-2 text-[11px] text-slate-400">

                            ${escapeHtml(archive.documentType || 'Dokumen')}

                            ${
                                archive.year
                                    ? ` • ${escapeHtml(archive.year)}`
                                    : ''
                            }

                        </p>


                        <div class="mt-3 space-y-1">

                            ${
                                archive.unit
                                    ? `
                                            <div class="flex items-start gap-2 text-[11px] text-slate-500">

                                                <i class="bi bi-building text-blue-500"></i>

                                                <span>
                                                    ${escapeHtml(archive.unit)}
                                                </span>

                                            </div>
                                        `
                                    : ''
                            }


                            ${
                                archive.program
                                    ? `
                                            <div class="flex items-start gap-2 text-[11px] text-slate-500">

                                                <i class="bi bi-diagram-3 text-emerald-500"></i>

                                                <span>
                                                    ${escapeHtml(archive.program)}
                                                </span>

                                            </div>
                                        `
                                    : ''
                            }


                            ${
                                archive.kegiatan
                                    ? `
                                            <div class="flex items-start gap-2 text-[11px] text-slate-500">

                                                <i class="bi bi-diagram-2 text-indigo-500"></i>

                                                <span>
                                                    ${escapeHtml(archive.kegiatan)}
                                                </span>

                                            </div>
                                        `
                                    : ''
                            }

                        </div>


                        <div
                            class="mt-4 flex items-center justify-end border-t border-slate-100 pt-3">

                            <span
                                class="inline-flex items-center gap-1 text-[11px] font-semibold text-sadarin-700">

                                Lihat arsip

                                <i class="bi bi-arrow-right"></i>

                            </span>

                        </div>

                    </a>

                `;

            });


            content.innerHTML = html;

        }


        /*
        |--------------------------------------------------------------------------
        | ESCAPE HTML
        |--------------------------------------------------------------------------
        */

        function escapeHtml(value) {

            if (
                value === null ||
                value === undefined
            ) {

                return '';

            }


            return String(value)

                .replace(/&/g, '&amp;')

                .replace(/</g, '&lt;')

                .replace(/>/g, '&gt;')

                .replace(/"/g, '&quot;')

                .replace(/'/g, '&#039;');

        }
    </script>


    @push('scripts')
        <script>
            /*
                    |--------------------------------------------------------------------------
                    | Jika layout menggunakan @stack('scripts),
                    | script utama sudah berada di halaman.
                    |--------------------------------------------------------------------------
                    */
        </script>
    @endpush

@endsection
