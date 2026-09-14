<header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur">

    <div class="mx-auto flex h-[72px] max-w-7xl items-center justify-between px-5 sm:px-8">

        {{-- ============================================================
            BRAND
        ============================================================= --}}

        <div class="flex items-center">
            <img src="{{ asset('assets/images/logo-sadarin-full.png') }}" alt="SADARIN" class="h-16 w-auto object-contain">
        </div>


        {{-- ============================================================
            DESKTOP NAVIGATION
        ============================================================= --}}

        <nav class="hidden items-center gap-7 md:flex">

            <a href="{{ route('sadarin.home') }}"
                class="text-sm font-semibold text-sadarin-600 transition hover:text-sadarin-700">
                Beranda
            </a>


            <a href="#arsip" class="text-sm font-medium text-navy-500 transition hover:text-sadarin-600">
                Arsip
            </a>


            <a href="#klasifikasi" class="text-sm font-medium text-navy-500 transition hover:text-sadarin-600">
                Klasifikasi
            </a>


            <a href="#terbaru" class="text-sm font-medium text-navy-500 transition hover:text-sadarin-600">
                Terbaru
            </a>

        </nav>


        {{-- ============================================================
            USER AREA
        ============================================================= --}}

        <div class="flex items-center gap-3">

            {{-- User Information --}}
            <div class="hidden text-right sm:block">

                <div class="text-sm font-semibold text-navy-700">
                    {{ $userName ?? 'Pengguna' }}
                </div>

                <div class="text-[11px] text-navy-400">
                    {{ $userRole ?? 'Pegawai' }}
                </div>

            </div>


            {{-- Profile --}}
            <button type="button"
                class="flex h-10 w-10 items-center justify-center rounded-full bg-sadarin-50 text-sadarin-600 transition hover:bg-sadarin-100"
                title="Profil">
                <i class="bi bi-person text-lg"></i>
            </button>


            {{-- Logout --}}
            <form action="{{ route('sadarin.logout') }}" method="POST" class="hidden sm:block">
                @csrf

                <button type="submit"
                    class="flex h-10 w-10 items-center justify-center rounded-xl text-navy-400 transition hover:bg-red-50 hover:text-red-500"
                    title="Keluar">
                    <i class="bi bi-box-arrow-right text-lg"></i>
                </button>
            </form>


            {{-- Mobile Menu --}}
            <button type="button" id="mobileMenuButton"
                class="flex h-10 w-10 items-center justify-center rounded-xl text-navy-500 transition hover:bg-slate-50 md:hidden"
                aria-label="Buka menu">
                <i class="bi bi-list text-2xl"></i>
            </button>

        </div>

    </div>


    {{-- ============================================================
        MOBILE NAVIGATION
    ============================================================= --}}

    <div id="mobileMenu" class="hidden border-t border-slate-100 bg-white md:hidden">

        <div class="space-y-1 px-5 py-4">

            {{-- Beranda --}}
            <a href="{{ route('sadarin.home') }}"
                class="block rounded-lg bg-sadarin-50 px-4 py-3 text-sm font-semibold text-sadarin-600">
                <span class="flex items-center gap-3">
                    <i class="bi bi-house"></i>
                    Beranda
                </span>
            </a>


            {{-- Arsip --}}
            <a href="#arsip" class="block rounded-lg px-4 py-3 text-sm text-navy-500 transition hover:bg-slate-50">
                <span class="flex items-center gap-3">
                    <i class="bi bi-archive"></i>
                    Arsip
                </span>
            </a>


            {{-- Klasifikasi --}}
            <a href="#klasifikasi"
                class="block rounded-lg px-4 py-3 text-sm text-navy-500 transition hover:bg-slate-50">
                <span class="flex items-center gap-3">
                    <i class="bi bi-diagram-3"></i>
                    Klasifikasi
                </span>
            </a>


            {{-- Terbaru --}}
            <a href="#terbaru" class="block rounded-lg px-4 py-3 text-sm text-navy-500 transition hover:bg-slate-50">
                <span class="flex items-center gap-3">
                    <i class="bi bi-clock-history"></i>
                    Arsip Terbaru
                </span>
            </a>


            {{-- Divider --}}
            <div class="my-3 border-t border-slate-100"></div>


            {{-- User --}}
            <div class="flex items-center gap-3 px-4 py-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-sadarin-50 text-sadarin-600">
                    <i class="bi bi-person"></i>
                </div>


                <div>

                    <div class="text-sm font-semibold text-navy-700">
                        {{ $userName ?? 'Pengguna' }}
                    </div>

                    <div class="text-xs text-navy-400">
                        {{ $userRole ?? 'Pegawai' }}
                    </div>

                </div>

            </div>


            {{-- Logout --}}
            <form action="{{ route('sadarin.logout') }}" method="POST">
                @csrf

                <button type="submit"
                    class="flex w-full items-center gap-3 rounded-lg px-4 py-3 text-left text-sm text-red-500 transition hover:bg-red-50">
                    <i class="bi bi-box-arrow-right"></i>
                    Keluar
                </button>

            </form>

        </div>

    </div>

</header>
