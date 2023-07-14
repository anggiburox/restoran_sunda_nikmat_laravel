<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Restoran Sunda Nikmat</title>


    <link href="{{asset('assets/images/logo.png') }}" rel="shortcut icon">
    <!-- Site favicon -->

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link href="{{asset('assets/styles/core.css') }}" rel="stylesheet">
    <link href="{{asset('assets/styles/style-login.css') }}" rel="stylesheet">
</head>

<body class="login-page">
    @yield('content')

    
    <!-- js -->
    <script src="{{asset('assets/scripts/core.js') }}"></script>
    <script src="{{asset('assets/scripts/script.min.js') }}"></script>
    <script src="{{asset('assets/scripts/process.js') }}"></script>
    <script src="{{asset('assets/scripts/layout-settings.js') }}"></script>
</body>

</html>