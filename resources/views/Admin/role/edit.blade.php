@extends('Dashboard.layouts.app')

@section('title', 'Edit Role')
@section('page_title', 'Edit Role')
@section('breadcrumb', 'Role & Permission / Edit Role')

@section('content')

    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50 text-violet-600">
                    <i class="bi bi-shield-fill-gear text-xl"></i>
                </div>

                <div>
                    <h1 class="text-xl font-bold text-slate-800">
                        Edit Role
                    </h1>

                    <p class="mt-0.5 text-sm text-slate-500">
                        Perbarui informasi dan status role
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
        <form action="{{ route('sadarin.admin.role.update', $role->role_id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- HEADER --}}
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
                                Role ID: {{ $role->role_id }}
                            </p>
                        </div>

                    </div>

                </div>


                {{-- BODY --}}
                <div class="space-y-5 p-5">

                    {{-- NAMA --}}
                    <div>

                        <label for="role_name" class="mb-2 block text-sm font-semibold text-slate-700">

                            Nama Role
                            <span class="text-red-500">*</span>

                        </label>

                        <input type="text" id="role_name" name="role_name"
                            value="{{ old('role_name', $role->role_name) }}" maxlength="100"
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
                        @error('role_description') border-red-300 @enderror">{{ old('role_description', $role->role_description) }}</textarea>

                        @error('role_description')
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
                                        Status Role
                                    </div>

                                    <div class="mt-0.5 text-xs text-slate-500">
                                        Role aktif dapat diberikan kepada pengguna.
                                    </div>

                                </div>

                            </div>


                            <input type="checkbox" name="role_is_active" value="1"
                                class="h-5 w-5 rounded border-slate-300 text-[oklch(29.3%_0.136_325.661)] focus:ring-[oklch(29.3%_0.136_325.661)]"
                                @checked(old('role_is_active', $role->role_is_active))>

                        </label>

                    </div>

                </div>


                {{-- FOOTER --}}
                <div
                    class="flex flex-col-reverse gap-3 border-t border-slate-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                    <div class="text-xs text-slate-400">
                        <i class="bi bi-info-circle mr-1"></i>
                        UID: {{ $role->role_uid }}
                    </div>


                    <div class="flex items-center gap-2">

                        <a href="{{ route('sadarin.admin.role.index') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">

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
        @if ($role->role_is_active)
            <div class="rounded-2xl border border-red-200 bg-red-50 p-5">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-start gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600">
                            <i class="bi bi-shield-x"></i>
                        </div>

                        <div>

                            <h3 class="text-sm font-bold text-red-700">
                                Nonaktifkan Role
                            </h3>

                            <p class="mt-1 text-xs leading-5 text-red-600">
                                Role tidak akan dapat diberikan kepada pengguna baru.
                                Data role tetap tersimpan.
                            </p>

                        </div>

                    </div>


                    <form action="{{ route('sadarin.admin.role.destroy', $role->role_id) }}" method="POST"
                        onsubmit="return confirm('Nonaktifkan role ini?')">

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
