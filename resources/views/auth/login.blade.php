@extends('layouts.login')
@section('pageTitle')
    {{__('app.login_title',["app_name"=> __('app.app_name')])}}
@endsection
@push('externalCssLoad')
<link rel="stylesheet" type="text/css" href="{{url('css/plugins/perfect-scrollbar.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{url('css/plugins/material-design-iconic-font.min.css')}}" />
<link rel="stylesheet" href="{{url('css/style.css')}}" type="text/css" />
<link rel="stylesheet" href="{{url('css/custom.css')}}" type="text/css" />
<link rel="stylesheet" href="{{url('css/plugins/font-awesome.min.css')}}" type="text/css" />
@endpush
@push('internalCssLoad')
<script type="text/javascript">
    var baseUrl = "{{ url('/') }}/";
    var csrf_token = "<?php echo csrf_token(); ?>";
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
@endpush
@section('content')

    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="splash-container">
                <div class="panel panel-default panel-border-color panel-border-color-primary">
                    <div class="panel-heading img-resposive"><img src="{{url('img/mainlogo.png')}}" alt="logo" width="102" height="27" class="logo-img"><span class="splash-description">{{trans('app.login_throttle')}}</span></div>
                    <div class="panel-body">
                        <form action="{{ url('/login') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input id="email" type="email" placeholder="{{trans('app.login_email_placeholder')}}" class="form-control" name="email" value="{{ old('email') }}" required autofocus />
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" placeholder="{{trans('app.login_password_placeholder')}}" class="form-control" maxlength="15" name="password" required />
                            </div>
                            <div class="form-group row login-tools">
                                <div class="col-xs-6 login-remember">
                                    <div class="be-checkbox">
                                        <input type="checkbox" name="remember" value="1" id="remember" />
                                        <label for="remember">{{trans('app.remember_me')}}</label>
                                    </div>
                                </div>
                                <div class="col-xs-6 login-forgot-password"><a href="{{ url('/password/reset') }}">{{trans('app.forgot_password')}}</a></div>
                            </div>
                            <div class="form-group login-submit">
                                <button data-dismiss="modal" type="submit" class="btn btn-primary btn-xl">{{trans('app.sign_in')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('externalJsLoad')
<script src="{{url('js/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/main.js')}}" type="text/javascript"></script>
<script src="{{url('js/app.js')}}" type="text/javascript"></script>
@endpush
@push('internalJsLoad')
<script type="text/javascript">
    $(document).ready(function () {
        //initialize the javascript
        App.init();
    });
</script>
@endpush
