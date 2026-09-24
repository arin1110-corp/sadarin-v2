@extends('UserPage.layouts.app')

@section('title', 'Daftar Arsip - SADARIN')

@section('meta_description')
    Daftar Arsip SADARIN - Sistem Arsip Data dan Berkas Internal
@endsection

@section('content')

    <div class="min-h-screen bg-slate-50">

        {{-- ============================================================
            PAGE
        ============================================================= --}}

        <main class="mx-auto max-w-[1600px] px-4 py-5 sm:px-6 lg:px-8">

            <div class="grid gap-5 lg:grid-cols-[250px_minmax(0,1fr)]">


                {{-- ====================================================
                    SIDEBAR FILTER
                ===================================================== --}}

                <aside class="lg:sticky lg:top-[84px] lg:h-[calc(100vh-104px)]">

                    <div class="flex h-full flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white">

                        {{-- SIDEBAR HEADER --}}
                        <div class="border-b border-slate-100 px-4 py-4">

                            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                Filter Arsip
                            </p>

                            <h2 class="mt-1 text-base font-bold text-slate-900">
                                Klasifikasi
                            </h2>

                        </div>


                        {{-- SIDEBAR CONTENT --}}
                        <div class="flex-1 overflow-y-auto p-2">

                            {{-- =================================================
                                SEMUA ARSIP
                            ================================================== --}}

                            <a href="{{ request()->url() }}"
                                class="mb-1 flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition
                                {{ !request()->hasAny(['unit', 'program', 'kegiatan', 'sub_kegiatan', 'document_type', 'tag', 'q'])
                                    ? 'bg-purple-50 text-purple-700'
                                    : 'text-slate-600 hover:bg-slate-50' }}">

                                <span
                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg
                                    {{ !request()->hasAny(['unit', 'program', 'kegiatan', 'sub_kegiatan', 'document_type', 'tag', 'q'])
                                        ? 'bg-white text-purple-600'
                                        : 'bg-slate-100 text-slate-500' }}">

                                    <i class="bi bi-archive"></i>

                                </span>

                                <span class="flex-1">
                                    Semua Arsip
                                </span>

                            </a>


                            {{-- =================================================
                                UNIT
                            ================================================== --}}

                            <div class="mt-4">

                                <p class="px-3 pb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    Unit
                                </p>

                                @forelse ($units ?? [] as $unit)
                                    <a href="{{ request()->fullUrlWithQuery([
                                        'unit' => $unit->unit_id,
                                        'page' => null,
                                    ]) }}"
                                        class="mb-0.5 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                                        {{ (string) request('unit') === (string) $unit->unit_id
                                            ? 'bg-blue-50 font-semibold text-blue-700'
                                            : 'text-slate-600 hover:bg-slate-50' }}">

                                        <i
                                            class="bi bi-building text-sm
                                            {{ (string) request('unit') === (string) $unit->unit_id ? 'text-blue-500' : 'text-slate-400' }}">
                                        </i>

                                        <span class="min-w-0 flex-1 truncate">
                                            {{ $unit->unit_name }}
                                        </span>

                                    </a>

                                @empty

                                    <p class="px-3 py-2 text-xs text-slate-400">
                                        Belum ada unit.
                                    </p>
                                @endforelse

                            </div>


                            {{-- =================================================
                                PROGRAM
                            ================================================== --}}

                            <div class="mt-5">

                                <p class="px-3 pb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    Program
                                </p>

                                @forelse ($programs ?? [] as $program)
                                    <a href="{{ request()->fullUrlWithQuery([
                                        'program' => $program->program_id,
                                        'page' => null,
                                    ]) }}"
                                        class="mb-0.5 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                                        {{ (string) request('program') === (string) $program->program_id
                                            ? 'bg-emerald-50 font-semibold text-emerald-700'
                                            : 'text-slate-600 hover:bg-slate-50' }}">

                                        <i
                                            class="bi bi-diagram-3 text-sm
                                            {{ (string) request('program') === (string) $program->program_id ? 'text-emerald-500' : 'text-slate-400' }}">
                                        </i>

                                        <span class="min-w-0 flex-1 truncate">
                                            {{ $program->program_name }}
                                        </span>

                                    </a>

                                @empty

                                    <p class="px-3 py-2 text-xs text-slate-400">
                                        Belum ada program.
                                    </p>
                                @endforelse

                            </div>


                            {{-- =================================================
                                KEGIATAN
                            ================================================== --}}

                            <div class="mt-5">

                                <p class="px-3 pb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    Kegiatan
                                </p>

                                @forelse ($kegiatans ?? [] as $kegiatan)
                                    <a href="{{ request()->fullUrlWithQuery([
                                        'kegiatan' => $kegiatan->kegiatan_id,
                                        'page' => null,
                                    ]) }}"
                                        class="mb-0.5 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                                        {{ (string) request('kegiatan') === (string) $kegiatan->kegiatan_id
                                            ? 'bg-indigo-50 font-semibold text-indigo-700'
                                            : 'text-slate-600 hover:bg-slate-50' }}">

                                        <i
                                            class="bi bi-diagram-2 text-sm
                                            {{ (string) request('kegiatan') === (string) $kegiatan->kegiatan_id ? 'text-indigo-500' : 'text-slate-400' }}">
                                        </i>

                                        <span class="min-w-0 flex-1 truncate">
                                            {{ $kegiatan->kegiatan_name }}
                                        </span>

                                    </a>

                                @empty

                                    <p class="px-3 py-2 text-xs text-slate-400">
                                        Belum ada kegiatan.
                                    </p>
                                @endforelse

                            </div>


                            {{-- =================================================
                                SUB KEGIATAN
                            ================================================== --}}

                            <div class="mt-5">

                                <p class="px-3 pb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    Sub Kegiatan
                                </p>

                                @forelse ($subKegiatans ?? [] as $subKegiatan)
                                    <a href="{{ request()->fullUrlWithQuery([
                                        'sub_kegiatan' => $subKegiatan->sub_kegiatan_id,
                                        'page' => null,
                                    ]) }}"
                                        class="mb-0.5 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                                        {{ (string) request('sub_kegiatan') === (string) $subKegiatan->sub_kegiatan_id
                                            ? 'bg-orange-50 font-semibold text-orange-700'
                                            : 'text-slate-600 hover:bg-slate-50' }}">

                                        <i
                                            class="bi bi-diagram-3-fill text-sm
                                            {{ (string) request('sub_kegiatan') === (string) $subKegiatan->sub_kegiatan_id
                                                ? 'text-orange-500'
                                                : 'text-slate-400' }}">
                                        </i>

                                        <span class="min-w-0 flex-1 truncate">
                                            {{ $subKegiatan->sub_kegiatan_name }}
                                        </span>

                                    </a>

                                @empty

                                    <p class="px-3 py-2 text-xs text-slate-400">
                                        Belum ada sub kegiatan.
                                    </p>
                                @endforelse

                            </div>


                            {{-- =================================================
                                JENIS DOKUMEN
                            ================================================== --}}

                            <div class="mt-5">

                                <p class="px-3 pb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    Jenis Dokumen
                                </p>

                                @forelse ($documentTypes ?? [] as $documentType)
                                    <a href="{{ request()->fullUrlWithQuery([
                                        'document_type' => $documentType->document_type_id,
                                        'page' => null,
                                    ]) }}"
                                        class="mb-0.5 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                                        {{ (string) request('document_type') === (string) $documentType->document_type_id
                                            ? 'bg-red-50 font-semibold text-red-700'
                                            : 'text-slate-600 hover:bg-slate-50' }}">

                                        <i
                                            class="bi bi-file-earmark-text text-sm
                                            {{ (string) request('document_type') === (string) $documentType->document_type_id
                                                ? 'text-red-500'
                                                : 'text-slate-400' }}">
                                        </i>

                                        <span class="min-w-0 flex-1 truncate">
                                            {{ $documentType->document_type_name }}
                                        </span>

                                    </a>

                                @empty

                                    <p class="px-3 py-2 text-xs text-slate-400">
                                        Belum ada jenis dokumen.
                                    </p>
                                @endforelse

                            </div>


                            {{-- =================================================
                                TAG
                            ================================================== --}}

                            <div class="mt-5">

                                <p class="px-3 pb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    Tag
                                </p>

                                @forelse ($tags ?? [] as $tag)
                                    <a href="{{ request()->fullUrlWithQuery([
                                        'tag' => $tag->tag_id,
                                        'page' => null,
                                    ]) }}"
                                        class="mb-0.5 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                                        {{ (string) request('tag') === (string) $tag->tag_id
                                            ? 'bg-amber-50 font-semibold text-amber-700'
                                            : 'text-slate-600 hover:bg-slate-50' }}">

                                        <i
                                            class="bi bi-tag text-sm
                                            {{ (string) request('tag') === (string) $tag->tag_id ? 'text-amber-500' : 'text-slate-400' }}">
                                        </i>

                                        <span class="min-w-0 flex-1 truncate">
                                            {{ $tag->tag_name }}
                                        </span>

                                    </a>

                                @empty

                                    <p class="px-3 py-2 text-xs text-slate-400">
                                        Belum ada tag.
                                    </p>
                                @endforelse

                            </div>

                        </div>

                    </div>

                </aside>


                {{-- ====================================================
                    CONTENT
                ===================================================== --}}

                <section class="min-w-0">


                    {{-- =================================================
                        PAGE HEADER
                    ================================================== --}}

                    <div class="mb-5 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <p class="text-[10px] font-bold uppercase tracking-wider text-purple-600">
                                Arsip
                            </p>

                            <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">

                                @if (request('unit') && isset($selectedUnit))
                                    {{ $selectedUnit->unit_name }}
                                @elseif (request('program') && isset($selectedProgram))
                                    {{ $selectedProgram->program_name }}
                                @elseif (request('kegiatan') && isset($selectedKegiatan))
                                    {{ $selectedKegiatan->kegiatan_name }}
                                @elseif (request('sub_kegiatan') && isset($selectedSubKegiatan))
                                    {{ $selectedSubKegiatan->sub_kegiatan_name }}
                                @elseif (request('document_type') && isset($selectedDocumentType))
                                    {{ $selectedDocumentType->document_type_name }}
                                @elseif (request('tag') && isset($selectedTag))
                                    #{{ $selectedTag->tag_name }}
                                @else
                                    Semua Arsip
                                @endif

                            </h1>

                            <p class="mt-1 text-sm text-slate-400">
                                Temukan dan akses arsip yang tersedia.
                            </p>

                        </div>


                        {{-- RESET FILTER --}}
                        @if (request()->hasAny(['unit', 'program', 'kegiatan', 'sub_kegiatan', 'document_type', 'tag', 'q']))
                            <a href="{{ request()->url() }}"
                                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-semibold text-slate-600 transition hover:border-purple-200 hover:bg-purple-50 hover:text-purple-700">

                                <i class="bi bi-x-circle"></i>

                                Reset Filter

                            </a>
                        @endif

                    </div>


                    {{-- =================================================
                        SEARCH
                    ================================================== --}}

                    <form action="{{ request()->url() }}" method="GET" class="mb-5">

                        {{-- PERTAHANKAN FILTER AKTIF --}}
                        @foreach (request()->except(['q', 'page']) as $key => $value)
                            @if (!is_array($value))
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach


                        <div class="relative">

                            <i
                                class="bi bi-search pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-lg text-slate-400">
                            </i>

                            <input type="text" name="q" value="{{ request('q') }}"
                                placeholder="Cari judul arsip, unit, program, jenis dokumen, atau kata kunci..."
                                class="w-full rounded-2xl border border-slate-200 bg-white py-3.5 pl-12 pr-4 text-sm text-slate-700 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-purple-300 focus:ring-4 focus:ring-purple-500/10">

                        </div>

                    </form>


                    {{-- =================================================
    ACTIVE FILTER
================================================== --}}

                    @if (request()->hasAny(['unit', 'program', 'kegiatan', 'sub_kegiatan', 'document_type', 'tag']))

                        @php
                            /*
        |--------------------------------------------------------------------------
        | URL UNTUK MENGHAPUS SATU FILTER
        |--------------------------------------------------------------------------
        | Filter lain tetap dipertahankan.
        | Page dihapus supaya kembali ke halaman 1.
        */

                            $removeFilterUrl = function ($filter) {
                                $query = request()->except([$filter, 'page']);

                                return request()->url() . (count($query) > 0 ? '?' . http_build_query($query) : '');
                            };
                        @endphp


                        <div class="mb-5 flex flex-wrap items-center gap-2">

                            {{-- LABEL --}}
                            <span class="mr-1 text-xs text-slate-400">
                                Filter aktif:
                            </span>


                            {{-- =====================================================
            UNIT
        ====================================================== --}}

                            @if (request('unit') && isset($selectedUnit))
                                <div
                                    class="inline-flex max-w-full items-center gap-2 rounded-full
                       bg-blue-50 px-3 py-1.5 text-xs font-medium text-blue-700">

                                    <i class="bi bi-building text-blue-500"></i>

                                    <span class="max-w-[320px] truncate">
                                        {{ $selectedUnit->unit_name }}
                                    </span>

                                    {{-- X --}}
                                    <a href="{{ $removeFilterUrl('unit') }}"
                                        class="ml-0.5 flex h-4 w-4 shrink-0 items-center justify-center
                           rounded-full text-blue-500 transition
                           hover:bg-blue-200 hover:text-blue-800"
                                        title="Hapus filter unit" aria-label="Hapus filter unit">

                                        <i class="bi bi-x text-sm"></i>

                                    </a>

                                </div>
                            @endif


                            {{-- =====================================================
            PROGRAM
        ====================================================== --}}

                            @if (request('program') && isset($selectedProgram))
                                <div
                                    class="inline-flex max-w-full items-center gap-2 rounded-full
                       bg-emerald-50 px-3 py-1.5 text-xs font-medium text-emerald-700">

                                    <i class="bi bi-diagram-3 text-emerald-500"></i>

                                    <span class="max-w-[320px] truncate">
                                        {{ $selectedProgram->program_name }}
                                    </span>

                                    {{-- X --}}
                                    <a href="{{ $removeFilterUrl('program') }}"
                                        class="ml-0.5 flex h-4 w-4 shrink-0 items-center justify-center
                           rounded-full text-emerald-500 transition
                           hover:bg-emerald-200 hover:text-emerald-800"
                                        title="Hapus filter program" aria-label="Hapus filter program">

                                        <i class="bi bi-x text-sm"></i>

                                    </a>

                                </div>
                            @endif


                            {{-- =====================================================
            KEGIATAN
        ====================================================== --}}

                            @if (request('kegiatan') && isset($selectedKegiatan))
                                <div
                                    class="inline-flex max-w-full items-center gap-2 rounded-full
                       bg-indigo-50 px-3 py-1.5 text-xs font-medium text-indigo-700">

                                    <i class="bi bi-diagram-2 text-indigo-500"></i>

                                    <span class="max-w-[320px] truncate">
                                        {{ $selectedKegiatan->kegiatan_name }}
                                    </span>

                                    {{-- X --}}
                                    <a href="{{ $removeFilterUrl('kegiatan') }}"
                                        class="ml-0.5 flex h-4 w-4 shrink-0 items-center justify-center
                           rounded-full text-indigo-500 transition
                           hover:bg-indigo-200 hover:text-indigo-800"
                                        title="Hapus filter kegiatan" aria-label="Hapus filter kegiatan">

                                        <i class="bi bi-x text-sm"></i>

                                    </a>

                                </div>
                            @endif


                            {{-- =====================================================
            SUB KEGIATAN
        ====================================================== --}}

                            @if (request('sub_kegiatan') && isset($selectedSubKegiatan))
                                <div
                                    class="inline-flex max-w-full items-center gap-2 rounded-full
                       bg-orange-50 px-3 py-1.5 text-xs font-medium text-orange-700">

                                    <i class="bi bi-diagram-3-fill text-orange-500"></i>

                                    <span class="max-w-[320px] truncate">
                                        {{ $selectedSubKegiatan->sub_kegiatan_name }}
                                    </span>

                                    {{-- X --}}
                                    <a href="{{ $removeFilterUrl('sub_kegiatan') }}"
                                        class="ml-0.5 flex h-4 w-4 shrink-0 items-center justify-center
                           rounded-full text-orange-500 transition
                           hover:bg-orange-200 hover:text-orange-800"
                                        title="Hapus filter sub kegiatan" aria-label="Hapus filter sub kegiatan">

                                        <i class="bi bi-x text-sm"></i>

                                    </a>

                                </div>
                            @endif


                            {{-- =====================================================
            JENIS DOKUMEN
        ====================================================== --}}

                            @if (request('document_type') && isset($selectedDocumentType))
                                <div
                                    class="inline-flex max-w-full items-center gap-2 rounded-full
                       bg-red-50 px-3 py-1.5 text-xs font-medium text-red-700">

                                    <i class="bi bi-file-earmark-text text-red-500"></i>

                                    <span class="max-w-[320px] truncate">
                                        {{ $selectedDocumentType->document_type_name }}
                                    </span>

                                    {{-- X --}}
                                    <a href="{{ $removeFilterUrl('document_type') }}"
                                        class="ml-0.5 flex h-4 w-4 shrink-0 items-center justify-center
                           rounded-full text-red-500 transition
                           hover:bg-red-200 hover:text-red-800"
                                        title="Hapus filter jenis dokumen" aria-label="Hapus filter jenis dokumen">

                                        <i class="bi bi-x text-sm"></i>

                                    </a>

                                </div>
                            @endif


                            {{-- =====================================================
            TAG
        ====================================================== --}}

                            @if (request('tag') && isset($selectedTag))
                                <div
                                    class="inline-flex max-w-full items-center gap-2 rounded-full
                       bg-amber-50 px-3 py-1.5 text-xs font-medium text-amber-700">

                                    <i class="bi bi-tag text-amber-500"></i>

                                    <span class="max-w-[320px] truncate">
                                        #{{ $selectedTag->tag_name }}
                                    </span>

                                    {{-- X --}}
                                    <a href="{{ $removeFilterUrl('tag') }}"
                                        class="ml-0.5 flex h-4 w-4 shrink-0 items-center justify-center
                           rounded-full text-amber-500 transition
                           hover:bg-amber-200 hover:text-amber-800"
                                        title="Hapus filter tag" aria-label="Hapus filter tag">

                                        <i class="bi bi-x text-sm"></i>

                                    </a>

                                </div>
                            @endif


                            {{-- =====================================================
            RESET SEMUA
        ====================================================== --}}

                            @if (request()->hasAny(['unit', 'program', 'kegiatan', 'sub_kegiatan', 'document_type', 'tag']))
                                <a href="{{ request()->url() }}"
                                    class="ml-1 inline-flex items-center gap-1.5 rounded-full
                       border border-slate-200 bg-white px-3 py-1.5
                       text-xs font-semibold text-slate-500 transition
                       hover:border-red-200 hover:bg-red-50 hover:text-red-600">

                                    <i class="bi bi-x-circle"></i>

                                    Reset semua

                                </a>
                            @endif

                        </div>

                    @endif


                    {{-- =================================================
                        RESULT INFO
                    ================================================== --}}

                    <div class="mb-4 flex items-center justify-between">

                        <p class="text-xs text-slate-400">

                            Menampilkan

                            <span class="font-semibold text-slate-600">
                                {{ $archives->count() }}
                            </span>

                            arsip

                            @if (method_exists($archives, 'total'))
                                dari

                                <span class="font-semibold text-slate-600">
                                    {{ $archives->total() }}
                                </span>
                            @endif

                        </p>

                    </div>


                    {{-- =================================================
                        ARCHIVE GRID
                    ================================================== --}}

                    @if ($archives->count() > 0)

                        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">

                            @foreach ($archives as $archive)
                                <article
                                    class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white transition duration-200 hover:-translate-y-0.5 hover:border-purple-200 hover:shadow-lg">


                                    {{-- =================================================
                                        CARD BODY
                                    ================================================== --}}

                                    <div class="p-5">

                                        {{-- TOP --}}
                                        <div class="flex items-start justify-between gap-3">

                                            {{-- ICON + JUDUL BERKAS --}}
                                            <div class="flex min-w-0 items-center gap-3">

                                                <div
                                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-sadarin-50 text-sadarin-600">

                                                    <i class="bi bi-archive text-xl"></i>

                                                </div>

                                                @php
                                                    $firstFile = $archive->files->first();
                                                @endphp

                                                @if ($firstFile)
                                                    <div class="min-w-0">

                                                        <p
                                                            class="text-xs font-semibold leading-5 text-slate-700 line-clamp-2">
                                                            {{ $firstFile->archive_file_original_name ?? 'Berkas' }}
                                                        </p>

                                                    </div>
                                                @endif

                                            </div>


                                            {{-- ACCESS --}}
                                            <span
                                                class="shrink-0 rounded-full px-2.5 py-1 text-[10px] font-semibold
        {{ $archive->archive_is_public ?? false ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">

                                                {{ $archive->archive_is_public ?? false ? 'Publik' : 'Internal' }}

                                            </span>

                                        </div>


                                        {{-- TITLE --}}
                                        <h2
                                            class="mt-5 line-clamp-2 text-base font-bold leading-6 text-slate-900 transition group-hover:text-purple-700">

                                            {{ $archive->archive_title }}

                                        </h2>


                                        {{-- DOCUMENT TYPE + YEAR --}}
                                        <div class="mt-2 flex items-center gap-1.5 text-xs text-slate-400">

                                            <i class="bi bi-file-earmark-text"></i>

                                            <span class="truncate">

                                                {{ $archive->documentType->document_type_name ?? 'Dokumen' }}

                                            </span>

                                            @if (!empty($archive->archive_year))
                                                <span class="text-slate-300">
                                                    •
                                                </span>

                                                <span>
                                                    {{ $archive->archive_year }}
                                                </span>
                                            @endif

                                        </div>


                                        {{-- UNIT --}}
                                        @if ($archive->unit)
                                            <div class="mt-4 flex items-center gap-2 text-xs text-slate-500">

                                                <i class="bi bi-building text-blue-500"></i>

                                                <span class="truncate">
                                                    {{ $archive->unit->unit_name }}
                                                </span>

                                            </div>
                                        @endif


                                        {{-- PROGRAM --}}
                                        @if ($archive->program)
                                            <div class="mt-2 flex items-center gap-2 text-xs text-slate-500">

                                                <i class="bi bi-diagram-3 text-emerald-500"></i>

                                                <span class="truncate">
                                                    {{ $archive->program->program_name }}
                                                </span>

                                            </div>
                                        @endif


                                        {{-- KEGIATAN --}}
                                        @if ($archive->kegiatan)
                                            <div class="mt-2 flex items-center gap-2 text-xs text-slate-500">

                                                <i class="bi bi-diagram-2 text-indigo-500"></i>

                                                <span class="truncate">
                                                    {{ $archive->kegiatan->kegiatan_name }}
                                                </span>

                                            </div>
                                        @endif


                                        {{-- SUB KEGIATAN --}}
                                        @if ($archive->subKegiatan)
                                            <div class="mt-2 flex items-center gap-2 text-xs text-slate-500">

                                                <i class="bi bi-diagram-3-fill text-orange-500"></i>

                                                <span class="truncate">
                                                    {{ $archive->subKegiatan->sub_kegiatan_name }}
                                                </span>

                                            </div>
                                        @endif


                                        {{-- =================================================
                                            TAG
                                            TAG BERASAL DARI FILE
                                        ================================================== --}}

                                        @php

                                            $archiveTags = collect();

                                            foreach ($archive->files ?? [] as $file) {
                                                foreach ($file->tags ?? [] as $tag) {
                                                    $archiveTags->push($tag);
                                                }
                                            }

                                            $archiveTags = $archiveTags->unique('tag_id')->take(5);

                                        @endphp


                                        @if ($archiveTags->count() > 0)
                                            <div class="mt-4 flex flex-wrap gap-1.5">

                                                @foreach ($archiveTags as $tag)
                                                    <a href="{{ request()->fullUrlWithQuery([
                                                        'tag' => $tag->tag_id,
                                                        'page' => null,
                                                    ]) }}"
                                                        class="rounded-full bg-amber-50 px-2.5 py-1 text-[10px] font-medium text-amber-700 transition hover:bg-amber-100">

                                                        #{{ $tag->tag_name }}

                                                    </a>
                                                @endforeach

                                            </div>
                                        @endif

                                    </div>


                                    {{-- =================================================
                                        CARD FOOTER
                                    ================================================== --}}

                                    <div class="mt-auto border-t border-slate-100 px-5 py-4">

                                        <div class="flex items-center justify-between gap-3">


                                            {{-- FILE COUNT --}}
                                            <div class="flex items-center gap-1.5 text-[11px] text-slate-400">

                                                <i class="bi bi-paperclip"></i>

                                                {{ $archive->files?->count() ?? 0 }}

                                                berkas

                                            </div>


                                            {{-- DETAIL --}}
                                            @if ($archive->archive_id)
                                                <a href="{{ route('sadarin.user.archive.files', $archive->archive_id) }}"
                                                    class="inline-flex items-center gap-2 rounded-xl bg-sadarin-700 px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-sadarin-800">

                                                    <i class="bi bi-folder2-open"></i>

                                                    Lihat Berkas

                                                    <i class="bi bi-arrow-right"></i>

                                                </a>
                                            @endif

                                        </div>

                                    </div>

                                </article>
                            @endforeach

                        </div>


                        {{-- =================================================
                            PAGINATION
                        ================================================== --}}

                        @if (method_exists($archives, 'links'))
                            <div class="mt-8">

                                {{ $archives->withQueryString()->links() }}

                            </div>
                        @endif
                    @else
                        {{-- =================================================
                            EMPTY
                        ================================================== --}}

                        <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center">

                            <div
                                class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                                <i class="bi bi-archive text-2xl"></i>

                            </div>


                            <h2 class="mt-5 text-base font-bold text-slate-800">

                                Arsip tidak ditemukan

                            </h2>


                            <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-400">

                                Tidak ada arsip yang sesuai dengan filter atau
                                pencarian yang digunakan.

                            </p>


                            <a href="{{ request()->url() }}"
                                class="mt-5 inline-flex items-center gap-2 rounded-xl bg-purple-700 px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-purple-800">

                                <i class="bi bi-arrow-counterclockwise"></i>

                                Tampilkan Semua Arsip

                            </a>

                        </div>

                    @endif

                </section>

            </div>

        </main>


        {{-- ============================================================
            FOOTER
        ============================================================= --}}

        <footer class="border-t border-slate-200 bg-white">

            <div
                class="mx-auto flex max-w-[1600px] flex-col gap-2 px-5 py-6 text-xs text-slate-400 sm:px-8 md:flex-row md:items-center md:justify-between">

                <span>
                    © {{ date('Y') }} SADARIN
                </span>

                <span>
                    Sistem Arsip Data dan Berkas Internal
                </span>

            </div>

        </footer>

    </div>

@endsection
