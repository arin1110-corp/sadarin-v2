{{-- ================================================================
    SIDEBAR FILTER ARSIP SADARIN
================================================================ --}}

<aside class="w-full shrink-0 lg:w-[270px]">

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- =========================================================
            HEADER
        ========================================================== --}}

        <div class="border-b border-slate-100 px-4 py-4">

            <p class="text-[10px] font-bold uppercase tracking-wider text-sadarin-500">
                Filter Arsip
            </p>

            <h2 class="mt-0.5 text-lg font-bold text-slate-900">
                Klasifikasi
            </h2>

        </div>


        {{-- =========================================================
            SEARCH KLASIFIKASI
        ========================================================== --}}

        <div class="px-4 pt-4">

            <form method="GET" action="{{ route('sadarin.user.archive.index') }}">

                {{-- Pertahankan filter yang sedang aktif --}}
                @foreach (['unit', 'program', 'kegiatan', 'sub_kegiatan', 'document_type', 'tag'] as $filter)
                    @if (request($filter))
                        <input type="hidden" name="{{ $filter }}" value="{{ request($filter) }}">
                    @endif
                @endforeach

                <div class="relative">

                    <i
                        class="bi bi-search pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-sm text-slate-400">
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

                    <i id="icon-unit" class="bi bi-chevron-up text-xs text-slate-500"></i>

                </button>


                <div id="filter-unit" class="mt-2 max-h-52 space-y-1 overflow-y-auto pr-1">

                    @foreach ($units as $unit)
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
                                    class="flex h-4 w-4 shrink-0 items-center justify-center rounded border
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

                    <i id="icon-program" class="bi bi-chevron-up text-xs text-slate-500"></i>

                </button>


                <div id="filter-program" class="mt-2 max-h-52 space-y-1 overflow-y-auto pr-1">

                    @foreach ($programs as $program)
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
                                    class="flex h-4 w-4 shrink-0 items-center justify-center rounded border
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

                </div>

            </div>


            {{-- =====================================================
                KEGIATAN
            ====================================================== --}}

            <div class="border-b border-slate-100 py-3">

                <button type="button" onclick="toggleSadarinFilter('kegiatan')"
                    class="flex w-full items-center justify-between px-3 py-1.5 text-left">

                    <span class="flex items-center gap-3">

                        <i class="bi bi-list-check text-sadarin-600"></i>

                        <span class="text-sm font-bold text-slate-800">
                            Kegiatan
                        </span>

                        <span class="rounded-md bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-500">
                            {{ $kegiatans->count() }}
                        </span>

                    </span>

                    <i id="icon-kegiatan" class="bi bi-chevron-up text-xs text-slate-500"></i>

                </button>


                <div id="filter-kegiatan" class="mt-2 max-h-52 space-y-1 overflow-y-auto pr-1">

                    @foreach ($kegiatans as $kegiatan)
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
                                    class="flex h-4 w-4 shrink-0 items-center justify-center rounded border
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

                    <i id="icon-sub-kegiatan" class="bi bi-chevron-down text-xs text-slate-500"></i>

                </button>


                <div id="filter-sub-kegiatan" class="mt-2 hidden max-h-52 space-y-1 overflow-y-auto pr-1">

                    @foreach ($subKegiatans as $subKegiatan)
                        <a href="{{ route(
                            'sadarin.user.archive.index',
                            array_merge(request()->query(), [
                                'sub_kegiatan' => $subKegiatan->sub_kegiatan_id,
                            ]),
                        ) }}"
                            class="flex items-center justify-between rounded-lg px-3 py-2 transition
                            {{ (string) request('sub_kegiatan') === (string) $subKegiatan->sub_kegiatan_id
                                ? 'bg-sadarin-50 text-sadarin-700'
                                : 'text-slate-600 hover:bg-slate-50' }}">

                            <span class="flex min-w-0 items-center gap-2">

                                <span
                                    class="flex h-4 w-4 shrink-0 items-center justify-center rounded border
                                    {{ (string) request('sub_kegiatan') === (string) $subKegiatan->sub_kegiatan_id
                                        ? 'border-sadarin-600 bg-sadarin-600'
                                        : 'border-slate-300 bg-white' }}">

                                    @if ((string) request('sub_kegiatan') === (string) $subKegiatan->sub_kegiatan_id)
                                        <i class="bi bi-check text-[10px] text-white"></i>
                                    @endif

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

                    <i id="icon-document-type" class="bi bi-chevron-up text-xs text-slate-500">
                    </i>

                </button>


                <div id="filter-document-type" class="mt-2">

                    {{-- Search Jenis Dokumen --}}
                    <div class="relative mb-2 px-1">

                        <i
                            class="bi bi-search pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-[11px] text-slate-400">
                        </i>

                        <input type="text" id="sadarinDocumentTypeSearch" placeholder="Cari jenis dokumen..."
                            class="h-8 w-full rounded-lg border border-slate-200 bg-slate-50 pl-8 pr-3 text-[11px] text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-sadarin-300 focus:bg-white focus:ring-1 focus:ring-sadarin-100">

                    </div>


                    {{-- List Jenis Dokumen --}}
                    <div id="sadarinDocumentTypeList" class="max-h-[260px] space-y-0.5 overflow-y-auto pr-1">

                        @forelse ($documentTypes as $documentType)
                            <a href="{{ route(
                                'sadarin.user.archive.index',
                                array_merge(request()->query(), [
                                    'document_type' => $documentType->document_type_id,
                                ]),
                            ) }}"
                                data-document-type-name="{{ strtolower($documentType->document_type_name) }}"
                                class="sadarin-document-type-item flex items-center gap-2 rounded-lg px-3 py-2 transition
                    {{ (string) request('document_type') === (string) $documentType->document_type_id
                        ? 'bg-sadarin-50 text-sadarin-700'
                        : 'text-slate-600 hover:bg-slate-50' }}">

                                <span
                                    class="flex h-4 w-4 shrink-0 items-center justify-center rounded border
                        {{ (string) request('document_type') === (string) $documentType->document_type_id
                            ? 'border-sadarin-600 bg-sadarin-600'
                            : 'border-slate-300 bg-white' }}">

                                    @if ((string) request('document_type') === (string) $documentType->document_type_id)
                                        <i class="bi bi-check text-[10px] text-white"></i>
                                    @endif

                                </span>

                                <span class="truncate text-xs">
                                    {{ $documentType->document_type_name }}
                                </span>

                            </a>

                        @empty

                            <div class="px-3 py-4 text-center">

                                <i class="bi bi-file-earmark-x text-xl text-slate-300"></i>

                                <p class="mt-1 text-[11px] text-slate-400">
                                    Belum ada jenis dokumen
                                </p>

                            </div>
                        @endforelse

                    </div>


                    {{-- Tidak ditemukan --}}
                    @if ($documentTypes->count() > 0)
                        <div id="sadarinDocumentTypeEmpty" class="hidden px-3 py-4 text-center">

                            <i class="bi bi-search text-lg text-slate-300"></i>

                            <p class="mt-1 text-[11px] text-slate-400">
                                Jenis dokumen tidak ditemukan
                            </p>

                        </div>
                    @endif

                </div>

            </div>


            {{-- =====================================================
                TAG
            ====================================================== --}}

            <div class="py-3">

                <button type="button" onclick="toggleSadarinFilter('tag')"
                    class="flex w-full items-center justify-between px-3 py-1.5 text-left">

                    <span class="flex items-center gap-3">

                        <i class="bi bi-tags text-sadarin-600"></i>

                        <span class="text-sm font-bold text-slate-800">
                            Tag
                        </span>

                        <span class="rounded-md bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-500">
                            {{ $tags->count() }}
                        </span>

                    </span>

                    <i id="icon-tag" class="bi bi-chevron-up text-xs text-slate-500"></i>

                </button>


                {{-- =================================================
                    TAG SEARCH
                ================================================== --}}

                <div id="filter-tag" class="mt-2">

                    <div class="relative mb-2 px-1">

                        <i
                            class="bi bi-search pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-[11px] text-slate-400">
                        </i>

                        <input type="text" id="sadarinTagSearch" placeholder="Cari tag..."
                            class="h-8 w-full rounded-lg border border-slate-200 bg-slate-50 pl-8 pr-3 text-[11px] text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-sadarin-300 focus:bg-white focus:ring-1 focus:ring-sadarin-100">

                    </div>


                    {{-- =================================================
                        TAG LIST
                    ================================================== --}}

                    <div id="sadarinTagList" class="max-h-[260px] space-y-0.5 overflow-y-auto pr-1">

                        @forelse ($tags as $tag)
                            <a href="{{ route(
                                'sadarin.user.archive.index',
                                array_merge(request()->query(), [
                                    'tag' => $tag->tag_id,
                                ]),
                            ) }}"
                                data-tag-name="{{ strtolower($tag->tag_name) }}"
                                class="sadarin-tag-item flex items-center justify-between rounded-lg px-3 py-2 transition
                                {{ (string) request('tag') === (string) $tag->tag_id
                                    ? 'bg-sadarin-50 text-sadarin-700'
                                    : 'text-slate-600 hover:bg-slate-50' }}">

                                <span class="flex min-w-0 items-center gap-2">

                                    <span
                                        class="flex h-4 w-4 shrink-0 items-center justify-center rounded border
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

                        @empty

                            <div class="px-3 py-4 text-center">

                                <i class="bi bi-tags text-xl text-slate-300"></i>

                                <p class="mt-1 text-[11px] text-slate-400">
                                    Belum ada tag
                                </p>

                            </div>
                        @endforelse

                    </div>


                    {{-- Jumlah hasil pencarian tag --}}

                    @if ($tags->count() > 0)
                        <div id="sadarinTagEmpty" class="hidden px-3 py-4 text-center">

                            <i class="bi bi-search text-lg text-slate-300"></i>

                            <p class="mt-1 text-[11px] text-slate-400">
                                Tag tidak ditemukan
                            </p>

                        </div>
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
    /**
     * ================================================================
     * TOGGLE FILTER SECTION
     * ================================================================
     */
    function toggleSadarinFilter(name) {

        const content = document.getElementById('filter-' + name);
        const icon = document.getElementById('icon-' + name);

        if (!content || !icon) {
            return;
        }

        const isHidden = content.classList.contains('hidden');

        if (isHidden) {
            content.classList.remove('hidden');

            icon.classList.remove('bi-chevron-down');
            icon.classList.add('bi-chevron-up');

        } else {
            content.classList.add('hidden');

            icon.classList.remove('bi-chevron-up');
            icon.classList.add('bi-chevron-down');
        }
    }


    /**
     * ================================================================
     * SEARCH TAG
     * ================================================================
     *
     * Pencarian tag dilakukan langsung di browser.
     * Tidak reload halaman.
     */
    document.addEventListener('DOMContentLoaded', function() {

        const searchInput = document.getElementById('sadarinTagSearch');
        const tagItems = document.querySelectorAll('.sadarin-tag-item');
        const emptyMessage = document.getElementById('sadarinTagEmpty');

        if (!searchInput || !tagItems.length) {
            return;
        }

        searchInput.addEventListener('input', function() {

            const keyword = this.value
                .toLowerCase()
                .trim();

            let visibleCount = 0;

            tagItems.forEach(function(item) {

                const tagName = (
                        item.dataset.tagName ||
                        item.textContent ||
                        ''
                    )
                    .toLowerCase()
                    .trim();

                const match = keyword === '' || tagName.includes(keyword);

                if (match) {

                    item.classList.remove('hidden');

                    visibleCount++;

                } else {

                    item.classList.add('hidden');

                }

            });


            /**
             * Pesan ketika tag tidak ditemukan
             */
            if (emptyMessage) {

                if (visibleCount === 0) {

                    emptyMessage.classList.remove('hidden');

                } else {

                    emptyMessage.classList.add('hidden');

                }

            }

        });

    });
</script>
