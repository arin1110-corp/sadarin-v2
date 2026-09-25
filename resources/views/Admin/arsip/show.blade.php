@extends('Dashboard.layouts.app')

@section('title', 'Detail Arsip')
@section('page_title', 'Detail Arsip')
@section('breadcrumb', 'Administrasi Sistem / Arsip / Detail')

@section('content')

    <div class="space-y-6">

        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

                <div
                    class="flex h-11 w-11 items-center justify-center
                           rounded-xl bg-blue-50 text-blue-600">

                    <i class="bi bi-file-earmark-text-fill text-xl"></i>

                </div>

                <div>

                    <h1 class="text-xl font-bold text-slate-800">
                        Detail Arsip
                    </h1>

                    <p class="mt-0.5 text-sm text-slate-500">
                        Informasi lengkap arsip yang tersimpan di SADARIN.
                    </p>

                </div>

            </div>


            <div class="flex flex-wrap items-center gap-2">

                {{-- KEMBALI --}}
                <a href="{{ route('sadarin.admin.archive.index') }}"
                    class="inline-flex items-center justify-center gap-2
                           rounded-xl border border-slate-200 bg-white
                           px-4 py-2.5 text-sm font-semibold text-slate-600
                           shadow-sm transition hover:bg-slate-50">

                    <i class="bi bi-arrow-left"></i>

                    Kembali

                </a>


                {{-- EDIT --}}
                <a href="{{ route('sadarin.admin.archive.edit', $archive->archive_id) }}"
                    class="inline-flex items-center justify-center gap-2
                           rounded-xl bg-[oklch(29.3%_0.136_325.661)]
                           px-4 py-2.5 text-sm font-semibold text-white
                           shadow-sm transition hover:opacity-90">

                    <i class="bi bi-pencil-square"></i>

                    Edit

                </a>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- SUCCESS --}}
        {{-- ========================================================= --}}

        @if (session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3">

                <div class="flex items-center gap-2 text-sm font-semibold text-emerald-700">

                    <i class="bi bi-check-circle-fill"></i>

                    {{ session('success') }}

                </div>

            </div>
        @endif


        {{-- ========================================================= --}}
        {{-- INFORMASI ARSIP --}}
        {{-- ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- HEADER CARD --}}
            <div class="border-b border-slate-100 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-9 w-9 items-center justify-center
                               rounded-lg bg-blue-50 text-blue-600">

                        <i class="bi bi-file-earmark-text-fill"></i>

                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-slate-800">
                            Informasi Arsip
                        </h2>

                        <p class="text-xs text-slate-400">
                            Informasi dasar mengenai arsip.
                        </p>

                    </div>

                </div>

            </div>


            {{-- CONTENT --}}
            <div class="space-y-5 p-5">

                {{-- JUDUL --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Judul Arsip
                    </p>

                    <p class="mt-1 text-base font-bold text-slate-800">
                        {{ $archive->archive_title }}
                    </p>

                </div>


                {{-- DESKRIPSI --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Deskripsi
                    </p>

                    <p class="mt-1 whitespace-pre-line text-sm leading-6 text-slate-600">
                        {{ $archive->archive_description ?: '-' }}
                    </p>

                </div>


                {{-- TANGGAL & TAHUN --}}
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                    {{-- TAHUN --}}
                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Tahun
                        </p>

                        <p class="mt-1 text-sm font-semibold text-slate-700">
                            {{ $archive->archive_year ?: '-' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- KLASIFIKASI --}}
        {{-- ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- HEADER CARD --}}
            <div class="border-b border-slate-100 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-9 w-9 items-center justify-center
                               rounded-lg bg-indigo-50 text-indigo-600">

                        <i class="bi bi-diagram-3-fill"></i>

                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-slate-800">
                            Klasifikasi Arsip
                        </h2>

                        <p class="text-xs text-slate-400">
                            Unit, jenis dokumen, serta keterkaitan program dan kegiatan.
                        </p>

                    </div>

                </div>

            </div>


            {{-- CONTENT --}}
            <div class="p-5">

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    {{-- ================================================= --}}
                    {{-- UNIT --}}
                    {{-- ================================================= --}}

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Unit
                        </p>

                        <p class="mt-1 text-sm font-semibold text-slate-700">
                            {{ $archive->unit->unit_name ?? '-' }}
                        </p>

                    </div>


                    {{-- ================================================= --}}
                    {{-- JENIS DOKUMEN --}}
                    {{-- ================================================= --}}

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Jenis Dokumen
                        </p>

                        <p class="mt-1 text-sm font-semibold text-slate-700">
                            {{ $archive->documentType->document_type_name ?? '-' }}
                        </p>

                    </div>


                    {{-- ================================================= --}}
                    {{-- PROGRAM --}}
                    {{-- ================================================= --}}

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Program
                        </p>

                        <p class="mt-1 text-sm font-semibold text-slate-700">

                            @if ($archive->subKegiatan?->kegiatan?->program)

                                @if ($archive->subKegiatan->kegiatan->program->program_code)
                                    {{ $archive->subKegiatan->kegiatan->program->program_code }}
                                    -
                                @endif

                                {{ $archive->subKegiatan->kegiatan->program->program_name }}
                            @else
                                -

                            @endif

                        </p>

                    </div>


                    {{-- ================================================= --}}
                    {{-- KEGIATAN --}}
                    {{-- ================================================= --}}

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Kegiatan
                        </p>

                        <p class="mt-1 text-sm font-semibold text-slate-700">

                            @if ($archive->subKegiatan?->kegiatan)

                                @if ($archive->subKegiatan->kegiatan->kegiatan_code)
                                    {{ $archive->subKegiatan->kegiatan->kegiatan_code }}
                                    -
                                @endif

                                {{ $archive->subKegiatan->kegiatan->kegiatan_name }}
                            @else
                                -

                            @endif

                        </p>

                    </div>


                    {{-- ================================================= --}}
                    {{-- SUB KEGIATAN --}}
                    {{-- ================================================= --}}

                    <div class="md:col-span-2">

                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Sub Kegiatan
                        </p>

                        <p class="mt-1 text-sm font-semibold text-slate-700">

                            @if ($archive->subKegiatan)

                                @if ($archive->subKegiatan->sub_kegiatan_code)
                                    {{ $archive->subKegiatan->sub_kegiatan_code }}
                                    -
                                @endif

                                {{ $archive->subKegiatan->sub_kegiatan_name }}
                            @else
                                -

                            @endif

                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- TAG --}}
        {{-- ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- HEADER CARD --}}
            <div class="border-b border-slate-100 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-9 w-9 items-center justify-center
                               rounded-lg bg-violet-50 text-violet-600">

                        <i class="bi bi-tags-fill"></i>

                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-slate-800">
                            Tag Arsip
                        </h2>

                        <p class="text-xs text-slate-400">
                            Tag yang digunakan untuk mengelompokkan arsip.
                        </p>

                    </div>

                </div>

            </div>


            {{-- CONTENT --}}
            <div class="p-5">

                @if ($archive->tags && $archive->tags->count() > 0)

                    <div class="flex flex-wrap gap-2">

                        @foreach ($archive->tags as $tag)
                            <span
                                class="inline-flex items-center gap-1.5
                                       rounded-full bg-violet-50
                                       px-3 py-1.5
                                       text-xs font-semibold
                                       text-violet-700">

                                <i class="bi bi-tag-fill"></i>

                                {{ $tag->tag_name }}

                            </span>
                        @endforeach

                    </div>
                @else
                    <div
                        class="rounded-xl border border-dashed
                               border-slate-300 bg-slate-50
                               px-5 py-6 text-center">

                        <i class="bi bi-tags text-xl text-slate-400"></i>

                        <p class="mt-2 text-xs text-slate-400">
                            Belum ada tag pada arsip ini.
                        </p>

                    </div>

                @endif

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- SUMBER ARSIP --}}
        {{-- ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- HEADER CARD --}}
            <div class="border-b border-slate-100 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-9 w-9 items-center justify-center
                               rounded-lg bg-emerald-50 text-emerald-600">

                        <i class="bi bi-link-45deg"></i>

                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-slate-800">
                            Sumber Arsip
                        </h2>

                        <p class="text-xs text-slate-400">
                            Informasi lokasi penyimpanan arsip.
                        </p>

                    </div>

                </div>

            </div>


            {{-- CONTENT --}}
            <div class="space-y-5 p-5">

                {{-- DRIVE URL --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Link Arsip
                    </p>

                    @if ($archive->archive_drive_url)
                        <div class="mt-2 flex flex-col gap-3 sm:flex-row sm:items-center">

                            <div
                                class="min-w-0 flex-1 rounded-xl
                                       border border-slate-200
                                       bg-slate-50 px-4 py-3">

                                <p class="break-all text-sm text-slate-600">
                                    {{ $archive->archive_drive_url }}
                                </p>

                            </div>

                            <a href="{{ $archive->archive_drive_url }}" target="_blank" rel="noopener noreferrer"
                                class="inline-flex shrink-0 items-center
                                       justify-center gap-2 rounded-xl
                                       bg-[oklch(29.3%_0.136_325.661)]
                                       px-4 py-2.5 text-sm font-semibold
                                       text-white transition hover:opacity-90">

                                <i class="bi bi-box-arrow-up-right"></i>

                                Buka Arsip

                            </a>

                        </div>
                    @else
                        <p class="mt-1 text-sm text-slate-400">
                            -
                        </p>
                    @endif

                </div>


                {{-- DRIVE FOLDER ID --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        ID Folder Penyimpanan
                    </p>

                    <p class="mt-1 break-all text-sm font-semibold text-slate-700">
                        {{ $archive->archive_drive_folder_id ?: '-' }}
                    </p>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- HAK AKSES --}}
        {{-- ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- HEADER CARD --}}
            <div class="border-b border-slate-100 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-9 w-9 items-center justify-center
                               rounded-lg bg-amber-50 text-amber-600">

                        <i class="bi bi-shield-lock-fill"></i>

                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-slate-800">
                            Hak Akses
                        </h2>

                        <p class="text-xs text-slate-400">
                            Tingkat akses terhadap arsip.
                        </p>

                    </div>

                </div>

            </div>


            {{-- CONTENT --}}
            <div class="p-5">

                @php

                    $accessClasses = [
                        'internal' => 'bg-blue-100 text-blue-700',
                        'public' => 'bg-emerald-100 text-emerald-700',
                    ];

                    $accessLabels = [
                        'internal' => 'Internal',
                        'public' => 'Publik',
                    ];

                @endphp


                <span
                    class="inline-flex items-center gap-2 rounded-full
                           px-3 py-1.5 text-xs font-bold
                           {{ $accessClasses[$archive->archive_access_level] ?? 'bg-slate-100 text-slate-700' }}">

                    @if ($archive->archive_access_level === 'public')
                        <i class="bi bi-globe2"></i>
                    @else
                        <i class="bi bi-building"></i>
                    @endif

                    {{ $accessLabels[$archive->archive_access_level] ?? ucfirst($archive->archive_access_level) }}

                </span>


                <p class="mt-2 text-xs text-slate-400">

                    @if ($archive->archive_access_level === 'public')
                        Arsip dapat diakses oleh publik.
                    @else
                        Arsip hanya dapat diakses oleh pengguna internal.
                    @endif

                </p>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- STATUS --}}
        {{-- ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- HEADER CARD --}}
            <div class="border-b border-slate-100 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-9 w-9 items-center justify-center
                               rounded-lg bg-slate-100 text-slate-600">

                        <i class="bi bi-check2-circle"></i>

                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-slate-800">
                            Status Arsip
                        </h2>

                        <p class="text-xs text-slate-400">
                            Status proses arsip.
                        </p>

                    </div>

                </div>

            </div>


            {{-- CONTENT --}}
            <div class="p-5">

                @php

                    $statusClasses = [
                        'draft' => 'bg-slate-100 text-slate-700',
                        'pending' => 'bg-amber-100 text-amber-700',
                        'verified' => 'bg-emerald-100 text-emerald-700',
                        'rejected' => 'bg-red-100 text-red-700',
                    ];

                    $statusLabels = [
                        'draft' => 'Draft',
                        'pending' => 'Menunggu Verifikasi',
                        'verified' => 'Terverifikasi',
                        'rejected' => 'Ditolak',
                    ];

                @endphp


                <span
                    class="inline-flex items-center gap-2 rounded-full
                           px-3 py-1.5 text-xs font-bold
                           {{ $statusClasses[$archive->archive_status] ?? 'bg-slate-100 text-slate-700' }}">

                    @if ($archive->archive_status === 'verified')
                        <i class="bi bi-check-circle-fill"></i>
                    @elseif ($archive->archive_status === 'rejected')
                        <i class="bi bi-x-circle-fill"></i>
                    @elseif ($archive->archive_status === 'pending')
                        <i class="bi bi-hourglass-split"></i>
                    @else
                        <i class="bi bi-pencil-fill"></i>
                    @endif

                    {{ $statusLabels[$archive->archive_status] ?? ucfirst($archive->archive_status) }}

                </span>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- INFORMASI SISTEM --}}
        {{-- ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- HEADER CARD --}}
            <div class="border-b border-slate-100 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-9 w-9 items-center justify-center
                               rounded-lg bg-slate-100 text-slate-600">

                        <i class="bi bi-clock-history"></i>

                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-slate-800">
                            Informasi Sistem
                        </h2>

                        <p class="text-xs text-slate-400">
                            Informasi pencatatan arsip.
                        </p>

                    </div>

                </div>

            </div>


            {{-- CONTENT --}}
            <div class="grid grid-cols-1 gap-5 p-5 md:grid-cols-2">

                {{-- DIBUAT --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Dibuat
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-700">

                        @if ($archive->archive_created_at)
                            {{ \Carbon\Carbon::parse($archive->archive_created_at)->translatedFormat('d F Y H:i') }}
                        @else
                            -
                        @endif

                    </p>

                </div>


                {{-- DIPERBARUI --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Diperbarui
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-700">

                        @if ($archive->archive_updated_at)
                            {{ \Carbon\Carbon::parse($archive->archive_updated_at)->translatedFormat('d F Y H:i') }}
                        @else
                            -
                        @endif

                    </p>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- BOTTOM ACTION --}}
        {{-- ========================================================= --}}

        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

            {{-- KEMBALI --}}
            <a href="{{ route('sadarin.admin.archive.index') }}"
                class="inline-flex items-center justify-center gap-2
                       rounded-xl border border-slate-200 bg-white
                       px-5 py-2.5 text-sm font-semibold
                       text-slate-600 transition hover:bg-slate-50">

                <i class="bi bi-arrow-left"></i>

                Kembali ke Daftar

            </a>


            {{-- EDIT --}}
            <a href="{{ route('sadarin.admin.archive.edit', $archive->archive_id) }}"
                class="inline-flex items-center justify-center gap-2
                       rounded-xl
                       bg-[oklch(29.3%_0.136_325.661)]
                       px-5 py-2.5 text-sm font-semibold
                       text-white shadow-sm transition hover:opacity-90">

                <i class="bi bi-pencil-square"></i>

                Edit Arsip

            </a>

        </div>

    </div>

@endsection
