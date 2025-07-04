<head>
    <title>{{ $title ?? env('APP_NAME') }}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend-assets/images/favicon.ico') }}" />

    <!-- Bootstrap css-->
    <link href="{{ asset('frontend-assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Materialdesign icon-->
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/materialdesignicons.min.css') }}" type="text/css" />

    <!-- Swiper Slider css -->
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/swiper-bundle.min.css') }}" type="text/css" />

    <!-- Custom Css -->
    <link href="{{ asset('frontend-assets/css/style.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend-assets/plugins/custom/ckeditor5/ckeditor5.css') }}"
        type="text/css" />


    <!-- colors -->
    <link href="{{ asset('frontend-assets/css/colors/default.css') }}" rel="stylesheet" type="text/css"
        id="color-opt" />

    <!-- DataTables -->
    <link href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.2/css/buttons.dataTables.css" type="text.css">

    @stack('customStyles')

</head>
