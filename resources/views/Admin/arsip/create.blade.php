@extends('Dashboard.layouts.app')

@section('title', 'Tambah Arsip')
@section('page_title', 'Tambah Arsip')
@section('breadcrumb', 'Administrasi Sistem / Arsip / Tambah')

@section('content')

    <div class="space-y-6">

        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                    <i class="bi bi-archive-fill text-xl"></i>
                </div>

                <div>

                    <h1 class="text-xl font-bold text-slate-800">
                        Tambah Arsip
                    </h1>

                    <p class="mt-0.5 text-sm text-slate-500">
                        Tambahkan arsip baru ke dalam SADARIN.
                    </p>

                </div>

            </div>

            <a href="{{ route('sadarin.admin.archive.index') }}"
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
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach

                </ul>

            </div>

        @endif


        {{-- ========================================================= --}}
        {{-- FORM --}}
        {{-- ========================================================= --}}

        <form action="{{ route('sadarin.admin.archive.store') }}" method="POST">

            @csrf


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
                                Informasi dasar mengenai arsip yang disimpan.
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

                        <input type="text" id="archive_title" name="archive_title" value="{{ old('archive_title') }}"
                            placeholder="Contoh: Surat Keputusan Kepala Dinas" required
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
                            placeholder="Masukkan deskripsi atau keterangan mengenai arsip..."
                            class="w-full rounded-xl border border-slate-200
                                   bg-slate-50 px-4 py-3
                                   text-sm text-slate-700 outline-none
                                   transition
                                   focus:border-[oklch(29.3%_0.136_325.661)]
                                   focus:bg-white
                                   focus:ring-2
                                   focus:ring-[oklch(29.3%_0.136_325.661)]/10">{{ old('archive_description') }}</textarea>

                    </div>


                    {{-- TAHUN --}}

                    <div>

                        <label for="archive_year" class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Tahun Arsip

                        </label>

                        <input type="number" id="archive_year" name="archive_year" value="{{ old('archive_year') }}"
                            min="1900" max="2100" placeholder="Contoh: 2026"
                            class="w-full rounded-xl border border-slate-200
                                   bg-slate-50 px-4 py-2.5
                                   text-sm text-slate-700 outline-none
                                   transition
                                   focus:border-[oklch(29.3%_0.136_325.661)]
                                   focus:bg-white
                                   focus:ring-2
                                   focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                        <p class="mt-1.5 text-xs text-slate-400">
                            Tahun yang berkaitan dengan arsip.
                        </p>

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
                                Klasifikasi Arsip
                            </h2>

                            <p class="text-xs text-slate-400">
                                Tentukan unit, jenis dokumen, serta keterkaitan program dan kegiatan.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="space-y-5 p-5">


                    {{-- ================================================= --}}
                    {{-- UNIT --}}
                    {{-- ================================================= --}}

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
                                    {{ old('archive_unit_id') == $unit->unit_id ? 'selected' : '' }}>

                                    {{ $unit->unit_name }}

                                </option>
                            @endforeach

                        </select>

                    </div>


                    {{-- ================================================= --}}
                    {{-- JENIS DOKUMEN --}}
                    {{-- ================================================= --}}

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
                                    {{ old('archive_document_type_id') == $documentType->document_type_id ? 'selected' : '' }}>

                                    {{ $documentType->document_type_name }}

                                </option>
                            @endforeach

                        </select>

                    </div>


                    {{-- ================================================= --}}
                    {{-- PROGRAM / KEGIATAN --}}
                    {{-- ================================================= --}}

                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                            <div>

                                <p class="text-sm font-semibold text-slate-700">
                                    Arsip berkaitan dengan Program / Kegiatan?
                                </p>

                                <p class="mt-1 text-xs leading-5 text-slate-400">

                                    Pilih <strong>Ya</strong> jika arsip berkaitan dengan
                                    program, kegiatan atau sub kegiatan tertentu.

                                </p>

                            </div>


                            <div class="flex shrink-0 gap-2">

                                <button type="button" id="programNo"
                                    class="rounded-lg bg-[oklch(29.3%_0.136_325.661)]
                                           px-4 py-2 text-xs font-semibold text-white">

                                    Tidak

                                </button>


                                <button type="button" id="programYes"
                                    class="rounded-lg border border-slate-200
                                           bg-white px-4 py-2
                                           text-xs font-semibold
                                           text-slate-600
                                           transition hover:bg-slate-100">

                                    Ya

                                </button>

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- PROGRAM --}}
                    {{-- ================================================= --}}

                    <div id="programSection"
                        class="hidden space-y-5 rounded-xl border border-indigo-100
                               bg-indigo-50/30 p-4">

                        {{-- PROGRAM --}}

                        <div>

                            <label for="archive_program_id" class="mb-1.5 block text-sm font-semibold text-slate-700">

                                Program

                            </label>

                            <select id="archive_program_id" name="archive_program_id"
                                class="w-full rounded-xl border border-slate-200
                                       bg-white px-4 py-2.5
                                       text-sm text-slate-700 outline-none
                                       transition
                                       focus:border-[oklch(29.3%_0.136_325.661)]
                                       focus:ring-2
                                       focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                                <option value="">
                                    -- Pilih Program --
                                </option>

                                @foreach ($programs as $program)
                                    <option value="{{ $program->program_id }}"
                                        {{ old('archive_program_id') == $program->program_id ? 'selected' : '' }}>

                                        @if (!empty($program->program_code))
                                            {{ $program->program_code }} -
                                        @endif

                                        {{ $program->program_name }}

                                    </option>
                                @endforeach

                            </select>

                        </div>


                        {{-- KEGIATAN --}}

                        <div id="kegiatanWrapper" class="hidden">

                            <label for="archive_kegiatan_id" class="mb-1.5 block text-sm font-semibold text-slate-700">

                                Kegiatan

                            </label>

                            <select id="archive_kegiatan_id" name="archive_kegiatan_id"
                                class="w-full rounded-xl border border-slate-200
                                       bg-white px-4 py-2.5
                                       text-sm text-slate-700 outline-none
                                       transition
                                       focus:border-[oklch(29.3%_0.136_325.661)]
                                       focus:ring-2
                                       focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                                <option value="">
                                    -- Pilih Kegiatan --
                                </option>

                            </select>

                        </div>


                        {{-- SUB KEGIATAN --}}

                        <div id="subKegiatanWrapper" class="hidden">

                            <label for="archive_sub_kegiatan_id"
                                class="mb-1.5 block text-sm font-semibold text-slate-700">

                                Sub Kegiatan

                            </label>

                            <select id="archive_sub_kegiatan_id" name="archive_sub_kegiatan_id"
                                class="w-full rounded-xl border border-slate-200
                                       bg-white px-4 py-2.5
                                       text-sm text-slate-700 outline-none
                                       transition
                                       focus:border-[oklch(29.3%_0.136_325.661)]
                                       focus:ring-2
                                       focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                                <option value="">
                                    -- Pilih Sub Kegiatan --
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- SUMBER ARSIP --}}
            {{-- ========================================================= --}}

            <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 px-5 py-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                            <i class="bi bi-google text-lg"></i>
                        </div>

                        <div>

                            <h2 class="text-sm font-bold text-slate-800">
                                Sumber Arsip
                            </h2>

                            <p class="text-xs text-slate-400">
                                Masukkan tautan menuju arsip yang tersimpan di Google Drive.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="space-y-5 p-5">

                    {{-- GOOGLE DRIVE URL --}}

                    <div>

                        <label for="archive_drive_url" class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Link Google Drive

                            <span class="text-red-500">*</span>

                        </label>

                        <div class="relative">

                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">

                                <i class="bi bi-link-45deg text-slate-400"></i>

                            </div>

                            <input type="url" id="archive_drive_url" name="archive_drive_url"
                                value="{{ old('archive_drive_url') }}" placeholder="https://drive.google.com/..."
                                required
                                class="w-full rounded-xl border border-slate-200
                                       bg-slate-50 py-2.5 pl-10 pr-4
                                       text-sm text-slate-700 outline-none
                                       transition
                                       focus:border-[oklch(29.3%_0.136_325.661)]
                                       focus:bg-white
                                       focus:ring-2
                                       focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                        </div>

                        <p class="mt-1.5 text-xs text-slate-400">
                            Masukkan link Google Drive yang menjadi sumber arsip.
                        </p>

                    </div>


                    {{-- GOOGLE DRIVE FOLDER ID --}}

                    <div>

                        <label for="archive_drive_folder_id" class="mb-1.5 block text-sm font-semibold text-slate-700">

                            ID Folder Google Drive

                        </label>

                        <input type="text" id="archive_drive_folder_id" name="archive_drive_folder_id"
                            value="{{ old('archive_drive_folder_id') }}"
                            placeholder="Contoh: 1AbCdEfGhIjKlMnOpQrStUvWxYz"
                            class="w-full rounded-xl border border-slate-200
                                   bg-slate-50 px-4 py-2.5
                                   text-sm text-slate-700 outline-none
                                   transition
                                   focus:border-[oklch(29.3%_0.136_325.661)]
                                   focus:bg-white
                                   focus:ring-2
                                   focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                        <p class="mt-1.5 text-xs text-slate-400">
                            Opsional. Digunakan jika arsip berada dalam folder Google Drive tertentu.
                        </p>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- TAG --}}
            {{-- ========================================================= --}}

            <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 px-5 py-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-amber-600">
                            <i class="bi bi-tags-fill"></i>
                        </div>

                        <div>

                            <h2 class="text-sm font-bold text-slate-800">
                                Tag Arsip
                            </h2>

                            <p class="text-xs text-slate-400">
                                Tambahkan tag untuk mempermudah pencarian dan pengelompokan arsip.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="p-5">

                    @if ($tags->count())

                        <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-3">

                            @foreach ($tags as $tag)
                                <label
                                    class="flex cursor-pointer items-center gap-3 rounded-xl
                                           border border-slate-200 bg-slate-50 px-4 py-3
                                           transition hover:border-amber-200 hover:bg-amber-50">

                                    <input type="checkbox" name="tag_ids[]" value="{{ $tag->tag_id }}"
                                        {{ in_array($tag->tag_id, old('tag_ids', [])) ? 'checked' : '' }}
                                        class="h-4 w-4 rounded border-slate-300
                                               text-amber-600
                                               focus:ring-amber-500">

                                    <span class="text-sm text-slate-700">
                                        #{{ $tag->tag_name }}
                                    </span>

                                </label>
                            @endforeach

                        </div>
                    @else
                        <div
                            class="rounded-xl border border-dashed border-slate-200
                                    bg-slate-50 px-4 py-6 text-center">

                            <i class="bi bi-tags text-xl text-slate-400"></i>

                            <p class="mt-2 text-xs text-slate-400">
                                Belum ada tag aktif.
                            </p>

                        </div>

                    @endif

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
                               bg-slate-50 px-4 py-2.5
                               text-sm text-slate-700 outline-none
                               transition
                               focus:border-[oklch(29.3%_0.136_325.661)]
                               focus:bg-white
                               focus:ring-2
                               focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                        <option value="internal"
                            {{ old('archive_access_level', 'internal') === 'internal' ? 'selected' : '' }}>

                            Internal

                        </option>

                        <option value="public" {{ old('archive_access_level') === 'public' ? 'selected' : '' }}>

                            Publik

                        </option>

                    </select>

                    <p class="mt-1.5 text-xs text-slate-400">

                        <strong>Publik</strong> dapat diakses masyarakat,
                        sedangkan <strong>Internal</strong> hanya untuk pengguna internal SADARIN.

                    </p>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- FOOTER --}}
            {{-- ========================================================= --}}

            <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <a href="{{ route('sadarin.admin.archive.index') }}"
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
                           px-5 py-2.5
                           text-sm font-semibold
                           text-white shadow-sm
                           transition hover:opacity-90">

                    <i class="bi bi-check-lg"></i>

                    Simpan Arsip

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
            | RESET SUB KEGIATAN
            |--------------------------------------------------------------------------
            */

            function resetSubKegiatan() {

                subKegiatanSelect.innerHTML =
                    '<option value="">-- Pilih Sub Kegiatan --</option>';

                subKegiatanWrapper.classList.add('hidden');

            }


            /*
            |--------------------------------------------------------------------------
            | RESET KEGIATAN
            |--------------------------------------------------------------------------
            */

            function resetKegiatan() {

                kegiatanSelect.innerHTML =
                    '<option value="">-- Pilih Kegiatan --</option>';

                kegiatanWrapper.classList.add('hidden');

                resetSubKegiatan();

            }


            /*
            |--------------------------------------------------------------------------
            | LOAD KEGIATAN
            |--------------------------------------------------------------------------
            */

            async function loadKegiatan(programId, selectedKegiatanId = null) {

                resetKegiatan();

                if (!programId) {
                    return;
                }

                kegiatanWrapper.classList.remove('hidden');

                const url =
                    "{{ route('sadarin.admin.archive.kegiatan', ':programId') }}"
                    .replace(':programId', programId);

                try {

                    const response = await fetch(url, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Gagal memuat kegiatan.');
                    }

                    const data = await response.json();

                    kegiatanSelect.innerHTML =
                        '<option value="">-- Pilih Kegiatan --</option>';

                    data.forEach(function(item) {

                        const option = document.createElement('option');

                        option.value = item.kegiatan_id;

                        option.textContent =
                            item.kegiatan_code ?
                            item.kegiatan_code + ' - ' + item.kegiatan_name :
                            item.kegiatan_name;

                        if (
                            selectedKegiatanId &&
                            String(selectedKegiatanId) === String(item.kegiatan_id)
                        ) {
                            option.selected = true;
                        }

                        kegiatanSelect.appendChild(option);

                    });

                    if (selectedKegiatanId) {
                        await loadSubKegiatan(
                            selectedKegiatanId,
                            "{{ old('archive_sub_kegiatan_id') }}"
                        );
                    }

                } catch (error) {

                    console.error(error);

                    kegiatanSelect.innerHTML =
                        '<option value="">Gagal memuat kegiatan</option>';

                }

            }


            /*
            |--------------------------------------------------------------------------
            | LOAD SUB KEGIATAN
            |--------------------------------------------------------------------------
            */

            async function loadSubKegiatan(kegiatanId, selectedSubKegiatanId = null) {

                resetSubKegiatan();

                if (!kegiatanId) {
                    return;
                }

                subKegiatanWrapper.classList.remove('hidden');

                const url =
                    "{{ route('sadarin.admin.archive.sub-kegiatan', ':kegiatanId') }}"
                    .replace(':kegiatanId', kegiatanId);

                try {

                    const response = await fetch(url, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Gagal memuat sub kegiatan.');
                    }

                    const data = await response.json();

                    subKegiatanSelect.innerHTML =
                        '<option value="">-- Pilih Sub Kegiatan --</option>';

                    data.forEach(function(item) {

                        const option = document.createElement('option');

                        option.value = item.sub_kegiatan_id;

                        option.textContent =
                            item.sub_kegiatan_code ?
                            item.sub_kegiatan_code + ' - ' + item.sub_kegiatan_name :
                            item.sub_kegiatan_name;

                        if (
                            selectedSubKegiatanId &&
                            String(selectedSubKegiatanId) === String(item.sub_kegiatan_id)
                        ) {
                            option.selected = true;
                        }

                        subKegiatanSelect.appendChild(option);

                    });

                } catch (error) {

                    console.error(error);

                    subKegiatanSelect.innerHTML =
                        '<option value="">Gagal memuat sub kegiatan</option>';

                }

            }


            /*
            |--------------------------------------------------------------------------
            | PROGRAM YA
            |--------------------------------------------------------------------------
            */

            programYes.addEventListener('click', function() {

                programSection.classList.remove('hidden');

                setProgramButton(true);

            });


            /*
            |--------------------------------------------------------------------------
            | PROGRAM TIDAK
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

            const oldProgram = "{{ old('archive_program_id') }}";
            const oldKegiatan = "{{ old('archive_kegiatan_id') }}";
            const oldSubKegiatan = "{{ old('archive_sub_kegiatan_id') }}";

            if (oldProgram) {

                programSection.classList.remove('hidden');

                setProgramButton(true);

                programSelect.value = oldProgram;

                loadKegiatan(
                    oldProgram,
                    oldKegiatan || null
                );

            } else {

                setProgramButton(false);

            }

        });
    </script>

@endsection
