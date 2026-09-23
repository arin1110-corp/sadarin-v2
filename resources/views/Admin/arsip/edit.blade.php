@extends('Dashboard.layouts.app')

@section('title', 'Edit Arsip')
@section('page_title', 'Edit Arsip')
@section('breadcrumb', 'Administrasi Sistem / Arsip / Edit')

@section('content')

    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                    <i class="bi bi-pencil-square text-xl"></i>
                </div>

                <div>
                    <h1 class="text-xl font-bold text-slate-800">
                        Edit Arsip
                    </h1>

                    <p class="mt-0.5 text-sm text-slate-500">
                        Perbarui informasi arsip di dalam SADARIN.
                    </p>
                </div>

            </div>

            {{-- KEMBALI --}}
            <a href="{{ route('sadarin.admin.archive.show', ['id' => $archive->archive_id]) }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl
                       border border-slate-200 bg-white px-4 py-2.5
                       text-sm font-semibold text-slate-600 shadow-sm
                       transition hover:bg-slate-50">

                <i class="bi bi-arrow-left"></i>

                Kembali

            </a>

        </div>


        {{-- VALIDATION ERROR --}}
        @if ($errors->any())

            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3">

                <div class="flex items-center gap-2 text-sm font-semibold text-red-700">

                    <i class="bi bi-exclamation-triangle-fill"></i>

                    Terdapat kesalahan pada data.

                </div>

                <ul class="mt-2 list-inside list-disc space-y-1 text-xs text-red-600">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        {{-- FORM --}}
        <form action="{{ route('sadarin.admin.archive.update', ['id' => $archive->archive_id]) }}" method="POST"
            class="space-y-6">

            @csrf
            @method('PUT')


            {{-- ========================================================= --}}
            {{-- INFORMASI ARSIP --}}
            {{-- ========================================================= --}}

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
                                Informasi dasar mengenai arsip.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="grid grid-cols-1 gap-5 p-5">

                    {{-- JUDUL --}}
                    <div>

                        <label for="archive_title" class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Judul Arsip

                            <span class="text-red-500">*</span>

                        </label>

                        <input type="text" id="archive_title" name="archive_title"
                            value="{{ old('archive_title', $archive->archive_title) }}" required maxlength="255"
                            placeholder="Masukkan judul arsip"
                            class="w-full rounded-xl border border-slate-200
                                   bg-white px-4 py-2.5 text-sm text-slate-700
                                   outline-none transition
                                   placeholder:text-slate-400
                                   focus:border-[oklch(29.3%_0.136_325.661)]
                                   focus:ring-2
                                   focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                    </div>


                    {{-- DESKRIPSI --}}
                    <div>

                        <label for="archive_description" class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Deskripsi

                        </label>

                        <textarea id="archive_description" name="archive_description" rows="4"
                            placeholder="Masukkan deskripsi arsip jika diperlukan"
                            class="w-full resize-y rounded-xl border border-slate-200
                                   bg-white px-4 py-3 text-sm text-slate-700
                                   outline-none transition
                                   placeholder:text-slate-400
                                   focus:border-[oklch(29.3%_0.136_325.661)]
                                   focus:ring-2
                                   focus:ring-[oklch(29.3%_0.136_325.661)]/10">{{ old('archive_description', $archive->archive_description) }}</textarea>

                    </div>


                    {{-- TANGGAL & TAHUN --}}
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        {{-- TANGGAL --}}
                        <div>

                            <label for="archive_date" class="mb-1.5 block text-sm font-semibold text-slate-700">

                                Tanggal Arsip

                            </label>

                            <input type="date" id="archive_date" name="archive_date"
                                value="{{ old('archive_date', optional($archive->archive_date)->format('Y-m-d')) }}"
                                class="w-full rounded-xl border border-slate-200
                                       bg-white px-4 py-2.5 text-sm text-slate-700
                                       outline-none transition
                                       focus:border-[oklch(29.3%_0.136_325.661)]
                                       focus:ring-2
                                       focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                        </div>


                        {{-- TAHUN --}}
                        <div>

                            <label for="archive_year" class="mb-1.5 block text-sm font-semibold text-slate-700">

                                Tahun

                            </label>

                            <input type="number" id="archive_year" name="archive_year"
                                value="{{ old('archive_year', $archive->archive_year) }}" min="1900" max="2100"
                                placeholder="Contoh: 2026"
                                class="w-full rounded-xl border border-slate-200
                                       bg-white px-4 py-2.5 text-sm text-slate-700
                                       outline-none transition
                                       placeholder:text-slate-400
                                       focus:border-[oklch(29.3%_0.136_325.661)]
                                       focus:ring-2
                                       focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- KLASIFIKASI --}}
            {{-- ========================================================= --}}

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

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
                                Tentukan klasifikasi arsip.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="grid grid-cols-1 gap-5 p-5 md:grid-cols-2">


                    {{-- UNIT --}}
                    <div>

                        <label for="archive_unit_id" class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Unit

                        </label>

                        <select id="archive_unit_id" name="archive_unit_id"
                            class="w-full rounded-xl border border-slate-200
                                   bg-white px-4 py-2.5 text-sm text-slate-700
                                   outline-none transition
                                   focus:border-[oklch(29.3%_0.136_325.661)]
                                   focus:ring-2
                                   focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                            <option value="">
                                -- Pilih Unit --
                            </option>

                            @foreach ($units as $unit)
                                <option value="{{ $unit->unit_id }}" @selected(old('archive_unit_id', $archive->archive_unit_id) == $unit->unit_id)>

                                    {{ $unit->unit_name }}

                                </option>
                            @endforeach

                        </select>

                    </div>


                    {{-- JENIS DOKUMEN --}}
                    <div>

                        <label for="archive_document_type_id" class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Jenis Dokumen

                        </label>

                        <select id="archive_document_type_id" name="archive_document_type_id"
                            class="w-full rounded-xl border border-slate-200
                                   bg-white px-4 py-2.5 text-sm text-slate-700
                                   outline-none transition
                                   focus:border-[oklch(29.3%_0.136_325.661)]
                                   focus:ring-2
                                   focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                            <option value="">
                                -- Pilih Jenis Dokumen --
                            </option>

                            @foreach ($documentTypes as $documentType)
                                <option value="{{ $documentType->document_type_id }}" @selected(old('archive_document_type_id', $archive->archive_document_type_id) == $documentType->document_type_id)>

                                    {{ $documentType->document_type_name }}

                                </option>
                            @endforeach

                        </select>

                    </div>


                    {{-- PROGRAM --}}
                    <div>

                        <label for="archive_program_id" class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Program

                        </label>

                        <select id="archive_program_id" name="archive_program_id"
                            class="w-full rounded-xl border border-slate-200
                                   bg-white px-4 py-2.5 text-sm text-slate-700
                                   outline-none transition
                                   focus:border-[oklch(29.3%_0.136_325.661)]
                                   focus:ring-2
                                   focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                            <option value="">
                                -- Pilih Program --
                            </option>

                            @foreach ($programs as $program)
                                <option value="{{ $program->program_id }}" @selected(old('archive_program_id', $archive->archive_program_id) == $program->program_id)>

                                    {{ $program->program_name }}

                                </option>
                            @endforeach

                        </select>

                    </div>


                    {{-- KEGIATAN --}}
                    <div>

                        <label for="archive_kegiatan_id" class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Kegiatan

                        </label>

                        <select id="archive_kegiatan_id" name="archive_kegiatan_id"
                            class="w-full rounded-xl border border-slate-200
                                   bg-white px-4 py-2.5 text-sm text-slate-700
                                   outline-none transition
                                   focus:border-[oklch(29.3%_0.136_325.661)]
                                   focus:ring-2
                                   focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                            <option value="">
                                -- Pilih Kegiatan --
                            </option>

                            @foreach ($kegiatans as $kegiatan)
                                <option value="{{ $kegiatan->kegiatan_id }}" @selected(old('archive_kegiatan_id', $archive->archive_kegiatan_id) == $kegiatan->kegiatan_id)>

                                    {{ $kegiatan->kegiatan_name }}

                                </option>
                            @endforeach

                        </select>

                    </div>


                    {{-- SUB KEGIATAN --}}
                    <div class="md:col-span-2">

                        <label for="archive_sub_kegiatan_id" class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Sub Kegiatan

                        </label>

                        <select id="archive_sub_kegiatan_id" name="archive_sub_kegiatan_id"
                            class="w-full rounded-xl border border-slate-200
                                   bg-white px-4 py-2.5 text-sm text-slate-700
                                   outline-none transition
                                   focus:border-[oklch(29.3%_0.136_325.661)]
                                   focus:ring-2
                                   focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                            <option value="">
                                -- Pilih Sub Kegiatan --
                            </option>

                            @foreach ($subKegiatans as $subKegiatan)
                                <option value="{{ $subKegiatan->sub_kegiatan_id }}" @selected(old('archive_sub_kegiatan_id', $archive->archive_sub_kegiatan_id) == $subKegiatan->sub_kegiatan_id)>

                                    {{ $subKegiatan->sub_kegiatan_name }}

                                </option>
                            @endforeach

                        </select>

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
                                Tentukan siapa yang dapat mengakses arsip.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="p-5">

                    <label for="archive_access_level" class="mb-1.5 block text-sm font-semibold text-slate-700">

                        Tingkat Akses

                        <span class="text-red-500">*</span>

                    </label>

                    <select id="archive_access_level" name="archive_access_level" required
                        class="w-full rounded-xl border border-slate-200
                               bg-white px-4 py-2.5 text-sm text-slate-700
                               outline-none transition
                               focus:border-[oklch(29.3%_0.136_325.661)]
                               focus:ring-2
                               focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                        <option value="internal" @selected(old('archive_access_level', $archive->archive_access_level) === 'internal')>
                            Internal
                        </option>

                        <option value="public" @selected(old('archive_access_level', $archive->archive_access_level) === 'public')>
                            Publik
                        </option>

                        <option value="restricted" @selected(old('archive_access_level', $archive->archive_access_level) === 'restricted')>
                            Terbatas
                        </option>

                    </select>

                    <p class="mt-2 text-xs text-slate-400">

                        <span class="font-semibold text-slate-500">
                            Internal
                        </span>
                        hanya untuk pengguna internal.

                        <span class="mx-1">•</span>

                        <span class="font-semibold text-slate-500">
                            Publik
                        </span>
                        dapat diakses publik.

                        <span class="mx-1">•</span>

                        <span class="font-semibold text-slate-500">
                            Terbatas
                        </span>
                        membutuhkan hak akses khusus.

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
                                Status saat ini dikelola oleh proses verifikasi.
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


                    <p class="mt-2 text-xs text-slate-400">
                        Status tidak diubah dari halaman edit arsip.
                    </p>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- ACTION --}}
            {{-- ========================================================= --}}

            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                {{-- BATAL --}}
                <a href="{{ route('sadarin.admin.archive.show', ['id' => $archive->archive_id]) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl
                           border border-slate-200 bg-white px-5 py-2.5
                           text-sm font-semibold text-slate-600
                           transition hover:bg-slate-50">

                    <i class="bi bi-x-lg"></i>

                    Batal

                </a>


                {{-- SIMPAN --}}
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl
                           bg-[oklch(29.3%_0.136_325.661)] px-5 py-2.5
                           text-sm font-semibold text-white shadow-sm
                           transition hover:opacity-90">

                    <i class="bi bi-check-lg"></i>

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

@endsection
