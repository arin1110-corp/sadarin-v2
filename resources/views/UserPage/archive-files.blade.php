@extends('UserPage.layouts.app')

@section('title', 'Berkas - ' . $archive->archive_title)

@section('meta_description')
    {{ $archive->archive_title }} - SADARIN
@endsection

@section('content')

    <div class="min-h-screen bg-slate-50">

        {{-- ============================================================
            MAIN
        ============================================================= --}}

        <main class="mx-auto w-full max-w-7xl px-4 py-5 sm:px-6 sm:py-6 lg:px-8">


            {{-- =========================================================
                KEMBALI KE ARSIP
            ========================================================== --}}

            <div class="mb-4 sm:mb-5">

                <a href="{{ route('sadarin.user.archive.index') }}"
                    class="inline-flex items-center gap-2 rounded-lg py-1 text-sm font-medium text-slate-500 transition hover:text-sadarin-700">

                    <i class="bi bi-arrow-left"></i>

                    <span>Kembali ke arsip</span>

                </a>

            </div>


            {{-- =========================================================
                HEADER ARSIP
            ========================================================== --}}

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="p-4 sm:p-6 lg:p-7">

                    <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">


                        {{-- =================================================
                            LEFT
                        ================================================== --}}

                        <div class="flex min-w-0 items-start gap-3 sm:gap-4">

                            {{-- ICON --}}

                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-sadarin-50 text-sadarin-600 sm:h-16 sm:w-16 sm:rounded-2xl">

                                <i class="bi bi-archive text-2xl sm:text-3xl"></i>

                            </div>


                            {{-- INFO --}}

                            <div class="min-w-0 flex-1">

                                <p class="text-[10px] font-bold uppercase tracking-wider text-sadarin-600">
                                    Arsip
                                </p>


                                <h1
                                    class="mt-1 break-words text-xl font-bold leading-tight tracking-tight text-slate-950 sm:text-2xl lg:text-3xl">
                                    {{ $archive->archive_title }}
                                </h1>


                                {{-- INFO BADGES --}}

                                <div class="mt-3 flex flex-wrap items-center gap-1.5 sm:mt-4 sm:gap-2">


                                    {{-- UNIT --}}

                                    @if ($archive->unit)
                                        <span
                                            class="inline-flex max-w-full items-center gap-1.5 rounded-full bg-blue-50 px-2.5 py-1.5 text-[11px] font-medium text-blue-700 sm:px-3 sm:text-xs">

                                            <i class="bi bi-building shrink-0"></i>

                                            <span class="max-w-[220px] truncate sm:max-w-none">
                                                {{ $archive->unit->unit_name }}
                                            </span>

                                        </span>
                                    @endif


                                    {{-- DOCUMENT TYPE --}}

                                    @if ($archive->documentType)
                                        <span
                                            class="inline-flex max-w-full items-center gap-1.5 rounded-full bg-sadarin-50 px-2.5 py-1.5 text-[11px] font-medium text-sadarin-700 sm:px-3 sm:text-xs">

                                            <i class="bi bi-file-earmark-text shrink-0"></i>

                                            <span class="max-w-[220px] truncate sm:max-w-none">
                                                {{ $archive->documentType->document_type_name }}
                                            </span>

                                        </span>
                                    @endif


                                    {{-- YEAR --}}

                                    @if (!empty($archive->archive_year))
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1.5 text-[11px] font-medium text-slate-600 sm:px-3 sm:text-xs">

                                            <i class="bi bi-calendar3"></i>

                                            {{ $archive->archive_year }}

                                        </span>
                                    @endif

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                            ACCESS
                        ================================================== --}}

                        <div class="shrink-0">

                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-sadarin-50 px-3 py-1.5 text-[11px] font-semibold text-sadarin-700 sm:text-xs">

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

            <div class="mt-5 grid gap-5 lg:mt-6 lg:grid-cols-[220px_minmax(0,1fr)]">


                {{-- =====================================================
                    SIDEBAR / INFORMASI
                ====================================================== --}}

                <aside class="min-w-0">

                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">


                        {{-- HEADER --}}

                        <div class="border-b border-slate-100 px-4 py-3.5 sm:px-4 sm:py-4">

                            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                Sumber Berkas
                            </p>

                        </div>


                        {{-- CONTENT --}}

                        <div class="p-4">

                            {{-- =================================================
                                INFO GRID
                            ================================================== --}}

                            <div class="grid grid-cols-2 gap-3 lg:grid-cols-1">


                                {{-- JUMLAH --}}

                                <div class="rounded-xl bg-slate-50 p-3">

                                    <p class="text-[10px] font-medium uppercase tracking-wide text-slate-400">
                                        Isi folder
                                    </p>

                                    <div class="mt-1 flex items-center gap-2">

                                        <i class="bi bi-folder2-open text-sadarin-500"></i>

                                        <span class="text-sm font-bold text-slate-700">
                                            {{ $driveFiles->count() }}
                                        </span>

                                        <span class="text-xs text-slate-400">
                                            item
                                        </span>

                                    </div>

                                </div>


                                {{-- SUMBER --}}

                                <div class="rounded-xl bg-slate-50 p-3">

                                    <p class="text-[10px] font-medium uppercase tracking-wide text-slate-400">
                                        Sumber
                                    </p>

                                    <div class="mt-1 flex items-center gap-2">

                                        <i class="bi bi-google text-slate-500"></i>

                                        <span class="text-sm font-semibold text-slate-700">
                                            Google Drive
                                        </span>

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                                BUKA GOOGLE DRIVE
                            ================================================== --}}

                            @if ($currentFolderUrl)
                                <a href="{{ $currentFolderUrl }}" target="_blank" rel="noopener noreferrer"
                                    class="mt-4 flex w-full items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-xs font-semibold text-slate-600 transition hover:border-sadarin-200 hover:bg-sadarin-50 hover:text-sadarin-700">

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


                            {{-- FOLDER INFO --}}

                            <div class="min-w-0">

                                <p class="text-[10px] font-bold uppercase tracking-wider text-sadarin-600">
                                    Berkas
                                </p>


                                <h2
                                    class="mt-1 flex min-w-0 items-center gap-1.5 text-lg font-bold text-slate-950 sm:text-xl">

                                    <i class="bi bi-folder2-open shrink-0 text-sadarin-500"></i>

                                    <span class="truncate">
                                        {{ $currentFolderName }}
                                    </span>

                                </h2>


                                <p class="mt-1 text-xs text-slate-400 sm:text-sm">

                                    {{ $driveFiles->count() }}

                                    {{ $driveFiles->count() == 1 ? 'item' : 'item' }}

                                    tersedia

                                </p>

                            </div>


                            {{-- =================================================
                                TOMBOL KEMBALI FOLDER
                            ================================================== --}}

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
                                    class="inline-flex w-full shrink-0 items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-semibold text-slate-600 shadow-sm transition hover:border-sadarin-200 hover:bg-sadarin-50 hover:text-sadarin-700 sm:w-auto">

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

                        <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-4 sm:px-5 sm:py-5">

                            <div class="flex items-start gap-3 sm:gap-4">

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

                            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">


                                {{-- =================================================
                                    TABLE HEADER - DESKTOP
                                ================================================== --}}

                                <div
                                    class="hidden grid-cols-[minmax(0,1fr)_130px_100px_150px] items-center gap-4 border-b border-slate-100 bg-slate-50 px-5 py-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 md:grid">

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


                                {{-- =================================================
                                    ITEMS
                                ================================================== --}}

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

                                        {{-- =================================================
                                            DESKTOP / TABLET
                                        ================================================== --}}

                                        <div
                                            class="hidden gap-4 md:grid md:grid-cols-[minmax(0,1fr)_130px_100px_150px] md:items-center">


                                            {{-- NAME --}}

                                            <div class="flex min-w-0 items-center gap-3">

                                                <div
                                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl
                                                    {{ $isFolder ? 'bg-amber-50 text-amber-500' : 'bg-sadarin-50 text-sadarin-600' }}">

                                                    <i
                                                        class="bi {{ $isFolder ? 'bi-folder-fill' : 'bi-file-earmark-text' }} text-lg"></i>

                                                </div>


                                                <div class="min-w-0">

                                                    <p
                                                        class="truncate text-sm font-semibold text-slate-700 group-hover:text-sadarin-700">
                                                        {{ $itemName }}
                                                    </p>


                                                    <p class="mt-0.5 truncate text-[11px] text-slate-400">

                                                        @if ($isFolder)
                                                            Folder
                                                        @else
                                                            {{ $item->getMimeType() }}
                                                        @endif

                                                    </p>

                                                </div>

                                            </div>


                                            {{-- DATE --}}

                                            <div class="text-xs text-slate-500">

                                                @if ($modifiedTime)
                                                    {{ \Carbon\Carbon::parse($modifiedTime)->translatedFormat('d M Y') }}
                                                @else
                                                    —
                                                @endif

                                            </div>


                                            {{-- SIZE --}}

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


                                            {{-- ACTION --}}

                                            <div class="flex items-center justify-end gap-2">


                                                {{-- FOLDER --}}

                                                @if ($isFolder)
                                                    <a href="{{ route('sadarin.user.archive.files', [
                                                        'archiveId' => $archive->archive_id,
                                                        'folder' => $item->getId(),
                                                    ]) }}"
                                                        class="inline-flex items-center gap-1.5 rounded-xl bg-sadarin-700 px-3 py-2 text-[11px] font-semibold text-white transition hover:bg-sadarin-800">

                                                        <i class="bi bi-folder2-open"></i>

                                                        Buka Folder

                                                    </a>


                                                    @if ($itemUrl)
                                                        <a href="{{ route('sadarin.user.archive.drive.open', [
                                                            'archiveId' => $archive->archive_id,
                                                            'url' => $itemUrl,
                                                            'object_type' => 'drive_folder',
                                                            'object_id' => $item->getId(),
                                                            'action' => 'open_folder_drive',
                                                        ]) }}"
                                                            class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition hover:border-sadarin-200 hover:bg-sadarin-50 hover:text-sadarin-700"
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
                                                            class="inline-flex items-center gap-1.5 rounded-xl bg-sadarin-700 px-3 py-2 text-[11px] font-semibold text-white transition hover:bg-sadarin-800">

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


                                        {{-- =================================================
                                            MOBILE
                                        ================================================== --}}

                                        <div class="md:hidden">


                                            {{-- FILE INFO --}}

                                            <div class="flex min-w-0 items-start gap-3">

                                                <div
                                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl
                                                    {{ $isFolder ? 'bg-amber-50 text-amber-500' : 'bg-sadarin-50 text-sadarin-600' }}">

                                                    <i
                                                        class="bi {{ $isFolder ? 'bi-folder-fill' : 'bi-file-earmark-text' }} text-lg"></i>

                                                </div>


                                                <div class="min-w-0 flex-1">

                                                    <p class="break-words text-sm font-semibold leading-5 text-slate-700">
                                                        {{ $itemName }}
                                                    </p>


                                                    <p class="mt-1 text-[11px] text-slate-400">

                                                        @if ($isFolder)
                                                            Folder
                                                        @else
                                                            {{ $item->getMimeType() }}
                                                        @endif

                                                    </p>


                                                    {{-- MOBILE META --}}

                                                    <div
                                                        class="mt-2 flex flex-wrap items-center gap-x-3 gap-y-1 text-[11px] text-slate-400">

                                                        <span class="inline-flex items-center gap-1">

                                                            <i class="bi bi-calendar3"></i>

                                                            @if ($modifiedTime)
                                                                {{ \Carbon\Carbon::parse($modifiedTime)->translatedFormat('d M Y') }}
                                                            @else
                                                                —
                                                            @endif

                                                        </span>


                                                        <span class="inline-flex items-center gap-1">

                                                            <i class="bi bi-hdd"></i>

                                                            @if ($isFolder)
                                                                —
                                                            @elseif ($itemSize)
                                                                @php

                                                                    $bytes = (int) $itemSize;

                                                                    if ($bytes >= 1073741824) {
                                                                        $sizeText =
                                                                            number_format($bytes / 1073741824, 2) .
                                                                            ' GB';
                                                                    } elseif ($bytes >= 1048576) {
                                                                        $sizeText =
                                                                            number_format($bytes / 1048576, 2) . ' MB';
                                                                    } elseif ($bytes >= 1024) {
                                                                        $sizeText =
                                                                            number_format($bytes / 1024, 2) . ' KB';
                                                                    } else {
                                                                        $sizeText = $bytes . ' B';
                                                                    }

                                                                @endphp

                                                                {{ $sizeText }}
                                                            @else
                                                                —
                                                            @endif

                                                        </span>

                                                    </div>

                                                </div>

                                            </div>


                                            {{-- MOBILE ACTION --}}

                                            <div class="mt-3 flex gap-2">


                                                @if ($isFolder)
                                                    {{-- BUKA FOLDER --}}

                                                    <a href="{{ route('sadarin.user.archive.files', [
                                                        'archiveId' => $archive->archive_id,
                                                        'folder' => $item->getId(),
                                                    ]) }}"
                                                        class="inline-flex min-h-10 flex-1 items-center justify-center gap-1.5 rounded-xl bg-sadarin-700 px-3 py-2.5 text-[11px] font-semibold text-white transition active:scale-[0.98] hover:bg-sadarin-800">

                                                        <i class="bi bi-folder2-open"></i>

                                                        Buka Folder

                                                    </a>


                                                    {{-- GOOGLE DRIVE --}}

                                                    @if ($itemUrl)
                                                        <a href="{{ route('sadarin.user.archive.drive.open', [
                                                            'archiveId' => $archive->archive_id,
                                                            'url' => $itemUrl,
                                                            'object_type' => 'drive_folder',
                                                            'object_id' => $item->getId(),
                                                            'action' => 'open_folder_drive',
                                                        ]) }}"
                                                            class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition hover:border-sadarin-200 hover:bg-sadarin-50 hover:text-sadarin-700"
                                                            title="Buka di Google Drive">

                                                            <i class="bi bi-box-arrow-up-right"></i>

                                                        </a>
                                                    @endif
                                                @else
                                                    @if ($itemUrl)
                                                        <a href="{{ route('sadarin.user.archive.drive.open', [
                                                            'archiveId' => $archive->archive_id,
                                                            'url' => $itemUrl,
                                                            'object_type' => 'drive_file',
                                                            'object_id' => $item->getId(),
                                                            'action' => 'open_file',
                                                        ]) }}"
                                                            class="inline-flex min-h-10 flex-1 items-center justify-center gap-1.5 rounded-xl bg-sadarin-700 px-3 py-2.5 text-[11px] font-semibold text-white transition active:scale-[0.98] hover:bg-sadarin-800">

                                                            <i class="bi bi-box-arrow-up-right"></i>

                                                            Buka Berkas

                                                        </a>
                                                    @else
                                                        <span
                                                            class="inline-flex min-h-10 flex-1 items-center justify-center gap-1.5 rounded-xl bg-slate-100 px-3 py-2.5 text-[11px] font-semibold text-slate-400">

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

                            <div
                                class="rounded-2xl border border-dashed border-slate-300 bg-white px-5 py-14 text-center sm:px-6 sm:py-16">

                                <div
                                    class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400 sm:h-16 sm:w-16">

                                    <i class="bi bi-folder2-open text-2xl"></i>

                                </div>


                                <h3 class="mt-5 text-base font-bold text-slate-700">
                                    Folder kosong
                                </h3>


                                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-400">
                                    Tidak ada file atau folder yang tersedia di dalam folder ini.
                                </p>


                                @if ($currentFolderUrl)
                                    <a href="{{ route('sadarin.user.archive.drive.open', [
                                        'archiveId' => $archive->archive_id,
                                        'url' => $currentFolderUrl,
                                        'object_type' => 'drive_folder',
                                        'object_id' => $currentFolderId,
                                        'action' => 'open_folder_drive',
                                    ]) }}"
                                        class="mx-auto mt-5 inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-semibold text-slate-600 transition hover:border-sadarin-200 hover:bg-sadarin-50 hover:text-sadarin-700">

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
                class="mx-auto flex w-full max-w-7xl flex-col gap-2 px-4 py-5 text-xs text-slate-400 sm:px-6 sm:py-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">

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
