@php
    $errorCode = (string) ($code ?? '500');

    $errors = [
        '403' => [
            'title' => 'Akses Ditolak',
            'description' => 'Anda tidak memiliki izin untuk mengakses halaman ini.',
            'icon' => 'bi-shield-lock',
        ],

        '404' => [
            'title' => 'Halaman Tidak Ditemukan',
            'description' => 'Halaman yang Anda cari tidak tersedia atau mungkin telah dipindahkan.',
            'icon' => 'bi-compass',
        ],

        '419' => [
            'title' => 'Sesi Telah Berakhir',
            'description' => 'Sesi Anda telah berakhir. Silakan kembali dan coba lagi.',
            'icon' => 'bi-clock-history',
        ],

        '429' => [
            'title' => 'Terlalu Banyak Permintaan',
            'description' => 'Terlalu banyak permintaan dalam waktu singkat. Silakan coba beberapa saat lagi.',
            'icon' => 'bi-hourglass-split',
        ],

        '500' => [
            'title' => 'Terjadi Kesalahan',
            'description' => 'Sistem mengalami kendala saat memproses permintaan Anda. Silakan coba lagi.',
            'icon' => 'bi-exclamation-triangle',
        ],

        '503' => [
            'title' => 'Sistem Sedang Dipersiapkan',
            'description' => 'SADARIN sedang dalam pemeliharaan. Silakan coba kembali beberapa saat lagi.',
            'icon' => 'bi-tools',
        ],
    ];

    $currentError = $errors[$errorCode] ?? $errors['500'];
@endphp


<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        {{ $errorCode }} - {{ $currentError['title'] }} | SADARIN
    </title>

    <meta name="robots" content="noindex, nofollow">

    <link rel="icon" href="{{ asset('assets/images/logo-sadarin.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">


    <style>
        :root {

            --sadarin-burgundy: #7f1d3a;

            --sadarin-burgundy-dark: #68152f;

            --sadarin-burgundy-soft: #fdf0f4;

            --sadarin-orange: #f59e0b;

            --sadarin-text: #475569;

            --sadarin-border: #e2e8f0;

            --sadarin-bg: #faf7f8;

            --sadarin-navy: #3b1625;

        }


        * {
            box-sizing: border-box;
        }


        html,
        body {

            width: 100%;

            min-height: 100%;

        }


        body {

            margin: 0;

            min-height: 100vh;

            font-family: 'Inter', sans-serif;

            color: var(--sadarin-navy);

            background:

                radial-gradient(circle at 8% 12%,
                    rgba(127, 29, 58, .08),
                    transparent 27%),

                radial-gradient(circle at 92% 88%,
                    rgba(245, 158, 11, .06),
                    transparent 27%),

                var(--sadarin-bg);

        }


        /* ============================================================
           ERROR PAGE
        ============================================================ */

        .sadarin-error-page {

            min-height: 100vh;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 30px 20px;

        }


        .sadarin-error-wrapper {

            width: 100%;

            max-width: 650px;

            text-align: center;

        }


        /* ============================================================
           LOGO
        ============================================================ */

        .sadarin-error-logo {

            display: block;

            width: 250px;

            max-width: 75%;

            height: auto;

            margin: 0 auto 28px;

            object-fit: contain;

        }


        /* ============================================================
           CARD
        ============================================================ */

        .sadarin-error-card {

            position: relative;

            overflow: hidden;

            background: #ffffff;

            border: 1px solid var(--sadarin-border);

            border-radius: 20px;

            padding: 42px 35px 38px;

            box-shadow:

                0 18px 50px rgba(80, 25, 45, .08);

        }


        .sadarin-error-card::before {

            content: '';

            position: absolute;

            top: 0;

            left: 0;

            right: 0;

            height: 4px;

            background:

                linear-gradient(90deg,
                    var(--sadarin-burgundy),
                    var(--sadarin-orange));

        }


        /* ============================================================
           ICON
        ============================================================ */

        .sadarin-error-icon {

            width: 66px;

            height: 66px;

            margin: 0 auto 20px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 18px;

            background: var(--sadarin-burgundy-soft);

            color: var(--sadarin-burgundy);

            font-size: 29px;

        }


        /* ============================================================
           ERROR CODE
        ============================================================ */

        .sadarin-error-code {

            margin-bottom: 12px;

            color: var(--sadarin-burgundy);

            font-size: 68px;

            line-height: 1;

            font-weight: 800;

            letter-spacing: -4px;

        }


        /* ============================================================
           LINE
        ============================================================ */

        .sadarin-error-line {

            width: 70px;

            height: 3px;

            margin: 21px auto 0;

            border-radius: 10px;

            background:

                linear-gradient(90deg,
                    var(--sadarin-burgundy),
                    var(--sadarin-orange));

        }


        /* ============================================================
           TITLE
        ============================================================ */

        .sadarin-error-title {

            margin: 20px 0 0;

            color: var(--sadarin-navy);

            font-size: 25px;

            line-height: 1.3;

            font-weight: 800;

        }


        /* ============================================================
           DESCRIPTION
        ============================================================ */

        .sadarin-error-description {

            max-width: 490px;

            margin: 12px auto 0;

            color: var(--sadarin-text);

            font-size: 14px;

            line-height: 1.7;

        }


        /* ============================================================
           BUTTON AREA
        ============================================================ */

        .sadarin-error-actions {

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 10px;

            margin-top: 27px;

        }


        /* ============================================================
           BUTTON
        ============================================================ */

        .sadarin-error-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            min-height: 42px;

            padding: 0 18px;

            border: 0;

            border-radius: 9px;

            background: var(--sadarin-burgundy);

            color: #ffffff;

            font-size: 13px;

            font-weight: 700;

            text-decoration: none;

            transition: .2s ease;

        }


        .sadarin-error-button:hover {

            background: var(--sadarin-burgundy-dark);

            color: #ffffff;

            transform: translateY(-1px);

        }


        /* ============================================================
           SECONDARY BUTTON
        ============================================================ */

        .sadarin-error-button-secondary {

            background: #ffffff;

            color: var(--sadarin-text);

            border: 1px solid var(--sadarin-border);

        }


        .sadarin-error-button-secondary:hover {

            background: var(--sadarin-burgundy-soft);

            color: var(--sadarin-burgundy);

            border-color: #e8b8c7;

        }


        /* ============================================================
           FOOTER
        ============================================================ */

        .sadarin-error-footer {

            margin-top: 22px;

            color: #718096;

            font-size: 11px;

            line-height: 1.6;

        }


        .sadarin-error-footer strong {

            color: var(--sadarin-burgundy);

            font-weight: 800;

        }


        /* ============================================================
           MOBILE
        ============================================================ */

        @media (max-width: 600px) {

            .sadarin-error-page {

                padding: 20px 14px;

            }


            .sadarin-error-logo {

                width: 195px;

                margin-bottom: 22px;

            }


            .sadarin-error-card {

                padding: 34px 20px 30px;

                border-radius: 16px;

            }


            .sadarin-error-icon {

                width: 58px;

                height: 58px;

                border-radius: 15px;

                font-size: 25px;

            }


            .sadarin-error-code {

                font-size: 58px;

                letter-spacing: -3px;

            }


            .sadarin-error-title {

                font-size: 21px;

            }


            .sadarin-error-description {

                font-size: 13px;

            }


            .sadarin-error-actions {

                flex-direction: column;

            }


            .sadarin-error-button {

                width: 100%;

            }


            .sadarin-error-footer {

                font-size: 10px;

            }

        }
    </style>

