@extends('Dashboard.layouts.app')

@section('title', 'Tambah Berkas')
@section('page_title', 'Tambah Berkas')
@section('breadcrumb', 'Administrasi Sistem / Arsip / Tambah Berkas')

@section('content')

    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex items-center justify-between">

            <div>
                <h1 class="text-xl font-bold text-slate-800">
                    Tambah Berkas
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Tambahkan tautan berkas untuk arsip:
                    <span class="font-semibold">
                        {{ $archive->archive_title }}
                    </span>
                </p>
            </div>

            <a href="{{ route('sadarin.admin.archive.show', $archive) }}"
                class="inline-flex items-center gap-2 rounded-xl border
                       border-slate-200 bg-white px-4 py-2.5
                       text-sm font-semibold text-slate-600
                       hover:bg-slate-50">

                <i class="bi bi-arrow-left"></i>

                Kembali

            </a>

        </div>


        {{-- ERROR --}}
        @if ($errors->any())

            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3">

                <div class="font-semibold text-red-700">
                    Terdapat kesalahan.
                </div>

                <ul class="mt-2 list-inside list-disc text-sm text-red-600">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        {{-- FORM --}}
        <form action="{{ route('sadarin.admin.archive.file.store', $archive) }}" method="POST"
            class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            @csrf

            <div class="border-b border-slate-100 px-5 py-4">

                <h2 class="text-sm font-bold text-slate-800">
                    Informasi Berkas
                </h2>

                <p class="mt-1 text-xs text-slate-400">
                    Berkas disimpan sebagai tautan Google Drive.
                </p>

            </div>


            <div class="space-y-5 p-5">

                {{-- NAMA --}}
                <div>

                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">

                        Nama Berkas

                        <span class="text-red-500">*</span>

                    </label>

                    <input type="text" name="archive_file_original_name" value="{{ old('archive_file_original_name') }}"
                        required maxlength="255" placeholder="Contoh: Surat Keputusan Kepala Dinas.pdf"
                        class="w-full rounded-xl border border-slate-200
                               px-4 py-2.5 text-sm outline-none
                               focus:border-blue-500 focus:ring-2
                               focus:ring-blue-500/10">

                </div>


                {{-- FILE ID --}}
                <div>

                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">

                        Google Drive File ID

                        <span class="text-red-500">*</span>

                    </label>

                    <input type="text" name="archive_file_drive_file_id" value="{{ old('archive_file_drive_file_id') }}"
                        required maxlength="255" placeholder="Contoh: 1AbCdEfGhIjKlMnOp"
                        class="w-full rounded-xl border border-slate-200
                               px-4 py-2.5 text-sm outline-none
                               focus:border-blue-500 focus:ring-2
                               focus:ring-blue-500/10">

                    <p class="mt-1.5 text-xs text-slate-400">
                        ID file dapat diambil dari URL Google Drive.
                    </p>

                </div>


                {{-- URL --}}
                <div>

                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">

                        Link Google Drive

                        <span class="text-red-500">*</span>

                    </label>

                    <input type="url" name="archive_file_drive_url" value="{{ old('archive_file_drive_url') }}" required
                        placeholder="https://drive.google.com/file/d/..."
                        class="w-full rounded-xl border border-slate-200
                               px-4 py-2.5 text-sm outline-none
                               focus:border-blue-500 focus:ring-2
                               focus:ring-blue-500/10">

                </div>


                {{-- PRIMARY --}}
                <label class="flex cursor-pointer items-center gap-3">

                    <input type="checkbox" name="archive_file_is_primary" value="1"
                        class="h-4 w-4 rounded border-slate-300">

                    <div>

                        <div class="text-sm font-semibold text-slate-700">
                            Jadikan berkas utama
                        </div>

                        <div class="text-xs text-slate-400">
                            Berkas utama akan ditampilkan sebagai berkas utama arsip.
                        </div>

                    </div>

                </label>

            </div>


            {{-- ACTION --}}
            <div class="flex justify-end gap-3 border-t border-slate-100
                        bg-slate-50 px-5 py-4">

                <a href="{{ route('sadarin.admin.archive.show', $archive) }}"
                    class="rounded-xl border border-slate-200 bg-white
                           px-5 py-2.5 text-sm font-semibold text-slate-600
                           hover:bg-slate-50">

                    Batal

                </a>

                <button type="submit"
                    class="rounded-xl bg-[oklch(29.3%_0.136_325.661)]
                           px-5 py-2.5 text-sm font-semibold text-white
                           hover:opacity-90">

                    <i class="bi bi-check-lg mr-1"></i>

                    Simpan Berkas

                </button>

            </div>

        </form>

    </div>

@endsection
