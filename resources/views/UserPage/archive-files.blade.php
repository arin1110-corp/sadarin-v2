@extends('UserPage.layouts.app')

@section('title', 'Berkas - ' . $archive->archive_title)

@section('meta_description')
    {{ $archive->archive_title }} - SADARIN
@endsection

@section('content')

    <div class="min-h-screen bg-slate-50">

        <main class="mx-auto max-w-[1600px] px-4 py-6 sm:px-6 lg:px-8">

            {{-- =========================================================
                KEMBALI KE ARSIP
            ========================================================== --}}

            <div class="mb-5">

                <a href="{{ route('sadarin.user.archive.index', $archive->archive_id) }}"
                    class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-sadarin-700">

                    <i class="bi bi-arrow-left"></i>

                    Kembali ke arsip

                </a>

            </div>


            {{-- =========================================================
                HEADER ARSIP
            ========================================================== --}}

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white">

                <div class="p-6 sm:p-7">

                    <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">

                        {{-- LEFT --}}

                        <div class="flex min-w-0 items-start gap-4">

                            <div
                                class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-purple-50 text-purple-600">

                                <i class="bi bi-archive text-3xl"></i>

                            </div>


                            <div class="min-w-0">

                                <p class="text-[10px] font-bold uppercase tracking-wider text-purple-600">
                                    Arsip
                                </p>

                                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">
                                    {{ $archive->archive_title }}
                                </h1>


                                {{-- INFO --}}

                                <div class="mt-4 flex flex-wrap items-center gap-2">

                                    {{-- UNIT --}}

                                    @if ($archive->unit)
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-3 py-1.5 text-xs font-medium text-blue-700">

                                            <i class="bi bi-building"></i>

                                            {{ $archive->unit->unit_name }}

                                        </span>
                                    @endif


                                    {{-- DOCUMENT TYPE --}}

                                    @if ($archive->documentType)
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3 py-1.5 text-xs font-medium text-red-700">

                                            <i class="bi bi-file-earmark-text"></i>

                                            {{ $archive->documentType->document_type_name }}

                                        </span>
                                    @endif


                                    {{-- YEAR --}}

                                    @if (!empty($archive->archive_year))
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1.5 text-xs font-medium text-slate-600">

                                            <i class="bi bi-calendar3"></i>

                                            {{ $archive->archive_year }}

                                        </span>
                                    @endif

                                </div>

                            </div>

                        </div>


                        {{-- ACCESS --}}

                        <div>

                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1.5 text-xs font-medium text-slate-600">

                                <i class="bi bi-lock"></i>

                                {{ ucfirst($archive->archive_access_level ?? 'internal') }}

                            </span>

                        </div>

                    </div>

                </div>

            </section>


            {{-- =========================================================
                DRIVE AREA
            ========================================================== --}}

            <div class="mt-6 grid gap-5 lg:grid-cols-[240px_minmax(0,1fr)]">


                {{-- =====================================================
                    SIDEBAR
                ====================================================== --}}

                <aside>

                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">

                        <div class="border-b border-slate-100 px-4 py-4">

                            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                Sumber Berkas
                            </p>

                        </div>


                        <div class="p-4">

                            {{-- JUMLAH --}}

                            <div class="flex items-center justify-between">

                                <span class="text-sm text-slate-500">
                                    Isi folder
                                </span>

                                <span class="text-sm font-semibold text-slate-700">
                                    {{ $driveFiles->count() }}
                                </span>

                            </div>


                            {{-- SUMBER --}}

                            <div class="mt-4 flex items-center justify-between">

                                <span class="text-sm text-slate-500">
                                    Sumber
                                </span>

                                <span class="text-sm font-semibold text-slate-700">
                                    Google Drive
                                </span>

                            </div>


                            {{-- BUKA GOOGLE DRIVE --}}

                            @if ($currentFolderUrl)
                                <a href="{{ $currentFolderUrl }}" target="_blank" rel="noopener noreferrer"
                                    class="mt-5 flex w-full items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-xs font-semibold text-slate-600 transition hover:border-purple-200 hover:bg-purple-50 hover:text-purple-700">

                                    <i class="bi bi-google"></i>

                                    Buka di Google Drive

                                </a>
                            @endif

                        </div>

                    </div>

                </aside>


                {{-- =====================================================
                    CONTENT
                ====================================================== --}}

                <section class="min-w-0">


                    {{-- =================================================
                        FOLDER HEADER
                    ================================================== --}}

                    <div class="mb-4">

                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                            <div class="min-w-0">

                                <p class="text-[10px] font-bold uppercase tracking-wider text-purple-600">
                                    Berkas
                                </p>

                                <h2 class="mt-1 truncate text-xl font-bold text-slate-950">

                                    <i class="bi bi-folder2-open mr-1 text-purple-500"></i>

                                    {{ $currentFolderName }}

                                </h2>

                                <p class="mt-1 text-sm text-slate-400">

                                    {{ $driveFiles->count() }}

                                    {{ $driveFiles->count() == 1 ? 'item' : 'item' }}
                                    tersedia

                                </p>

                            </div>


                            {{-- TOMBOL KEMBALI --}}

                            @if ($currentFolderId !== $rootFolderId)
                                @php

                                    $parentFolderId = !empty($currentFolderParents)
                                        ? $currentFolderParents[0]
                                        : $rootFolderId;

                                @endphp

                                <a href="{{ route('sadarin.user.archive.files', [
                                    'archiveId' => $archive->archive_id,
                                    'folder' => $parentFolderId,
                                ]) }}"
                                    class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-semibold text-slate-600 transition hover:border-purple-200 hover:bg-purple-50 hover:text-purple-700">

                                    <i class="bi bi-arrow-left"></i>

                                    Folder Sebelumnya

                                </a>
                            @endif

                        </div>

                    </div>


                    {{-- =================================================
                        ERROR
                    ================================================== --}}

                    @if ($driveError)

                        <div class="rounded-2xl border border-red-200 bg-red-50 px-5 py-5">

                            <div class="flex items-start gap-4">

                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-500">

                                    <i class="bi bi-exclamation-triangle"></i>

                                </div>


                                <div class="min-w-0">

                                    <h3 class="text-sm font-bold text-red-700">
                                        Google Drive tidak dapat dibaca
                                    </h3>

                                    <p class="mt-1 break-words text-xs leading-5 text-red-500">
                                        {{ $driveError }}
                                    </p>

                                </div>

                            </div>

                        </div>
                    @else
                        {{-- =================================================
                            ISI FOLDER
                        ================================================== --}}

                        @if ($driveFiles->count() > 0)

                            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">

                                {{-- HEADER LIST --}}

                                <div
                                    class="hidden grid-cols-[minmax(0,1fr)_150px_130px_160px] items-center gap-4 border-b border-slate-100 bg-slate-50 px-5 py-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 md:grid">

                                    <div>
                                        Nama
                                    </div>

                                    <div>
                                        Tanggal
                                    </div>

                                    <div>
                                        Ukuran
                                    </div>

                                    <div class="text-right">
                                        Aksi
                                    </div>

                                </div>


                                {{-- ITEMS --}}

                                @foreach ($driveFiles as $item)
                                    @php

                                        $isFolder = $item->getMimeType() === 'application/vnd.google-apps.folder';

                                        $itemUrl = $item->getWebViewLink();

                                        $itemName = $item->getName();

                                        $itemSize = $item->getSize();

                                        $modifiedTime = $item->getModifiedTime();

                                    @endphp


                                    <div
                                        class="group border-b border-slate-100 px-4 py-4 transition last:border-b-0 hover:bg-slate-50 sm:px-5">

                                        <div
                                            class="grid gap-4 md:grid-cols-[minmax(0,1fr)_150px_130px_160px] md:items-center">


                                            {{-- =================================================
                                                NAME
                                            ================================================== --}}

                                            <div class="flex min-w-0 items-center gap-3">

                                                {{-- ICON --}}

                                                <div
                                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl
                                                    {{ $isFolder ? 'bg-amber-50 text-amber-500' : 'bg-purple-50 text-purple-600' }}">

                                                    <i
                                                        class="bi {{ $isFolder ? 'bi-folder-fill' : 'bi-file-earmark-text' }} text-lg">
                                                    </i>

                                                </div>


                                                {{-- NAME --}}

                                                <div class="min-w-0">

                                                    <p
                                                        class="truncate text-sm font-semibold text-slate-700 group-hover:text-purple-700">

                                                        {{ $itemName }}

                                                    </p>


                                                    {{-- MIME TYPE --}}

                                                    <p class="mt-0.5 truncate text-[11px] text-slate-400">

                                                        @if ($isFolder)
                                                            Folder
                                                        @else
                                                            {{ $item->getMimeType() }}
                                                        @endif

                                                    </p>

                                                </div>

                                            </div>


                                            {{-- =================================================
                                                DATE
                                            ================================================== --}}

                                            <div class="text-xs text-slate-500">

                                                @if ($modifiedTime)
                                                    {{ \Carbon\Carbon::parse($modifiedTime)->translatedFormat('d M Y') }}
                                                @else
                                                    —
                                                @endif

                                            </div>


                                            {{-- =================================================
                                                SIZE
                                            ================================================== --}}

                                            <div class="text-xs text-slate-500">

                                                @if ($isFolder)
                                                    —
                                                @elseif ($itemSize)
                                                    @php
                                                        $bytes = (int) $itemSize;

                                                        if ($bytes >= 1073741824) {
                                                            $sizeText = number_format($bytes / 1073741824, 2) . ' GB';
                                                        } elseif ($bytes >= 1048576) {
                                                            $sizeText = number_format($bytes / 1048576, 2) . ' MB';
                                                        } elseif ($bytes >= 1024) {
                                                            $sizeText = number_format($bytes / 1024, 2) . ' KB';
                                                        } else {
                                                            $sizeText = $bytes . ' B';
                                                        }
                                                    @endphp

                                                    {{ $sizeText }}
                                                @else
                                                    —
                                                @endif

                                            </div>


                                            {{-- =================================================
                                                ACTION
                                            ================================================== --}}

                                            <div class="flex items-center justify-start gap-2 md:justify-end">

                                                {{-- FOLDER --}}

                                                @if ($isFolder)
                                                    <a href="{{ route('sadarin.user.archive.files', [
                                                        'archiveId' => $archive->archive_id,
                                                        'folder' => $item->getId(),
                                                    ]) }}"
                                                        class="inline-flex items-center gap-1.5 rounded-xl bg-purple-700 px-3 py-2 text-[11px] font-semibold text-white transition hover:bg-purple-800">

                                                        <i class="bi bi-folder2-open"></i>

                                                        Buka Folder

                                                    </a>


                                                    {{-- BUKA LINK DRIVE --}}

                                                    @if ($itemUrl)
                                                        <a href="{{ route('sadarin.user.archive.drive.open', [
                                                            'archiveId' => $archive->archive_id,
                                                            'url' => $itemUrl,
                                                            'object_type' => 'drive_folder',
                                                            'object_id' => $item->getId(),
                                                            'action' => 'open_folder_drive',
                                                        ]) }}"
                                                            class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition hover:border-purple-200 hover:bg-purple-50 hover:text-purple-700"
                                                            title="Buka di Google Drive">

                                                            <i class="bi bi-box-arrow-up-right"></i>

                                                        </a>
                                                    @endif


                                                    {{-- FILE --}}
                                                @else
                                                    @if ($itemUrl)
                                                        <a href="{{ route('sadarin.user.archive.drive.open', [
                                                            'archiveId' => $archive->archive_id,
                                                            'url' => $itemUrl,
                                                            'object_type' => 'drive_file',
                                                            'object_id' => $item->getId(),
                                                            'action' => 'open_file',
                                                        ]) }}"
                                                            class="inline-flex items-center gap-1.5 rounded-xl bg-purple-700 px-3 py-2 text-[11px] font-semibold text-white transition hover:bg-purple-800">

                                                            <i class="bi bi-box-arrow-up-right"></i>

                                                            Buka Berkas

                                                        </a>
                                                    @else
                                                        <span
                                                            class="inline-flex items-center gap-1.5 rounded-xl bg-slate-100 px-3 py-2 text-[11px] font-semibold text-slate-400">

                                                            <i class="bi bi-link-45deg"></i>

                                                            Link tidak tersedia

                                                        </span>
                                                    @endif
                                                @endif

                                            </div>

                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        @else
                            {{-- =================================================
                                EMPTY
                            ================================================== --}}

                            <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center">

                                <div
                                    class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                                    <i class="bi bi-folder2-open text-2xl"></i>

                                </div>


                                <h3 class="mt-5 text-base font-bold text-slate-700">
                                    Folder kosong
                                </h3>


                                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-400">

                                    Tidak ada file atau folder yang tersedia
                                    di dalam folder ini.

                                </p>


                                @if ($currentFolderUrl)
                                    <a href="{{ route('sadarin.user.archive.drive.open', [
                                        'archiveId' => $archive->archive_id,
                                        'url' => $currentFolderUrl,
                                        'object_type' => 'drive_folder',
                                        'object_id' => $currentFolderId,
                                        'action' => 'open_folder_drive',
                                    ]) }}"
                                        class="mt-5 flex w-full items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-xs font-semibold text-slate-600 transition hover:border-purple-200 hover:bg-purple-50 hover:text-purple-700">

                                        <i class="bi bi-google"></i>

                                        Buka di Google Drive

                                    </a>
                                @endif

                            </div>

                        @endif

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
