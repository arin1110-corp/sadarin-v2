<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white text-navy-700 antialiased">

    @yield('content')

    @include('partials.scripts')

</body>

</html>
