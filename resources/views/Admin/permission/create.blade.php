@extends('Dashboard.layouts.app')

@section('title', 'Tambah Permission')
@section('page_title', 'Tambah Permission')
@section('breadcrumb', 'Role & Permission / Permission / Tambah')

@section('content')

    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                    <i class="bi bi-key-fill text-xl"></i>
                </div>

                <div>
                    <h1 class="text-xl font-bold text-slate-800">
                        Tambah Permission
                    </h1>

                    <p class="mt-0.5 text-sm text-slate-500">
                        Tambahkan hak akses baru ke sistem SADARIN
                    </p>
                </div>

            </div>

            <a href="{{ route('sadarin.admin.permission.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 shadow-sm transition hover:bg-slate-50">

                <i class="bi bi-arrow-left"></i>
                Kembali

            </a>

        </div>


        {{-- FORM --}}
        <form action="{{ route('sadarin.admin.permission.store') }}" method="POST">

            @csrf

            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- HEADER --}}
                <div class="border-b border-slate-100 px-5 py-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                            <i class="bi bi-pencil-square"></i>
                        </div>

                        <div>
                            <h2 class="text-sm font-bold text-slate-800">
                                Informasi Permission
                            </h2>

                            <p class="text-xs text-slate-500">
                                Tentukan identifier dan informasi permission
                            </p>
                        </div>

                    </div>

                </div>


                {{-- BODY --}}
                <div class="space-y-5 p-5">

                    {{-- NAME --}}
                    <div>

                        <label for="permission_name" class="mb-2 block text-sm font-semibold text-slate-700">

                            Nama Permission
                            <span class="text-red-500">*</span>

                        </label>

                        <input type="text" id="permission_name" name="permission_name"
                            value="{{ old('permission_name') }}" maxlength="100" placeholder="Contoh: archive.view"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 font-mono text-sm text-slate-700 outline-none transition
                        focus:border-[oklch(29.3%_0.136_325.661)]
                        focus:ring-2 focus:ring-[oklch(29.3%_0.136_325.661)]/10
                        @error('permission_name') border-red-300 @enderror">

                        @error('permission_name')
                            <p class="mt-1.5 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                        <p class="mt-1.5 text-xs text-slate-400">
                            Identifier unik yang digunakan aplikasi untuk pengecekan permission.
                        </p>

                    </div>


                    {{-- LABEL --}}
                    <div>

                        <label for="permission_label" class="mb-2 block text-sm font-semibold text-slate-700">

                            Label
                            <span class="text-red-500">*</span>

                        </label>

                        <input type="text" id="permission_label" name="permission_label"
                            value="{{ old('permission_label') }}" maxlength="150" placeholder="Contoh: Melihat Arsip"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition
                        focus:border-[oklch(29.3%_0.136_325.661)]
                        focus:ring-2 focus:ring-[oklch(29.3%_0.136_325.661)]/10
                        @error('permission_label') border-red-300 @enderror">

                        @error('permission_label')
                            <p class="mt-1.5 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- DESCRIPTION --}}
                    <div>

                        <label for="permission_description" class="mb-2 block text-sm font-semibold text-slate-700">

                            Deskripsi

                        </label>

                        <textarea id="permission_description" name="permission_description" rows="4"
                            placeholder="Jelaskan fungsi permission ini..."
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition
                        focus:border-[oklch(29.3%_0.136_325.661)]
                        focus:ring-2 focus:ring-[oklch(29.3%_0.136_325.661)]/10
                        @error('permission_description') border-red-300 @enderror">{{ old('permission_description') }}</textarea>

                        @error('permission_description')
                            <p class="mt-1.5 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- INFO --}}
                    <div class="rounded-xl border border-blue-200 bg-blue-50 px-4 py-3">

                        <div class="flex items-start gap-3 text-sm text-blue-700">

                            <i class="bi bi-info-circle-fill mt-0.5"></i>

                            <div>

                                <div class="font-semibold">
                                    Contoh Permission
                                </div>

                                <div class="mt-1 grid gap-1 text-xs sm:grid-cols-2">

                                    <span>
                                        <code>archive.view</code> — Melihat arsip
                                    </span>

                                    <span>
                                        <code>archive.create</code> — Membuat arsip
                                    </span>

                                    <span>
                                        <code>archive.update</code> — Mengubah arsip
                                    </span>

                                    <span>
                                        <code>archive.delete</code> — Menghapus arsip
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="flex flex-col-reverse gap-3 border-t border-slate-100 px-5 py-4 sm:flex-row sm:justify-end">

                    <a href="{{ route('sadarin.admin.permission.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">

                        Batal

                    </a>

                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-[oklch(29.3%_0.136_325.661)] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:opacity-90">

                        <i class="bi bi-check2-circle"></i>
                        Simpan Permission

                    </button>

                </div>

            </div>

        </form>

    </div>

@endsection
