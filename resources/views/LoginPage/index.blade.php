@extends('LoginPage.layouts.app')

@section('title', 'Masuk - SADARIN')

@section('content')

    <div class="min-h-screen bg-white">

        <div class="min-h-screen flex flex-col lg:flex-row">

            {{-- ============================================================
             LEFT SIDE
        ============================================================= --}}

            <section class="relative hidden lg:flex lg:w-[40%] xl:w-[39%] min-h-screen overflow-hidden bg-slate-50">

                {{-- Background --}}
                <div class="absolute inset-0">

                    <div class="absolute inset-0 bg-cover bg-center"
                        style="
                        background-image:
                            url('/images/sadarin/login-bali.jpg');
                    ">
                    </div>

                    {{-- White overlay --}}
                    <div
                        class="absolute inset-0 bg-gradient-to-b
                    from-white/95
                    via-white/80
                    to-white/30">
                    </div>

                    {{-- Soft right fade --}}
                    <div
                        class="absolute inset-y-0 right-0 w-32
                    bg-gradient-to-l
                    from-white
                    via-white/30
                    to-transparent">
                    </div>

                </div>


                {{-- Content --}}
                <div class="relative z-10 flex flex-col w-full min-h-screen">

                    {{-- ====================================================
                     BRAND
                ===================================================== --}}

                    <div class="px-12 xl:px-16 pt-12">

                        <div class="flex items-center gap-4">

                            {{-- Logo icon --}}
                            <div class="relative w-[58px] h-[66px] shrink-0">

                                {{-- Back document --}}
                                <div
                                    class="absolute top-0 left-3
                                w-[42px] h-[54px]
                                rounded-[6px]
                                bg-gradient-to-br
                                from-sky-400
                                to-blue-600
                                shadow-sm">

                                    <div class="absolute right-0 top-0
                                    w-[15px] h-[15px]
                                    bg-sky-200/80"
                                        style="
                                        clip-path:
                                        polygon(
                                            0 0,
                                            100% 100%,
                                            100% 0
                                        );
                                    ">
                                    </div>

                                </div>


                                {{-- Front document --}}
                                <div
                                    class="absolute left-0 top-[28px]
                                w-[44px] h-[54px]
                                rounded-[6px]
                                bg-gradient-to-br
                                from-blue-500
                                to-blue-700
                                shadow-md">

                                    <div
                                        class="absolute top-[24px] left-[12px]
                                    w-[20px] h-[4px]
                                    rounded-full
                                    bg-blue-400/70">
                                    </div>

                                    <div
                                        class="absolute top-[32px] left-[12px]
                                    w-[14px] h-[4px]
                                    rounded-full
                                    bg-blue-400/50">
                                    </div>

                                </div>

                            </div>


                            {{-- Brand text --}}
                            <div>

                                <div
                                    class="text-[42px] leading-none
                                font-extrabold
                                tracking-[-2px]
                                text-navy-900">
                                    SADAR<span class="text-sadarin-500">IN</span>
                                </div>

                                <div
                                    class="mt-2
                                text-[14px]
                                leading-5
                                tracking-[0.8px]
                                text-navy-500">
                                    Sistem Arsip Digital Internal
                                    <br>
                                    Dinas Kebudayaan Provinsi Bali
                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- ====================================================
                     HERO TEXT
                ===================================================== --}}

                    <div class="px-12 xl:px-16
                    mt-20
                    xl:mt-24">

                        <div
                            class="w-12 h-1
                        rounded-full
                        bg-sadarin-500
                        mb-12">
                        </div>


                        <h1
                            class="text-[48px]
                        xl:text-[54px]
                        leading-[1.1]
                        font-light
                        tracking-[-2px]
                        text-navy-800">
                            Arsip
                            <br>
                            untuk
                            <br>
                            Masa Depan
                        </h1>


                        <p
                            class="mt-7
                        max-w-[370px]
                        text-[19px]
                        leading-7
                        text-navy-500">
                            Dokumen hari ini,
                            <br>
                            warisan untuk generasi mendatang.
                        </p>

                    </div>


                    {{-- ====================================================
                     BOTTOM PHRASE
                ===================================================== --}}

                    <div class="mt-auto
                    px-12 xl:px-16
                    pb-16">

                        <div
                            class="ml-[225px]
                        text-[11px]
                        leading-7
                        tracking-[5px]
                        uppercase
                        text-navy-600">
                            <div>BUDAYA</div>
                            <div>IDENTITAS</div>
                            <div>KEBERLANJUTAN</div>
                        </div>

                    </div>


                    {{-- ====================================================
                     LEFT FOOTER
                ===================================================== --}}

                    <div
                        class="absolute
                    bottom-0
                    left-0
                    right-0
                    px-12 xl:px-16
                    py-7
                    bg-white/65
                    backdrop-blur-sm">

                        <div
                            class="flex items-center
                        gap-3
                        text-[13px]
                        text-navy-500">

                            <span>SADARIN</span>

                            <span class="text-slate-300">|</span>

                            <span>
                                Dinas Kebudayaan Provinsi Bali
                            </span>

                        </div>

                    </div>

                </div>

            </section>


            {{-- ============================================================
             RIGHT SIDE
        ============================================================= --}}

            <section class="relative flex-1 min-h-screen
            bg-white
            flex flex-col">

                {{-- ========================================================
                 TOP RIGHT
            ========================================================= --}}

                <div
                    class="absolute
                top-0
                right-0
                px-8
                lg:px-12
                py-8">

                    <button type="button"
                        class="group
                    flex items-center gap-3
                    text-[15px]
                    font-medium
                    text-navy-500
                    hover:text-sadarin-600
                    transition">

                        <span
                            class="flex items-center justify-center
                        w-[22px] h-[22px]
                        rounded-full
                        bg-navy-500
                        text-white">
                            <i class="bi bi-info text-[13px]"></i>
                        </span>

                        <span>Tentang SADARIN</span>

                    </button>

                </div>


                {{-- ========================================================
                 LOGIN WRAPPER
            ========================================================= --}}

                <div
                    class="flex-1
                flex items-center justify-center
                px-5
                sm:px-8
                pt-20
                pb-8">

                    <div class="w-full
                    max-w-[690px]">

                        {{-- =================================================
                         LOGIN CARD
                    ================================================== --}}

                        <div
                            class="rounded-[18px]
                        border border-slate-200/80
                        bg-white
                        shadow-panel
                        px-7
                        sm:px-10
                        lg:px-9
                        py-9
                        sm:py-11">

                            {{-- Heading --}}
                            <div class="text-center">

                                <h2
                                    class="text-[34px]
                                sm:text-[40px]
                                leading-tight
                                font-bold
                                tracking-[-1.5px]
                                text-navy-900">
                                    Masuk ke
                                    <span class="text-sadarin-500">
                                        SADARIN
                                    </span>
                                </h2>

                                <p
                                    class="mt-3
                                text-[16px]
                                text-navy-500">
                                    Pilih jenis akses untuk melanjutkan.
                                </p>

                            </div>


                            {{-- =================================================
                             LOGIN TYPE
                        ================================================== --}}

                            <div
                                class="mt-8
                            grid grid-cols-2
                            gap-2">

                                <button type="button" data-login-type="internal"
                                    class="
                                    h-[60px]
                                    rounded-[10px]
                                    border
                                    border-transparent
                                    flex items-center
                                    justify-center
                                    gap-3
                                    text-[16px]
                                    font-semibold
                                    transition-all
                                ">

                                    <i class="bi bi-person-fill text-[23px]"></i>

                                    <span>Pegawai</span>

                                </button>


                                <button type="button" data-login-type="public"
                                    class="
                                    h-[60px]
                                    rounded-[10px]
                                    border
                                    border-slate-200
                                    bg-white
                                    text-navy-500
                                    flex items-center
                                    justify-center
                                    gap-3
                                    text-[16px]
                                    font-semibold
                                    transition-all
                                ">

                                    <i class="bi bi-globe2 text-[22px]"></i>

                                    <span>Publik</span>

                                </button>

                            </div>


                            {{-- =================================================
                             ALERT SUCCESS
                        ================================================== --}}

                            @if (session('success'))
                                <div
                                    class="mt-6
                                rounded-xl
                                border border-emerald-200
                                bg-emerald-50
                                px-4 py-3
                                text-sm
                                text-emerald-700">

                                    <div class="flex gap-3">

                                        <i class="bi bi-check-circle-fill"></i>

                                        <span>
                                            {{ session('success') }}
                                        </span>

                                    </div>

                                </div>
                            @endif


                            {{-- =================================================
                             ALERT ERROR
                        ================================================== --}}

                            @if (session('error'))
                                <div
                                    class="mt-6
                                rounded-xl
                                border border-red-200
                                bg-red-50
                                px-4 py-3
                                text-sm
                                text-red-700">

                                    <div class="flex gap-3">

                                        <i class="bi bi-exclamation-circle-fill"></i>

                                        <span>
                                            {{ session('error') }}
                                        </span>

                                    </div>

                                </div>
                            @endif


                            {{-- =================================================
                             VALIDATION ERROR
                        ================================================== --}}

                            @if ($errors->any())

                                <div
                                    class="mt-6
                                rounded-xl
                                border border-red-200
                                bg-red-50
                                px-4 py-3
                                text-sm
                                text-red-700">

                                    <div class="flex gap-3">

                                        <i class="bi bi-exclamation-circle-fill"></i>

                                        <div>

                                            @foreach ($errors->all() as $error)
                                                <div>
                                                    {{ $error }}
                                                </div>
                                            @endforeach

                                        </div>

                                    </div>

                                </div>

                            @endif


                            {{-- =================================================
                             INTERNAL LOGIN
                        ================================================== --}}

                            <form method="POST" action="{{ route('sadarin.login.internal') }}" data-login-form="internal"
                                class="mt-8">

                                @csrf


                                {{-- Identifier --}}
                                <div
                                    class="flex
                                h-[62px]
                                rounded-[10px]
                                border
                                border-slate-300
                                bg-white
                                overflow-hidden
                                focus-within:border-sadarin-500
                                focus-within:ring-4
                                focus-within:ring-sadarin-500/10
                                transition">

                                    <div
                                        class="w-[64px]
                                    shrink-0
                                    flex items-center justify-center
                                    border-r
                                    border-slate-200
                                    text-navy-400">

                                        <i class="bi bi-person-fill text-[22px]"></i>

                                    </div>

                                    <input type="text" name="identifier" value="{{ old('identifier') }}"
                                        placeholder="NIP, NIK, atau Email Dinas" autocomplete="username"
                                        class="flex-1
                                    min-w-0
                                    px-5
                                    outline-none
                                    bg-transparent
                                    text-[16px]
                                    text-navy-700
                                    placeholder:text-navy-400">

                                </div>


                                {{-- OTP --}}
                                <div
                                    class="mt-5
                                flex
                                h-[62px]
                                rounded-[10px]
                                border
                                border-slate-300
                                bg-white
                                overflow-hidden
                                focus-within:border-sadarin-500
                                focus-within:ring-4
                                focus-within:ring-sadarin-500/10
                                transition">

                                    <div
                                        class="w-[64px]
                                    shrink-0
                                    flex items-center justify-center
                                    border-r
                                    border-slate-200
                                    text-navy-400">

                                        <i class="bi bi-lock-fill text-[21px]"></i>

                                    </div>


                                    <input type="text" name="otp" inputmode="numeric" maxlength="6"
                                        placeholder="Kode OTP" autocomplete="one-time-code"
                                        class="flex-1
                                    min-w-0
                                    px-5
                                    outline-none
                                    bg-transparent
                                    text-[16px]
                                    text-navy-700
                                    placeholder:text-navy-400">


                                    <button type="button"
                                        class="px-5
                                    font-semibold
                                    text-sadarin-600
                                    hover:text-sadarin-700
                                    whitespace-nowrap
                                    transition">
                                        Kirim OTP
                                    </button>

                                </div>


                                {{-- Submit --}}
                                <button type="submit"
                                    class="
                                    mt-10
                                    w-full
                                    h-[61px]
                                    rounded-[10px]
                                    bg-gradient-to-r
                                    from-sadarin-500
                                    to-blue-600
                                    hover:from-sadarin-600
                                    hover:to-blue-700
                                    text-white
                                    text-[18px]
                                    font-semibold
                                    shadow-sm
                                    flex items-center
                                    justify-center
                                    gap-4
                                    transition-all
                                ">

                                    <span>Masuk</span>

                                    <i class="bi bi-arrow-right text-[24px]"></i>

                                </button>

                            </form>


                            {{-- =================================================
                             PUBLIC LOGIN
                        ================================================== --}}

                            <form method="POST" action="{{ route('sadarin.login.public') }}" data-login-form="public"
                                class="hidden mt-8">

                                @csrf


                                {{-- Email --}}
                                <div
                                    class="
                                    flex
                                    h-[62px]
                                    rounded-[10px]
                                    border
                                    border-slate-300
                                    bg-white
                                    overflow-hidden
                                    focus-within:border-sadarin-500
                                    focus-within:ring-4
                                    focus-within:ring-sadarin-500/10
                                    transition
                                ">

                                    <div
                                        class="
                                        w-[64px]
                                        shrink-0
                                        flex
                                        items-center
                                        justify-center
                                        border-r
                                        border-slate-200
                                        text-navy-400
                                    ">

                                        <i class="bi bi-envelope-fill text-[21px]"></i>

                                    </div>


                                    <input type="email" name="email" value="{{ old('email') }}"
                                        placeholder="Alamat email" autocomplete="email"
                                        class="
                                        flex-1
                                        min-w-0
                                        px-5
                                        outline-none
                                        bg-transparent
                                        text-[16px]
                                        text-navy-700
                                        placeholder:text-navy-400
                                    ">

                                </div>


                                {{-- OTP --}}
                                <div
                                    class="
                                    mt-5
                                    flex
                                    h-[62px]
                                    rounded-[10px]
                                    border
                                    border-slate-300
                                    bg-white
                                    overflow-hidden
                                    focus-within:border-sadarin-500
                                    focus-within:ring-4
                                    focus-within:ring-sadarin-500/10
                                    transition
                                ">

                                    <div
                                        class="
                                        w-[64px]
                                        shrink-0
                                        flex
                                        items-center
                                        justify-center
                                        border-r
                                        border-slate-200
                                        text-navy-400
                                    ">

                                        <i class="bi bi-lock-fill text-[21px]"></i>

                                    </div>


                                    <input type="text" name="otp" inputmode="numeric" maxlength="6"
                                        placeholder="Kode OTP" autocomplete="one-time-code"
                                        class="
                                        flex-1
                                        min-w-0
                                        px-5
                                        outline-none
                                        bg-transparent
                                        text-[16px]
                                        text-navy-700
                                        placeholder:text-navy-400
                                    ">


                                    <button type="button"
                                        class="
                                        px-5
                                        font-semibold
                                        text-sadarin-600
                                        hover:text-sadarin-700
                                        whitespace-nowrap
                                        transition
                                    ">
                                        Kirim OTP
                                    </button>

                                </div>


                                {{-- Submit --}}
                                <button type="submit"
                                    class="
                                    mt-10
                                    w-full
                                    h-[61px]
                                    rounded-[10px]
                                    bg-gradient-to-r
                                    from-sadarin-500
                                    to-blue-600
                                    hover:from-sadarin-600
                                    hover:to-blue-700
                                    text-white
                                    text-[18px]
                                    font-semibold
                                    shadow-sm
                                    flex items-center
                                    justify-center
                                    gap-4
                                    transition-all
                                ">

                                    <span>Masuk</span>

                                    <i class="bi bi-arrow-right text-[24px]"></i>

                                </button>

                            </form>


                            {{-- =================================================
                             SECURITY INFO
                        ================================================== --}}

                            <div
                                class="
                                mt-8
                                pt-6
                                border-t
                                border-slate-200
                            ">

                                <div
                                    class="
                                    flex
                                    items-start
                                    justify-center
                                    gap-3
                                    text-center
                                    text-[13px]
                                    leading-5
                                    text-navy-500
                                ">

                                    <i
                                        class="
                                        bi
                                        bi-info-circle-fill
                                        shrink-0
                                        text-[19px]
                                        text-navy-400
                                    "></i>

                                    <p>
                                        Kode OTP akan dikirim ke email
                                        yang terdaftar di SAMPERIN.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ========================================================
                 RIGHT FOOTER
            ========================================================= --}}

                <footer
                    class="
                    px-6
                    pb-7
                    text-center
                ">

                    <p
                        class="
                        text-[13px]
                        text-navy-500
                    ">
                        © {{ date('Y') }} SADARIN
                        <span class="mx-1 text-slate-300">—</span>
                        Dinas Kebudayaan Provinsi Bali
                    </p>

                    <p
                        class="
                        mt-2
                        text-[13px]
                        text-navy-500
                    ">
                        Arsip
                        <span class="mx-2 text-slate-300">•</span>
                        Akses
                        <span class="mx-2 text-slate-300">•</span>
                        Pengetahuan
                        <span class="mx-2 text-slate-300">•</span>
                        Masa Depan
                    </p>

                </footer>

            </section>

        </div>

    </div>

@endsection
