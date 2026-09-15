@extends('Dashboard.layouts.app')

@section('title', 'Tambah Tag')

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

                    <i class="bi bi-tag-fill text-xl"></i>

                </div>


                <div>

                    <h1 class="text-xl font-bold text-slate-800">
                        Tambah Tag
                    </h1>

                    <p class="text-sm text-slate-500">
                        Tambahkan tag baru untuk membantu pengelompokan arsip.
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
        <form method="POST" action="{{ route('sadarin.admin.master.tag.store') }}">

            @csrf


            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="space-y-5">

                    {{-- Nama --}}
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">

                            Nama Tag

                            <span class="text-rose-500">*</span>

                        </label>


                        <input type="text" name="tag_name" value="{{ old('tag_name') }}" maxlength="100" required
                            autofocus placeholder="Contoh: Bulan Bahasa Bali"
                            class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-amber-400 focus:ring-2 focus:ring-amber-100">


                        @error('tag_name')
                            <p class="mt-1 text-xs text-rose-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Info Slug --}}
                    <div class="rounded-xl border border-amber-100 bg-amber-50 p-4">

                        <div class="flex gap-3">

                            <i class="bi bi-info-circle-fill mt-0.5 text-amber-600"></i>

                            <div>

                                <div class="text-sm font-semibold text-amber-800">
                                    Slug dibuat otomatis
                                </div>

                                <p class="mt-1 text-xs leading-5 text-amber-700">

                                    Slug akan dibuat otomatis berdasarkan nama tag.
                                    Contoh:
                                    <strong>Bulan Bahasa Bali</strong>
                                    menjadi
                                    <strong>bulan-bahasa-bali</strong>.

                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Description --}}
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">

                            Deskripsi

                        </label>


                        <textarea name="tag_description" rows="4" placeholder="Deskripsi atau konteks tag (opsional)"
                            class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-amber-400 focus:ring-2 focus:ring-amber-100">{{ old('tag_description') }}</textarea>


                        @error('tag_description')
                            <p class="mt-1 text-xs text-rose-600">
                                {{ $message }}
                            </p>
                        @enderror

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

                        Simpan Tag

                    </button>

                </div>

            </div>

        </form>

    </div>

@endsection
