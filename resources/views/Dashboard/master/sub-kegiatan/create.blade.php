@extends('Dashboard.layouts.app')

@section('title', 'Tambah Sub Kegiatan')

@section('content')

    <div class="mx-auto max-w-3xl">

        {{-- Header --}}
        <div class="mb-6">

            <a href="{{ route('sadarin.admin.master.sub-kegiatan.index') }}"
                class="mb-4 inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-slate-700">

                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                    <i class="bi bi-list-nested text-xl"></i>
                </div>

                <div>
                    <h1 class="text-xl font-bold text-slate-800">
                        Tambah Sub Kegiatan
                    </h1>

                    <p class="text-sm text-slate-500">
                        Tambahkan sub kegiatan baru.
                    </p>
                </div>

            </div>

        </div>


        {{-- Error --}}
        @if ($errors->any())

            <div class="mb-5 rounded-xl border border-rose-200 bg-rose-50 p-4">

                <div class="mb-2 flex items-center gap-2 font-semibold text-rose-700">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    Periksa kembali data
                </div>

                <ul class="list-inside list-disc text-sm text-rose-600">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Form --}}
        <form method="POST" action="{{ route('sadarin.admin.master.sub-kegiatan.store') }}">

            @csrf

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="space-y-5">

                    {{-- Kegiatan --}}
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Kegiatan
                            <span class="text-rose-500">*</span>
                        </label>

                        <select name="sub_kegiatan_kegiatan_id" required
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-orange-400 focus:ring-2 focus:ring-orange-100">

                            <option value="">
                                -- Pilih Kegiatan --
                            </option>

                            @foreach ($kegiatans as $kegiatan)
                                <option value="{{ $kegiatan->kegiatan_id }}" @selected(old('sub_kegiatan_kegiatan_id') == $kegiatan->kegiatan_id)>

                                    {{ $kegiatan->kegiatan_name }}

                                    @if ($kegiatan->kegiatan_code)
                                        — {{ $kegiatan->kegiatan_code }}
                                    @endif

                                </option>
                            @endforeach

                        </select>

                        @error('sub_kegiatan_kegiatan_id')
                            <p class="mt-1 text-xs text-rose-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Kode --}}
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Kode Sub Kegiatan
                        </label>

                        <input type="text" name="sub_kegiatan_code" value="{{ old('sub_kegiatan_code') }}"
                            maxlength="100" placeholder="Contoh: 01.01.01"
                            class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-orange-400 focus:ring-2 focus:ring-orange-100">

                        @error('sub_kegiatan_code')
                            <p class="mt-1 text-xs text-rose-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Nama --}}
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Sub Kegiatan
                            <span class="text-rose-500">*</span>
                        </label>

                        <input type="text" name="sub_kegiatan_name" value="{{ old('sub_kegiatan_name') }}"
                            maxlength="255" required placeholder="Masukkan nama sub kegiatan"
                            class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-orange-400 focus:ring-2 focus:ring-orange-100">

                        @error('sub_kegiatan_name')
                            <p class="mt-1 text-xs text-rose-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Deskripsi --}}
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Deskripsi
                        </label>

                        <textarea name="sub_kegiatan_description" rows="4" placeholder="Deskripsi sub kegiatan (opsional)"
                            class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-orange-400 focus:ring-2 focus:ring-orange-100">{{ old('sub_kegiatan_description') }}</textarea>

                        @error('sub_kegiatan_description')
                            <p class="mt-1 text-xs text-rose-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>


                {{-- Footer --}}
                <div class="mt-7 flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">

                    <a href="{{ route('sadarin.admin.master.sub-kegiatan.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50">

                        Batal

                    </a>

                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:opacity-90"
                        style="background: oklch(29.3% 0.136 325.661);">

                        <i class="bi bi-check-lg"></i>

                        Simpan Sub Kegiatan

                    </button>

                </div>

            </div>

        </form>

    </div>

@endsection
