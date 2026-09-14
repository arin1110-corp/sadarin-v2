<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')

    <style>
        :root {
            --sadarin-primary: oklch(29.3% 0.136 325.661);
        }

        html,
        body {
            min-height: 100%;
        }

        body {
            background: #f8fafc;
        }

        .admin-sidebar {
            width: 260px;
            transition: all .25s ease;
        }

        .admin-main {
            margin-left: 260px;
            transition: all .25s ease;
        }

        .sidebar-link {
            transition: all .2s ease;
        }

        .sidebar-link:hover {
            background: #f8f5f8;
            color: var(--sadarin-primary);
        }

        .sidebar-link.active {
            background: var(--sadarin-primary);
            color: white;
            box-shadow: 0 8px 20px rgba(80, 20, 65, .12);
        }

        .sidebar-link.active:hover {
            background: var(--sadarin-primary);
            color: white;
        }

        .stat-card {
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(15, 23, 42, .07);
        }

        .mobile-overlay {
            display: none;
        }

        @media (max-width: 1023px) {
            .admin-sidebar {
                transform: translateX(-100%);
                z-index: 60;
            }

            .admin-sidebar.open {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
            }

            .mobile-overlay.show {
                display: block;
            }
        }
    </style>
</head>

<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">

    {{-- Mobile Overlay --}}
    <div id="mobileOverlay" class="mobile-overlay fixed inset-0 z-50 bg-slate-950/40 backdrop-blur-sm lg:hidden"
        onclick="toggleSidebar()">
    </div>

    {{-- Sidebar --}}
    @include('dashboard.partials.sidebar')

    {{-- Main --}}
    <div class="admin-main min-h-screen">

        {{-- Header --}}
        @include('dashboard.partials.header')

        {{-- Page Content --}}
        <main class="p-4 sm:p-6 lg:p-8">
            @yield('content')
        </main>

    </div>

    @include('partials.scripts')

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('mobileOverlay');

            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
        }

        function closeSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('mobileOverlay');

            sidebar.classList.remove('open');
            overlay.classList.remove('show');
        }
    </script>

    @stack('scripts')

</body>

</html>
