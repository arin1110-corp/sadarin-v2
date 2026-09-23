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
                        Tambahkan data arsip baru ke dalam SADARIN.
                    </p>

                </div>

            </div>


            <a href="{{ route('sadarin.admin.archive.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl
                       border border-slate-200 bg-white px-4 py-2.5
                       text-sm font-semibold text-slate-600 shadow-sm
                       transition hover:bg-slate-50">

                <i class="bi bi-arrow-left"></i>

                Kembali

            </a>

        </div>


        {{-- ========================================================= --}}
        {{-- VALIDATION ERROR --}}
        {{-- ========================================================= --}}

        @if ($errors->any())

            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3">

                <div class="flex items-center gap-2 text-sm font-semibold text-red-700">

                    <i class="bi bi-exclamation-triangle-fill"></i>

                    Terdapat kesalahan pada data.

                </div>

                <ul class="mt-2 list-inside list-disc space-y-1 text-xs text-red-600">

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

        <form action="{{ route('sadarin.admin.archive.store') }}" method="POST" class="space-y-6">

            @csrf


            {{-- ===================================================== --}}
            {{-- INFORMASI ARSIP --}}
            {{-- ===================================================== --}}

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- HEADER CARD --}}

                <div class="border-b border-slate-100 px-5 py-4">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-lg
                                   bg-blue-50 text-blue-600">

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


                {{-- BODY CARD --}}

                <div class="grid grid-cols-1 gap-5 p-5">


                    {{-- JUDUL --}}

                    <div>

                        <label for="archive_title" class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Judul Arsip

                            <span class="text-red-500">*</span>

                        </label>


                        <input type="text" id="archive_title" name="archive_title" value="{{ old('archive_title') }}"
                            required maxlength="255" placeholder="Masukkan judul arsip"
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
                                   focus:ring-[oklch(29.3%_0.136_325.661)]/10">{{ old('archive_description') }}</textarea>

                    </div>


                    {{-- TANGGAL & TAHUN --}}

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                        {{-- TANGGAL --}}

                        <div>

                            <label for="archive_date" class="mb-1.5 block text-sm font-semibold text-slate-700">

                                Tanggal Arsip

                            </label>


                            <input type="date" id="archive_date" name="archive_date" value="{{ old('archive_date') }}"
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


                            <input type="number" id="archive_year" name="archive_year" value="{{ old('archive_year') }}"
                                min="1900" max="2100" placeholder="Contoh: 2026"
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


                {{-- HEADER --}}

                <div class="border-b border-slate-100 px-5 py-4">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-lg
                                   bg-indigo-50 text-indigo-600">

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


                {{-- BODY --}}

                <div class="grid grid-cols-1 gap-5 p-5">


                    {{-- ================================================= --}}
                    {{-- UNIT --}}
                    {{-- ================================================= --}}

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
                                <option value="{{ $unit->unit_id }}" @selected(old('archive_unit_id') == $unit->unit_id)>

                                    {{ $unit->unit_name }}

                                </option>
                            @endforeach

                        </select>


                        <p class="mt-1 text-xs text-slate-400">

                            Pilih unit yang terkait dengan arsip.

                        </p>

                    </div>


                    {{-- ================================================= --}}
                    {{-- JENIS DOKUMEN --}}
                    {{-- ================================================= --}}

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
                                <option value="{{ $documentType->document_type_id }}" @selected(old('archive_document_type_id') == $documentType->document_type_id)>

                                    {{ $documentType->document_type_name }}

                                </option>
                            @endforeach

                        </select>

                    </div>


                    {{-- ================================================= --}}
                    {{-- PROGRAM --}}
                    {{-- ================================================= --}}

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
                                <option value="{{ $program->program_id }}" @selected(old('archive_program_id') == $program->program_id)>

                                    @if ($program->program_code)
                                        {{ $program->program_code }} -
                                    @endif

                                    {{ $program->program_name }}

                                </option>
                            @endforeach

                        </select>

                    </div>


                    {{-- ================================================= --}}
                    {{-- KEGIATAN --}}
                    {{-- ================================================= --}}

                    <div>

                        <label for="archive_kegiatan_id" class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Kegiatan

                        </label>


                        <select id="archive_kegiatan_id" name="archive_kegiatan_id" disabled
                            class="w-full rounded-xl border border-slate-200
                                   bg-white px-4 py-2.5 text-sm text-slate-700
                                   outline-none transition
                                   disabled:cursor-not-allowed
                                   disabled:bg-slate-50
                                   disabled:text-slate-400
                                   focus:border-[oklch(29.3%_0.136_325.661)]
                                   focus:ring-2
                                   focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                            <option value="">
                                -- Pilih Program Dahulu --
                            </option>

                        </select>

                    </div>


                    {{-- ================================================= --}}
                    {{-- SUB KEGIATAN --}}
                    {{-- ================================================= --}}

                    <div class="md:col-span-2">

                        <label for="archive_sub_kegiatan_id" class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Sub Kegiatan

                        </label>


                        <select id="archive_sub_kegiatan_id" name="archive_sub_kegiatan_id" disabled
                            class="w-full rounded-xl border border-slate-200
                                   bg-white px-4 py-2.5 text-sm text-slate-700
                                   outline-none transition
                                   disabled:cursor-not-allowed
                                   disabled:bg-slate-50
                                   disabled:text-slate-400
                                   focus:border-[oklch(29.3%_0.136_325.661)]
                                   focus:ring-2
                                   focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                            <option value="">
                                -- Pilih Kegiatan Dahulu --
                            </option>

                        </select>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- HAK AKSES --}}
            {{-- ========================================================= --}}

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">


                {{-- HEADER --}}

                <div class="border-b border-slate-100 px-5 py-4">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-lg
                                   bg-amber-50 text-amber-600">

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


                {{-- BODY --}}

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

                        <option value="internal" @selected(old('archive_access_level', 'internal') === 'internal')>

                            Internal

                        </option>


                        <option value="public" @selected(old('archive_access_level') === 'public')>

                            Publik

                        </option>


                        <option value="restricted" @selected(old('archive_access_level') === 'restricted')>

                            Terbatas

                        </option>

                    </select>


                    <p class="mt-2 text-xs text-slate-400">

                        <span class="font-semibold text-slate-500">
                            Internal
                        </span>

                        hanya untuk pengguna internal.

                        <span class="mx-1">
                            •
                        </span>

                        <span class="font-semibold text-slate-500">
                            Publik
                        </span>

                        dapat diakses publik.

                        <span class="mx-1">
                            •
                        </span>

                        <span class="font-semibold text-slate-500">
                            Terbatas
                        </span>

                        membutuhkan hak akses khusus.

                    </p>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- ACTION --}}
            {{-- ========================================================= --}}

            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">


                {{-- BATAL --}}

                <a href="{{ route('sadarin.admin.archive.index') }}"
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

                    Simpan Arsip

                </button>

            </div>


        </form>

    </div>

