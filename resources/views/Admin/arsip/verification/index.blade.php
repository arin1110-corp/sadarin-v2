@extends('Dashboard.layouts.app')

@section('title', 'Verifikasi Arsip')
@section('page_title', 'Verifikasi Arsip')
@section('breadcrumb', 'Administrasi Sistem / Arsip / Verifikasi')

@section('content')

    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                        <i class="bi bi-shield-check text-xl"></i>
                    </div>

                    <div>
                        <h1 class="text-xl font-bold text-slate-800">
                            Verifikasi Arsip
                        </h1>

                        <p class="mt-0.5 text-sm text-slate-500">
                            Periksa dan verifikasi arsip yang menunggu pemeriksaan.
                        </p>
                    </div>

                </div>
            </div>

            {{-- TOTAL --}}
            <div class="flex items-center gap-2 rounded-xl border border-amber-200 bg-amber-50 px-4 py-2.5">

                <i class="bi bi-hourglass-split text-amber-600"></i>

                <span class="text-sm font-semibold text-amber-700">
                    {{ $archives->total() }} Menunggu Verifikasi
                </span>

            </div>

        </div>


        {{-- SUCCESS --}}
        @if (session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3">

                <div class="flex items-center gap-2 text-sm font-semibold text-emerald-700">

                    <i class="bi bi-check-circle-fill"></i>

                    {{ session('success') }}

                </div>

            </div>
        @endif


        {{-- ERROR --}}
        @if (session('error'))
            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3">

                <div class="flex items-center gap-2 text-sm font-semibold text-red-700">

                    <i class="bi bi-exclamation-circle-fill"></i>

                    {{ session('error') }}

                </div>

            </div>
        @endif


        {{-- SEARCH --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

            <form action="{{ route('sadarin.admin.archive.verification') }}" method="GET">

                <div class="relative">

                    <i class="bi bi-search pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                    <input type="text" name="search" value="{{ $search }}"
                        placeholder="Cari judul atau deskripsi arsip..."
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-amber-300 focus:bg-white focus:ring-4 focus:ring-amber-500/10">

                </div>

            </form>

        </div>


        {{-- LIST --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- TABLE HEADER --}}
            <div class="border-b border-slate-100 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-amber-600">
                        <i class="bi bi-files"></i>
                    </div>

                    <div>
                        <h2 class="text-sm font-bold text-slate-800">
                            Arsip Menunggu Verifikasi
                        </h2>

                        <p class="text-xs text-slate-400">
                            Daftar arsip yang perlu diperiksa oleh administrator.
                        </p>
                    </div>

                </div>

            </div>


            @if ($archives->count() > 0)

                <div class="divide-y divide-slate-100">

                    @foreach ($archives as $archive)
                        <div class="p-5 transition hover:bg-slate-50/70">

                            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                                {{-- INFO --}}
                                <div class="min-w-0 flex-1">

                                    <div class="flex items-start gap-3">

                                        <div
                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                                            <i class="bi bi-file-earmark-text-fill"></i>
                                        </div>

                                        <div class="min-w-0">

                                            <h3 class="line-clamp-2 text-sm font-bold text-slate-800">
                                                {{ $archive->archive_title }}
                                            </h3>

                                            <div
                                                class="mt-1.5 flex flex-wrap items-center gap-x-2 gap-y-1 text-xs text-slate-400">

                                                @if ($archive->documentType)
                                                    <span class="inline-flex items-center gap-1">
                                                        <i class="bi bi-file-earmark-text"></i>
                                                        {{ $archive->documentType->document_type_name }}
                                                    </span>
                                                @endif

                                                @if ($archive->archive_year)
                                                    <span>•</span>

                                                    <span>
                                                        {{ $archive->archive_year }}
                                                    </span>
                                                @endif

                                            </div>

                                        </div>

                                    </div>


                                    {{-- CLASSIFICATION --}}
                                    <div class="mt-4 flex flex-wrap gap-2">

                                        @if ($archive->unit)
                                            <span
                                                class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-2.5 py-1.5 text-[11px] font-medium text-blue-700">
                                                <i class="bi bi-building"></i>
                                                {{ $archive->unit->unit_name }}
                                            </span>
                                        @endif


                                        @if ($archive->subKegiatan?->kegiatan?->program)
                                            <span
                                                class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-50 px-2.5 py-1.5 text-[11px] font-medium text-emerald-700">
                                                <i class="bi bi-diagram-3"></i>
                                                {{ $archive->subKegiatan->kegiatan->program->program_name }}
                                            </span>
                                        @endif


                                        @if ($archive->subKegiatan?->kegiatan)
                                            <span
                                                class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-50 px-2.5 py-1.5 text-[11px] font-medium text-indigo-700">
                                                <i class="bi bi-diagram-2"></i>
                                                {{ $archive->subKegiatan->kegiatan->kegiatan_name }}
                                            </span>
                                        @endif

                                    </div>


                                    {{-- DATE --}}
                                    <div class="mt-3 flex items-center gap-1.5 text-xs text-slate-400">

                                        <i class="bi bi-clock"></i>

                                        Diajukan
                                        {{ $archive->archive_created_at
                                            ? \Carbon\Carbon::parse($archive->archive_created_at)->translatedFormat('d F Y H:i')
                                            : '-' }}

                                    </div>

                                </div>


                                {{-- ACTION --}}
                                <div class="flex shrink-0 items-center gap-2">

                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-3 py-1.5 text-[11px] font-bold text-amber-700">

                                        <i class="bi bi-hourglass-split"></i>

                                        Menunggu

                                    </span>


                                    <a href="{{ route('sadarin.admin.archive.verify', $archive->archive_id) }}"
                                        class="inline-flex items-center gap-2 rounded-xl bg-[oklch(29.3%_0.136_325.661)] px-4 py-2.5 text-xs font-semibold text-white shadow-sm transition hover:opacity-90">

                                        <i class="bi bi-shield-check"></i>

                                        Periksa

                                    </a>

                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>


                {{-- PAGINATION --}}
                <div class="border-t border-slate-100 px-5 py-4">

                    {{ $archives->withQueryString()->links() }}

                </div>
            @else
                {{-- EMPTY --}}
                <div class="px-5 py-16 text-center">

                    <div
                        class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-500">

                        <i class="bi bi-check2-circle text-3xl"></i>

                    </div>

                    <h2 class="mt-5 text-base font-bold text-slate-800">
                        Tidak Ada Arsip Menunggu
                    </h2>

                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-400">
                        Semua arsip sudah selesai diproses atau belum ada pengajuan baru.
                    </p>

                </div>

            @endif

        </div>

    </div>

@endsection
