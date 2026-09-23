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

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
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


            {{-- ACTION HEADER --}}
            <div class="flex flex-wrap items-center gap-2">

                <a href="{{ route('sadarin.admin.archive.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl
                           border border-slate-200 bg-white px-4 py-2.5
                           text-sm font-semibold text-slate-600 shadow-sm
                           transition hover:bg-slate-50">

                    <i class="bi bi-arrow-left"></i>

                    Kembali

                </a>


                <a href="{{ route('sadarin.admin.archive.edit', $archive->archive_id) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl
                           bg-[oklch(29.3%_0.136_325.661)] px-4 py-2.5
                           text-sm font-semibold text-white shadow-sm
                           transition hover:opacity-90">

                    <i class="bi bi-pencil-square"></i>

                    Edit

                </a>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- SUCCESS MESSAGE --}}
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

            {{-- CARD HEADER --}}

            <div class="border-b border-slate-100 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-blue-600">

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

            <div class="p-5">

                <div class="space-y-5">


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

                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                Tanggal Arsip
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-700">

                                @if ($archive->archive_date)
                                    {{ \Carbon\Carbon::parse($archive->archive_date)->translatedFormat('d F Y') }}
                                @else
                                    -
                                @endif

                            </p>

                        </div>


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

        </div>


        {{-- ========================================================= --}}
        {{-- KLASIFIKASI --}}
        {{-- ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- HEADER --}}

            <div class="border-b border-slate-100 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">

                        <i class="bi bi-diagram-3-fill"></i>

                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-slate-800">
                            Klasifikasi
                        </h2>

                        <p class="text-xs text-slate-400">
                            Klasifikasi dan pengelompokan arsip.
                        </p>

                    </div>

                </div>

            </div>


            {{-- CONTENT --}}

            <div class="grid grid-cols-1 gap-5 p-5 md:grid-cols-2">


                {{-- UNIT --}}

                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Unit
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-700">

                        {{ $archive->unit->unit_name ?? '-' }}

                    </p>

                </div>


                {{-- JENIS DOKUMEN --}}

                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Jenis Dokumen
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-700">

                        {{ $archive->documentType->document_type_name ?? '-' }}

                    </p>

                </div>


                {{-- PROGRAM --}}

                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Program
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-700">

                        {{ $archive->program->program_name ?? '-' }}

                    </p>

                </div>


                {{-- KEGIATAN --}}

                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Kegiatan
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-700">

                        {{ $archive->kegiatan->kegiatan_name ?? '-' }}

                    </p>

                </div>


                {{-- SUB KEGIATAN --}}

                <div class="md:col-span-2">

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Sub Kegiatan
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-700">

                        {{ $archive->subKegiatan->sub_kegiatan_name ?? '-' }}

                    </p>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- HAK AKSES --}}
        {{-- ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-amber-600">

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


            <div class="p-5">

                @php

                    $accessClasses = [
                        'internal' => 'bg-blue-100 text-blue-700',

                        'public' => 'bg-emerald-100 text-emerald-700',

                        'restricted' => 'bg-amber-100 text-amber-700',
                    ];

                    $accessLabels = [
                        'internal' => 'Internal',

                        'public' => 'Publik',

                        'restricted' => 'Terbatas',
                    ];

                @endphp


                <span
                    class="inline-flex items-center gap-2 rounded-full px-3 py-1.5 text-xs font-bold
                    {{ $accessClasses[$archive->archive_access_level] ?? 'bg-slate-100 text-slate-700' }}">

                    @if ($archive->archive_access_level === 'public')
                        <i class="bi bi-globe2"></i>
                    @elseif ($archive->archive_access_level === 'restricted')
                        <i class="bi bi-lock-fill"></i>
                    @else
                        <i class="bi bi-building"></i>
                    @endif


                    {{ $accessLabels[$archive->archive_access_level] ?? ucfirst($archive->archive_access_level) }}

                </span>


                <p class="mt-2 text-xs text-slate-400">

                    @if ($archive->archive_access_level === 'public')
                        Arsip dapat diakses oleh publik.
                    @elseif ($archive->archive_access_level === 'restricted')
                        Arsip membutuhkan hak akses khusus.
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

            <div class="border-b border-slate-100 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-600">

                        <i class="bi bi-info-circle-fill"></i>

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


            <div class="p-5">

                @php

                    $statusClasses = [
                        'draft' => 'bg-slate-100 text-slate-700',

                        'pending' => 'bg-amber-100 text-amber-700',

                        'verified' => 'bg-emerald-100 text-emerald-700',

                        'rejected' => 'bg-red-100 text-red-700',
                    ];

                @endphp


                <span
                    class="inline-flex items-center gap-2 rounded-full px-3 py-1.5 text-xs font-bold
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


                    {{ ucfirst($archive->archive_status) }}

                </span>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- BERKAS ARSIP --}}
        {{-- ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- HEADER --}}

            <div class="border-b border-slate-100 px-5 py-4">

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">

                            <i class="bi bi-paperclip"></i>

                        </div>

                        <div>

                            <h2 class="text-sm font-bold text-slate-800">
                                Berkas Arsip
                            </h2>

                            <p class="text-xs text-slate-400">
                                Daftar berkas yang terhubung dengan arsip ini.
                            </p>

                        </div>

                    </div>


                    {{-- JUMLAH BERKAS --}}

                    <span
                        class="inline-flex w-fit items-center rounded-full bg-slate-100 px-3 py-1.5 text-xs font-bold text-slate-600">

                        {{ $archive->files->count() }} Berkas

                    </span>

                </div>

            </div>


            {{-- FILE LIST --}}

            <div class="p-5">

                @if ($archive->files->count() > 0)

                    <div class="space-y-3">

                        @foreach ($archive->files as $file)
                            <div
                                class="flex flex-col gap-4 rounded-xl border border-slate-200 bg-slate-50 p-4
                                       transition hover:border-slate-300 hover:bg-white
                                       sm:flex-row sm:items-center sm:justify-between">

                                <div class="flex min-w-0 items-center gap-3">

                                    {{-- ICON --}}

                                    <div
                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg
                                               bg-white text-red-500 shadow-sm">

                                        <i class="bi bi-file-earmark-pdf-fill text-lg"></i>

                                    </div>


                                    {{-- INFO --}}

                                    <div class="min-w-0">

                                        <p class="truncate text-sm font-semibold text-slate-700">

                                            {{ $file->file_name ?? 'Berkas Arsip' }}

                                        </p>

                                        @if (!empty($file->file_description))
                                            <p class="mt-0.5 truncate text-xs text-slate-400">

                                                {{ $file->file_description }}

                                            </p>
                                        @endif

                                        @if (!empty($file->file_url))
                                            <p class="mt-1 truncate text-xs text-slate-400">

                                                {{ $file->file_url }}

                                            </p>
                                        @endif

                                    </div>

                                </div>


                                {{-- OPEN LINK --}}

                                @if (!empty($file->file_url))
                                    <a href="{{ $file->file_url }}" target="_blank" rel="noopener noreferrer"
                                        class="inline-flex shrink-0 items-center justify-center gap-2 rounded-lg
                                               bg-[oklch(29.3%_0.136_325.661)] px-3.5 py-2
                                               text-xs font-semibold text-white
                                               transition hover:opacity-90">

                                        <i class="bi bi-box-arrow-up-right"></i>

                                        Buka Berkas

                                    </a>
                                @else
                                    <span
                                        class="inline-flex shrink-0 items-center gap-2 rounded-lg
                                               bg-slate-200 px-3.5 py-2
                                               text-xs font-semibold text-slate-500">

                                        <i class="bi bi-link-45deg"></i>

                                        Link Tidak Tersedia

                                    </span>
                                @endif

                            </div>
                        @endforeach

                    </div>
                @else
                    {{-- EMPTY STATE --}}

                    <div class="rounded-xl border border-dashed border-slate-300 bg-slate-50 px-5 py-10 text-center">

                        <div
                            class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl
                                   bg-white text-slate-400 shadow-sm">

                            <i class="bi bi-folder2-open text-xl"></i>

                        </div>

                        <h3 class="mt-3 text-sm font-bold text-slate-700">

                            Belum Ada Berkas

                        </h3>

                        <p class="mt-1 text-xs text-slate-400">

                            Belum ada berkas yang terhubung dengan arsip ini.

                        </p>

                    </div>

                @endif

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- METADATA --}}
        {{-- ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-600">

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


            <div class="grid grid-cols-1 gap-5 p-5 md:grid-cols-2">


                {{-- CREATED --}}

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


                {{-- UPDATED --}}

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

            <a href="{{ route('sadarin.admin.archive.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl
                       border border-slate-200 bg-white px-5 py-2.5
                       text-sm font-semibold text-slate-600
                       transition hover:bg-slate-50">

                <i class="bi bi-arrow-left"></i>

                Kembali ke Daftar

            </a>


            <a href="{{ route('sadarin.admin.archive.edit', $archive->archive_id) }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl
                       bg-[oklch(29.3%_0.136_325.661)] px-5 py-2.5
                       text-sm font-semibold text-white shadow-sm
                       transition hover:opacity-90">

                <i class="bi bi-pencil-square"></i>

                Edit Arsip

            </a>

        </div>

    </div>

@endsection
