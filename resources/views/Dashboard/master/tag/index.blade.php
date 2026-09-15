@extends('Dashboard.layouts.app')

@section('title', 'Tag')

@section('content')

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                        <i class="bi bi-tags-fill text-xl"></i>
                    </div>

                    <div>
                        <h1 class="text-xl font-bold text-slate-800">
                            Tag
                        </h1>

                        <p class="text-sm text-slate-500">
                            Kelola tag dan konteks untuk pengelompokan arsip.
                        </p>
                    </div>

                </div>
            </div>

            <a href="{{ route('sadarin.admin.master.tag.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:opacity-90"
                style="background: oklch(29.3% 0.136 325.661);">

                <i class="bi bi-plus-lg"></i>
                Tambah Tag

            </a>

        </div>


        {{-- Success --}}
        @if (session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">

                <div class="flex items-center gap-2">

                    <i class="bi bi-check-circle-fill"></i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            </div>
        @endif


        {{-- Search --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

            <form method="GET" action="{{ route('sadarin.admin.master.tag.index') }}" class="flex flex-col gap-3 sm:flex-row">

                <div class="relative flex-1">

                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama tag, slug, atau deskripsi..."
                        class="w-full rounded-xl border border-slate-200 py-2.5 pl-10 pr-4 text-sm outline-none transition focus:border-purple-400 focus:ring-2 focus:ring-purple-100">

                </div>


                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-800 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700">

                    <i class="bi bi-search"></i>

                    Cari

                </button>


                @if (request('search'))
                    <a href="{{ route('sadarin.admin.master.tag.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">

                        <i class="bi bi-x-lg"></i>

                        Reset

                    </a>
                @endif

            </form>

        </div>


        {{-- Table --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="overflow-x-auto">

                <table class="min-w-full text-sm">

                    <thead class="bg-slate-50">

                        <tr class="border-b border-slate-200">

                            <th class="px-5 py-3 text-left font-semibold text-slate-600">
                                #
                            </th>

                            <th class="px-5 py-3 text-left font-semibold text-slate-600">
                                Tag
                            </th>

                            <th class="px-5 py-3 text-left font-semibold text-slate-600">
                                Slug
                            </th>

                            <th class="px-5 py-3 text-left font-semibold text-slate-600">
                                Deskripsi
                            </th>

                            <th class="px-5 py-3 text-center font-semibold text-slate-600">
                                Status
                            </th>

                            <th class="px-5 py-3 text-center font-semibold text-slate-600">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse($tags as $item)
                            <tr class="transition hover:bg-slate-50">

                                {{-- No --}}
                                <td class="whitespace-nowrap px-5 py-4 text-slate-500">

                                    {{ $tags->firstItem() + $loop->index }}

                                </td>


                                {{-- Tag --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-amber-50 text-amber-600">

                                            <i class="bi bi-tag-fill"></i>

                                        </div>


                                        <div>

                                            <div class="font-semibold text-slate-800">

                                                {{ $item->tag_name }}

                                            </div>

                                            <div class="mt-0.5 text-xs text-slate-400">

                                                ID #{{ $item->tag_id }}

                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- Slug --}}
                                <td class="px-5 py-4">

                                    <span class="rounded-lg bg-slate-100 px-2.5 py-1.5 font-mono text-xs text-slate-600">

                                        {{ $item->tag_slug }}

                                    </span>

                                </td>


                                {{-- Description --}}
                                <td class="px-5 py-4">

                                    @if ($item->tag_description)
                                        <div class="max-w-md truncate text-slate-500">

                                            {{ $item->tag_description }}

                                        </div>
                                    @else
                                        <span class="text-slate-400">
                                            -
                                        </span>
                                    @endif

                                </td>


                                {{-- Status --}}
                                <td class="px-5 py-4 text-center">

                                    @if ($item->tag_is_active)
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">

                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                            Aktif

                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-500">

                                            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>

                                            Nonaktif

                                        </span>
                                    @endif

                                </td>


                                {{-- Aksi --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center justify-center gap-2">

                                        {{-- Edit --}}
                                        <a href="{{ route('sadarin.admin.master.tag.edit', $item->tag_id) }}" title="Edit"
                                            class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-blue-600 transition hover:bg-blue-100">

                                            <i class="bi bi-pencil-square"></i>

                                        </a>


                                        {{-- Nonaktifkan --}}
                                        @if ($item->tag_is_active)
                                            <form action="{{ route('sadarin.admin.master.tag.destroy', $item->tag_id) }}"
                                                method="POST" onsubmit="return confirm('Nonaktifkan tag ini?')">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit" title="Nonaktifkan"
                                                    class="flex h-9 w-9 items-center justify-center rounded-lg bg-rose-50 text-rose-600 transition hover:bg-rose-100">

                                                    <i class="bi bi-power"></i>

                                                </button>

                                            </form>
                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="px-5 py-12 text-center">

                                    <div class="flex flex-col items-center justify-center">

                                        <div
                                            class="mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-50 text-amber-500">

                                            <i class="bi bi-tags text-2xl"></i>

                                        </div>


                                        <h3 class="font-semibold text-slate-700">

                                            Belum ada tag

                                        </h3>


                                        <p class="mt-1 text-sm text-slate-400">

                                            Silakan tambahkan tag baru.

                                        </p>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            @if ($tags->hasPages())
                <div class="border-t border-slate-100 px-5 py-4">

                    {{ $tags->links() }}

                </div>
            @endif

        </div>

    </div>

@endsection
