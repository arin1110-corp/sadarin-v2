@extends('Dashboard.layouts.app')

@section('title', 'Tambah Jenis Dokumen')

@section('content')

    <div class="mx-auto max-w-3xl">

        {{-- Header --}}
        <div class="mb-6">

            <a href="{{ route('sadarin.admin.master.document-type.index') }}"
                class="mb-4 inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-slate-700">

                <i class="bi bi-arrow-left"></i>
                Kembali

            </a>


            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50 text-violet-600">
                    <i class="bi bi-file-earmark-plus-fill text-xl"></i>
                </div>

                <div>

                    <h1 class="text-xl font-bold text-slate-800">
                        Tambah Jenis Dokumen
                    </h1>

                    <p class="text-sm text-slate-500">
                        Tambahkan jenis dokumen baru ke dalam sistem.
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
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Form --}}
        <form method="POST" action="{{ route('sadarin.admin.master.document-type.store') }}">

            @csrf

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="space-y-5">

                    {{-- Nama --}}
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">

                            Nama Jenis Dokumen

                            <span class="text-rose-500">*</span>

                        </label>

                        <input type="text" name="document_type_name" value="{{ old('document_type_name') }}"
                            maxlength="150" required autofocus placeholder="Contoh: Surat Masuk"
                            class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-purple-400 focus:ring-2 focus:ring-purple-100">

                        @error('document_type_name')
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

                        <textarea name="document_type_description" rows="4" placeholder="Deskripsi jenis dokumen (opsional)"
                            class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-purple-400 focus:ring-2 focus:ring-purple-100">{{ old('document_type_description') }}</textarea>

                        @error('document_type_description')
                            <p class="mt-1 text-xs text-rose-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>


                {{-- Footer --}}
                <div class="mt-7 flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">

                    <a href="{{ route('sadarin.admin.master.document-type.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50">

                        Batal

                    </a>


                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:opacity-90"
                        style="background: oklch(29.3% 0.136 325.661);">

                        <i class="bi bi-check-lg"></i>

                        Simpan Jenis Dokumen

                    </button>

                </div>

            </div>

        </form>

    </div>

@endsection
