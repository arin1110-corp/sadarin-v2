@extends('Dashboard.layouts.app')

@section('content')

    <div class="mx-auto max-w-4xl space-y-6">

        {{-- Header --}}
        <div>

            <div class="flex items-center gap-2 text-sm text-slate-400">

                <a href="{{ route('sadarin.admin.master.program.index') }}" class="transition hover:text-slate-600">

                    Program

                </a>

                <i class="bi bi-chevron-right text-xs"></i>

                <span class="text-slate-600">
                    Tambah
                </span>

            </div>


            <h1 class="mt-2 text-2xl font-bold text-slate-800">
                Tambah Program
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Tambahkan program baru ke dalam master data SADARIN.
            </p>

        </div>


        {{-- Validation --}}
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
        <form action="{{ route('sadarin.admin.master.program.store') }}" method="POST"
            class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            @csrf


            {{-- Form Header --}}
            <div class="border-b border-slate-200 px-6 py-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

                        <i class="bi bi-diagram-3-fill"></i>

                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-slate-800">
                            Informasi Program
                        </h2>

                        <p class="text-xs text-slate-400">
                            Isi informasi program dengan benar.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Body --}}
            <div class="space-y-5 p-6">

                {{-- Code --}}
                <div>

                    <label for="program_code" class="mb-2 block text-sm font-semibold text-slate-700">

                        Kode Program

                        <span class="text-xs font-normal text-slate-400">
                            (opsional)
                        </span>

                    </label>


                    <input type="text" id="program_code" name="program_code" value="{{ old('program_code') }}"
                        maxlength="100" placeholder="Contoh: 2.22.01"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[oklch(29.3%_0.136_325.661)] focus:ring-2 focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                </div>


                {{-- Name --}}
                <div>

                    <label for="program_name" class="mb-2 block text-sm font-semibold text-slate-700">

                        Nama Program

                        <span class="text-rose-500">*</span>

                    </label>


                    <input type="text" id="program_name" name="program_name" value="{{ old('program_name') }}"
                        maxlength="255" required placeholder="Contoh: Program Pengembangan Kebudayaan"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[oklch(29.3%_0.136_325.661)] focus:ring-2 focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                </div>


                {{-- Description --}}
                <div>

                    <label for="program_description" class="mb-2 block text-sm font-semibold text-slate-700">

                        Deskripsi

                        <span class="text-xs font-normal text-slate-400">
                            (opsional)
                        </span>

                    </label>


                    <textarea id="program_description" name="program_description" rows="4"
                        placeholder="Deskripsi singkat mengenai program..."
                        class="w-full resize-none rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[oklch(29.3%_0.136_325.661)] focus:ring-2 focus:ring-[oklch(29.3%_0.136_325.661)]/10">{{ old('program_description') }}</textarea>

                </div>


                {{-- Active --}}
                <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">

                    <label class="flex cursor-pointer items-center gap-3">

                        <input type="checkbox" name="program_is_active" value="1" checked
                            class="h-4 w-4 rounded border-slate-300 text-[oklch(29.3%_0.136_325.661)] focus:ring-[oklch(29.3%_0.136_325.661)]">

                        <div>

                            <p class="text-sm font-semibold text-slate-700">
                                Program Aktif
                            </p>

                            <p class="text-xs text-slate-400">
                                Program dapat digunakan dalam data arsip.
                            </p>

                        </div>

                    </label>

                </div>

            </div>


            {{-- Footer --}}
            <div
                class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4 sm:flex-row sm:justify-end">

                <a href="{{ route('sadarin.admin.master.program.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">

                    Batal

                </a>


                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[oklch(29.3%_0.136_325.661)] px-5 py-2.5 text-sm font-semibold text-white transition hover:opacity-90">

                    <i class="bi bi-check-lg"></i>

                    Simpan Program

                </button>

            </div>

        </form>

    </div>

@endsection
