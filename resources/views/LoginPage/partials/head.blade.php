<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="description" content="SADARIN - Sistem Arsip Digital Internal" />

<title>
    @yield('title', 'SADARIN')
</title>

{{-- Tailwind CDN --}}
<script src="https://cdn.tailwindcss.com"></script>

<script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                },

                colors: {
                    sadarin: {
                        50: '#F4F8FD',
                        100: '#E8F1FC',
                        200: '#D2E4F8',
                        300: '#A9CFF2',
                        400: '#6EAEEC',
                        500: '#2187E8',
                        600: '#1478D4',
                        700: '#0F63B5',
                        800: '#104F8C',
                        900: '#123F6D',
                    },

                    navy: {
                        50: '#F4F6FA',
                        100: '#E9EDF4',
                        200: '#D3D9E5',
                        300: '#AAB5C7',
                        400: '#74839B',
                        500: '#52627A',
                        600: '#3C4E69',
                        700: '#293B57',
                        800: '#1A2E4A',
                        900: '#10284C',
                    }
                },

                boxShadow: {
                    'soft': '0 10px 40px rgba(15, 35, 65, 0.07)',
                    'panel': '0 12px 40px rgba(15, 35, 65, 0.08)',
                }
            }
        }
    }
</script>

{{-- Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

{{-- Font --}}
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

    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus {
        -webkit-text-fill-color: #293b57;
        -webkit-box-shadow: 0 0 0 1000px #ffffff inset;
        transition: background-color 5000s ease-in-out 0s;
    }
</style>
