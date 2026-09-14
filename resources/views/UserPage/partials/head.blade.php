<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="icon" href="{{ asset('assets/images/logo-sadarin.png') }}" type="image/x-icon">

<meta name="description" content="@yield('meta_description', 'SADARIN - Sistem Arsip Data dan Berkas Internal')">

<title>
    @yield('title', 'SADARIN')
</title>

<script src="https://cdn.tailwindcss.com"></script>

<script>
    tailwind.config = {
        theme: {
            extend: {

                fontFamily: {
                    sans: [
                        'Inter',
                        'ui-sans-serif',
                        'system-ui',
                        'sans-serif'
                    ],
                },

                colors: {
                    sadarin: {
                        50: 'oklch(97.5% 0.015 325.661)',
                        100: 'oklch(94.5% 0.028 325.661)',
                        200: 'oklch(88.5% 0.055 325.661)',
                        300: 'oklch(79% 0.085 325.661)',
                        400: 'oklch(66% 0.115 325.661)',
                        500: 'oklch(50% 0.136 325.661)',
                        600: 'oklch(42% 0.136 325.661)',
                        700: 'oklch(35% 0.136 325.661)',
                        800: 'oklch(31% 0.136 325.661)',
                        900: 'oklch(29.3% 0.136 325.661)',
                    },

                    navy: {
                        50: 'oklch(97% 0.008 285)',
                        100: 'oklch(93% 0.012 285)',
                        200: 'oklch(86% 0.018 285)',
                        300: 'oklch(74% 0.025 285)',
                        400: 'oklch(62% 0.03 285)',
                        500: 'oklch(50% 0.032 285)',
                        600: 'oklch(40% 0.035 285)',
                        700: 'oklch(32% 0.038 285)',
                        800: 'oklch(25% 0.04 285)',
                        900: 'oklch(18% 0.035 285)',
                    }
                },

                boxShadow: {
                    soft: '0 10px 40px rgba(15, 35, 65, 0.06)',
                    card: '0 6px 24px rgba(15, 35, 65, 0.05)',
                }
            }
        }
    };
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

<style>
    html,
    body {
        font-family: 'Inter', sans-serif;
    }

    * {
        box-sizing: border-box;
    }

    ::selection {
        background: #dbeafe;
        color: #10284c;
    }
</style>
