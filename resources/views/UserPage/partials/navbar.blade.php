<header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur">

    <div class="mx-auto flex h-[72px] max-w-7xl items-center justify-between px-5 sm:px-8">

        {{-- ============================================================
            BRAND
        ============================================================= --}}

        <div class="flex items-center">

            <a href="{{ route('sadarin.user.archive.index') }}" class="flex items-center">

                <img
                    src="{{ asset('assets/images/logo-sadarin-full.png') }}"
                    alt="SADARIN"
                    class="h-16 w-auto object-contain"
                >

            </a>

        </div>


        {{-- ============================================================
            DESKTOP NAVIGATION
        ============================================================= --}}

        <nav class="hidden items-center gap-7 md:flex">

            <a
                href="{{ route('sadarin.user.archive.index') }}"
                class="text-sm font-semibold text-sadarin-600 transition hover:text-sadarin-700"
            >
                Beranda
            </a>


            <a
                href="#arsip"
                class="text-sm font-medium text-navy-500 transition hover:text-sadarin-600"
            >
                Arsip
            </a>


            <a
                href="#klasifikasi"
                class="text-sm font-medium text-navy-500 transition hover:text-sadarin-600"
            >
                Klasifikasi
            </a>


            <a
                href="#terbaru"
                class="text-sm font-medium text-navy-500 transition hover:text-sadarin-600"
            >
                Terbaru
            </a>

        </nav>


        {{-- ============================================================
            USER AREA
        ============================================================= --}}

        <div class="flex items-center gap-2 sm:gap-3">

            {{-- ========================================================
                USER DROPDOWN
            ========================================================= --}}

            <div class="relative">

                <details class="group">

                    {{-- USER BUTTON --}}
                    <summary
                        class="flex cursor-pointer list-none items-center gap-2 rounded-xl px-2 py-1.5 transition hover:bg-slate-50 sm:gap-3"
                    >

                        {{-- AVATAR --}}
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-sadarin-50 text-sm font-bold text-sadarin-600"
                        >

                            {{ strtoupper(substr(session('sadarin_user_nama', 'P'), 0, 1)) }}

                        </div>


                        {{-- USER INFO --}}
                        <div class="hidden text-left sm:block">

                            <p class="max-w-32 truncate text-sm font-semibold text-navy-700">

                                {{ session('sadarin_user_nama', 'Pengguna') }}

                            </p>

                            <p class="text-[11px] text-navy-400">

                                {{ session('sadarin_role_name', 'Pengguna Internal') }}

                            </p>

                        </div>


                        {{-- ARROW --}}
                        <i
                            class="bi bi-chevron-down text-xs text-slate-400 transition group-open:rotate-180"
                        ></i>

                    </summary>


                    {{-- =================================================
                        DROPDOWN
                    ================================================== --}}

                    <div
                        class="absolute right-0 z-50 mt-3 w-80 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl shadow-slate-900/10"
                    >

                        {{-- =================================================
                            PROFILE
                        ================================================== --}}

                        <div class="border-b border-slate-100 px-4 py-4">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-sadarin-50 text-sm font-bold text-sadarin-600"
                                >

                                    {{ strtoupper(substr(session('sadarin_user_nama', 'P'), 0, 1)) }}

                                </div>


                                <div class="min-w-0">

                                    <p class="truncate text-sm font-bold text-slate-800">

                                        {{ session('sadarin_user_nama', 'Pengguna') }}

                                    </p>

                                    <p class="mt-0.5 truncate text-xs text-slate-400">

                                        {{ session('sadarin_user_nip', '-') }}

                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                            ROLE SWITCHER
                        ================================================== --}}

                        <div class="p-2">

                            <div class="px-3 py-2">

                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    Role Aktif
                                </p>

                                <p class="mt-0.5 text-xs text-slate-500">
                                    Pilih role untuk melanjutkan
                                </p>

                            </div>


                            @forelse (session('sadarin_roles', []) as $role)

                                <form
                                    action="{{ route('sadarin.role.switch') }}"
                                    method="POST"
                                >

                                    @csrf

                                    <input
                                        type="hidden"
                                        name="role_id"
                                        value="{{ $role['id'] }}"
                                    >


                                    <button
                                        type="submit"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-3 text-left transition
                                        {{ session('sadarin_role_id') == $role['id']
                                            ? 'bg-sadarin-50'
                                            : 'hover:bg-slate-50' }}"
                                    >

                                        {{-- ROLE ICON --}}
                                        <div
                                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg
                                            {{ session('sadarin_role_id') == $role['id']
                                                ? 'bg-sadarin-600 text-white'
                                                : 'bg-slate-100 text-slate-500' }}"
                                        >

                                            @if ($role['name'] === 'Administrator')

                                                <i class="bi bi-shield-lock"></i>

                                            @elseif ($role['name'] === 'Arsiparis')

                                                <i class="bi bi-archive"></i>

                                            @elseif ($role['name'] === 'Pengguna Internal')

                                                <i class="bi bi-person"></i>

                                            @else

                                                <i class="bi bi-person-badge"></i>

                                            @endif

                                        </div>


                                        {{-- ROLE INFO --}}
                                        <div class="min-w-0 flex-1">

                                            <p
                                                class="text-sm font-semibold
                                                {{ session('sadarin_role_id') == $role['id']
                                                    ? 'text-sadarin-700'
                                                    : 'text-slate-700' }}"
                                            >

                                                {{ $role['name'] }}

                                            </p>


                                            @if (!empty($role['description']))

                                                <p class="mt-0.5 truncate text-[11px] text-slate-400">

                                                    {{ $role['description'] }}

                                                </p>

                                            @endif

                                        </div>


                                        {{-- ACTIVE --}}
                                        @if (session('sadarin_role_id') == $role['id'])

                                            <i class="bi bi-check-circle-fill text-sadarin-600"></i>

                                        @endif

                                    </button>

                                </form>

                            @empty

                                <div class="px-3 py-4 text-center text-xs text-slate-400">

                                    Tidak ada role yang tersedia.

                                </div>

                            @endforelse

                        </div>


                        {{-- =================================================
                            PROFILE / USER
                        ================================================== --}}

                        <div class="border-t border-slate-100 p-2">

                            <a
                                href="#"
                                class="flex items-center gap-3 rounded-xl px-3 py-3 transition hover:bg-slate-50"
                            >

                                <div
                                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-500"
                                >

                                    <i class="bi bi-person"></i>

                                </div>


                                <div>

                                    <p class="text-sm font-semibold text-slate-700">
                                        Profil
                                    </p>

                                    <p class="text-[11px] text-slate-400">
                                        Informasi akun
                                    </p>

                                </div>

                            </a>

                        </div>


                        {{-- =================================================
                            LOGOUT
                        ================================================== --}}

                        <div class="border-t border-slate-100 p-2">

                            <form
                                action="{{ route('sadarin.logout') }}"
                                method="POST"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-3 text-left transition hover:bg-rose-50"
                                >

                                    <div
                                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-rose-50 text-rose-500"
                                    >

                                        <i class="bi bi-box-arrow-right"></i>

                                    </div>


                                    <div>

                                        <p class="text-sm font-semibold text-slate-700">
                                            Keluar
                                        </p>

                                        <p class="text-[11px] text-slate-400">
                                            Keluar dari SADARIN
                                        </p>

                                    </div>

                                </button>

                            </form>

                        </div>

                    </div>

                </details>

            </div>


            {{-- ========================================================
                MOBILE MENU BUTTON
            ========================================================= --}}

            <button
                type="button"
                id="mobileMenuButton"
                class="flex h-10 w-10 items-center justify-center rounded-xl text-navy-500 transition hover:bg-slate-50 md:hidden"
                aria-label="Buka menu"
            >

                <i class="bi bi-list text-2xl"></i>

            </button>

        </div>

    </div>


    {{-- ============================================================
        MOBILE NAVIGATION
    ============================================================= --}}

    <div
        id="mobileMenu"
        class="hidden border-t border-slate-100 bg-white md:hidden"
    >

        <div class="space-y-1 px-5 py-4">

            {{-- BERANDA --}}
            <a
                href="{{ route('sadarin.user.archive.index') }}"
                class="block rounded-lg bg-sadarin-50 px-4 py-3 text-sm font-semibold text-sadarin-600"
            >

                <span class="flex items-center gap-3">

                    <i class="bi bi-house"></i>

                    Beranda

                </span>

            </a>


            {{-- ARSIP --}}
            <a
                href="#arsip"
                class="block rounded-lg px-4 py-3 text-sm text-navy-500 transition hover:bg-slate-50"
            >

                <span class="flex items-center gap-3">

                    <i class="bi bi-archive"></i>

                    Arsip

                </span>

            </a>


            {{-- KLASIFIKASI --}}
            <a
                href="#klasifikasi"
                class="block rounded-lg px-4 py-3 text-sm text-navy-500 transition hover:bg-slate-50"
            >

                <span class="flex items-center gap-3">

                    <i class="bi bi-diagram-3"></i>

                    Klasifikasi

                </span>

            </a>


            {{-- TERBARU --}}
            <a
                href="#terbaru"
                class="block rounded-lg px-4 py-3 text-sm text-navy-500 transition hover:bg-slate-50"
            >

                <span class="flex items-center gap-3">

                    <i class="bi bi-clock-history"></i>

                    Arsip Terbaru

                </span>

            </a>


            <div class="my-3 border-t border-slate-100"></div>


            {{-- ========================================================
                ROLE DI MOBILE
            ========================================================= --}}

            <div class="px-4 py-2">

                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                    Role
                </p>

            </div>


            @foreach (session('sadarin_roles', []) as $role)

                <form
                    action="{{ route('sadarin.role.switch') }}"
                    method="POST"
                >

                    @csrf

                    <input
                        type="hidden"
                        name="role_id"
                        value="{{ $role['id'] }}"
                    >


                    <button
                        type="submit"
                        class="flex w-full items-center gap-3 rounded-lg px-4 py-3 text-left transition
                        {{ session('sadarin_role_id') == $role['id']
                            ? 'bg-sadarin-50 text-sadarin-700'
                            : 'text-navy-500 hover:bg-slate-50' }}"
                    >

                        @if ($role['name'] === 'Administrator')

                            <i class="bi bi-shield-lock"></i>

                        @elseif ($role['name'] === 'Arsiparis')

                            <i class="bi bi-archive"></i>

                        @elseif ($role['name'] === 'Pengguna Internal')

                            <i class="bi bi-person"></i>

                        @else

                            <i class="bi bi-person-badge"></i>

                        @endif


                        <span class="flex-1 text-sm font-medium">

                            {{ $role['name'] }}

                        </span>


                        @if (session('sadarin_role_id') == $role['id'])

                            <i class="bi bi-check-circle-fill text-sadarin-600"></i>

                        @endif

                    </button>

                </form>

            @endforeach


            <div class="my-3 border-t border-slate-100"></div>


            {{-- USER --}}
            <div class="flex items-center gap-3 px-4 py-3">

                <div
                    class="flex h-10 w-10 items-center justify-center rounded-full bg-sadarin-50 text-sadarin-600"
                >

                    <i class="bi bi-person"></i>

                </div>


                <div>

                    <div class="text-sm font-semibold text-navy-700">

                        {{ session('sadarin_user_nama', 'Pengguna') }}

                    </div>

                    <div class="text-xs text-navy-400">

                        {{ session('sadarin_role_name', 'Pengguna Internal') }}

                    </div>

                </div>

            </div>


            {{-- LOGOUT --}}
            <form
                action="{{ route('sadarin.logout') }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="flex w-full items-center gap-3 rounded-lg px-4 py-3 text-left text-sm text-red-500 transition hover:bg-red-50"
                >

                    <i class="bi bi-box-arrow-right"></i>

                    Keluar

                </button>

            </form>

        </div>

    </div>

</header>