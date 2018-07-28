@extends('layouts.login')
@section('pageTitle')
    {{__('app.reset_form',["app_name"=> __('app.app_name')])}}
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
                    <div class="panel-heading img-resposive"><img src="{{url('img/mainlogo.png')}}" alt="logo" width="102" height="27" class="logo-img"><span class="splash-description">Reset Password</span></div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email" placeholder="Email id" name="email" autocomplete="off" class="form-control" value="{{ $email or old('email') }}" />
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" name="password" placeholder="New Password" required autocomplete="off" class="form-control" />
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control" required />
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <input type="hidden" name="guard" value="1" />

                            <div class="form-group login-submit"><button data-dismiss="modal" type="submit" class="btn btn-primary btn-xl">Reset Password</button>
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
