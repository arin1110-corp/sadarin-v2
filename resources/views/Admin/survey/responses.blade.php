@extends('Dashboard.layouts.app')

@section('title', 'Response Survey')
@section('page_title', 'Response Survey')
@section('breadcrumb', 'Administrasi Sistem / Survey / Response')

@section('content')

    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                    <i class="bi bi-chat-square-text-fill text-xl"></i>
                </div>

                <div>

                    <h1 class="text-xl font-bold text-slate-800">
                        Response Survey
                    </h1>

                    <p class="mt-0.5 text-sm text-slate-500">
                        {{ $survey->survey_title }}
                    </p>

                </div>

            </div>


            <a href="{{ route('sadarin.admin.survey.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl
                       border border-slate-200 bg-white px-4 py-2.5
                       text-sm font-semibold text-slate-600 shadow-sm
                       transition hover:bg-slate-50">

                <i class="bi bi-arrow-left"></i>

                Kembali

            </a>

        </div>


        {{-- SUMMARY --}}
        @php

            $totalResponse = $responses->total();

            $ratings = $responses->getCollection()->pluck('survey_response_rating')->filter();

            $averageRating = $ratings->count() ? round($ratings->avg(), 1) : 0;

        @endphp


        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

            {{-- TOTAL --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl
                               bg-blue-50 text-blue-600">

                        <i class="bi bi-people-fill text-lg"></i>

                    </div>

                    <div>

                        <div class="text-xs font-medium text-slate-400">
                            Total Response
                        </div>

                        <div class="text-2xl font-bold text-slate-800">
                            {{ $totalResponse }}
                        </div>

                    </div>

                </div>

            </div>


            {{-- RATING --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl
                               bg-amber-50 text-amber-600">

                        <i class="bi bi-star-fill text-lg"></i>

                    </div>

                    <div>

                        <div class="text-xs font-medium text-slate-400">
                            Rating Rata-rata
                        </div>

                        <div class="flex items-center gap-2">

                            <span class="text-2xl font-bold text-slate-800">
                                {{ $averageRating }}
                            </span>

                            <span class="text-sm text-slate-400">
                                / 5
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- SURVEY --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl
                               bg-emerald-50 text-emerald-600">

                        <i class="bi bi-clipboard-check-fill text-lg"></i>

                    </div>

                    <div class="min-w-0">

                        <div class="text-xs font-medium text-slate-400">
                            Survey
                        </div>

                        <div class="truncate text-sm font-semibold text-slate-700">
                            {{ $survey->survey_title }}
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="overflow-x-auto">

                <table class="min-w-[1000px] w-full">

                    <thead class="border-b border-slate-100 bg-slate-50">

                        <tr>

                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Waktu
                            </th>

                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Pengguna
                            </th>

                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Rating
                            </th>

                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Pesan
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse ($responses as $response)

                            <tr class="transition hover:bg-slate-50">

                                {{-- WAKTU --}}
                                <td class="whitespace-nowrap px-5 py-4">

                                    <div class="text-sm font-medium text-slate-700">

                                        {{ $response->survey_response_created_at ? $response->survey_response_created_at->format('d M Y') : '-' }}

                                    </div>

                                    <div class="mt-0.5 text-xs text-slate-400">

                                        {{ $response->survey_response_created_at ? $response->survey_response_created_at->format('H:i:s') : '-' }}

                                    </div>

                                </td>


                                {{-- PENGGUNA --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-9 w-9 shrink-0 items-center justify-center
                                                   rounded-xl bg-slate-100 text-slate-500">

                                            <i class="bi bi-person-fill"></i>

                                        </div>

                                        <div>

                                            @if ($response->survey_response_samperin_user_id)
                                                <div class="text-sm font-semibold text-slate-700">
                                                    {{ $response->user_name ?? 'Nama tidak ditemukan' }}
                                                </div>

                                                @if (!empty($response->user_nip))
                                                    <div class="mt-0.5 text-xs text-slate-400">
                                                        {{ $response->user_nip }}
                                                    </div>
                                                @else
                                                    <div class="mt-0.5 text-xs text-slate-400">
                                                        Pengguna Internal
                                                    </div>
                                                @endif
                                            @elseif ($response->survey_response_guestbook_id)
                                                <div class="text-sm font-semibold text-slate-700">
                                                    Guestbook #{{ $response->survey_response_guestbook_id }}
                                                </div>

                                                <div class="text-xs text-slate-400">
                                                    Guest
                                                </div>
                                            @else
                                                <div class="text-sm font-semibold text-slate-700">
                                                    Anonymous
                                                </div>
                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- RATING --}}
                                <td class="px-5 py-4">

                                    @if ($response->survey_response_rating)
                                        <div class="flex items-center gap-1">

                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="bi bi-star-fill text-sm
                                                    {{ $i <= $response->survey_response_rating ? 'text-amber-400' : 'text-slate-200' }}">
                                                </i>
                                            @endfor

                                            <span class="ml-2 text-sm font-semibold text-slate-600">
                                                {{ $response->survey_response_rating }}/5
                                            </span>

                                        </div>
                                    @else
                                        <span class="text-xs text-slate-400">
                                            Tidak memberikan rating
                                        </span>
                                    @endif

                                </td>


                                {{-- MESSAGE --}}
                                <td class="px-5 py-4">

                                    @if ($response->survey_response_message)
                                        <div class="max-w-[450px] text-sm leading-6 text-slate-600">

                                            {{ $response->survey_response_message }}

                                        </div>
                                    @else
                                        <span class="text-xs text-slate-400">
                                            Tidak ada pesan
                                        </span>
                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="px-5 py-16 text-center">

                                    <div
                                        class="mx-auto flex h-14 w-14 items-center justify-center
                                               rounded-2xl bg-slate-100 text-slate-400">

                                        <i class="bi bi-chat-square-text text-2xl"></i>

                                    </div>

                                    <div class="mt-4 text-sm font-semibold text-slate-700">
                                        Belum ada response
                                    </div>

                                    <p class="mt-1 text-xs text-slate-400">
                                        Belum ada pengguna yang mengisi survey ini.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            @if ($responses->hasPages())
                <div class="flex justify-center border-t border-slate-100 px-5 py-4">

                    {{ $responses->links() }}

                </div>
            @endif

        </div>

    </div>

@endsection
