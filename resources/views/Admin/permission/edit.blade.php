@extends('Dashboard.layouts.app')

@section('title', 'Edit Permission')
@section('page_title', 'Edit Permission')
@section('breadcrumb', 'Role & Permission / Permission / Edit')

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
                        Edit Permission
                    </h1>

                    <p class="mt-0.5 text-sm text-slate-500">
                        Perbarui informasi dan status permission
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
        <form action="{{ route('sadarin.admin.permission.update', $permission->permission_id) }}" method="POST">

            @csrf
            @method('PUT')

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
                                Permission ID: {{ $permission->permission_id }}
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
                            value="{{ old('permission_name', $permission->permission_name) }}" maxlength="100"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 font-mono text-sm text-slate-700 outline-none transition
                        focus:border-[oklch(29.3%_0.136_325.661)]
                        focus:ring-2 focus:ring-[oklch(29.3%_0.136_325.661)]/10
                        @error('permission_name') border-red-300 @enderror">

                        @error('permission_name')
                            <p class="mt-1.5 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- LABEL --}}
                    <div>

                        <label for="permission_label" class="mb-2 block text-sm font-semibold text-slate-700">

                            Label
                            <span class="text-red-500">*</span>

                        </label>

                        <input type="text" id="permission_label" name="permission_label"
                            value="{{ old('permission_label', $permission->permission_label) }}" maxlength="150"
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
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition
                        focus:border-[oklch(29.3%_0.136_325.661)]
                        focus:ring-2 focus:ring-[oklch(29.3%_0.136_325.661)]/10
                        @error('permission_description') border-red-300 @enderror">{{ old('permission_description', $permission->permission_description) }}</textarea>

                        @error('permission_description')
                            <p class="mt-1.5 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- STATUS --}}
                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">

                        <label class="flex cursor-pointer items-center justify-between gap-4">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                    <i class="bi bi-toggle-on text-lg"></i>
                                </div>

                                <div>

                                    <div class="text-sm font-semibold text-slate-700">
                                        Status Permission
                                    </div>

                                    <div class="mt-0.5 text-xs text-slate-500">
                                        Permission aktif dapat diberikan kepada role.
                                    </div>

                                </div>

                            </div>


                            <input type="checkbox" name="permission_is_active" value="1"
                                class="h-5 w-5 rounded border-slate-300 text-[oklch(29.3%_0.136_325.661)] focus:ring-[oklch(29.3%_0.136_325.661)]"
                                @checked(old('permission_is_active', $permission->permission_is_active))>

                        </label>

                    </div>

                </div>


                {{-- FOOTER --}}
                <div
                    class="flex flex-col-reverse gap-3 border-t border-slate-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                    <div class="text-xs text-slate-400">
                        <i class="bi bi-info-circle mr-1"></i>
                        UID: {{ $permission->permission_uid }}
                    </div>


                    <div class="flex items-center gap-2">

                        <a href="{{ route('sadarin.admin.permission.index') }}"
                            class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">

                            Batal

                        </a>

                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[oklch(29.3%_0.136_325.661)] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:opacity-90">

                            <i class="bi bi-check2-circle"></i>
                            Simpan Perubahan

                        </button>

                    </div>

                </div>

            </div>

        </form>


        {{-- NONAKTIFKAN --}}
        @if ($permission->permission_is_active)
            <div class="rounded-2xl border border-red-200 bg-red-50 p-5">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-start gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600">
                            <i class="bi bi-key-fill"></i>
                        </div>

                        <div>

                            <h3 class="text-sm font-bold text-red-700">
                                Nonaktifkan Permission
                            </h3>

                            <p class="mt-1 text-xs leading-5 text-red-600">
                                Permission tidak dapat diberikan ke role baru.
                                Data permission tetap tersimpan.
                            </p>

                        </div>

                    </div>


                    <form action="{{ route('sadarin.admin.permission.destroy', $permission->permission_id) }}"
                        method="POST" onsubmit="return confirm('Nonaktifkan permission ini?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-red-200 bg-white px-4 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-600 hover:text-white">

                            <i class="bi bi-power"></i>
                            Nonaktifkan

                        </button>

                    </form>

                </div>

            </div>
        @endif

    </div>

@endsection
