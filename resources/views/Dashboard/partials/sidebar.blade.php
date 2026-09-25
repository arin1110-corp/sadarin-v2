<aside id="adminSidebar"
    class="admin-sidebar fixed left-0 top-0 flex h-screen flex-col border-r border-slate-200 bg-white">

    {{-- Logo --}}
    <div class="flex h-20 shrink-0 items-center border-b border-slate-100 px-6">

        <a href="{{ route('sadarin.user.archive.index') }}" class="flex items-center">
            <img src="{{ asset('assets/images/logo-sadarin-full.png') }}" alt="SADARIN"
                class="h-16 w-auto object-contain">
        </a>

        {{-- Mobile Close --}}
        <button type="button" onclick="closeSidebar()"
            class="ml-auto flex h-9 w-9 items-center justify-center rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-700 lg:hidden">
            <i class="bi bi-x-lg text-lg"></i>
        </button>

    </div>


    {{-- Navigation --}}
    <div class="flex-1 overflow-y-auto px-4 py-5">

        {{-- MAIN --}}
        <div class="mb-3 px-3 text-[11px] font-bold uppercase tracking-[0.16em] text-slate-400">
            Menu Utama
        </div>

        <nav class="space-y-1">

            {{-- Dashboard --}}
            <a href="{{ route('sadarin.admin.dashboard.index') }}"
                class="sidebar-link flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
    {{ request()->routeIs('sadarin.admin.dashboard.*')
        ? 'bg-[oklch(29.3%_0.136_325.661)] text-white shadow-sm'
        : 'text-slate-600 hover:bg-slate-100' }}">

                <span
                    class="flex h-9 w-9 items-center justify-center rounded-lg
        {{ request()->routeIs('sadarin.admin.dashboard.*') ? 'bg-white/15 text-white' : 'bg-blue-50 text-blue-600' }}">
                    <i class="bi bi-speedometer2 text-base"></i>
                </span>

                <span>Dashboard</span>
            </a>


            {{-- Arsip --}}
            <a href="{{ route('sadarin.admin.archive.index') }}"
                class="sidebar-link flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
    {{ request()->routeIs(
        'sadarin.admin.archive.index',
        'sadarin.admin.archive.create',
        'sadarin.admin.archive.edit',
        'sadarin.admin.archive.show',
    )
        ? 'bg-[oklch(29.3%_0.136_325.661)] text-white shadow-sm'
        : 'text-slate-600 hover:bg-slate-100' }}">

                <span
                    class="flex h-9 w-9 items-center justify-center rounded-lg
        {{ request()->routeIs(
            'sadarin.admin.archive.index',
            'sadarin.admin.archive.create',
            'sadarin.admin.archive.edit',
            'sadarin.admin.archive.show',
        )
            ? 'bg-white/15 text-white'
            : 'bg-blue-50 text-blue-600' }}">

                    <i class="bi bi-archive-fill text-base"></i>

                </span>

                <span class="flex-1">Arsip</span>

            </a>
            {{-- Verifikasi --}}
            <a href="{{ route('sadarin.admin.archive.verification') }}"
                class="sidebar-link flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
    {{ request()->routeIs('sadarin.admin.archive.verification', 'sadarin.admin.archive.verify')
        ? 'bg-[oklch(29.3%_0.136_325.661)] text-white shadow-sm'
        : 'text-slate-600 hover:bg-slate-100' }}">

                <span
                    class="flex h-9 w-9 items-center justify-center rounded-lg
        {{ request()->routeIs('sadarin.admin.archive.verification', 'sadarin.admin.archive.verify')
            ? 'bg-white/15 text-white'
            : 'bg-amber-50 text-amber-600' }}">

                    <i class="bi bi-shield-check text-base"></i>

                </span>

                <span class="flex-1">Verifikasi</span>

                <span class="rounded-full bg-amber-100 px-2 py-0.5 text-[10px] font-bold text-amber-700">
                    {{ \App\Models\SadarinArchive::where('archive_status', 'draft')->count() }}
                </span>

            </a>
        </nav>


        {{-- KLASIFIKASI --}}
        <div class="mb-3 mt-8 px-3 text-[11px] font-bold uppercase tracking-[0.16em] text-slate-400">
            Klasifikasi
        </div>

        <nav class="space-y-1">

            {{-- Unit --}}
            <a href="{{ route('sadarin.admin.master.unit.index') }}"
                class="sidebar-link flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
        {{ request()->routeIs('sadarin.admin.master.unit.*')
            ? 'bg-[oklch(29.3%_0.136_325.661)] text-white shadow-sm'
            : 'text-slate-600 hover:bg-slate-100' }}">

                <span
                    class="flex h-9 w-9 items-center justify-center rounded-lg
            {{ request()->routeIs('sadarin.admin.master.unit.*') ? 'bg-white/15 text-white' : 'bg-blue-50 text-blue-600' }}">

                    <i class="bi bi-building-fill text-base"></i>

                </span>

                <span>Unit</span>

            </a>


            {{-- Program --}}
            <a href="{{ route('sadarin.admin.master.program.index') }}"
                class="sidebar-link flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
        {{ request()->routeIs('sadarin.admin.master.program.*')
            ? 'bg-[oklch(29.3%_0.136_325.661)] text-white shadow-sm'
            : 'text-slate-600 hover:bg-slate-100' }}">

                <span
                    class="flex h-9 w-9 items-center justify-center rounded-lg
            {{ request()->routeIs('sadarin.admin.master.program.*')
                ? 'bg-white/15 text-white'
                : 'bg-indigo-50 text-indigo-600' }}">

                    <i class="bi bi-diagram-3 text-base"></i>

                </span>

                <span>Program</span>

            </a>


            {{-- Kegiatan --}}
            <a href="{{ route('sadarin.admin.master.kegiatan.index') }}"
                class="sidebar-link flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
        {{ request()->routeIs('sadarin.admin.master.kegiatan.*')
            ? 'bg-[oklch(29.3%_0.136_325.661)] text-white shadow-sm'
            : 'text-slate-600 hover:bg-slate-100' }}">

                <span
                    class="flex h-9 w-9 items-center justify-center rounded-lg
            {{ request()->routeIs('sadarin.admin.master.kegiatan.*')
                ? 'bg-white/15 text-white'
                : 'bg-orange-50 text-orange-600' }}">

                    <i class="bi bi-diagram-2 text-base"></i>

                </span>

                <span>Kegiatan</span>

            </a>


            {{-- Sub Kegiatan --}}
            <a href="{{ route('sadarin.admin.master.sub-kegiatan.index') }}"
                class="sidebar-link flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
        {{ request()->routeIs('sadarin.admin.master.sub-kegiatan.*')
            ? 'bg-[oklch(29.3%_0.136_325.661)] text-white shadow-sm'
            : 'text-slate-600 hover:bg-slate-100' }}">

                <span
                    class="flex h-9 w-9 items-center justify-center rounded-lg
            {{ request()->routeIs('sadarin.admin.master.sub-kegiatan.*')
                ? 'bg-white/15 text-white'
                : 'bg-emerald-50 text-emerald-600' }}">

                    <i class="bi bi-diagram-3-fill text-base"></i>

                </span>

                <span>Sub Kegiatan</span>

            </a>


            {{-- Jenis Dokumen --}}
            <a href="{{ route('sadarin.admin.master.document-type.index') }}"
                class="sidebar-link flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
        {{ request()->routeIs('sadarin.admin.master.document-type.*')
            ? 'bg-[oklch(29.3%_0.136_325.661)] text-white shadow-sm'
            : 'text-slate-600 hover:bg-slate-100' }}">

                <span
                    class="flex h-9 w-9 items-center justify-center rounded-lg
            {{ request()->routeIs('sadarin.admin.master.document-type.*')
                ? 'bg-white/15 text-white'
                : 'bg-violet-50 text-violet-600' }}">

                    <i class="bi bi-file-earmark-text-fill text-base"></i>

                </span>

                <span>Jenis Dokumen</span>

            </a>


            {{-- Tag --}}
            <a href="{{ route('sadarin.admin.master.tag.index') }}"
                class="sidebar-link flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
        {{ request()->routeIs('sadarin.admin.master.tag.*')
            ? 'bg-[oklch(29.3%_0.136_325.661)] text-white shadow-sm'
            : 'text-slate-600 hover:bg-slate-100' }}">

                <span
                    class="flex h-9 w-9 items-center justify-center rounded-lg
            {{ request()->routeIs('sadarin.admin.master.tag.*') ? 'bg-white/15 text-white' : 'bg-amber-50 text-amber-600' }}">

                    <i class="bi bi-tags-fill text-base"></i>

                </span>

                <span>Tag</span>

            </a>

        </nav>


        {{-- SISTEM --}}
        <div class="mb-3 mt-8 px-3 text-[11px] font-bold uppercase tracking-[0.16em] text-slate-400">
            Sistem
        </div>

        <nav class="space-y-1">

            <a href="{{ route('sadarin.admin.pengguna.index') }}"
                class="sidebar-link flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
    {{ request()->routeIs('sadarin.admin.pengguna.*')
        ? 'bg-[oklch(29.3%_0.136_325.661)] text-white shadow-sm'
        : 'text-slate-600 hover:bg-slate-100' }}">

                <span
                    class="flex h-9 w-9 items-center justify-center rounded-lg
        {{ request()->routeIs('sadarin.admin.pengguna.*') ? 'bg-white/15 text-white' : 'bg-violet-50 text-violet-600' }}">

                    <i class="bi bi-people-fill text-base"></i>

                </span>

                <span>Pengguna</span>

            </a>


            {{-- Role --}}
            <a href="{{ route('sadarin.admin.role.index') }}"
                class="sidebar-link flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
    {{ request()->routeIs('sadarin.admin.role.*')
        ? 'bg-[oklch(29.3%_0.136_325.661)] text-white shadow-sm'
        : 'text-slate-600 hover:bg-slate-100' }}">

                <span
                    class="flex h-9 w-9 items-center justify-center rounded-lg
        {{ request()->routeIs('sadarin.admin.role.*') ? 'bg-white/15 text-white' : 'bg-amber-50 text-amber-600' }}">

                    <i class="bi bi-people-fill text-base"></i>

                </span>

                <span>Role</span>

            </a>

            {{-- Permission --}}
            <a href="{{ route('sadarin.admin.permission.index') }}"
                class="sidebar-link flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
    {{ request()->routeIs('sadarin.admin.permission.*')
        ? 'bg-[oklch(29.3%_0.136_325.661)] text-white shadow-sm'
        : 'text-slate-600 hover:bg-slate-100' }}">

                <span
                    class="flex h-9 w-9 items-center justify-center rounded-lg
        {{ request()->routeIs('sadarin.admin.permission.*') ? 'bg-white/15 text-white' : 'bg-amber-50 text-amber-600' }}">

                    <i class="bi bi-people-fill text-base"></i>

                </span>

                <span>Permission</span>

            </a>


            {{-- Access Log --}}
            <a href="{{ route('sadarin.admin.access-log.index') }}"
                class="sidebar-link flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
    {{ request()->routeIs('sadarin.admin.access-log.*')
        ? 'bg-[oklch(29.3%_0.136_325.661)] text-white shadow-sm'
        : 'text-slate-600 hover:bg-slate-100' }}">

                <span
                    class="flex h-9 w-9 items-center justify-center rounded-lg
        {{ request()->routeIs('sadarin.admin.access-log.*') ? 'bg-white/15 text-white' : 'bg-amber-50 text-amber-600' }}">

                    <i class="bi bi-activity"></i>

                </span>

                <span>Akses Log</span>

            </a>


            {{-- Survey --}}
            <a href="{{ route('sadarin.admin.survey.index') }}"
                class="sidebar-link flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
    {{ request()->routeIs('sadarin.admin.survey.*')
        ? 'bg-[oklch(29.3%_0.136_325.661)] text-white shadow-sm'
        : 'text-slate-600 hover:bg-slate-100' }}">

                <span
                    class="flex h-9 w-9 items-center justify-center rounded-lg
        {{ request()->routeIs('sadarin.admin.survey.*') ? 'bg-white/15 text-white' : 'bg-amber-50 text-amber-600' }}">

                    <i class="bi bi-clipboard-check"></i>

                </span>

                <span>Survey</span>

            </a>


            {{-- Pengaturan --}}
            <a href="#"
                class="sidebar-link flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-600">

                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-600">
                    <i class="bi bi-gear-fill text-base"></i>
                </span>

                <span>Pengaturan</span>
            </a>

        </nav>

    </div>


    {{-- Bottom User --}}
    <div class="shrink-0 border-t border-slate-100 p-4">

        <div class="flex items-center gap-3 rounded-xl bg-slate-50 p-3">

            <div
                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[oklch(29.3%_0.136_325.661)] text-sm font-bold text-white">
                A
            </div>

            <div class="min-w-0 flex-1">
                <p class="truncate text-sm font-semibold text-slate-800">
                    Administrator
                </p>

                <p class="truncate text-xs text-slate-500">
                    Administrator
                </p>
            </div>

            <i class="bi bi-three-dots-vertical text-slate-400"></i>

        </div>


    </div>

</aside>
