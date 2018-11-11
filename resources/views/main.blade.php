<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>

    <link href="{{ asset('css/plugins/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="shortcut icon" href="{{{ asset('img/favicon.ico') }}}">
</head>
<body class="app sidebar-lg-show">
    
    <div id="app">
        <main-app></main-app>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <!-- <script src="{{ asset('js/dashboard.js') }}"></script> -->
    <script src="{{ asset('js/plugins/hullabaloo/hullabaloo.js') }}"></script>
</body>
</html>