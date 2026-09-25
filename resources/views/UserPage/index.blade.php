@extends('UserPage.layouts.app')

@section('title', 'Daftar Arsip - SADARIN')

@section('meta_description')
    Daftar Arsip SADARIN - Sistem Arsip Data dan Berkas Internal
@endsection

@section('content')

    <div class="min-h-screen bg-slate-50">

        <main class="mx-auto w-full max-w-[1600px] px-4 py-5 sm:px-6 lg:px-8">

            {{-- ============================================================
                MOBILE FILTER
            ============================================================= --}}

            <div class="mb-4 lg:hidden">

                <details class="group">

                    <summary
                        class="flex cursor-pointer list-none items-center justify-between rounded-2xl border border-slate-200 bg-white px-4 py-3.5 shadow-sm transition hover:border-sadarin-200 hover:bg-sadarin-50/30">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-sadarin-50 text-sadarin-600">

                                <i class="bi bi-funnel"></i>

                            </div>

                            <div class="text-left">

                                <p class="text-sm font-semibold text-slate-800">
                                    Filter Arsip
                                </p>

                                <p class="text-[11px] text-slate-400">
                                    Pilih klasifikasi arsip
                                </p>

                            </div>

                        </div>

                        <i class="bi bi-chevron-down text-sm text-slate-400 transition duration-200 group-open:rotate-180">
                        </i>

                    </summary>


                    {{-- MOBILE FILTER CONTENT --}}

                    <div class="mt-2 overflow-hidden rounded-2xl border border-slate-200 bg-white p-2 shadow-sm">

                        {{-- SEMUA ARSIP --}}

                        <a href="{{ request()->url() }}"
                            class="mb-1 flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition
                            {{ !request()->hasAny(['unit', 'program', 'kegiatan', 'sub_kegiatan', 'document_type', 'tag', 'q'])
                                ? 'bg-sadarin-50 text-sadarin-700'
                                : 'text-slate-600 hover:bg-slate-50' }}">

                            <span
                                class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg
                                {{ !request()->hasAny(['unit', 'program', 'kegiatan', 'sub_kegiatan', 'document_type', 'tag', 'q'])
                                    ? 'bg-white text-sadarin-600'
                                    : 'bg-slate-100 text-slate-500' }}">

                                <i class="bi bi-archive"></i>

                            </span>

                            <span class="flex-1">
                                Semua Arsip
                            </span>

                        </a>


                        {{-- UNIT --}}

                        @if (($units ?? collect())->count() > 0)

                            <div class="mt-3">

                                <p class="px-3 pb-1.5 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    Unit
                                </p>

                                @foreach ($units as $unit)
                                    <a href="{{ request()->fullUrlWithQuery([
                                        'unit' => $unit->unit_id,
                                        'page' => null,
                                    ]) }}"
                                        class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                                        {{ (string) request('unit') === (string) $unit->unit_id
                                            ? 'bg-sadarin-50 font-semibold text-sadarin-700'
                                            : 'text-slate-600 hover:bg-slate-50' }}">

                                        <i
                                            class="bi bi-building text-sm
                                            {{ (string) request('unit') === (string) $unit->unit_id ? 'text-sadarin-500' : 'text-slate-400' }}">
                                        </i>

                                        <span class="min-w-0 flex-1 truncate">
                                            {{ $unit->unit_name }}
                                        </span>

                                    </a>
                                @endforeach

                            </div>

                        @endif


                        {{-- PROGRAM --}}

                        @if (($programs ?? collect())->count() > 0)

                            <div class="mt-3">

                                <p class="px-3 pb-1.5 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    Program
                                </p>

                                @foreach ($programs as $program)
                                    <a href="{{ request()->fullUrlWithQuery([
                                        'program' => $program->program_id,
                                        'page' => null,
                                    ]) }}"
                                        class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                                        {{ (string) request('program') === (string) $program->program_id
                                            ? 'bg-sadarin-50 font-semibold text-sadarin-700'
                                            : 'text-slate-600 hover:bg-slate-50' }}">

                                        <i
                                            class="bi bi-diagram-3 text-sm
                                            {{ (string) request('program') === (string) $program->program_id ? 'text-sadarin-500' : 'text-slate-400' }}">
                                        </i>

                                        <span class="min-w-0 flex-1 truncate">

                                            @if (!empty($program->program_code))
                                                {{ $program->program_code }} -
                                            @endif

                                            {{ $program->program_name }}

                                        </span>

                                    </a>
                                @endforeach

                            </div>

                        @endif


                        {{-- KEGIATAN --}}

                        @if (($kegiatans ?? collect())->count() > 0)

                            <div class="mt-3">

                                <p class="px-3 pb-1.5 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    Kegiatan
                                </p>

                                @foreach ($kegiatans as $kegiatan)
                                    <a href="{{ request()->fullUrlWithQuery([
                                        'kegiatan' => $kegiatan->kegiatan_id,
                                        'page' => null,
                                    ]) }}"
                                        class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                                        {{ (string) request('kegiatan') === (string) $kegiatan->kegiatan_id
                                            ? 'bg-sadarin-50 font-semibold text-sadarin-700'
                                            : 'text-slate-600 hover:bg-slate-50' }}">

                                        <i
                                            class="bi bi-diagram-2 text-sm
                                            {{ (string) request('kegiatan') === (string) $kegiatan->kegiatan_id ? 'text-sadarin-500' : 'text-slate-400' }}">
                                        </i>

                                        <span class="min-w-0 flex-1 truncate">

                                            @if (!empty($kegiatan->kegiatan_code))
                                                {{ $kegiatan->kegiatan_code }} -
                                            @endif

                                            {{ $kegiatan->kegiatan_name }}

                                        </span>

                                    </a>
                                @endforeach

                            </div>

                        @endif


                        {{-- SUB KEGIATAN --}}

                        @if (($subKegiatans ?? collect())->count() > 0)

                            <div class="mt-3">

                                <p class="px-3 pb-1.5 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    Sub Kegiatan
                                </p>

                                @foreach ($subKegiatans as $subKegiatan)
                                    <a href="{{ request()->fullUrlWithQuery([
                                        'sub_kegiatan' => $subKegiatan->sub_kegiatan_id,
                                        'page' => null,
                                    ]) }}"
                                        class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                                        {{ (string) request('sub_kegiatan') === (string) $subKegiatan->sub_kegiatan_id
                                            ? 'bg-sadarin-50 font-semibold text-sadarin-700'
                                            : 'text-slate-600 hover:bg-slate-50' }}">

                                        <i
                                            class="bi bi-diagram-3-fill text-sm
                                            {{ (string) request('sub_kegiatan') === (string) $subKegiatan->sub_kegiatan_id
                                                ? 'text-sadarin-500'
                                                : 'text-slate-400' }}">
                                        </i>

                                        <span class="min-w-0 flex-1 truncate">

                                            @if (!empty($subKegiatan->sub_kegiatan_code))
                                                {{ $subKegiatan->sub_kegiatan_code }} -
                                            @endif

                                            {{ $subKegiatan->sub_kegiatan_name }}

                                        </span>

                                    </a>
                                @endforeach

                            </div>

                        @endif


                        {{-- JENIS DOKUMEN --}}

                        @if (($documentTypes ?? collect())->count() > 0)

                            <div class="mt-3">

                                <p class="px-3 pb-1.5 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    Jenis Dokumen
                                </p>

                                @foreach ($documentTypes as $documentType)
                                    <a href="{{ request()->fullUrlWithQuery([
                                        'document_type' => $documentType->document_type_id,
                                        'page' => null,
                                    ]) }}"
                                        class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                                        {{ (string) request('document_type') === (string) $documentType->document_type_id
                                            ? 'bg-sadarin-50 font-semibold text-sadarin-700'
                                            : 'text-slate-600 hover:bg-slate-50' }}">

                                        <i
                                            class="bi bi-file-earmark-text text-sm
                                            {{ (string) request('document_type') === (string) $documentType->document_type_id
                                                ? 'text-sadarin-500'
                                                : 'text-slate-400' }}">
                                        </i>

                                        <span class="min-w-0 flex-1 truncate">
                                            {{ $documentType->document_type_name }}
                                        </span>

                                    </a>
                                @endforeach

                            </div>

                        @endif


                        {{-- TAG --}}

                        @if (($tags ?? collect())->count() > 0)

                            <div class="mt-3">

                                <p class="px-3 pb-1.5 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    Tag
                                </p>

                                @foreach ($tags as $tag)
                                    <a href="{{ request()->fullUrlWithQuery([
                                        'tag' => $tag->tag_id,
                                        'page' => null,
                                    ]) }}"
                                        class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                                        {{ (string) request('tag') === (string) $tag->tag_id
                                            ? 'bg-sadarin-50 font-semibold text-sadarin-700'
                                            : 'text-slate-600 hover:bg-slate-50' }}">

                                        <i
                                            class="bi bi-tag text-sm
                                            {{ (string) request('tag') === (string) $tag->tag_id ? 'text-sadarin-500' : 'text-slate-400' }}">
                                        </i>

                                        <span class="min-w-0 flex-1 truncate">
                                            #{{ $tag->tag_name }}
                                        </span>

                                    </a>
                                @endforeach

                            </div>

                        @endif

                    </div>

                </details>

            </div>


            {{-- ============================================================
                DESKTOP
            ============================================================= --}}

            <div class="grid gap-5 lg:grid-cols-[338px_minmax(0,1fr)]">


                @include('UserPage.partials.sidebar')


                {{-- ========================================================
                    CONTENT
                ========================================================= --}}

                <section class="min-w-0">


                    {{-- PAGE HEADER --}}

                    <div class="mb-5 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        <div class="min-w-0">

                            <p class="text-[10px] font-bold uppercase tracking-wider text-sadarin-600">
                                Arsip
                            </p>

                            <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">

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


                        {{-- RESET --}}

                        @if (request()->hasAny(['unit', 'program', 'kegiatan', 'sub_kegiatan', 'document_type', 'tag', 'q']))
                            <a href="{{ request()->url() }}"
                                class="inline-flex w-full shrink-0 items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-semibold text-slate-600 transition hover:border-sadarin-200 hover:bg-sadarin-50 hover:text-sadarin-700 sm:w-auto">

                                <i class="bi bi-x-circle"></i>

                                Reset Filter

                            </a>
                        @endif

                    </div>


                    {{-- SEARCH --}}

                    <form action="{{ request()->url() }}" method="GET" class="mb-5">

                        @foreach (request()->except(['q', 'page']) as $key => $value)
                            @if (!is_array($value))
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach


                        <div class="relative">

                            <i
                                class="bi bi-search pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-lg text-slate-400 sm:left-5">
                            </i>

                            <input type="text" name="q" value="{{ request('q') }}"
                                placeholder="Cari judul arsip, unit, program, kegiatan, jenis dokumen, atau tag..."
                                class="w-full rounded-2xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-sm text-slate-700 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-sadarin-300 focus:ring-4 focus:ring-sadarin-500/10 sm:py-3.5 sm:pl-12">

                        </div>

                    </form>


                    {{-- ACTIVE FILTER --}}

                    @if (request()->hasAny(['unit', 'program', 'kegiatan', 'sub_kegiatan', 'document_type', 'tag']))

                        @php

                            $removeFilterUrl = function ($filter) {
                                $query = request()->except([$filter, 'page']);

                                return request()->url() . (count($query) > 0 ? '?' . http_build_query($query) : '');
                            };
                        @endphp


                        <div class="mb-5 flex flex-wrap items-center gap-2">

                            <span class="mr-1 text-xs text-slate-400">
                                Filter aktif:
                            </span>


                            {{-- UNIT --}}

                            @if (request('unit') && isset($selectedUnit))
                                <div
                                    class="inline-flex max-w-full items-center gap-2 rounded-full bg-blue-50 px-3 py-1.5 text-xs font-medium text-blue-700">

                                    <i class="bi bi-building text-blue-500"></i>

                                    <span class="max-w-[240px] truncate sm:max-w-[320px]">
                                        {{ $selectedUnit->unit_name }}
                                    </span>

                                    <a href="{{ $removeFilterUrl('unit') }}"
                                        class="ml-0.5 flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-blue-500 transition hover:bg-blue-200 hover:text-blue-800">

                                        <i class="bi bi-x text-sm"></i>

                                    </a>

                                </div>
                            @endif


                            {{-- PROGRAM --}}

                            @if (request('program') && isset($selectedProgram))
                                <div
                                    class="inline-flex max-w-full items-center gap-2 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-medium text-emerald-700">

                                    <i class="bi bi-diagram-3 text-emerald-500"></i>

                                    <span class="max-w-[240px] truncate sm:max-w-[320px]">
                                        {{ $selectedProgram->program_name }}
                                    </span>

                                    <a href="{{ $removeFilterUrl('program') }}"
                                        class="ml-0.5 flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-emerald-500 transition hover:bg-emerald-200 hover:text-emerald-800">

                                        <i class="bi bi-x text-sm"></i>

                                    </a>

                                </div>
                            @endif


                            {{-- KEGIATAN --}}

                            @if (request('kegiatan') && isset($selectedKegiatan))
                                <div
                                    class="inline-flex max-w-full items-center gap-2 rounded-full bg-indigo-50 px-3 py-1.5 text-xs font-medium text-indigo-700">

                                    <i class="bi bi-diagram-2 text-indigo-500"></i>

                                    <span class="max-w-[240px] truncate sm:max-w-[320px]">
                                        {{ $selectedKegiatan->kegiatan_name }}
                                    </span>

                                    <a href="{{ $removeFilterUrl('kegiatan') }}"
                                        class="ml-0.5 flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-indigo-500 transition hover:bg-indigo-200 hover:text-indigo-800">

                                        <i class="bi bi-x text-sm"></i>

                                    </a>

                                </div>
                            @endif


                            {{-- SUB KEGIATAN --}}

                            @if (request('sub_kegiatan') && isset($selectedSubKegiatan))
                                <div
                                    class="inline-flex max-w-full items-center gap-2 rounded-full bg-orange-50 px-3 py-1.5 text-xs font-medium text-orange-700">

                                    <i class="bi bi-diagram-3-fill text-orange-500"></i>

                                    <span class="max-w-[240px] truncate sm:max-w-[320px]">
                                        {{ $selectedSubKegiatan->sub_kegiatan_name }}
                                    </span>

                                    <a href="{{ $removeFilterUrl('sub_kegiatan') }}"
                                        class="ml-0.5 flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-orange-500 transition hover:bg-orange-200 hover:text-orange-800">

                                        <i class="bi bi-x text-sm"></i>

                                    </a>

                                </div>
                            @endif


                            {{-- DOCUMENT TYPE --}}

                            @if (request('document_type') && isset($selectedDocumentType))
                                <div
                                    class="inline-flex max-w-full items-center gap-2 rounded-full bg-red-50 px-3 py-1.5 text-xs font-medium text-red-700">

                                    <i class="bi bi-file-earmark-text text-red-500"></i>

                                    <span class="max-w-[240px] truncate sm:max-w-[320px]">
                                        {{ $selectedDocumentType->document_type_name }}
                                    </span>

                                    <a href="{{ $removeFilterUrl('document_type') }}"
                                        class="ml-0.5 flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-red-500 transition hover:bg-red-200 hover:text-red-800">

                                        <i class="bi bi-x text-sm"></i>

                                    </a>

                                </div>
                            @endif


                            {{-- TAG --}}

                            @if (request('tag') && isset($selectedTag))
                                <div
                                    class="inline-flex max-w-full items-center gap-2 rounded-full bg-amber-50 px-3 py-1.5 text-xs font-medium text-amber-700">

                                    <i class="bi bi-tag text-amber-500"></i>

                                    <span class="max-w-[240px] truncate sm:max-w-[320px]">
                                        #{{ $selectedTag->tag_name }}
                                    </span>

                                    <a href="{{ $removeFilterUrl('tag') }}"
                                        class="ml-0.5 flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-amber-500 transition hover:bg-amber-200 hover:text-amber-800">

                                        <i class="bi bi-x text-sm"></i>

                                    </a>

                                </div>
                            @endif


                            {{-- RESET --}}

                            <a href="{{ request()->url() }}"
                                class="ml-1 inline-flex items-center gap-1.5 rounded-full border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-500 transition hover:border-sadarin-200 hover:bg-sadarin-50 hover:text-sadarin-700">

                                <i class="bi bi-x-circle"></i>

                                Reset semua

                            </a>

                        </div>

                    @endif


                    {{-- RESULT INFO --}}

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


                    {{-- ========================================================
                        ARCHIVE GRID
                    ========================================================= --}}

                    @if ($archives->count() > 0)

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">

                            @foreach ($archives as $archive)
                                @php
                                    /*
                                    |--------------------------------------------------------------------------
                                    | HIERARKI KLASIFIKASI
                                    |--------------------------------------------------------------------------
                                    |
                                    | Archive hanya menyimpan archive_sub_kegiatan_id.
                                    |
                                    | Sub Kegiatan
                                    |      ↓
                                    | Kegiatan
                                    |      ↓
                                    | Program
                                    |
                                    */

                                    $subKegiatan = $archive->subKegiatan;

                                    $kegiatan = $subKegiatan?->kegiatan;

                                    $program = $kegiatan?->program;

                                    $archiveTags = $archive->tags ?? collect();

                                    $accessLevel = $archive->archive_access_level ?? 'internal';

                                    $accessLabel = match ($accessLevel) {
                                        'public' => 'Publik',
                                        'restricted' => 'Terbatas',
                                        default => 'Internal',
                                    };

                                    $accessClass = match ($accessLevel) {
                                        'public' => 'bg-emerald-50 text-emerald-600',
                                        'restricted' => 'bg-amber-50 text-amber-600',
                                        default => 'bg-slate-100 text-slate-500',
                                    };

                                @endphp


                                <article
                                    class="group flex min-w-0 flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white transition duration-200 hover:-translate-y-0.5 hover:border-sadarin-200 hover:shadow-lg">


                                    {{-- =================================================
                                        CARD BODY
                                    ================================================== --}}

                                    <div class="p-4 sm:p-5">


                                        {{-- TOP --}}

                                        <div class="flex items-start justify-between gap-3">

                                            <div
                                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-sadarin-50 text-sadarin-600">

                                                <i class="bi bi-archive text-xl"></i>

                                            </div>


                                            {{-- ACCESS LEVEL --}}

                                            <span
                                                class="shrink-0 rounded-full px-2.5 py-1 text-[10px] font-semibold {{ $accessClass }}">

                                                @if ($accessLevel === 'public')
                                                    <i class="bi bi-globe2 mr-1"></i>
                                                @elseif ($accessLevel === 'restricted')
                                                    <i class="bi bi-lock-fill mr-1"></i>
                                                @else
                                                    <i class="bi bi-building mr-1"></i>
                                                @endif

                                                {{ $accessLabel }}

                                            </span>

                                        </div>


                                        {{-- TITLE --}}

                                        <h2
                                            class="mt-5 line-clamp-2 text-base font-bold leading-6 text-slate-900 transition group-hover:text-sadarin-700">

                                            {{ $archive->archive_title }}

                                        </h2>


                                        {{-- DOCUMENT TYPE + YEAR --}}

                                        <div class="mt-2 flex flex-wrap items-center gap-1.5 text-xs text-slate-400">

                                            <i class="bi bi-file-earmark-text"></i>

                                            <span>

                                                {{ $archive->documentType->document_type_name ?? 'Dokumen' }}

                                            </span>

                                            @if ($archive->archive_year)
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
                                            <div class="mt-4 flex items-start gap-2 text-xs text-slate-500">

                                                <i class="bi bi-building mt-0.5 shrink-0 text-blue-500"></i>

                                                <span class="line-clamp-2">
                                                    {{ $archive->unit->unit_name }}
                                                </span>

                                            </div>
                                        @endif


                                        {{-- PROGRAM --}}

                                        @if ($program)
                                            <div class="mt-2 flex items-start gap-2 text-xs text-slate-500">

                                                <i class="bi bi-diagram-3 mt-0.5 shrink-0 text-emerald-500"></i>

                                                <span class="line-clamp-2">

                                                    @if (!empty($program->program_code))
                                                        {{ $program->program_code }} -
                                                    @endif

                                                    {{ $program->program_name }}

                                                </span>

                                            </div>
                                        @endif


                                        {{-- KEGIATAN --}}

                                        @if ($kegiatan)
                                            <div class="mt-2 flex items-start gap-2 text-xs text-slate-500">

                                                <i class="bi bi-diagram-2 mt-0.5 shrink-0 text-indigo-500"></i>

                                                <span class="line-clamp-2">

                                                    @if (!empty($kegiatan->kegiatan_code))
                                                        {{ $kegiatan->kegiatan_code }} -
                                                    @endif

                                                    {{ $kegiatan->kegiatan_name }}

                                                </span>

                                            </div>
                                        @endif


                                        {{-- SUB KEGIATAN --}}

                                        @if ($subKegiatan)
                                            <div class="mt-2 flex items-start gap-2 text-xs text-slate-500">

                                                <i class="bi bi-diagram-3-fill mt-0.5 shrink-0 text-orange-500"></i>

                                                <span class="line-clamp-2">

                                                    @if (!empty($subKegiatan->sub_kegiatan_code))
                                                        {{ $subKegiatan->sub_kegiatan_code }} -
                                                    @endif

                                                    {{ $subKegiatan->sub_kegiatan_name }}

                                                </span>

                                            </div>
                                        @endif


                                        {{-- TAG ARSIP --}}

                                        @if ($archiveTags->count() > 0)
                                            <div class="mt-4 flex flex-wrap gap-1.5">

                                                @foreach ($archiveTags->take(5) as $tag)
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

                                    <div class="mt-auto border-t border-slate-100 px-4 py-3.5 sm:px-5 sm:py-4">

                                        <div class="flex items-center justify-end">

                                            <a href="{{ route('sadarin.user.archive.show', $archive->archive_id) }}"
                                                class="inline-flex shrink-0 items-center gap-2 rounded-xl bg-sadarin-700 px-3.5 py-2.5 text-xs font-semibold text-white transition hover:bg-sadarin-800">

                                                <i class="bi bi-eye"></i>

                                                <span>
                                                    Lihat Arsip
                                                </span>

                                                <i class="bi bi-arrow-right"></i>

                                            </a>

                                        </div>

                                    </div>

                                </article>
                            @endforeach

                        </div>


                        {{-- PAGINATION --}}

                        @if (method_exists($archives, 'links'))
                            <div class="mt-8 overflow-x-auto">

                                {{ $archives->withQueryString()->links() }}

                            </div>
                        @endif
                    @else
                        {{-- EMPTY --}}

                        <div
                            class="rounded-2xl border border-dashed border-slate-300 bg-white px-5 py-14 text-center sm:px-6 sm:py-16">

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
                                class="mt-5 inline-flex items-center gap-2 rounded-xl bg-sadarin-700 px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-sadarin-800">

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
                class="mx-auto flex w-full max-w-[1600px] flex-col gap-2 px-4 py-6 text-xs text-slate-400 sm:px-6 md:flex-row md:items-center md:justify-between lg:px-8">

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
