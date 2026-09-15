@extends('Dashboard.layouts.app')

@section('content')

    <div class="mx-auto max-w-4xl space-y-6">

        {{-- Header --}}
        <div>

            <div class="flex items-center gap-2 text-sm text-slate-400">

                <a href="{{ route('sadarin.admin.master.kegiatan.index') }}" class="transition hover:text-slate-600">

                    Kegiatan

                </a>

                <i class="bi bi-chevron-right text-xs"></i>

                <span class="text-slate-600">
                    Edit
                </span>

            </div>


            <h1 class="mt-2 text-2xl font-bold text-slate-800">
                Edit Kegiatan
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Perbarui informasi kegiatan.
            </p>

        </div>


        {{-- Error --}}
        @if (session('error'))
            <div class="flex items-start gap-3 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-rose-700">

                <i class="bi bi-exclamation-circle-fill mt-0.5"></i>

                <div class="text-sm font-medium">
                    {{ session('error') }}
                </div>

            </div>
        @endif


        @if ($errors->any())
            <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3">

                <div class="flex items-start gap-3">

                    <i class="bi bi-exclamation-circle-fill mt-0.5 text-rose-500"></i>

                    <div>

                        <p class="text-sm font-semibold text-rose-700">
                            Terdapat kesalahan pada data.
                        </p>

                        <ul class="mt-1 list-inside list-disc text-xs text-rose-600">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>
        @endif


        {{-- Form --}}
        <form action="{{ route('sadarin.admin.master.kegiatan.update', $kegiatan->kegiatan_id) }}" method="POST"
            class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            @csrf

            @method('PUT')


            {{-- Header --}}
            <div class="border-b border-slate-200 px-6 py-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-orange-600">

                        <i class="bi bi-list-check"></i>

                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-slate-800">
                            Informasi Kegiatan
                        </h2>

                        <p class="text-xs text-slate-400">
                            Perbarui informasi kegiatan yang dipilih.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Body --}}
            <div class="space-y-5 p-6">

                {{-- Program --}}
                <div>

                    <label for="kegiatan_program_id" class="mb-2 block text-sm font-semibold text-slate-700">

                        Program

                        <span class="text-rose-500">*</span>

                    </label>


                    <select id="kegiatan_program_id" name="kegiatan_program_id" required
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[oklch(29.3%_0.136_325.661)] focus:ring-2 focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                        <option value="">
                            Pilih Program
                        </option>

                        @foreach ($programs as $program)
                            <option value="{{ $program->program_id }}"
                                {{ old('kegiatan_program_id', $kegiatan->kegiatan_program_id) == $program->program_id ? 'selected' : '' }}>

                                {{ $program->program_code ? $program->program_code . ' - ' : '' }}{{ $program->program_name }}

                            </option>
                        @endforeach

                    </select>

                </div>


                {{-- Code --}}
                <div>

                    <label for="kegiatan_code" class="mb-2 block text-sm font-semibold text-slate-700">

                        Kode Kegiatan

                        <span class="text-xs font-normal text-slate-400">
                            (opsional)
                        </span>

                    </label>


                    <input type="text" id="kegiatan_code" name="kegiatan_code"
                        value="{{ old('kegiatan_code', $kegiatan->kegiatan_code) }}" maxlength="100"
                        placeholder="Contoh: 2.22.01.1.01"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[oklch(29.3%_0.136_325.661)] focus:ring-2 focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                </div>


                {{-- Name --}}
                <div>

                    <label for="kegiatan_name" class="mb-2 block text-sm font-semibold text-slate-700">

                        Nama Kegiatan

                        <span class="text-rose-500">*</span>

                    </label>


                    <input type="text" id="kegiatan_name" name="kegiatan_name"
                        value="{{ old('kegiatan_name', $kegiatan->kegiatan_name) }}" maxlength="255" required
                        placeholder="Contoh: Pengelolaan Kebudayaan"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[oklch(29.3%_0.136_325.661)] focus:ring-2 focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                </div>


                {{-- Description --}}
                <div>

                    <label for="kegiatan_description" class="mb-2 block text-sm font-semibold text-slate-700">

                        Deskripsi

                        <span class="text-xs font-normal text-slate-400">
                            (opsional)
                        </span>

                    </label>


                    <textarea id="kegiatan_description" name="kegiatan_description" rows="4"
                        placeholder="Deskripsi singkat mengenai kegiatan..."
                        class="w-full resize-none rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[oklch(29.3%_0.136_325.661)] focus:ring-2 focus:ring-[oklch(29.3%_0.136_325.661)]/10">{{ old('kegiatan_description', $kegiatan->kegiatan_description) }}</textarea>

                </div>


                {{-- Status --}}
                <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">

                    <label class="flex cursor-pointer items-center gap-3">

                        <input type="checkbox" name="kegiatan_is_active" value="1"
                            {{ old('kegiatan_is_active', $kegiatan->kegiatan_is_active) ? 'checked' : '' }}
                            class="h-4 w-4 rounded border-slate-300 text-[oklch(29.3%_0.136_325.661)] focus:ring-[oklch(29.3%_0.136_325.661)]">

                        <div>

                            <p class="text-sm font-semibold text-slate-700">
                                Kegiatan Aktif
                            </p>

                            <p class="text-xs text-slate-400">
                                Kegiatan aktif dapat digunakan dalam data arsip.
                            </p>

                        </div>

                    </label>

                </div>

            </div>


            {{-- Footer --}}
            <div
                class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4 sm:flex-row sm:justify-end">

                <a href="{{ route('sadarin.admin.master.kegiatan.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">

                    Batal

                </a>


                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[oklch(29.3%_0.136_325.661)] px-5 py-2.5 text-sm font-semibold text-white transition hover:opacity-90">

                    <i class="bi bi-check-lg"></i>

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

@endsection
