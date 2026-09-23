@extends('Dashboard.layouts.app')

@section('title', 'Tambah Berkas')
@section('page_title', 'Tambah Berkas')
@section('breadcrumb', 'Administrasi Sistem / Arsip / Tambah Berkas')

@section('content')

    <div class="space-y-6">

        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

                <div
                    class="flex h-11 w-11 items-center justify-center
                           rounded-xl bg-emerald-50 text-emerald-600">

                    <i class="bi bi-paperclip text-xl"></i>

                </div>

                <div>

                    <h1 class="text-xl font-bold text-slate-800">
                        Tambah Berkas
                    </h1>

                    <p class="mt-0.5 text-sm text-slate-500">
                        Tambahkan berkas dan tag ke arsip.
                    </p>

                </div>

            </div>


            {{-- KEMBALI --}}

            <a href="{{ route('sadarin.admin.archive.show', $archive->archive_id) }}"
                class="inline-flex items-center justify-center gap-2
                       rounded-xl border border-slate-200 bg-white
                       px-4 py-2.5 text-sm font-semibold
                       text-slate-600 shadow-sm
                       transition hover:bg-slate-50">

                <i class="bi bi-arrow-left"></i>

                Kembali

            </a>

        </div>


        {{-- ========================================================= --}}
        {{-- ERROR --}}
        {{-- ========================================================= --}}

        @if ($errors->any())

            <div class="rounded-xl border border-red-200 bg-red-50
                       px-4 py-3 text-sm text-red-700">

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
        {{-- INFO ARSIP --}}
        {{-- ========================================================= --}}

        <div class="rounded-2xl border border-blue-200 bg-blue-50 px-5 py-4">

            <div class="flex items-start gap-3">

                <div
                    class="flex h-9 w-9 shrink-0 items-center justify-center
                           rounded-lg bg-white text-blue-600 shadow-sm">

                    <i class="bi bi-archive-fill"></i>

                </div>

                <div class="min-w-0">

                    <p class="text-xs font-semibold uppercase tracking-wide text-blue-500">
                        Arsip
                    </p>

                    <p class="mt-1 break-words text-sm font-bold text-blue-800">
                        {{ $archive->archive_title }}
                    </p>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- FORM --}}
        {{-- ========================================================= --}}

        <div class="overflow-hidden rounded-2xl
                    border border-slate-200 bg-white shadow-sm">

            {{-- FORM HEADER --}}

            <div class="border-b border-slate-100 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-9 w-9 items-center justify-center
                               rounded-lg bg-emerald-50
                               text-emerald-600">

                        <i class="bi bi-link-45deg"></i>

                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-slate-800">
                            Informasi Berkas
                        </h2>

                        <p class="text-xs text-slate-400">
                            Masukkan informasi berkas, link Google Drive, dan tag.
                        </p>

                    </div>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- FORM --}}
            {{-- ===================================================== --}}

            <form action="{{ route('sadarin.admin.archive.file.store', $archive->archive_id) }}" method="POST">

                @csrf

                <div class="space-y-5 p-5">


                    {{-- ================================================= --}}
                    {{-- NAMA BERKAS --}}
                    {{-- ================================================= --}}

                    <div>

                        <label for="archive_file_original_name" class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Nama Berkas

                            <span class="text-red-500">*</span>

                        </label>

                        <input type="text" id="archive_file_original_name" name="archive_file_original_name"
                            value="{{ old('archive_file_original_name') }}"
                            placeholder="Contoh: Surat Keputusan Kepala Dinas.pdf" required
                            class="w-full rounded-xl border border-slate-200
                                   bg-slate-50 px-4 py-2.5
                                   text-sm text-slate-700
                                   outline-none transition
                                   focus:border-[oklch(29.3%_0.136_325.661)]
                                   focus:bg-white focus:ring-2
                                   focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                    </div>


                    {{-- ================================================= --}}
                    {{-- GOOGLE DRIVE FILE ID --}}
                    {{-- ================================================= --}}

                    <div>

                        <label for="archive_file_drive_file_id" class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Google Drive File ID

                            <span class="text-red-500">*</span>

                        </label>

                        <input type="text" id="archive_file_drive_file_id" name="archive_file_drive_file_id"
                            value="{{ old('archive_file_drive_file_id') }}"
                            placeholder="Contoh: 1AbCdEfGhIjKlMnOpQrStUvWxYz" required
                            class="w-full rounded-xl border border-slate-200
                                   bg-slate-50 px-4 py-2.5
                                   text-sm text-slate-700
                                   outline-none transition
                                   focus:border-[oklch(29.3%_0.136_325.661)]
                                   focus:bg-white focus:ring-2
                                   focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                        <p class="mt-1.5 text-xs text-slate-400">
                            ID file Google Drive yang digunakan untuk identifikasi berkas.
                        </p>

                    </div>


                    {{-- ================================================= --}}
                    {{-- LINK GOOGLE DRIVE --}}
                    {{-- ================================================= --}}

                    <div>

                        <label for="archive_file_drive_url" class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Link Google Drive

                            <span class="text-red-500">*</span>

                        </label>

                        <input type="url" id="archive_file_drive_url" name="archive_file_drive_url"
                            value="{{ old('archive_file_drive_url') }}" placeholder="https://drive.google.com/file/d/..."
                            required
                            class="w-full rounded-xl border border-slate-200
                                   bg-slate-50 px-4 py-2.5
                                   text-sm text-slate-700
                                   outline-none transition
                                   focus:border-[oklch(29.3%_0.136_325.661)]
                                   focus:bg-white focus:ring-2
                                   focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                        <p class="mt-1.5 text-xs text-slate-400">
                            Link ini yang akan digunakan untuk membuka berkas.
                        </p>

                    </div>


                    {{-- ================================================= --}}
                    {{-- TAG --}}
                    {{-- ================================================= --}}

                    <div>

                        <div class="mb-2">

                            <label class="block text-sm font-semibold text-slate-700">
                                Tag
                            </label>

                            <p class="mt-1 text-xs text-slate-400">
                                Pilih satu atau beberapa tag yang sesuai dengan berkas ini.
                            </p>

                        </div>


                        @if ($tags->count() > 0)

                            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-3">

                                @foreach ($tags as $tag)
                                    <label
                                        class="flex cursor-pointer items-center gap-3
                                               rounded-xl border border-slate-200
                                               bg-slate-50 px-4 py-3
                                               transition hover:border-blue-300
                                               hover:bg-blue-50">

                                        <input type="checkbox" name="tag_ids[]" value="{{ $tag->tag_id }}"
                                            {{ in_array($tag->tag_id, old('tag_ids', [])) ? 'checked' : '' }}
                                            class="h-4 w-4 rounded border-slate-300
                                                   text-blue-600
                                                   focus:ring-blue-500">

                                        <div class="min-w-0">

                                            <p class="truncate text-sm font-semibold text-slate-700">
                                                {{ $tag->tag_name }}
                                            </p>

                                            @if ($tag->tag_description)
                                                <p class="mt-0.5 truncate text-xs text-slate-400">
                                                    {{ $tag->tag_description }}
                                                </p>
                                            @endif

                                        </div>

                                    </label>
                                @endforeach

                            </div>
                        @else
                            <div
                                class="rounded-xl border border-dashed
                                       border-slate-300 bg-slate-50
                                       px-4 py-8 text-center">

                                <div
                                    class="mx-auto flex h-11 w-11
                                           items-center justify-center
                                           rounded-xl bg-white
                                           text-slate-400 shadow-sm">

                                    <i class="bi bi-tags text-xl"></i>

                                </div>

                                <p class="mt-3 text-sm font-semibold text-slate-600">
                                    Belum Ada Tag
                                </p>

                                <p class="mt-1 text-xs text-slate-400">
                                    Belum ada tag aktif yang dapat dipilih.
                                </p>

                            </div>

                        @endif

                    </div>


                    {{-- ================================================= --}}
                    {{-- PRIMARY --}}
                    {{-- ================================================= --}}

                    <div class="rounded-xl border border-slate-200
                               bg-slate-50 p-4">

                        <label class="flex cursor-pointer items-start gap-3">

                            <input type="checkbox" name="archive_file_is_primary" value="1"
                                {{ old('archive_file_is_primary') ? 'checked' : '' }}
                                class="mt-0.5 h-4 w-4 rounded
                                       border-slate-300 text-blue-600
                                       focus:ring-blue-500">

                            <div>

                                <p class="text-sm font-semibold text-slate-700">
                                    Jadikan berkas utama
                                </p>

                                <p class="mt-1 text-xs leading-5 text-slate-400">
                                    Jika dipilih, berkas utama sebelumnya pada arsip ini
                                    akan otomatis menjadi bukan berkas utama.
                                </p>

                            </div>

                        </label>

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- FOOTER --}}
                {{-- ===================================================== --}}

                <div
                    class="flex flex-col-reverse gap-3
                           border-t border-slate-100
                           bg-slate-50 px-5 py-4
                           sm:flex-row sm:justify-end">

                    {{-- BATAL --}}

                    <a href="{{ route('sadarin.admin.archive.show', $archive->archive_id) }}"
                        class="inline-flex items-center justify-center
                               gap-2 rounded-xl
                               border border-slate-200 bg-white
                               px-5 py-2.5 text-sm font-semibold
                               text-slate-600
                               transition hover:bg-slate-50">

                        <i class="bi bi-x-lg"></i>

                        Batal

                    </a>


                    {{-- SIMPAN --}}

                    <button type="submit"
                        class="inline-flex items-center justify-center
                               gap-2 rounded-xl
                               bg-[oklch(29.3%_0.136_325.661)]
                               px-5 py-2.5 text-sm font-semibold
                               text-white shadow-sm
                               transition hover:opacity-90">

                        <i class="bi bi-check-lg"></i>

                        Simpan Berkas

                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection
