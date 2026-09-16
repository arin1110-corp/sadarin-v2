@extends('Dashboard.layouts.app')

@section('title', 'Access Log')
@section('page_title', 'Access Log')
@section('breadcrumb', 'Administrasi Sistem / Access Log')

@section('content')

    <div class="space-y-6">

        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                    <i class="bi bi-activity text-xl"></i>
                </div>

                <div>

                    <h1 class="text-xl font-bold text-slate-800">
                        Access Log
                    </h1>

                    <p class="mt-0.5 text-sm text-slate-500">
                        Riwayat aktivitas pengguna pada sistem SADARIN
                    </p>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- INFO --}}
        {{-- ========================================================= --}}

        <div class="rounded-xl border border-blue-200 bg-blue-50 px-4 py-3">

            <div class="flex items-start gap-3 text-sm text-blue-700">

                <i class="bi bi-info-circle-fill mt-0.5"></i>

                <div>

                    <div class="font-semibold">
                        Log aktivitas bersifat read-only
                    </div>

                    <p class="mt-0.5 text-xs leading-5">
                        Data aktivitas dicatat otomatis oleh sistem dan tidak dapat
                        diubah secara manual.
                    </p>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- FILTER --}}
        {{-- ========================================================= --}}

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <form method="GET" action="{{ route('sadarin.admin.access-log.index') }}"
                class="grid grid-cols-1 gap-3 lg:grid-cols-12">

                {{-- SEARCH --}}
                <div class="relative lg:col-span-4">

                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                    <input type="text" name="search" value="{{ $search }}"
                        placeholder="Cari aktivitas, ID pengguna, objek, IP..."
                        class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-sm text-slate-700 outline-none transition focus:border-[oklch(29.3%_0.136_325.661)] focus:ring-2 focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                </div>


                {{-- ACTION --}}
                <div class="lg:col-span-3">

                    <select name="action"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-600 outline-none transition focus:border-[oklch(29.3%_0.136_325.661)] focus:ring-2 focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                        <option value="">
                            Semua Aktivitas
                        </option>

                        @foreach ($actions as $item)
                            <option value="{{ $item }}" @selected($action === $item)>
                                {{ ucwords(str_replace(['.', '_', '-'], ' ', $item)) }}
                            </option>
                        @endforeach

                    </select>

                </div>


                {{-- USER TYPE --}}
                <div class="lg:col-span-2">

                    <select name="user_type"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-600 outline-none transition focus:border-[oklch(29.3%_0.136_325.661)] focus:ring-2 focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                        <option value="">
                            Semua Pengguna
                        </option>

                        @foreach ($userTypes as $value => $label)
                            <option value="{{ $value }}" @selected($userType === $value)>
                                {{ $label }}
                            </option>
                        @endforeach

                    </select>

                </div>


                {{-- OBJECT TYPE --}}
                <div class="lg:col-span-2">

                    <select name="object_type"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-600 outline-none transition focus:border-[oklch(29.3%_0.136_325.661)] focus:ring-2 focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                        <option value="">
                            Semua Objek
                        </option>

                        @foreach ($objectTypes as $value => $label)
                            <option value="{{ $value }}" @selected($objectType === $value)>
                                {{ $label }}
                            </option>
                        @endforeach

                    </select>

                </div>


                {{-- BUTTON --}}
                <div class="lg:col-span-1">

                    <button type="submit"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[oklch(29.3%_0.136_325.661)] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:opacity-90">

                        <i class="bi bi-funnel-fill"></i>

                        <span class="hidden xl:inline">
                            Filter
                        </span>

                    </button>

                </div>

            </form>

        </div>


        {{-- ========================================================= --}}
        {{-- TABLE --}}
        {{-- ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="overflow-x-auto">

                <table class="min-w-[1100px] w-full">

                    {{-- ================================================= --}}
                    {{-- TABLE HEADER --}}
                    {{-- ================================================= --}}

                    <thead class="border-b border-slate-100 bg-slate-50">

                        <tr>

                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Waktu
                            </th>

                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Pengguna
                            </th>

                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Aktivitas
                            </th>

                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Objek
                            </th>

                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                IP Address
                            </th>

                        </tr>

                    </thead>


                    {{-- ================================================= --}}
                    {{-- TABLE BODY --}}
                    {{-- ================================================= --}}

                    <tbody class="divide-y divide-slate-100">

                        @forelse ($logs as $log)
                            @php

                                /*
                                |--------------------------------------------------------------------------
                                | ACTION
                                |--------------------------------------------------------------------------
                                */

                                $actionName = strtolower(
                                    str_replace(['.', '_', '-'], ' ', $log->access_log_action ?? ''),
                                );

                                /*
                                |--------------------------------------------------------------------------
                                | ACTION ICON & COLOR
                                |--------------------------------------------------------------------------
                                */

                                if (str_contains($actionName, 'login')) {
                                    $actionIcon = 'bi-box-arrow-in-right';
                                    $actionClass = 'bg-emerald-50 text-emerald-600';
                                } elseif (str_contains($actionName, 'logout')) {
                                    $actionIcon = 'bi-box-arrow-right';
                                    $actionClass = 'bg-slate-100 text-slate-600';
                                } elseif (str_contains($actionName, 'delete')) {
                                    $actionIcon = 'bi-trash-fill';
                                    $actionClass = 'bg-red-50 text-red-600';
                                } elseif (str_contains($actionName, 'create') || str_contains($actionName, 'upload')) {
                                    $actionIcon = 'bi-plus-circle-fill';
                                    $actionClass = 'bg-blue-50 text-blue-600';
                                } elseif (str_contains($actionName, 'update') || str_contains($actionName, 'edit')) {
                                    $actionIcon = 'bi-pencil-fill';
                                    $actionClass = 'bg-amber-50 text-amber-600';
                                } elseif (str_contains($actionName, 'verify')) {
                                    $actionIcon = 'bi-check-circle-fill';
                                    $actionClass = 'bg-indigo-50 text-indigo-600';
                                } elseif (str_contains($actionName, 'download')) {
                                    $actionIcon = 'bi-download';
                                    $actionClass = 'bg-cyan-50 text-cyan-600';
                                } elseif (str_contains($actionName, 'search')) {
                                    $actionIcon = 'bi-search';
                                    $actionClass = 'bg-violet-50 text-violet-600';
                                } elseif (str_contains($actionName, 'role')) {
                                    $actionIcon = 'bi-person-gear';
                                    $actionClass = 'bg-orange-50 text-orange-600';
                                } elseif (str_contains($actionName, 'permission')) {
                                    $actionIcon = 'bi-key-fill';
                                    $actionClass = 'bg-indigo-50 text-indigo-600';
                                } else {
                                    $actionIcon = 'bi-activity';
                                    $actionClass = 'bg-slate-100 text-slate-600';
                                }

                                /*
                                |--------------------------------------------------------------------------
                                | USER TYPE
                                |--------------------------------------------------------------------------
                                */

                                $userTypeLabel = match ($log->access_log_user_type) {
                                    'admin' => 'Administrator',

                                    'arsiparis' => 'Arsiparis',

                                    'user' => 'Pengguna Internal',

                                    'guest' => 'Guest',

                                    default => ucfirst($log->access_log_user_type ?? '-'),
                                };

                                /*
                                |--------------------------------------------------------------------------
                                | OBJECT
                                |--------------------------------------------------------------------------
                                */

                                $objectType = $log->access_log_object_type;
                                $objectId = $log->access_log_object_id;

                                /*
                                |--------------------------------------------------------------------------
                                | OBJECT LABEL
                                |--------------------------------------------------------------------------
                                */

                                $objectLabels = [
                                    'role' => 'Role',

                                    'permission' => 'Permission',

                                    'unit' => 'Unit',

                                    'program' => 'Program',

                                    'kegiatan' => 'Kegiatan',

                                    'sub_kegiatan' => 'Sub Kegiatan',

                                    'document_type' => 'Jenis Dokumen',

                                    'tag' => 'Tag',

                                    'user' => 'Pengguna',

                                    'archive' => 'Arsip',

                                    'guestbook' => 'Guestbook',
                                ];

                                $objectLabel =
                                    $objectLabels[$objectType] ?? ucfirst(str_replace('_', ' ', $objectType ?? ''));

                                /*
                                |--------------------------------------------------------------------------
                                | OBJECT ICON & COLOR
                                |--------------------------------------------------------------------------
                                */

                                $objectIconMap = [
                                    'role' => [
                                        'icon' => 'bi-person-gear',
                                        'class' => 'bg-orange-50 text-orange-600',
                                    ],

                                    'permission' => [
                                        'icon' => 'bi-key-fill',
                                        'class' => 'bg-indigo-50 text-indigo-600',
                                    ],

                                    'unit' => [
                                        'icon' => 'bi-building',
                                        'class' => 'bg-blue-50 text-blue-600',
                                    ],

                                    'program' => [
                                        'icon' => 'bi-diagram-3-fill',
                                        'class' => 'bg-violet-50 text-violet-600',
                                    ],

                                    'kegiatan' => [
                                        'icon' => 'bi-list-task',
                                        'class' => 'bg-cyan-50 text-cyan-600',
                                    ],

                                    'sub_kegiatan' => [
                                        'icon' => 'bi-list-check',
                                        'class' => 'bg-teal-50 text-teal-600',
                                    ],

                                    'document_type' => [
                                        'icon' => 'bi-file-earmark-text-fill',
                                        'class' => 'bg-amber-50 text-amber-600',
                                    ],

                                    'tag' => [
                                        'icon' => 'bi-tags-fill',
                                        'class' => 'bg-pink-50 text-pink-600',
                                    ],

                                    'user' => [
                                        'icon' => 'bi-person-fill',
                                        'class' => 'bg-emerald-50 text-emerald-600',
                                    ],

                                    'archive' => [
                                        'icon' => 'bi-archive-fill',
                                        'class' => 'bg-blue-50 text-blue-600',
                                    ],

                                    'guestbook' => [
                                        'icon' => 'bi-journal-text',
                                        'class' => 'bg-amber-50 text-amber-600',
                                    ],
                                ];

                                $objectStyle = $objectIconMap[$objectType] ?? [
                                    'icon' => 'bi-box',
                                    'class' => 'bg-slate-50 text-slate-400',
                                ];

                                /*
                                |--------------------------------------------------------------------------
                                | OBJECT DISPLAY
                                |--------------------------------------------------------------------------
                                */

                                if ($objectType && $objectId) {
                                    $objectDisplay = $objectLabel . ' #' . $objectId;
                                } elseif ($log->access_log_archive_id) {
                                    /*
                                    | Fallback untuk log lama
                                    */

                                    $objectDisplay = 'Arsip #' . $log->access_log_archive_id;

                                    $objectStyle = [
                                        'icon' => 'bi-archive-fill',
                                        'class' => 'bg-blue-50 text-blue-600',
                                    ];
                                } elseif ($log->access_log_guestbook_id) {
                                    /*
                                    | Fallback untuk log lama
                                    */

                                    $objectDisplay = 'Guestbook #' . $log->access_log_guestbook_id;

                                    $objectStyle = [
                                        'icon' => 'bi-journal-text',
                                        'class' => 'bg-amber-50 text-amber-600',
                                    ];
                                } else {
                                    $objectDisplay = '-';
                                }

                            @endphp


                            {{-- ================================================= --}}
                            {{-- ROW --}}
                            {{-- ================================================= --}}

                            <tr class="transition hover:bg-slate-50">


                                {{-- ================================================= --}}
                                {{-- WAKTU --}}
                                {{-- ================================================= --}}

                                <td class="whitespace-nowrap px-5 py-4">

                                    <div class="text-sm font-medium text-slate-700">

                                        {{ $log->access_log_created_at ? \Carbon\Carbon::parse($log->access_log_created_at)->format('d M Y') : '-' }}

                                    </div>

                                    <div class="mt-0.5 text-xs text-slate-400">

                                        {{ $log->access_log_created_at ? \Carbon\Carbon::parse($log->access_log_created_at)->format('H:i:s') : '-' }}

                                    </div>

                                </td>


                                {{-- ================================================= --}}
                                {{-- PENGGUNA --}}
                                {{-- ================================================= --}}

                                <td class="px-5 py-4">

                                    <div class="flex items-start gap-3">

                                        <div
                                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-500">

                                            <i class="bi bi-person-fill"></i>

                                        </div>

                                        <div class="min-w-0">

                                            {{-- USER ID --}}

                                            <div class="text-sm font-semibold text-slate-700">

                                                @if ($log->access_log_samperin_user_id)
                                                    User #{{ $log->access_log_samperin_user_id }}
                                                @else
                                                    Guest
                                                @endif

                                            </div>


                                            {{-- USER NAME --}}

                                            @if (!empty($log->user_name))
                                                <div class="mt-0.5 max-w-[230px] truncate text-xs font-medium text-slate-500"
                                                    title="{{ $log->user_name }}">

                                                    {{ $log->user_name }}

                                                </div>
                                            @endif


                                            {{-- USER TYPE --}}

                                            <div class="mt-0.5 text-xs text-slate-400">

                                                {{ $userTypeLabel }}

                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- ================================================= --}}
                                {{-- AKTIVITAS --}}
                                {{-- ================================================= --}}

                                <td class="px-5 py-4">

                                    <span
                                        class="inline-flex items-center gap-2 rounded-lg px-2.5 py-1.5 text-xs font-semibold {{ $actionClass }}">

                                        <i class="bi {{ $actionIcon }}"></i>

                                        {{ ucwords($actionName ?: '-') }}

                                    </span>

                                </td>


                                {{-- ================================================= --}}
                                {{-- OBJEK --}}
                                {{-- ================================================= --}}

                                <td class="px-5 py-4">

                                    <div class="flex items-start gap-2">

                                        {{-- OBJECT ICON --}}

                                        <span
                                            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg {{ $objectStyle['class'] }}">

                                            <i class="bi {{ $objectStyle['icon'] }}"></i>

                                        </span>


                                        <div class="min-w-0">

                                            {{-- OBJECT ID --}}

                                            <div class="text-sm font-medium text-slate-600">

                                                {{ $objectDisplay }}

                                            </div>


                                            {{-- OBJECT NAME --}}

                                            @if (!empty($log->object_name))
                                                <div class="mt-0.5 max-w-[280px] truncate text-xs font-medium text-slate-500"
                                                    title="{{ $log->object_name }}">

                                                    {{ $log->object_name }}

                                                </div>
                                            @endif


                                            {{-- OBJECT TYPE --}}

                                            @if ($objectType && $objectId)
                                                <div class="mt-0.5 text-[11px] text-slate-400">

                                                    {{ $objectType }}

                                                </div>
                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- ================================================= --}}
                                {{-- IP ADDRESS --}}
                                {{-- ================================================= --}}

                                <td class="px-5 py-4">

                                    <code class="rounded-lg bg-slate-100 px-2.5 py-1 text-xs text-slate-600">

                                        {{ $log->access_log_ip_address ?? '-' }}

                                    </code>

                                </td>

                            </tr>


                        @empty

                            {{-- ================================================= --}}
                            {{-- EMPTY --}}
                            {{-- ================================================= --}}

                            <tr>

                                <td colspan="5" class="px-5 py-16 text-center">

                                    <div
                                        class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                                        <i class="bi bi-activity text-2xl"></i>

                                    </div>

                                    <div class="mt-4 text-sm font-semibold text-slate-700">

                                        Belum ada aktivitas

                                    </div>

                                    <p class="mt-1 text-xs text-slate-400">

                                        Belum terdapat data Access Log pada sistem.

                                    </p>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- ========================================================= --}}
            {{-- PAGINATION --}}
            {{-- ========================================================= --}}

            @if ($logs->hasPages())

                <div class="flex justify-center border-t border-slate-100 px-5 py-4">

                    <div
                        class="inline-flex items-center overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">


                        {{-- PREVIOUS --}}

                        @if ($logs->onFirstPage())
                            <span
                                class="flex h-9 w-9 items-center justify-center border-r border-slate-200 bg-slate-50 text-slate-300">

                                <i class="bi bi-chevron-left text-xs"></i>

                            </span>
                        @else
                            <a href="{{ $logs->previousPageUrl() }}"
                                class="flex h-9 w-9 items-center justify-center border-r border-slate-200 text-slate-500 transition hover:bg-slate-50 hover:text-[oklch(29.3%_0.136_325.661)]">

                                <i class="bi bi-chevron-left text-xs"></i>

                            </a>
                        @endif


                        {{-- PAGE NUMBERS --}}

                        @foreach ($logs->getUrlRange(max(1, $logs->currentPage() - 4), min($logs->lastPage(), $logs->currentPage() + 4)) as $page => $url)
                            @if ($page == $logs->currentPage())
                                <span
                                    class="flex h-9 min-w-[40px] items-center justify-center border-r border-[oklch(29.3%_0.136_325.661)] bg-[oklch(29.3%_0.136_325.661)] px-3 text-xs font-semibold text-white">

                                    {{ $page }}

                                </span>
                            @else
                                <a href="{{ $url }}"
                                    class="flex h-9 min-w-[40px] items-center justify-center border-r border-slate-200 px-3 text-xs font-medium text-slate-600 transition hover:bg-[oklch(29.3%_0.136_325.661)] hover:text-white">

                                    {{ $page }}

                                </a>
                            @endif
                        @endforeach


                        {{-- NEXT --}}

                        @if ($logs->hasMorePages())
                            <a href="{{ $logs->nextPageUrl() }}"
                                class="flex h-9 w-9 items-center justify-center text-slate-500 transition hover:bg-slate-50 hover:text-[oklch(29.3%_0.136_325.661)]">

                                <i class="bi bi-chevron-right text-xs"></i>

                            </a>
                        @else
                            <span class="flex h-9 w-9 items-center justify-center bg-slate-50 text-slate-300">

                                <i class="bi bi-chevron-right text-xs"></i>

                            </span>
                        @endif

                    </div>

                </div>

            @endif

        </div>

    </div>

@endsection
