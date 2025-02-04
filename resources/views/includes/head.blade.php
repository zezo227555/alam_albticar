    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>عالم الابتكار</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('favicon.ico') }}" rel="icon">

    <link href="{{ asset('dist/css/bootstrap5.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('dist/css/ovelayscrollbar.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css"
        integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.rtl.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <!-- DataTables -->
    <link href="{{ asset('plugins/datatable/main.css') }}" rel="stylesheet">

    {{-- select 2 --}}
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    {{-- fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    @yield('receipt_style')

    <style>
        body {
            font-family: "Cairo", sans-serif !important;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
            font-variation-settings: "slnt" 0;
        }

        body {
            overflow-x: hidden;
        }

        th,
        td {
            text-align: center !important;
            vertical-align: middle !important;
        }

        label {
            margin-bottom: .4rem !important;
        }

        .form-group {
            margin-bottom: .8rem !important;
        }
    </style>
