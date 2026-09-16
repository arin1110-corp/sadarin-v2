@extends('Dashboard.layouts.app')

@section('title', 'Kelola Permission Role')
@section('page_title', 'Kelola Permission Role')
@section('breadcrumb', 'Role & Permission / Permission Role')

@section('content')

    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                    <i class="bi bi-shield-lock-fill text-xl"></i>
                </div>

                <div>

                    <h1 class="text-xl font-bold text-slate-800">
                        Kelola Permission
                    </h1>

                    <p class="mt-0.5 text-sm text-slate-500">
                        Atur hak akses untuk role
                        <span class="font-semibold text-slate-700">
                            {{ $role->role_name }}
                        </span>
                    </p>

                </div>

            </div>


            <a href="{{ route('sadarin.admin.role.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 shadow-sm transition hover:bg-slate-50">

                <i class="bi bi-arrow-left"></i>
                Kembali

            </a>

        </div>


        {{-- ERROR --}}
        @if ($errors->any())

            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">

                <div class="flex items-start gap-3">

                    <i class="bi bi-exclamation-circle-fill mt-0.5"></i>

                    <div>

                        <div class="font-semibold">
                            Terdapat kesalahan
                        </div>

                        <ul class="mt-1 list-disc space-y-1 pl-5">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- ROLE INFO --}}
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="flex items-center gap-4 p-5">

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50 text-violet-600">

                    @php
                        $roleIcon = match (strtolower($role->role_name)) {
                            'administrator' => 'bi-shield-fill-check',
                            'arsiparis' => 'bi-archive-fill',
                            'pegawai' => 'bi-person-fill',
                            default => 'bi-shield-fill',
                        };
                    @endphp

                    <i class="bi {{ $roleIcon }} text-xl"></i>

                </div>


                <div class="flex-1">

                    <div class="text-sm font-bold text-slate-800">
                        {{ $role->role_name }}
                    </div>

                    <div class="mt-1 text-xs text-slate-500">
                        {{ $role->role_description ?: 'Tidak ada deskripsi role.' }}
                    </div>

                </div>


                <div class="hidden text-right sm:block">

                    <div class="text-xs text-slate-400">
                        Permission aktif
                    </div>

                    <div class="mt-1 text-lg font-bold text-[oklch(29.3%_0.136_325.661)]">
                        {{ count($permissionIds) }}
                    </div>

                </div>

            </div>

        </div>


        {{-- PERMISSION --}}
        <form action="{{ route('sadarin.admin.role.permission.update', $role->role_id) }}" method="POST">

            @csrf
            @method('PUT')


            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- HEADER --}}
                <div class="border-b border-slate-100 px-5 py-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                            <i class="bi bi-key-fill"></i>
                        </div>

                        <div>

                            <h2 class="text-sm font-bold text-slate-800">
                                Daftar Permission
                            </h2>

                            <p class="text-xs text-slate-500">
                                Centang permission yang dapat digunakan oleh role ini.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- BODY --}}
                <div class="p-5">

                    @if ($permissions->count())

                        <div class="grid grid-cols-1 gap-3 md:grid-cols-2">

                            @foreach ($permissions as $permission)
                                @php
                                    $checked = in_array($permission->permission_id, $permissionIds);
                                @endphp


                                <label class="group cursor-pointer">

                                    <input type="checkbox" name="permission_ids[]" value="{{ $permission->permission_id }}"
                                        class="peer sr-only" @checked($checked)>


                                    <div
                                        class="flex items-start gap-4 rounded-xl border border-slate-200 bg-white p-4 transition
                                    hover:border-indigo-200 hover:bg-indigo-50/30
                                    peer-checked:border-[oklch(29.3%_0.136_325.661)]
                                    peer-checked:bg-[oklch(29.3%_0.136_325.661)]/5
                                    peer-checked:ring-2
                                    peer-checked:ring-[oklch(29.3%_0.136_325.661)]/10
                                ">

                                        {{-- ICON --}}
                                        <div
                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 transition
                                        peer-checked:bg-[oklch(29.3%_0.136_325.661)] peer-checked:text-white
                                    ">

                                            <i class="bi bi-key-fill"></i>

                                        </div>


                                        {{-- INFO --}}
                                        <div class="min-w-0 flex-1">

                                            <div class="flex flex-wrap items-center gap-2">

                                                <span class="font-mono text-sm font-semibold text-slate-700">
                                                    {{ $permission->permission_name }}
                                                </span>

                                            </div>


                                            <div class="mt-1 text-xs font-medium text-slate-600">
                                                {{ $permission->permission_label }}
                                            </div>


                                            @if ($permission->permission_description)
                                                <div class="mt-1 text-xs leading-5 text-slate-400">
                                                    {{ $permission->permission_description }}
                                                </div>
                                            @endif

                                        </div>


                                        {{-- CHECK --}}
                                        <div
                                            class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full border-2 border-slate-300 bg-white text-transparent transition
                                        peer-checked:border-[oklch(29.3%_0.136_325.661)]
                                        peer-checked:bg-[oklch(29.3%_0.136_325.661)]
                                        peer-checked:text-white
                                    ">

                                            <i class="bi bi-check text-sm"></i>

                                        </div>

                                    </div>

                                </label>
                            @endforeach

                        </div>
                    @else
                        <div class="rounded-xl border border-amber-200 bg-amber-50 px-4 py-4">

                            <div class="flex items-center gap-3 text-sm text-amber-700">

                                <i class="bi bi-exclamation-triangle-fill"></i>

                                <span>
                                    Belum ada permission aktif.
                                </span>

                            </div>

                        </div>

                    @endif

                </div>


                {{-- FOOTER --}}
                <div
                    class="flex flex-col-reverse gap-3 border-t border-slate-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                    <div class="text-xs text-slate-400">

                        <i class="bi bi-info-circle mr-1"></i>

                        Perubahan permission berlaku setelah disimpan.

                    </div>


                    <div class="flex items-center gap-2">

                        <a href="{{ route('sadarin.admin.role.index') }}"
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

            </div>

        </form>

    </div>

@endsection
