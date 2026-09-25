{{-- ================================================================
    SIDEBAR FILTER ARSIP SADARIN
================================================================ --}}

<aside class="w-full shrink-0 lg:w-[270px]">

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- =========================================================
            HEADER
        ========================================================== --}}

        <div class="border-b border-slate-100 px-4 py-4">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-[10px] font-bold uppercase tracking-wider text-sadarin-500">
                        Filter Arsip
                    </p>

                    <h2 class="mt-0.5 text-lg font-bold text-slate-900">
                        Klasifikasi
                    </h2>

                </div>

            </div>

        </div>


        {{-- =========================================================
            SEARCH KLASIFIKASI
        ========================================================== --}}

        <div class="px-4 pt-4">

            <form method="GET" action="{{ route('sadarin.user.archive.index') }}">

                {{-- pertahankan filter --}}
                @if (request('unit'))
                    <input type="hidden" name="unit" value="{{ request('unit') }}">
                @endif

                @if (request('program'))
                    <input type="hidden" name="program" value="{{ request('program') }}">
                @endif

                @if (request('kegiatan'))
                    <input type="hidden" name="kegiatan" value="{{ request('kegiatan') }}">
                @endif

                @if (request('sub_kegiatan'))
                    <input type="hidden" name="sub_kegiatan" value="{{ request('sub_kegiatan') }}">
                @endif

                @if (request('document_type'))
                    <input type="hidden" name="document_type" value="{{ request('document_type') }}">
                @endif

                @if (request('tag'))
                    <input type="hidden" name="tag" value="{{ request('tag') }}">
                @endif

                <div class="relative">

                    <i class="bi bi-search pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                    </i>

                    <input type="text" name="q" value="{{ $search ?? request('q') }}"
                        placeholder="Cari klasifikasi..."
                        class="h-10 w-full rounded-xl border border-slate-200 bg-white pl-9 pr-3 text-xs text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-sadarin-300 focus:ring-2 focus:ring-sadarin-100">

                </div>

            </form>

        </div>


        {{-- =========================================================
            FILTER LIST
        ========================================================== --}}

        <div class="px-3 py-4">


            {{-- =====================================================
                SEMUA ARSIP
            ====================================================== --}}

            <a href="{{ route('sadarin.user.archive.index') }}"
                class="mb-2 flex items-center justify-between rounded-xl px-3 py-2.5 transition
                {{ !request()->filled('unit') &&
                !request()->filled('program') &&
                !request()->filled('kegiatan') &&
                !request()->filled('sub_kegiatan') &&
                !request()->filled('document_type') &&
                !request()->filled('tag')
                    ? 'border-l-4 border-sadarin-700 bg-sadarin-50 text-sadarin-700'
                    : 'text-slate-700 hover:bg-slate-50' }}">

                <span class="flex items-center gap-3">

                    <span
                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-white text-sadarin-600 shadow-sm">

                        <i class="bi bi-archive"></i>

                    </span>

                    <span class="text-sm font-semibold">
                        Semua Arsip
                    </span>

                </span>

                <span class="rounded-md bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-500">
                    {{ $archives->total() }}
                </span>

            </a>


            {{-- =====================================================
                UNIT
            ====================================================== --}}

            <div class="border-b border-slate-100 py-3">

                <button type="button" onclick="toggleSadarinFilter('unit')"
                    class="flex w-full items-center justify-between px-3 py-1.5 text-left">

                    <span class="flex items-center gap-3">

                        <i class="bi bi-building text-sadarin-600"></i>

                        <span class="text-sm font-bold text-slate-800">
                            Unit
                        </span>

                        <span class="rounded-md bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-500">
                            {{ $units->count() }}
                        </span>

                    </span>

                    <i id="icon-unit" class="bi bi-chevron-up text-xs text-slate-500">
                    </i>

                </button>


                <div id="filter-unit" class="mt-2 space-y-1">

                    @foreach ($units->take(5) as $unit)
                        <a href="{{ route(
                            'sadarin.user.archive.index',
                            array_merge(request()->query(), [
                                'unit' => $unit->unit_id,
                            ]),
                        ) }}"
                            class="flex items-center justify-between rounded-lg px-3 py-2 transition
                            {{ (string) request('unit') === (string) $unit->unit_id
                                ? 'bg-sadarin-50 text-sadarin-700'
                                : 'text-slate-600 hover:bg-slate-50' }}">

                            <span class="flex min-w-0 items-center gap-2">

                                <span
                                    class="h-4 w-4 shrink-0 rounded border
                                    {{ (string) request('unit') === (string) $unit->unit_id
                                        ? 'border-sadarin-600 bg-sadarin-600'
                                        : 'border-slate-300 bg-white' }}">

                                    @if ((string) request('unit') === (string) $unit->unit_id)
                                        <i class="bi bi-check text-[10px] text-white"></i>
                                    @endif

                                </span>

                                <span class="truncate text-xs">
                                    {{ $unit->unit_name }}
                                </span>

                            </span>

                        </a>
                    @endforeach


                    @if ($units->count() > 5)
                        <button type="button"
                            class="px-3 pt-1 text-xs font-medium text-sadarin-600 hover:text-sadarin-800">

                            Tampilkan {{ $units->count() - 5 }} lainnya...

                        </button>
                    @endif

                </div>

            </div>


            {{-- =====================================================
                PROGRAM
            ====================================================== --}}

            <div class="border-b border-slate-100 py-3">

                <button type="button" onclick="toggleSadarinFilter('program')"
                    class="flex w-full items-center justify-between px-3 py-1.5 text-left">

                    <span class="flex items-center gap-3">

                        <i class="bi bi-diagram-3 text-sadarin-600"></i>

                        <span class="text-sm font-bold text-slate-800">
                            Program
                        </span>

                        <span class="rounded-md bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-500">
                            {{ $programs->count() }}
                        </span>

                    </span>

                    <i id="icon-program" class="bi bi-chevron-up text-xs text-slate-500">
                    </i>

                </button>


                <div id="filter-program" class="mt-2 space-y-1">

                    @foreach ($programs->take(5) as $program)
                        <a href="{{ route(
                            'sadarin.user.archive.index',
                            array_merge(request()->query(), [
                                'program' => $program->program_id,
                            ]),
                        ) }}"
                            class="flex items-center justify-between rounded-lg px-3 py-2 transition
                            {{ (string) request('program') === (string) $program->program_id
                                ? 'bg-sadarin-50 text-sadarin-700'
                                : 'text-slate-600 hover:bg-slate-50' }}">

                            <span class="flex min-w-0 items-center gap-2">

                                <span
                                    class="h-4 w-4 shrink-0 rounded border
                                    {{ (string) request('program') === (string) $program->program_id
                                        ? 'border-sadarin-600 bg-sadarin-600'
                                        : 'border-slate-300 bg-white' }}">

                                    @if ((string) request('program') === (string) $program->program_id)
                                        <i class="bi bi-check text-[10px] text-white"></i>
                                    @endif

                                </span>

                                <span class="truncate text-xs">
                                    {{ $program->program_name }}
                                </span>

                            </span>

                        </a>
                    @endforeach


                    @if ($programs->count() > 5)
                        <button type="button"
                            class="px-3 pt-1 text-xs font-medium text-sadarin-600 hover:text-sadarin-800">

                            Tampilkan {{ $programs->count() - 5 }} lainnya...

                        </button>
                    @endif

                </div>

            </div>


            {{-- =====================================================
                KEGIATAN
            ====================================================== --}}

            <div class="border-b border-slate-100 py-3">

                <button type="button" onclick="toggleSadarinFilter('kegiatan')"
                    class="flex w-full items-center justify-between px-3 py-1.5 text-left">

                    <span class="flex items-center gap-3">

                        <i class="bi bi-diagram-3 text-sadarin-600"></i>

                        <span class="text-sm font-bold text-slate-800">
                            Kegiatan
                        </span>

                        <span class="rounded-md bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-500">
                            {{ $kegiatans->count() }}
                        </span>

                    </span>

                    <i id="icon-kegiatan" class="bi bi-chevron-up text-xs text-slate-500">
                    </i>

                </button>


                <div id="filter-kegiatan" class="mt-2 space-y-1">

                    @foreach ($kegiatans->take(5) as $kegiatan)
                        <a href="{{ route(
                            'sadarin.user.archive.index',
                            array_merge(request()->query(), [
                                'kegiatan' => $kegiatan->kegiatan_id,
                            ]),
                        ) }}"
                            class="flex items-center justify-between rounded-lg px-3 py-2 transition
                            {{ (string) request('kegiatan') === (string) $kegiatan->kegiatan_id
                                ? 'bg-sadarin-50 text-sadarin-700'
                                : 'text-slate-600 hover:bg-slate-50' }}">

                            <span class="flex min-w-0 items-center gap-2">

                                <span
                                    class="h-4 w-4 shrink-0 rounded border
                                    {{ (string) request('kegiatan') === (string) $kegiatan->kegiatan_id
                                        ? 'border-sadarin-600 bg-sadarin-600'
                                        : 'border-slate-300 bg-white' }}">

                                    @if ((string) request('kegiatan') === (string) $kegiatan->kegiatan_id)
                                        <i class="bi bi-check text-[10px] text-white"></i>
                                    @endif

                                </span>

                                <span class="truncate text-xs">
                                    {{ $kegiatan->kegiatan_name }}
                                </span>

                            </span>

                        </a>
                    @endforeach


                    @if ($kegiatans->count() > 5)
                        <button type="button"
                            class="px-3 pt-1 text-xs font-medium text-sadarin-600 hover:text-sadarin-800">

                            Tampilkan {{ $kegiatans->count() - 5 }} lainnya...

                        </button>
                    @endif

                </div>

            </div>


            {{-- =====================================================
                SUB KEGIATAN
            ====================================================== --}}

            <div class="border-b border-slate-100 py-3">

                <button type="button" onclick="toggleSadarinFilter('sub-kegiatan')"
                    class="flex w-full items-center justify-between px-3 py-1.5 text-left">

                    <span class="flex items-center gap-3">

                        <i class="bi bi-diagram-2 text-sadarin-600"></i>

                        <span class="text-sm font-bold text-slate-800">
                            Sub Kegiatan
                        </span>

                        <span class="rounded-md bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-500">
                            {{ $subKegiatans->count() }}
                        </span>

                    </span>

                    <i id="icon-sub-kegiatan" class="bi bi-chevron-down text-xs text-slate-500">
                    </i>

                </button>


                <div id="filter-sub-kegiatan" class="mt-2 hidden space-y-1">

                    @foreach ($subKegiatans->take(5) as $subKegiatan)
                        <a href="{{ route(
                            'sadarin.user.archive.index',
                            array_merge(request()->query(), [
                                'sub_kegiatan' => $subKegiatan->sub_kegiatan_id,
                            ]),
                        ) }}"
                            class="flex items-center justify-between rounded-lg px-3 py-2 text-slate-600 transition hover:bg-slate-50">

                            <span class="flex min-w-0 items-center gap-2">

                                <span class="h-4 w-4 shrink-0 rounded border border-slate-300 bg-white">
                                </span>

                                <span class="truncate text-xs">
                                    {{ $subKegiatan->sub_kegiatan_name }}
                                </span>

                            </span>

                        </a>
                    @endforeach

                </div>

            </div>


            {{-- =====================================================
                JENIS DOKUMEN
            ====================================================== --}}

            <div class="border-b border-slate-100 py-3">

                <button type="button" onclick="toggleSadarinFilter('document-type')"
                    class="flex w-full items-center justify-between px-3 py-1.5 text-left">

                    <span class="flex items-center gap-3">

                        <i class="bi bi-file-earmark-text text-sadarin-600"></i>

                        <span class="text-sm font-bold text-slate-800">
                            Jenis Dokumen
                        </span>

                        <span class="rounded-md bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-500">
                            {{ $documentTypes->count() }}
                        </span>

                    </span>

                    <i id="icon-document-type" class="bi bi-chevron-down text-xs text-slate-500">
                    </i>

                </button>


                <div id="filter-document-type" class="mt-2 hidden space-y-1">

                    @foreach ($documentTypes->take(5) as $documentType)
                        <a href="{{ route(
                            'sadarin.user.archive.index',
                            array_merge(request()->query(), [
                                'document_type' => $documentType->document_type_id,
                            ]),
                        ) }}"
                            class="flex items-center gap-2 rounded-lg px-3 py-2 text-slate-600 transition hover:bg-slate-50">

                            <span class="h-4 w-4 shrink-0 rounded border border-slate-300 bg-white">
                            </span>

                            <span class="truncate text-xs">
                                {{ $documentType->document_type_name }}
                            </span>

                        </a>
                    @endforeach

                </div>

            </div>


            {{-- =====================================================
                TAG
            ====================================================== --}}

            <div class="py-3">

                <button type="button" onclick="toggleSadarinFilter('tag')"
                    class="flex w-full items-center justify-between px-3 py-1.5 text-left">

                    <span class="flex items-center gap-3">

                        <i class="bi bi-tag text-sadarin-600"></i>

                        <span class="text-sm font-bold text-slate-800">
                            Tag
                        </span>

                        <span class="rounded-md bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-500">
                            {{ $tags->count() }}
                        </span>

                    </span>

                    <i id="icon-tag" class="bi bi-chevron-up text-xs text-slate-500">
                    </i>

                </button>


                <div id="filter-tag" class="mt-2 space-y-1">

                    @foreach ($tags->take(5) as $tag)
                        <a href="{{ route(
                            'sadarin.user.archive.index',
                            array_merge(request()->query(), [
                                'tag' => $tag->tag_id,
                            ]),
                        ) }}"
                            class="flex items-center justify-between rounded-lg px-3 py-2 transition
                            {{ (string) request('tag') === (string) $tag->tag_id
                                ? 'bg-sadarin-50 text-sadarin-700'
                                : 'text-slate-600 hover:bg-slate-50' }}">

                            <span class="flex min-w-0 items-center gap-2">

                                <span
                                    class="h-4 w-4 shrink-0 rounded border
                                    {{ (string) request('tag') === (string) $tag->tag_id
                                        ? 'border-sadarin-600 bg-sadarin-600'
                                        : 'border-slate-300 bg-white' }}">

                                    @if ((string) request('tag') === (string) $tag->tag_id)
                                        <i class="bi bi-check text-[10px] text-white"></i>
                                    @endif

                                </span>

                                <span class="truncate text-xs">
                                    #{{ $tag->tag_name }}
                                </span>

                            </span>

                        </a>
                    @endforeach


                    @if ($tags->count() > 5)
                        <button type="button"
                            class="px-3 pt-1 text-xs font-medium text-sadarin-600 hover:text-sadarin-800">

                            Tampilkan {{ $tags->count() - 5 }} lainnya...

                        </button>
                    @endif

                </div>

            </div>


            {{-- =====================================================
                RESET
            ====================================================== --}}

            <div class="border-t border-slate-100 pt-3">

                <a href="{{ route('sadarin.user.archive.index') }}"
                    class="flex w-full items-center justify-center gap-2 rounded-xl border border-sadarin-300 bg-white px-3 py-2.5 text-xs font-semibold text-sadarin-700 transition hover:bg-sadarin-50">

                    <i class="bi bi-arrow-counterclockwise"></i>

                    Reset Semua Filter

                </a>

            </div>

        </div>

    </div>

</aside>


{{-- ================================================================
    SIDEBAR JAVASCRIPT
================================================================ --}}

<script>
    function toggleSadarinFilter(name) {

        const content = document.getElementById('filter-' + name);
        const icon = document.getElementById('icon-' + name);

        if (!content || !icon) {
            return;
        }

        const isHidden = content.classList.contains('hidden');

        content.classList.toggle('hidden');

        icon.classList.toggle('bi-chevron-down', !isHidden);
        icon.classList.toggle('bi-chevron-up', isHidden);
    }
</script>
