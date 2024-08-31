<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>SUIT BB - DRC</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    {{-- <link href="assets/img/favicon.png" rel="icon"> --}}
    {{-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> --}}

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Bootstrap CSS Files -->
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Plugins CSS Files -->
    <link href="{{ asset('plugins/font-awesome-icons/css/font-awesome.min.css') }}" rel="stylesheet">
    @stack('plugin_css')
    {{-- <link href="{{ asset('plugins/DataTables/datatables.min.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('plugins/simple-datatables/style.css') }}" rel="stylesheet"> --}}

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- Jquery -->
    <script src="{{ asset('plugins/jquery/jquery-3.7.1.min.js') }}"></script>
</head>

<body class="d-flex flex-column min-vh-100">

    {{ $slot }}

    <!-- Bootstrap JS File -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Plugins JS Files -->
    @stack('plugin_js')

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('js')

</body>

</html>
