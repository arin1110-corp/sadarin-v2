@extends('UserPage.layouts.app')

@section('title', $archive->archive_title . ' - SADARIN')

@section('content')

    <div class="min-h-screen bg-slate-50">

        <div class="mx-auto max-w-7xl px-5 py-8 sm:px-8">

            {{-- BACK --}}

            <a href="{{ route('sadarin.user.dashboard') }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-sadarin-600 transition hover:text-sadarin-800">

                <i class="bi bi-arrow-left"></i>

                Kembali ke Arsip

            </a>


            {{-- HEADER --}}

            <div class="mt-5 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="flex flex-col gap-5 md:flex-row md:items-start md:justify-between">

                    <div class="min-w-0">

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-sadarin-50 text-sadarin-600">

                            <i class="bi bi-archive text-xl"></i>

                        </div>


                        <h1 class="mt-5 text-2xl font-bold tracking-tight text-slate-800 sm:text-3xl">
                            {{ $archive->archive_title }}
                        </h1>


                        @if ($archive->archive_description)
                            <p class="mt-3 max-w-3xl text-sm leading-6 text-slate-500">
                                {{ $archive->archive_description }}
                            </p>
                        @endif

                    </div>


                    @if ($archive->archive_is_public)
                        <span
                            class="inline-flex w-fit shrink-0 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-600">
                            Publik
                        </span>
                    @else
                        <span
                            class="inline-flex w-fit shrink-0 rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-500">
                            Internal
                        </span>
                    @endif

                </div>


                {{-- METADATA --}}

                <div class="mt-7 grid gap-4 border-t border-slate-100 pt-6 sm:grid-cols-2 lg:grid-cols-3">

                    @if ($archive->unit)
                        <div>

                            <p class="text-xs text-slate-400">
                                Unit
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-700">
                                {{ $archive->unit->unit_name }}
                            </p>

                        </div>
                    @endif


                    @if ($archive->documentType)
                        <div>

                            <p class="text-xs text-slate-400">
                                Jenis Dokumen
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-700">
                                {{ $archive->documentType->document_type_name }}
                            </p>

                        </div>
                    @endif


                    @if ($archive->archive_year)
                        <div>

                            <p class="text-xs text-slate-400">
                                Tahun
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-700">
                                {{ $archive->archive_year }}
                            </p>

                        </div>
                    @endif


                    @if ($archive->program)
                        <div>

                            <p class="text-xs text-slate-400">
                                Program
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-700">
                                {{ $archive->program->program_name }}
                            </p>

                        </div>
                    @endif


                    @if ($archive->kegiatan)
                        <div>

                            <p class="text-xs text-slate-400">
                                Kegiatan
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-700">
                                {{ $archive->kegiatan->kegiatan_name }}
                            </p>

                        </div>
                    @endif


                    @if ($archive->subKegiatan)
                        <div>

                            <p class="text-xs text-slate-400">
                                Sub Kegiatan
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-700">
                                {{ $archive->subKegiatan->sub_kegiatan_name }}
                            </p>

                        </div>
                    @endif

                </div>

            </div>


            {{-- ========================================================
                BERKAS
            ========================================================= --}}

            <div class="mt-6">

                <div class="flex items-end justify-between gap-4">

                    <div>

                        <h2 class="text-lg font-semibold text-slate-800">
                            Berkas Arsip
                        </h2>

                        <p class="mt-1 text-sm text-slate-400">
                            Berkas tersedia melalui Google Drive.
                        </p>

                    </div>


                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-500">
                        {{ $archive->files->count() }} berkas
                    </span>

                </div>


                <div class="mt-4 space-y-3">

                    @forelse ($archive->files as $file)

                        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center">

                                {{-- ICON --}}

                                <div
                                    class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600">

                                    <i class="bi bi-google text-xl"></i>

                                </div>


                                {{-- INFO --}}

                                <div class="min-w-0 flex-1">

                                    <h3 class="truncate text-sm font-semibold text-slate-800">
                                        {{ $file->archive_file_name }}
                                    </h3>


                                    @if ($file->archive_file_description)
                                        <p class="mt-1 text-xs leading-5 text-slate-400">
                                            {{ $file->archive_file_description }}
                                        </p>
                                    @endif


                                    {{-- TAG FILE --}}

                                    @if ($file->tags->count())
                                        <div class="mt-3 flex flex-wrap gap-1.5">

                                            @foreach ($file->tags as $tag)
                                                <span
                                                    class="rounded-full bg-slate-100 px-2.5 py-1 text-[11px] text-slate-500">
                                                    #{{ $tag->tag_name }}
                                                </span>
                                            @endforeach

                                        </div>
                                    @endif

                                </div>


                                {{-- DRIVE BUTTON --}}

                                @if ($file->archive_file_drive_url)
                                    <a href="{{ $file->archive_file_drive_url }}" target="_blank" rel="noopener noreferrer"
                                        class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-sadarin-700 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-sadarin-800">

                                        <i class="bi bi-box-arrow-up-right"></i>

                                        Buka Google Drive

                                    </a>
                                @else
                                    <span
                                        class="inline-flex shrink-0 items-center gap-2 rounded-xl bg-slate-100 px-4 py-2.5 text-sm font-medium text-slate-400">

                                        <i class="bi bi-link-45deg"></i>

                                        Link belum tersedia

                                    </span>
                                @endif

                            </div>

                        </div>

                    @empty

                        <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center">

                            <i class="bi bi-folder-x text-3xl text-slate-300">
                            </i>


                            <h3 class="mt-3 font-semibold text-slate-700">
                                Belum ada berkas
                            </h3>


                            <p class="mt-1 text-sm text-slate-400">
                                Belum ada berkas Google Drive yang ditambahkan
                                ke arsip ini.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

@endsection
