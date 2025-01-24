<html lang="en" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" data-theme-mode="light"
    data-header-styles="light" data-menu-styles="light" data-toggled="close">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        {{ config('app.name', 'Laravel') }}
    </title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/brand-logos/favicon.ico') }}" type="image/x-icon">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="{{ asset('assets/css/styles.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    
    <script type="module" src="{{ asset('assets/js/scripts.js') }}"></script>

    <style>
        body {
            background: url('{{ asset('assets/images/media/auth-bg.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center center;
            height: 100vh;
            overflow: hidden;
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    @yield('content')

    @stack('scripts')
</body>

</html>