@endsection


{{-- ========================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================= --}}

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /*
            |--------------------------------------------------------------------------
            | ELEMENT
            |--------------------------------------------------------------------------
            */

            const programSelect = document.getElementById(
                'archive_program_id'
            );

            const kegiatanSelect = document.getElementById(
                'archive_kegiatan_id'
            );

            const subKegiatanSelect = document.getElementById(
                'archive_sub_kegiatan_id'
            );


            /*
            |--------------------------------------------------------------------------
            | PROGRAM → KEGIATAN
            |--------------------------------------------------------------------------
            */

            programSelect.addEventListener('change', function() {

                const programId = this.value;


                /*
                | Reset kegiatan
                */

                kegiatanSelect.innerHTML = `
            <option value="">
                -- Memuat Kegiatan --
            </option>
        `;

                kegiatanSelect.disabled = true;


                /*
                | Reset sub kegiatan
                */

                subKegiatanSelect.innerHTML = `
            <option value="">
                -- Pilih Kegiatan Dahulu --
            </option>
        `;

                subKegiatanSelect.disabled = true;


                /*
                | Jika program dikosongkan
                */

                if (!programId) {

                    kegiatanSelect.innerHTML = `
                <option value="">
                    -- Pilih Program Dahulu --
                </option>
            `;

                    return;
                }


                /*
                | URL Laravel
                */

                const url = `{{ route('sadarin.admin.archive.kegiatan', ':id') }}`
                    .replace(':id', programId);


                /*
                | Request
                */

                fetch(url, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })

                    .then(response => {

                        if (!response.ok) {

                            throw new Error(
                                'Gagal mengambil data kegiatan.'
                            );

                        }

                        return response.json();

                    })

                    .then(data => {


                        /*
                        | Reset option
                        */

                        kegiatanSelect.innerHTML = `
                <option value="">
                    -- Pilih Kegiatan --
                </option>
            `;


                        /*
                        | Isi kegiatan
                        */

                        data.forEach(item => {

                            const option =
                                document.createElement('option');


                            option.value =
                                item.kegiatan_id;


                            option.textContent =
                                item.kegiatan_code ?
                                `${item.kegiatan_code} - ${item.kegiatan_name}` :
                                item.kegiatan_name;


                            kegiatanSelect.appendChild(option);

                        });


                        /*
                        | Aktifkan
                        */

                        kegiatanSelect.disabled = false;

                    })

                    .catch(error => {

                        console.error(error);


                        kegiatanSelect.innerHTML = `
                <option value="">
                    -- Gagal Memuat Kegiatan --
                </option>
            `;

                        kegiatanSelect.disabled = true;

                    });

            });


            /*
            |--------------------------------------------------------------------------
            | KEGIATAN → SUB KEGIATAN
            |--------------------------------------------------------------------------
            */

            kegiatanSelect.addEventListener('change', function() {

                const kegiatanId = this.value;


                /*
                | Reset
                */

                subKegiatanSelect.innerHTML = `
            <option value="">
                -- Memuat Sub Kegiatan --
            </option>
        `;

                subKegiatanSelect.disabled = true;


                /*
                | Jika kosong
                */

                if (!kegiatanId) {

                    subKegiatanSelect.innerHTML = `
                <option value="">
                    -- Pilih Kegiatan Dahulu --
                </option>
            `;

                    return;
                }


                /*
                | URL Laravel
                */

                const url = `{{ route('sadarin.admin.archive.sub-kegiatan', ':id') }}`
                    .replace(':id', kegiatanId);


                /*
                | Request
                */

                fetch(url, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })

                    .then(response => {

                        if (!response.ok) {

                            throw new Error(
                                'Gagal mengambil data sub kegiatan.'
                            );

                        }

                        return response.json();

                    })

                    .then(data => {


                        /*
                        | Reset option
                        */

                        subKegiatanSelect.innerHTML = `
                <option value="">
                    -- Pilih Sub Kegiatan --
                </option>
            `;


                        /*
                        | Isi sub kegiatan
                        */

                        data.forEach(item => {

                            const option =
                                document.createElement('option');


                            option.value =
                                item.sub_kegiatan_id;


                            option.textContent =
                                item.sub_kegiatan_code ?
                                `${item.sub_kegiatan_code} - ${item.sub_kegiatan_name}` :
                                item.sub_kegiatan_name;


                            subKegiatanSelect.appendChild(option);

                        });


                        /*
                        | Aktifkan
                        */

                        subKegiatanSelect.disabled = false;

                    })

                    .catch(error => {

                        console.error(error);


                        subKegiatanSelect.innerHTML = `
                <option value="">
                    -- Gagal Memuat Sub Kegiatan --
                </option>
            `;

                        subKegiatanSelect.disabled = true;

                    });

            });

        });
    </script>
@endpush
