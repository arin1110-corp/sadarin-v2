@extends('Dashboard.layouts.app')

@section('title', 'Edit Arsip')
@section('page_title', 'Edit Arsip')
@section('breadcrumb', 'Administrasi Sistem / Arsip / Edit')

@section('content')

    @php

        $oldProgram = old('archive_program_id', $archive->archive_program_id);
        $oldKegiatan = old('archive_kegiatan_id', $archive->archive_kegiatan_id);
        $oldSubKegiatan = old('archive_sub_kegiatan_id', $archive->archive_sub_kegiatan_id);

        $hasClassification = !empty($oldProgram) || !empty($oldKegiatan) || !empty($oldSubKegiatan);

    @endphp


    <div class="space-y-6">

        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}

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
                        Perbarui informasi arsip yang tersimpan di SADARIN.
                    </p>

                </div>

            </div>


            <a href="{{ route('sadarin.admin.archive.show', $archive->archive_id) }}"
                class="inline-flex items-center justify-center gap-2
                       rounded-xl border border-slate-200 bg-white
                       px-4 py-2.5 text-sm font-semibold
                       text-slate-600 shadow-sm transition
                       hover:bg-slate-50">

                <i class="bi bi-arrow-left"></i>

                Kembali

            </a>

        </div>


        {{-- ========================================================= --}}
        {{-- ERROR --}}
        {{-- ========================================================= --}}

        @if ($errors->any())

            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">

                <div class="flex items-center gap-2 font-semibold">

                    <i class="bi bi-exclamation-triangle-fill"></i>

                    Terjadi kesalahan.

                </div>

                <ul class="mt-2 list-inside list-disc text-xs">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        {{-- ========================================================= --}}
        {{-- FORM --}}
        {{-- ========================================================= --}}

        <form action="{{ route('sadarin.admin.archive.update', $archive->archive_id) }}" method="POST">

            @csrf
            @method('PUT')


            {{-- ===================================================== --}}
            {{-- INFORMASI ARSIP --}}
            {{-- ===================================================== --}}

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


                <div class="space-y-5 p-5">


                    {{-- JUDUL --}}

                    <div>

                        <label for="archive_title" class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Judul Arsip

                            <span class="text-red-500">*</span>

                        </label>

                        <input type="text" id="archive_title" name="archive_title"
                            value="{{ old('archive_title', $archive->archive_title) }}" required
                            class="w-full rounded-xl border border-slate-200
                                   bg-slate-50 px-4 py-2.5
                                   text-sm text-slate-700 outline-none
                                   transition
                                   focus:border-[oklch(29.3%_0.136_325.661)]
                                   focus:bg-white
                                   focus:ring-2
                                   focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                    </div>


                    {{-- DESKRIPSI --}}

                    <div>

                        <label for="archive_description" class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Deskripsi

                        </label>

                        <textarea id="archive_description" name="archive_description" rows="4"
                            class="w-full rounded-xl border border-slate-200
                                   bg-slate-50 px-4 py-3
                                   text-sm text-slate-700 outline-none
                                   transition
                                   focus:border-[oklch(29.3%_0.136_325.661)]
                                   focus:bg-white
                                   focus:ring-2
                                   focus:ring-[oklch(29.3%_0.136_325.661)]/10">{{ old('archive_description', $archive->archive_description) }}</textarea>

                    </div>


                    {{-- TANGGAL & TAHUN --}}

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        <div>

                            <label for="archive_date" class="mb-1.5 block text-sm font-semibold text-slate-700">

                                Tanggal Arsip

                            </label>

                            <input type="date" id="archive_date" name="archive_date"
                                value="{{ old('archive_date', $archive->archive_date?->format('Y-m-d')) }}"
                                class="w-full rounded-xl border border-slate-200
                                       bg-slate-50 px-4 py-2.5
                                       text-sm text-slate-700 outline-none
                                       transition
                                       focus:border-[oklch(29.3%_0.136_325.661)]
                                       focus:bg-white
                                       focus:ring-2
                                       focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                        </div>


                        <div>

                            <label for="archive_year" class="mb-1.5 block text-sm font-semibold text-slate-700">

                                Tahun

                            </label>

                            <input type="number" id="archive_year" name="archive_year"
                                value="{{ old('archive_year', $archive->archive_year) }}" min="1900" max="2100"
                                class="w-full rounded-xl border border-slate-200
                                       bg-slate-50 px-4 py-2.5
                                       text-sm text-slate-700 outline-none
                                       transition
                                       focus:border-[oklch(29.3%_0.136_325.661)]
                                       focus:bg-white
                                       focus:ring-2
                                       focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- KLASIFIKASI --}}
            {{-- ========================================================= --}}

            <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

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
                                Unit dan jenis dokumen wajib. Program dan kegiatan bersifat opsional.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="space-y-5 p-5">


                    {{-- UNIT --}}

                    <div>

                        <label for="archive_unit_id" class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Unit

                            <span class="text-red-500">*</span>

                        </label>

                        <select id="archive_unit_id" name="archive_unit_id" required
                            class="w-full rounded-xl border border-slate-200
                                   bg-slate-50 px-4 py-2.5
                                   text-sm text-slate-700 outline-none
                                   transition
                                   focus:border-[oklch(29.3%_0.136_325.661)]
                                   focus:bg-white
                                   focus:ring-2
                                   focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                            <option value="">
                                -- Pilih Unit --
                            </option>

                            @foreach ($units as $unit)
                                <option value="{{ $unit->unit_id }}"
                                    {{ (string) old('archive_unit_id', $archive->archive_unit_id) === (string) $unit->unit_id ? 'selected' : '' }}>

                                    {{ $unit->unit_name }}

                                </option>
                            @endforeach

                        </select>

                    </div>


                    {{-- JENIS DOKUMEN --}}

                    <div>

                        <label for="archive_document_type_id" class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Jenis Dokumen

                            <span class="text-red-500">*</span>

                        </label>

                        <select id="archive_document_type_id" name="archive_document_type_id" required
                            class="w-full rounded-xl border border-slate-200
                                   bg-slate-50 px-4 py-2.5
                                   text-sm text-slate-700 outline-none
                                   transition
                                   focus:border-[oklch(29.3%_0.136_325.661)]
                                   focus:bg-white
                                   focus:ring-2
                                   focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                            <option value="">
                                -- Pilih Jenis Dokumen --
                            </option>

                            @foreach ($documentTypes as $documentType)
                                <option value="{{ $documentType->document_type_id }}"
                                    {{ (string) old('archive_document_type_id', $archive->archive_document_type_id) === (string) $documentType->document_type_id ? 'selected' : '' }}>

                                    {{ $documentType->document_type_name }}

                                </option>
                            @endforeach

                        </select>

                    </div>


                    {{-- ================================================= --}}
                    {{-- TOGGLE PROGRAM --}}
                    {{-- ================================================= --}}

                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">

                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                            <div>

                                <p class="text-sm font-semibold text-slate-700">
                                    Gunakan Program / Kegiatan
                                </p>

                                <p class="mt-1 text-xs leading-5 text-slate-400">
                                    Aktifkan jika arsip memiliki klasifikasi program,
                                    kegiatan atau sub kegiatan.
                                </p>

                            </div>


                            <div class="flex shrink-0 gap-2">

                                <button type="button" id="programNo" class="rounded-lg px-4 py-2 text-xs font-semibold">

                                    Tidak

                                </button>


                                <button type="button" id="programYes" class="rounded-lg px-4 py-2 text-xs font-semibold">

                                    Ya

                                </button>

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- PROGRAM --}}
                    {{-- ================================================= --}}

                    <div id="programSection" class="{{ $hasClassification ? '' : 'hidden' }} space-y-5">


                        {{-- PROGRAM --}}

                        <div>

                            <label for="archive_program_id" class="mb-1.5 block text-sm font-semibold text-slate-700">

                                Program

                            </label>

                            <select id="archive_program_id" name="archive_program_id"
                                class="w-full rounded-xl border border-slate-200
                                       bg-slate-50 px-4 py-2.5
                                       text-sm text-slate-700 outline-none
                                       transition
                                       focus:border-[oklch(29.3%_0.136_325.661)]
                                       focus:bg-white
                                       focus:ring-2
                                       focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                                <option value="">
                                    -- Pilih Program --
                                </option>

                                @foreach ($programs as $program)
                                    <option value="{{ $program->program_id }}"
                                        {{ (string) $oldProgram === (string) $program->program_id ? 'selected' : '' }}>

                                        {{ $program->program_name }}

                                    </option>
                                @endforeach

                            </select>

                        </div>


                        {{-- KEGIATAN --}}

                        <div id="kegiatanWrapper" class="{{ $oldProgram ? '' : 'hidden' }}">

                            <label for="archive_kegiatan_id" class="mb-1.5 block text-sm font-semibold text-slate-700">

                                Kegiatan

                            </label>

                            <select id="archive_kegiatan_id" name="archive_kegiatan_id"
                                class="w-full rounded-xl border border-slate-200
                                       bg-slate-50 px-4 py-2.5
                                       text-sm text-slate-700 outline-none
                                       transition
                                       focus:border-[oklch(29.3%_0.136_325.661)]
                                       focus:bg-white
                                       focus:ring-2
                                       focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                                <option value="">
                                    -- Pilih Kegiatan --
                                </option>

                                @if ($archive->kegiatan)
                                    <option value="{{ $archive->kegiatan->kegiatan_id }}" selected>

                                        {{ $archive->kegiatan->kegiatan_name }}

                                    </option>
                                @endif

                            </select>

                        </div>


                        {{-- SUB KEGIATAN --}}

                        <div id="subKegiatanWrapper" class="{{ $oldKegiatan ? '' : 'hidden' }}">

                            <label for="archive_sub_kegiatan_id"
                                class="mb-1.5 block text-sm font-semibold text-slate-700">

                                Sub Kegiatan

                            </label>

                            <select id="archive_sub_kegiatan_id" name="archive_sub_kegiatan_id"
                                class="w-full rounded-xl border border-slate-200
                                       bg-slate-50 px-4 py-2.5
                                       text-sm text-slate-700 outline-none
                                       transition
                                       focus:border-[oklch(29.3%_0.136_325.661)]
                                       focus:bg-white
                                       focus:ring-2
                                       focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                                <option value="">
                                    -- Pilih Sub Kegiatan --
                                </option>

                                @if ($archive->subKegiatan)
                                    <option value="{{ $archive->subKegiatan->sub_kegiatan_id }}" selected>

                                        {{ $archive->subKegiatan->sub_kegiatan_name }}

                                    </option>
                                @endif

                            </select>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- HAK AKSES --}}
            {{-- ========================================================= --}}

            <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

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
                                Tentukan tingkat akses arsip.
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
                               bg-slate-50 px-4 py-2.5
                               text-sm text-slate-700 outline-none
                               transition
                               focus:border-[oklch(29.3%_0.136_325.661)]
                               focus:bg-white
                               focus:ring-2
                               focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                        <option value="internal"
                            {{ old('archive_access_level', $archive->archive_access_level) === 'internal' ? 'selected' : '' }}>
                            Internal
                        </option>

                        <option value="public"
                            {{ old('archive_access_level', $archive->archive_access_level) === 'public' ? 'selected' : '' }}>
                            Publik
                        </option>

                        <option value="restricted"
                            {{ old('archive_access_level', $archive->archive_access_level) === 'restricted' ? 'selected' : '' }}>
                            Terbatas
                        </option>

                    </select>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- FOOTER --}}
            {{-- ========================================================= --}}

            <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <a href="{{ route('sadarin.admin.archive.show', $archive->archive_id) }}"
                    class="inline-flex items-center justify-center gap-2
                           rounded-xl border border-slate-200 bg-white
                           px-5 py-2.5 text-sm font-semibold
                           text-slate-600 transition hover:bg-slate-50">

                    <i class="bi bi-x-lg"></i>

                    Batal

                </a>


                <button type="submit"
                    class="inline-flex items-center justify-center gap-2
                           rounded-xl
                           bg-[oklch(29.3%_0.136_325.661)]
                           px-5 py-2.5 text-sm font-semibold
                           text-white shadow-sm
                           transition hover:opacity-90">

                    <i class="bi bi-check-lg"></i>

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>


    {{-- ========================================================= --}}
    {{-- JAVASCRIPT --}}
    {{-- ========================================================= --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const programYes = document.getElementById('programYes');
            const programNo = document.getElementById('programNo');

            const programSection = document.getElementById('programSection');

            const programSelect = document.getElementById('archive_program_id');

            const kegiatanWrapper = document.getElementById('kegiatanWrapper');
            const kegiatanSelect = document.getElementById('archive_kegiatan_id');

            const subKegiatanWrapper = document.getElementById('subKegiatanWrapper');
            const subKegiatanSelect = document.getElementById('archive_sub_kegiatan_id');


            const existingProgram = @json($oldProgram);
            const existingKegiatan = @json($oldKegiatan);
            const existingSubKegiatan = @json($oldSubKegiatan);


            /*
            |--------------------------------------------------------------------------
            | BUTTON STYLE
            |--------------------------------------------------------------------------
            */

            function setProgramButton(active) {

                if (active) {

                    programYes.className =
                        'rounded-lg bg-[oklch(29.3%_0.136_325.661)] px-4 py-2 text-xs font-semibold text-white';

                    programNo.className =
                        'rounded-lg border border-slate-200 bg-white px-4 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-100';

                } else {

                    programNo.className =
                        'rounded-lg bg-[oklch(29.3%_0.136_325.661)] px-4 py-2 text-xs font-semibold text-white';

                    programYes.className =
                        'rounded-lg border border-slate-200 bg-white px-4 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-100';

                }

            }


            /*
            |--------------------------------------------------------------------------
            | RESET
            |--------------------------------------------------------------------------
            */

            function resetKegiatan() {

                kegiatanSelect.innerHTML = `
                    <option value="">-- Pilih Kegiatan --</option>
                `;

                kegiatanWrapper.classList.add('hidden');

                resetSubKegiatan();

            }


            function resetSubKegiatan() {

                subKegiatanSelect.innerHTML = `
                    <option value="">-- Pilih Sub Kegiatan --</option>
                `;

                subKegiatanWrapper.classList.add('hidden');

            }


            /*
            |--------------------------------------------------------------------------
            | LOAD KEGIATAN
            |--------------------------------------------------------------------------
            */

            async function loadKegiatan(programId, selectedKegiatan = null) {

                resetKegiatan();

                if (!programId) {
                    return;
                }

                kegiatanWrapper.classList.remove('hidden');

                const url =
                    "{{ route('sadarin.admin.archive.kegiatan', ':programId') }}"
                    .replace(':programId', programId);

                try {

                    const response = await fetch(url);

                    if (!response.ok) {
                        throw new Error('Gagal memuat kegiatan.');
                    }

                    const data = await response.json();

                    kegiatanSelect.innerHTML = `
                        <option value="">-- Pilih Kegiatan --</option>
                    `;

                    data.forEach(function(item) {

                        const option = document.createElement('option');

                        option.value = item.kegiatan_id;

                        option.textContent =
                            item.kegiatan_code ?
                            item.kegiatan_code + ' - ' + item.kegiatan_name :
                            item.kegiatan_name;

                        if (
                            selectedKegiatan &&
                            String(selectedKegiatan) === String(item.kegiatan_id)
                        ) {
                            option.selected = true;
                        }

                        kegiatanSelect.appendChild(option);

                    });


                    if (selectedKegiatan) {

                        await loadSubKegiatan(
                            selectedKegiatan,
                            existingSubKegiatan
                        );

                    }

                } catch (error) {

                    console.error(error);

                    kegiatanSelect.innerHTML = `
                        <option value="">Gagal memuat kegiatan</option>
                    `;

                }

            }


            /*
            |--------------------------------------------------------------------------
            | LOAD SUB KEGIATAN
            |--------------------------------------------------------------------------
            */

            async function loadSubKegiatan(kegiatanId, selectedSubKegiatan = null) {

                resetSubKegiatan();

                if (!kegiatanId) {
                    return;
                }

                subKegiatanWrapper.classList.remove('hidden');

                const url =
                    "{{ route('sadarin.admin.archive.sub-kegiatan', ':kegiatanId') }}"
                    .replace(':kegiatanId', kegiatanId);

                try {

                    const response = await fetch(url);

                    if (!response.ok) {
                        throw new Error('Gagal memuat sub kegiatan.');
                    }

                    const data = await response.json();

                    subKegiatanSelect.innerHTML = `
                        <option value="">-- Pilih Sub Kegiatan --</option>
                    `;

                    data.forEach(function(item) {

                        const option = document.createElement('option');

                        option.value = item.sub_kegiatan_id;

                        option.textContent =
                            item.sub_kegiatan_code ?
                            item.sub_kegiatan_code + ' - ' + item.sub_kegiatan_name :
                            item.sub_kegiatan_name;

                        if (
                            selectedSubKegiatan &&
                            String(selectedSubKegiatan) === String(item.sub_kegiatan_id)
                        ) {
                            option.selected = true;
                        }

                        subKegiatanSelect.appendChild(option);

                    });

                } catch (error) {

                    console.error(error);

                    subKegiatanSelect.innerHTML = `
                        <option value="">Gagal memuat sub kegiatan</option>
                    `;

                }

            }


            /*
            |--------------------------------------------------------------------------
            | YA
            |--------------------------------------------------------------------------
            */

            programYes.addEventListener('click', function() {

                programSection.classList.remove('hidden');

                setProgramButton(true);

            });


            /*
            |--------------------------------------------------------------------------
            | TIDAK
            |--------------------------------------------------------------------------
            */

            programNo.addEventListener('click', function() {

                programSection.classList.add('hidden');

                programSelect.value = '';

                resetKegiatan();

                setProgramButton(false);

            });


            /*
            |--------------------------------------------------------------------------
            | PROGRAM BERUBAH
            |--------------------------------------------------------------------------
            */

            programSelect.addEventListener('change', function() {

                loadKegiatan(this.value);

            });


            /*
            |--------------------------------------------------------------------------
            | KEGIATAN BERUBAH
            |--------------------------------------------------------------------------
            */

            kegiatanSelect.addEventListener('change', function() {

                loadSubKegiatan(this.value);

            });


            /*
            |--------------------------------------------------------------------------
            | INITIAL STATE
            |--------------------------------------------------------------------------
            */

            if (existingProgram || existingKegiatan || existingSubKegiatan) {

                programSection.classList.remove('hidden');

                setProgramButton(true);

                if (existingProgram) {

                    loadKegiatan(
                        existingProgram,
                        existingKegiatan
                    );

                }

            } else {

                setProgramButton(false);

            }

        });
    </script>

@endsection
