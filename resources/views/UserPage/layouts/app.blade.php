<!DOCTYPE html>
<html lang="id">

<head>
    @include('UserPage.partials.head')
</head>

<body class="min-h-screen bg-slate-50 text-slate-700 antialiased">

    @include('UserPage.partials.navbar')

    @yield('content')

    @include('UserPage.partials.scripts')

</body>

</html>