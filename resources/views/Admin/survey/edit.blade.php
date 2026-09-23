@extends('Dashboard.layouts.app')

@section('title', 'Edit Survey Kepuasan')
@section('page_title', 'Edit Survey Kepuasan')
@section('breadcrumb', 'Administrasi Sistem / Kepuasan Pengguna / Edit Survey')

@section('content')

    <div class="mx-auto max-w-3xl">

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-6 py-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600">

                        <i class="bi bi-pencil-fill"></i>

                    </div>

                    <div>

                        <h1 class="text-lg font-bold text-slate-800">
                            Edit Survey Kepuasan
                        </h1>

                        <p class="text-xs text-slate-400">
                            Perbarui informasi survey kepuasan.
                        </p>

                    </div>

                </div>

            </div>


            <form method="POST" action="{{ route('sadarin.admin.survey.update', $survey) }}" class="space-y-6 p-6">

                @csrf
                @method('PUT')


                {{-- TITLE --}}
                <div>

                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Judul Survey
                    </label>

                    <input type="text" name="survey_title" value="{{ old('survey_title', $survey->survey_title) }}"
                        required
                        class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-[oklch(29.3%_0.136_325.661)] focus:ring-2 focus:ring-[oklch(29.3%_0.136_325.661)]/10">

                    @error('survey_title')
                        <div class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- DESCRIPTION --}}
                <div>

                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Deskripsi
                    </label>

                    <textarea name="survey_description" rows="4"
                        class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-[oklch(29.3%_0.136_325.661)] focus:ring-2 focus:ring-[oklch(29.3%_0.136_325.661)]/10">{{ old('survey_description', $survey->survey_description) }}</textarea>

                </div>


                {{-- PERIODE --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Mulai Survey
                        </label>

                        <input type="datetime-local" name="survey_started_at"
                            value="{{ old('survey_started_at', $survey->survey_started_at?->format('Y-m-d\TH:i')) }}"
                            class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-[oklch(29.3%_0.136_325.661)]">

                    </div>


                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Berakhir
                        </label>

                        <input type="datetime-local" name="survey_ended_at"
                            value="{{ old('survey_ended_at', $survey->survey_ended_at?->format('Y-m-d\TH:i')) }}"
                            class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-[oklch(29.3%_0.136_325.661)]">

                    </div>

                </div>


                {{-- ACTIVE --}}
                <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">

                    <label class="flex cursor-pointer items-center gap-3">

                        <input type="checkbox" name="survey_is_active" value="1" @checked(old('survey_is_active', $survey->survey_is_active))
                            class="h-4 w-4 rounded border-slate-300">

                        <div>

                            <div class="text-sm font-semibold text-slate-700">
                                Aktifkan survey
                            </div>

                            <div class="text-xs text-slate-400">
                                Survey dapat digunakan oleh pengguna ketika aktif.
                            </div>

                        </div>

                    </label>

                </div>


                {{-- BUTTON --}}
                <div class="flex justify-end gap-3 border-t border-slate-100 pt-5">

                    <a href="{{ route('sadarin.admin.survey.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">

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

    </div>

@endsection