</head>


<body>


    <main class="sadarin-error-page">


        <div class="sadarin-error-wrapper">


            {{-- ========================================================
                LOGO SADARIN
            ========================================================= --}}

            <img src="{{ asset('assets/images/logo-sadarin.png') }}" class="sadarin-error-logo" alt="SADARIN">


            {{-- ========================================================
                ERROR CARD
            ========================================================= --}}

            <section class="sadarin-error-card">


                {{-- ICON --}}

                <div class="sadarin-error-icon">

                    <i class="bi {{ $currentError['icon'] }}"></i>

                </div>


                {{-- ERROR CODE --}}

                <div class="sadarin-error-code">

                    {{ $errorCode }}

                </div>


                {{-- LINE --}}

                <div class="sadarin-error-line"></div>


                {{-- TITLE --}}

                <h1 class="sadarin-error-title">

                    {{ $currentError['title'] }}

                </h1>


                {{-- DESCRIPTION --}}

                <p class="sadarin-error-description">

                    {{ $currentError['description'] }}

                </p>


                {{-- ACTIONS --}}

                <div class="sadarin-error-actions">


                    {{-- HOME --}}

                    <a href="{{ url('/') }}" class="sadarin-error-button">

                        <i class="bi bi-house"></i>

                        Kembali ke Beranda

                    </a>


                    {{-- BACK --}}

                    <a href="javascript:history.back()" class="sadarin-error-button sadarin-error-button-secondary">

                        <i class="bi bi-arrow-left"></i>

                        Kembali

                    </a>


                </div>


            </section>


            {{-- ========================================================
                FOOTER
            ========================================================= --}}

            <div class="sadarin-error-footer">

                &copy; {{ date('Y') }}

                <strong>SADARIN</strong>.

                Dinas Kebudayaan Provinsi Bali.

            </div>


        </div>


    </main>


</body>

</html>
