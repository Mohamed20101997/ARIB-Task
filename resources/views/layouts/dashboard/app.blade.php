<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/css/main_rtl.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet"  href="{{ asset('front/fonts/font600.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">

    {{-- noty --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/plugins/noty/noty.css') }}">
    <script src="{{ asset('dashboard_files/plugins/noty/noty.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="{{asset('front/css/summernote.min.css')}}" rel="stylesheet">

    <style>
        .toggle-flip input[type="checkbox"] + .flip-indecator {
            width: 110px;
        }
    </style>
</head>
<body class="app sidebar-mini">
<!-- Navbar-->
@include('layouts.dashboard._header')
<!-- Sidebar menu-->
@include('layouts.dashboard._aside')

<main class="app-content">
    @include('dashboard.partials._confirm')
    @include('dashboard.partials._errors')
    @include('dashboard.partials._sessions')


    @yield('content')

</main>

<!-- Essential javascripts for application to work-->
<script src="{{ asset('dashboard_files/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('dashboard_files/js/plugins/jquery-ui.min.js') }}"></script>
<script src="{{ asset('dashboard_files/js/popper.min.js') }}"></script>
<script src="{{ asset('dashboard_files/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dashboard_files/js/main.js') }}"></script>
{{-- select2--}}
<script src="{{ asset('dashboard_files/js/plugins/select2.min.js') }}"></script>

{{-- custom fields --}}
<script src="{{ asset('dashboard_files/js/plugins/form-builder.min.js') }}"></script>
<script src="{{ asset('dashboard_files/js/plugins/form-render.min.js') }}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

  <script src="{{asset('front/js/summernote.min.js')}}"></script>

@stack('js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@include('dashboard.partials._confirm')

<script>
    $('.select2').select2({
        width: '100%'
    });
</script>


@yield('script')

</body>
</html>

