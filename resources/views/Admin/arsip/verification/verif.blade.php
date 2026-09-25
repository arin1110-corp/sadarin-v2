@extends('Dashboard.layouts.app')

@section('title', 'Verifikasi Arsip')
@section('page_title', 'Verifikasi Arsip')
@section('breadcrumb', 'Administrasi Sistem / Arsip / Verifikasi')

@section('content')

    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">

                    <i class="bi bi-shield-check text-xl"></i>

                </div>

                <div>

                    <h1 class="text-xl font-bold text-slate-800">
                        Verifikasi Arsip
                    </h1>

                    <p class="mt-0.5 text-sm text-slate-500">
                        Periksa informasi arsip sebelum menentukan status verifikasi.
                    </p>

                </div>

            </div>


            <a href="{{ route('sadarin.admin.archive.verification') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:bg-slate-50">

                <i class="bi bi-arrow-left"></i>

                Kembali

            </a>

        </div>


        {{-- STATUS --}}
        <div class="rounded-xl border border-amber-200 bg-amber-50 px-4 py-3">

            <div class="flex items-center gap-2 text-sm font-semibold text-amber-700">

                <i class="bi bi-hourglass-split"></i>

                Arsip ini sedang menunggu verifikasi.

            </div>

        </div>


        {{-- INFORMASI ARSIP --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

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
                            Periksa data utama arsip.
                        </p>

                    </div>

                </div>

            </div>


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


        {{-- KLASIFIKASI --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">

                        <i class="bi bi-diagram-3-fill"></i>

                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-slate-800">
                            Klasifikasi Arsip
                        </h2>

                        <p class="text-xs text-slate-400">
                            Periksa klasifikasi dan keterkaitan arsip.
                        </p>

                    </div>

                </div>

            </div>


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


                {{-- JENIS --}}
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

                        @if ($archive->subKegiatan?->kegiatan?->program)

                            @if ($archive->subKegiatan->kegiatan->program->program_code)
                                {{ $archive->subKegiatan->kegiatan->program->program_code }} -
                            @endif

                            {{ $archive->subKegiatan->kegiatan->program->program_name }}
                        @else
                            -
                        @endif

                    </p>

                </div>


                {{-- KEGIATAN --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Kegiatan
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-700">

                        @if ($archive->subKegiatan?->kegiatan)

                            @if ($archive->subKegiatan->kegiatan->kegiatan_code)
                                {{ $archive->subKegiatan->kegiatan->kegiatan_code }} -
                            @endif

                            {{ $archive->subKegiatan->kegiatan->kegiatan_name }}
                        @else
                            -
                        @endif

                    </p>

                </div>


                {{-- SUB KEGIATAN --}}
                <div class="md:col-span-2">

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Sub Kegiatan
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-700">

                        @if ($archive->subKegiatan)

                            @if ($archive->subKegiatan->sub_kegiatan_code)
                                {{ $archive->subKegiatan->sub_kegiatan_code }} -
                            @endif

                            {{ $archive->subKegiatan->sub_kegiatan_name }}
                        @else
                            -
                        @endif

                    </p>

                </div>

            </div>

        </div>


        {{-- TAG --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-violet-50 text-violet-600">

                        <i class="bi bi-tags-fill"></i>

                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-slate-800">
                            Tag Arsip
                        </h2>

                        <p class="text-xs text-slate-400">
                            Tag yang terpasang pada arsip.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-5">

                @if ($archive->tags && $archive->tags->count())

                    <div class="flex flex-wrap gap-2">

                        @foreach ($archive->tags as $tag)
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-violet-50 px-3 py-1.5 text-xs font-semibold text-violet-700">

                                <i class="bi bi-tag-fill"></i>

                                {{ $tag->tag_name }}

                            </span>
                        @endforeach

                    </div>
                @else
                    <p class="text-sm text-slate-400">
                        Tidak ada tag.
                    </p>

                @endif

            </div>

        </div>


        {{-- SUMBER --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">

                        <i class="bi bi-link-45deg"></i>

                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-slate-800">
                            Sumber Arsip
                        </h2>

                        <p class="text-xs text-slate-400">
                            Periksa lokasi file arsip.
                        </p>

                    </div>

                </div>

            </div>


            <div class="space-y-4 p-5">

                @if ($archive->archive_drive_url)
                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Link Arsip
                        </p>

                        <div class="mt-2 flex flex-col gap-3 sm:flex-row">

                            <div class="min-w-0 flex-1 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">

                                <p class="break-all text-sm text-slate-600">
                                    {{ $archive->archive_drive_url }}
                                </p>

                            </div>

                            <a href="{{ $archive->archive_drive_url }}" target="_blank" rel="noopener noreferrer"
                                class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700">

                                <i class="bi bi-box-arrow-up-right"></i>

                                Buka Arsip

                            </a>

                        </div>

                    </div>
                @else
                    <div class="rounded-xl border border-dashed border-red-200 bg-red-50 px-4 py-4">

                        <div class="flex items-center gap-2 text-sm font-semibold text-red-700">

                            <i class="bi bi-exclamation-triangle-fill"></i>

                            Link arsip belum tersedia.

                        </div>

                    </div>
                @endif


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


        {{-- HAK AKSES --}}
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
                            Tingkat akses arsip.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-5">

                @if ($archive->archive_access_level === 'public')
                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-3 py-1.5 text-xs font-bold text-emerald-700">

                        <i class="bi bi-globe2"></i>

                        Publik

                    </span>
                @else
                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-blue-100 px-3 py-1.5 text-xs font-bold text-blue-700">

                        <i class="bi bi-building"></i>

                        Internal

                    </span>
                @endif

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- FORM VERIFIKASI --}}
        {{-- ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-amber-600">

                        <i class="bi bi-shield-check"></i>

                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-slate-800">
                            Tindakan Verifikasi
                        </h2>

                        <p class="text-xs text-slate-400">
                            Tentukan hasil pemeriksaan arsip.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-5">

                <form action="{{ route('sadarin.admin.archive.processVerify', $archive->archive_id) }}" method="POST">

                    @csrf


                    {{-- ALASAN PENOLAKAN --}}
                    <div class="mb-5">

                        <label for="archive_rejection_reason"
                            class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500">

                            Alasan Penolakan

                            <span class="font-normal normal-case text-slate-400">
                                (isi jika ditolak)
                            </span>

                        </label>

                        <textarea name="archive_rejection_reason" id="archive_rejection_reason" rows="4"
                            placeholder="Tuliskan alasan jika arsip ditolak..."
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-red-300 focus:bg-white focus:ring-4 focus:ring-red-500/10">{{ old('archive_rejection_reason') }}</textarea>

                        @error('archive_rejection_reason')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- BUTTON --}}
                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                        <a href="{{ route('sadarin.admin.archive.verification') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">

                            <i class="bi bi-arrow-left"></i>

                            Kembali

                        </a>


                        {{-- TOLAK --}}
                        <button type="submit" name="action" value="rejected"
                            onclick="return confirm('Yakin ingin menolak arsip ini?')"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-red-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-red-700">

                            <i class="bi bi-x-circle"></i>

                            Tolak Arsip

                        </button>


                        {{-- VERIFIKASI --}}
                        <button type="submit" name="action" value="verified"
                            onclick="return confirm('Yakin ingin memverifikasi arsip ini?')"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">

                            <i class="bi bi-check-circle"></i>

                            Verifikasi Arsip

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
