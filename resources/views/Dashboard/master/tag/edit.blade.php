@extends('Dashboard.layouts.app')

@section('title', 'Edit Tag')

@section('content')

    <div class="mx-auto max-w-3xl">

        {{-- Header --}}
        <div class="mb-6">

            <a href="{{ route('sadarin.admin.master.tag.index') }}"
                class="mb-4 inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-slate-700">

                <i class="bi bi-arrow-left"></i>

                Kembali

            </a>


            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">

                    <i class="bi bi-pencil-square text-xl"></i>

                </div>


                <div>

                    <h1 class="text-xl font-bold text-slate-800">
                        Edit Tag
                    </h1>

                    <p class="text-sm text-slate-500">
                        Perbarui informasi tag.
                    </p>

                </div>

            </div>

        </div>


        {{-- Errors --}}
        @if ($errors->any())

            <div class="mb-5 rounded-xl border border-rose-200 bg-rose-50 p-4">

                <div class="mb-2 flex items-center gap-2 font-semibold text-rose-700">

                    <i class="bi bi-exclamation-triangle-fill"></i>

                    Periksa kembali data

                </div>


                <ul class="list-inside list-disc text-sm text-rose-600">

                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Form --}}
        <form method="POST" action="{{ route('sadarin.admin.master.tag.update', $tag->tag_id) }}">

            @csrf

            @method('PUT')


            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="space-y-5">

                    {{-- Nama --}}
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">

                            Nama Tag

                            <span class="text-rose-500">*</span>

                        </label>


                        <input type="text" name="tag_name" value="{{ old('tag_name', $tag->tag_name) }}" maxlength="100"
                            required autofocus
                            class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-amber-400 focus:ring-2 focus:ring-amber-100">


                        @error('tag_name')
                            <p class="mt-1 text-xs text-rose-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Slug --}}
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">

                            Slug

                        </label>


                        <div class="flex items-center rounded-xl border border-slate-200 bg-slate-50">

                            <span class="border-r border-slate-200 px-3 text-xs text-slate-400">
                                #
                            </span>


                            <input type="text" value="{{ $tag->tag_slug }}" readonly
                                class="w-full bg-transparent px-3 py-2.5 font-mono text-sm text-slate-500 outline-none">

                        </div>


                        <p class="mt-1 text-xs text-slate-400">
                            Slug akan diperbarui otomatis berdasarkan nama tag.
                        </p>

                    </div>


                    {{-- Description --}}
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">

                            Deskripsi

                        </label>


                        <textarea name="tag_description" rows="4" placeholder="Deskripsi atau konteks tag (opsional)"
                            class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-amber-400 focus:ring-2 focus:ring-amber-100">{{ old('tag_description', $tag->tag_description) }}</textarea>


                        @error('tag_description')
                            <p class="mt-1 text-xs text-rose-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Status --}}
                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">

                        <label class="flex cursor-pointer items-center gap-3">

                            <input type="checkbox" name="tag_is_active" value="1" @checked(old('tag_is_active', $tag->tag_is_active))
                                class="h-4 w-4 rounded border-slate-300 text-purple-600 focus:ring-purple-500">


                            <div>

                                <div class="text-sm font-semibold text-slate-700">
                                    Tag aktif
                                </div>

                                <div class="text-xs text-slate-500">
                                    Tag aktif dapat digunakan pada metadata arsip.
                                </div>

                            </div>

                        </label>

                    </div>

                </div>


                {{-- Footer --}}
                <div class="mt-7 flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">

                    <a href="{{ route('sadarin.admin.master.tag.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">

                        Batal

                    </a>


                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:opacity-90"
                        style="background: oklch(29.3% 0.136 325.661);">

                        <i class="bi bi-check-lg"></i>

                        Simpan Perubahan

                    </button>

                </div>

            </div>

        </form>

    </div>

@endsection
