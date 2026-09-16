@extends('Dashboard.layouts.app')

@section('title', 'Tambah Role')
@section('page_title', 'Tambah Role')
@section('breadcrumb', 'Role & Permission / Tambah Role')

@section('content')

    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50 text-violet-600">
                    <i class="bi bi-shield-plus text-xl"></i>
                </div>

                <div>
                    <h1 class="text-xl font-bold text-slate-800">
                        Tambah Role
                    </h1>

                    <p class="mt-0.5 text-sm text-slate-500">
                        Tambahkan role baru untuk sistem SADARIN
                    </p>
                </div>

            </div>

            <a href="{{ route('sadarin.admin.role.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 shadow-sm transition hover:bg-slate-50">

                <i class="bi bi-arrow-left"></i>
                Kembali

            </a>

        </div>


        {{-- FORM --}}
        <form action="{{ route('sadarin.admin.role.store') }}" method="POST">

            @csrf

            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- FORM HEADER --}}
                <div class="border-b border-slate-100 px-5 py-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                            <i class="bi bi-pencil-square"></i>
                        </div>

                        <div>
                            <h2 class="text-sm font-bold text-slate-800">
                                Informasi Role
                            </h2>

                            <p class="text-xs text-slate-500">
                                Isi informasi dasar role
                            </p>
                        </div>

                    </div>

                </div>


                {{-- FORM BODY --}}
                <div class="space-y-5 p-5">

                    {{-- NAMA ROLE --}}
                    <div>

                        <label for="role_name" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Role
                            <span class="text-red-500">*</span>
                        </label>

                        <input type="text" id="role_name" name="role_name" value="{{ old('role_name') }}" maxlength="100"
                            placeholder="Contoh: Arsiparis"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition
                        focus:border-[oklch(29.3%_0.136_325.661)]
                        focus:ring-2 focus:ring-[oklch(29.3%_0.136_325.661)]/10
                        @error('role_name') border-red-300 @enderror">

                        @error('role_name')
                            <p class="mt-1.5 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- DESKRIPSI --}}
                    <div>

                        <label for="role_description" class="mb-2 block text-sm font-semibold text-slate-700">
                            Deskripsi
                        </label>

                        <textarea id="role_description" name="role_description" rows="4"
                            placeholder="Jelaskan fungsi atau kewenangan role..."
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition
                        focus:border-[oklch(29.3%_0.136_325.661)]
                        focus:ring-2 focus:ring-[oklch(29.3%_0.136_325.661)]/10
                        @error('role_description') border-red-300 @enderror">{{ old('role_description') }}</textarea>

                        @error('role_description')
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
                                    Catatan
                                </div>

                                <p class="mt-0.5 text-xs leading-5">
                                    Permission untuk role dapat diatur setelah role dibuat.
                                </p>
                            </div>

                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="flex flex-col-reverse gap-3 border-t border-slate-100 px-5 py-4 sm:flex-row sm:justify-end">

                    <a href="{{ route('sadarin.admin.role.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">

                        Batal

                    </a>

                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-[oklch(29.3%_0.136_325.661)] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:opacity-90">

                        <i class="bi bi-check2-circle"></i>
                        Simpan Role

                    </button>

                </div>

            </div>

        </form>

    </div>

@endsection
