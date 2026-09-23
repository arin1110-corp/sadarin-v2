@extends('Dashboard.layouts.app')

@section('title', 'Kepuasan Pengguna')
@section('page_title', 'Kepuasan Pengguna')
@section('breadcrumb', 'Administrasi Sistem / Kepuasan Pengguna')

@section('content')

    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                    <i class="bi bi-star-fill text-xl"></i>
                </div>

                <div>

                    <h1 class="text-xl font-bold text-slate-800">
                        Kepuasan Pengguna
                    </h1>

                    <p class="mt-0.5 text-sm text-slate-500">
                        Kelola survey kepuasan pengguna SADARIN
                    </p>

                </div>

            </div>

            <a href="{{ route('sadarin.admin.survey.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[oklch(29.3%_0.136_325.661)] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:opacity-90">

                <i class="bi bi-plus-lg"></i>

                Buat Survey

            </a>

        </div>


        {{-- SUCCESS --}}
        @if (session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3">

                <div class="flex items-center gap-3 text-sm text-emerald-700">

                    <i class="bi bi-check-circle-fill"></i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            </div>
        @endif


        {{-- SEARCH --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <form method="GET" action="{{ route('sadarin.admin.survey.index') }}" class="flex flex-col gap-3 sm:flex-row">

                <div class="relative flex-1">

                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari survey..."
                        class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-sm text-slate-700 outline-none transition focus:border-[oklch(29.3%_0.136_325.661)] focus:ring-2 focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                </div>

                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[oklch(29.3%_0.136_325.661)] px-5 py-2.5 text-sm font-semibold text-white">

                    <i class="bi bi-search"></i>

                    Cari

                </button>

            </form>

        </div>


        {{-- TABLE --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="overflow-x-auto">

                <table class="min-w-[900px] w-full">

                    <thead class="border-b border-slate-100 bg-slate-50">

                        <tr>

                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Survey
                            </th>

                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Periode
                            </th>

                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Status
                            </th>

                            <th class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse ($surveys as $survey)
                            <tr class="transition hover:bg-slate-50">

                                {{-- SURVEY --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-start gap-3">

                                        <div
                                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600">

                                            <i class="bi bi-star-fill"></i>

                                        </div>

                                        <div class="min-w-0">

                                            <div class="text-sm font-semibold text-slate-700">
                                                {{ $survey->survey_title }}
                                            </div>

                                            @if ($survey->survey_description)
                                                <div class="mt-1 max-w-[450px] truncate text-xs text-slate-400">

                                                    {{ $survey->survey_description }}

                                                </div>
                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- PERIODE --}}
                                <td class="px-5 py-4">

                                    <div class="text-xs text-slate-600">

                                        @if ($survey->survey_started_at)
                                            {{ $survey->survey_started_at->format('d M Y H:i') }}
                                        @else
                                            Tidak dibatasi
                                        @endif

                                    </div>

                                    <div class="mt-1 text-xs text-slate-400">

                                        s/d

                                        @if ($survey->survey_ended_at)
                                            {{ $survey->survey_ended_at->format('d M Y H:i') }}
                                        @else
                                            Tidak dibatasi
                                        @endif

                                    </div>

                                </td>


                                {{-- STATUS --}}
                                <td class="px-5 py-4">

                                    @if ($survey->survey_is_active)
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-50 px-2.5 py-1.5 text-xs font-semibold text-emerald-600">

                                            <i class="bi bi-check-circle-fill"></i>

                                            Aktif

                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-lg bg-slate-100 px-2.5 py-1.5 text-xs font-semibold text-slate-500">

                                            <i class="bi bi-pause-circle-fill"></i>

                                            Nonaktif

                                        </span>
                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td class="px-5 py-4">

                                    <div class="flex justify-end gap-2">

                                        <a href="{{ route('sadarin.admin.survey.edit', $survey) }}"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-amber-600 transition hover:bg-amber-100"
                                            title="Edit">

                                            <i class="bi bi-pencil-fill"></i>

                                        </a>


                                        <form method="POST" action="{{ route('sadarin.admin.survey.destroy', $survey) }}"
                                            onsubmit="return confirm('Hapus survey ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-red-600 transition hover:bg-red-100"
                                                title="Hapus">

                                                <i class="bi bi-trash-fill"></i>

                                            </button>

                                        </form>

                                        <a href="{{ route('sadarin.admin.survey.responses', $survey->survey_id) }}"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg
           bg-amber-50 text-amber-600
           transition hover:bg-amber-100"
                                            title="Lihat Response">

                                            <i class="bi bi-chat-square-text-fill"></i>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="px-5 py-16 text-center">

                                    <div
                                        class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                                        <i class="bi bi-star text-2xl"></i>

                                    </div>

                                    <div class="mt-4 text-sm font-semibold text-slate-700">
                                        Belum ada survey
                                    </div>

                                    <p class="mt-1 text-xs text-slate-400">
                                        Silakan buat survey kepuasan pertama.
                                    </p>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            @if ($surveys->hasPages())
                <div class="flex justify-center border-t border-slate-100 px-5 py-4">

                    {{ $surveys->links() }}

                </div>
            @endif

        </div>

    </div>

@endsection
