<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{!! asset('img/favicon.png') !!}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{url('img/favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{url('img/favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{url('img/favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{url('img/favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{url('img/favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{url('img/favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{url('img/favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{url('img/favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{url('img/favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{url('img/favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{url('img/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{url('img/favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('img/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{url('img/favicon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{url('img/favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    <title>@yield('pageTitle')</title>
    <link rel="stylesheet" type="text/css" href="{{url('css/plugins/perfect-scrollbar.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{url('css/plugins/material-design-iconic-font.min.css')}}" />
    {{--<link rel="stylesheet" type="text/css" href="{{url('css/plugins/jquery.dataTables.min.css')}}" />--}}
    <link rel="stylesheet" type="text/css" href="{{url('css/plugins/dataTables.bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{url('css/plugins/jquery.loadmask.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{url('css/plugins/responsive.dataTables.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{url('css/plugins/select.dataTables.min.css')}}" />
    <link rel="stylesheet" href="{{url('css/style.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{url('css/custom.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{url('css/plugins/font-awesome.min.css')}}" type="text/css" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{url('js/plugins/html5shiv.min.js')}}"></script>
    <script src="{{url('js/plugins/respond.min.js')}}"></script>
    <![endif]-->
    @stack('externalCssLoad')
    @stack('internalCssLoad')
    <script type="text/javascript">
        var baseUrl = "{{ url('/') }}/";
        var csrf_token = "<?php echo csrf_token(); ?>";

        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>

<div class="be-wrapper be-collapsible-sidebar">

    <div id="load-nav">
        @include('layouts.header')
    </div>
    @include('layouts.sidebar')
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}" style="text-align:center;text-transform:capitalize;"><?php echo Session::get('alert-' . $msg);?><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
    @yield('content')
    @include('layouts.footer')
</div>

<!-- Mainly scripts -->
<script src="{{url('js/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/bootstrap.min.js')}}" type="text/javascript"></script>

<script src="{{url('js/plugins/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/dataTables.buttons.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/dataTables.responsive.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/dataTables.select.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/jquery.loadmask.min.js')}}" type="text/javascript"></script>

<script src="{{url('js/config.js')}}" type="text/javascript"></script>
<script src="{{url('js/main.js')}}" type="text/javascript"></script>
<script src="{{url('js/app.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/validate/jquery.validate.min.js')}}" type="text/javascript"></script>
@stack('externalJsLoad')
@stack('internalJsLoad')
<script>
    App.init();
</script>

</body>
</html>