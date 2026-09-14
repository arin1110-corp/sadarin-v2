<header class="sticky top-0 z-40 border-b border-slate-200 bg-white/95 backdrop-blur">

    <div class="flex h-20 items-center justify-between px-4 sm:px-6 lg:px-8">

        {{-- Left --}}
        <div class="flex items-center gap-3">

            {{-- Mobile Menu --}}
            <button type="button" onclick="toggleSidebar()"
                class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 lg:hidden">
                <i class="bi bi-list text-xl"></i>
            </button>


            {{-- Page Title --}}
            <div>

                <p class="text-xs font-medium text-slate-400">
                    SADARIN
                </p>

                <h1 class="text-lg font-bold text-slate-800 sm:text-xl">
                    Dashboard {{ session('sadarin_role_name', 'Admin') }}
                </h1>

            </div>

        </div>


        {{-- Right --}}
        <div class="flex items-center gap-2 sm:gap-4">

            {{-- Search --}}
            <button type="button"
                class="hidden h-10 items-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm text-slate-400 hover:bg-white hover:text-slate-600 md:flex">

                <i class="bi bi-search"></i>

                <span>
                    Cari...
                </span>

                <span
                    class="ml-4 rounded-md border border-slate-200 bg-white px-1.5 py-0.5 text-[10px] font-semibold text-slate-400">
                    /
                </span>

            </button>


            {{-- Notification --}}
            <button type="button"
                class="relative flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 text-slate-500 hover:bg-slate-50">

                <i class="bi bi-bell text-lg"></i>

                <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-rose-500"></span>

            </button>


            {{-- Divider --}}
            <div class="hidden h-8 w-px bg-slate-200 sm:block"></div>


            {{-- User + Role --}}
            <div class="relative">

                <details class="group">

                    {{-- User Button --}}
                    <summary
                        class="flex cursor-pointer list-none items-center gap-3 rounded-xl px-2 py-1.5 transition hover:bg-slate-50">

                        {{-- Avatar --}}
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[oklch(29.3%_0.136_325.661)] text-sm font-bold text-white">
                            {{ strtoupper(substr(session('sadarin_user_nama', 'U'), 0, 1)) }}
                        </div>


                        {{-- User Information --}}
                        <div class="hidden text-left lg:block">

                            <p class="max-w-32 truncate text-sm font-semibold text-slate-800">
                                {{ session('sadarin_user_nama', 'Pengguna') }}
                            </p>

                            <p class="text-xs text-slate-400">
                                {{ session('sadarin_role_name', 'Pengguna') }}
                            </p>

                        </div>


                        {{-- Arrow --}}
                        <i class="bi bi-chevron-down text-xs text-slate-400 transition group-open:rotate-180"></i>

                    </summary>


                    {{-- Dropdown --}}
                    <div
                        class="absolute right-0 z-50 mt-3 w-72 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl shadow-slate-900/10">

                        {{-- Profile --}}
                        <div class="border-b border-slate-100 px-4 py-4">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-[oklch(29.3%_0.136_325.661)] text-sm font-bold text-white">
                                    {{ strtoupper(substr(session('sadarin_user_nama', 'U'), 0, 1)) }}
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


                        {{-- Role Switcher --}}
                        <div class="p-2">

                            <div class="px-3 py-2">

                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    Role Aktif
                                </p>

                                <p class="mt-0.5 text-xs text-slate-500">
                                    Pilih role untuk melanjutkan
                                </p>

                            </div>


                            @foreach (session('sadarin_roles', []) as $role)
                                <form action="{{ route('sadarin.role.switch') }}" method="POST">

                                    @csrf

                                    <input type="hidden" name="role_id" value="{{ $role['id'] }}">


                                    <button type="submit"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-3 text-left transition
                                        {{ session('sadarin_role_id') == $role['id'] ? 'bg-[oklch(29.3%_0.136_325.661)]/10' : 'hover:bg-slate-50' }}">

                                        {{-- Role Icon --}}
                                        <div
                                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg
                                            {{ session('sadarin_role_id') == $role['id']
                                                ? 'bg-[oklch(29.3%_0.136_325.661)] text-white'
                                                : 'bg-slate-100 text-slate-500' }}">

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


                                        {{-- Role Name --}}
                                        <div class="min-w-0 flex-1">

                                            <p
                                                class="text-sm font-semibold
                                                {{ session('sadarin_role_id') == $role['id'] ? 'text-[oklch(29.3%_0.136_325.661)]' : 'text-slate-700' }}">
                                                {{ $role['name'] }}
                                            </p>

                                            @if (!empty($role['description']))
                                                <p class="mt-0.5 truncate text-[11px] text-slate-400">
                                                    {{ $role['description'] }}
                                                </p>
                                            @endif

                                        </div>


                                        {{-- Active --}}
                                        @if (session('sadarin_role_id') == $role['id'])
                                            <i class="bi bi-check-circle-fill text-[oklch(29.3%_0.136_325.661)]"></i>
                                        @endif

                                    </button>

                                </form>
                            @endforeach

                        </div>


                        {{-- Logout --}}
                        <div class="border-t border-slate-100 p-2">

                            <form action="{{ route('sadarin.logout') }}" method="POST">

                                @csrf

                                <button type="submit"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-3 text-left transition hover:bg-rose-50">

                                    <div
                                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-rose-50 text-rose-500">
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

        </div>

    </div>

</header>
