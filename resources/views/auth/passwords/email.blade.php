@extends('layouts.login')
@section('pageTitle')
    {{__('app.forgot_form',["app_name"=> __('app.app_name')])}}
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
            <div class="splash-container forgot-password">
                <div class="panel panel-default panel-border-color panel-border-color-primary">
                    <div class="panel-heading"><img src="{{url('img/mainlogo.png')}}" alt="logo"  class="logo-img"><span class="splash-description">Forgot your password?</span></div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                            {{ csrf_field() }}
                            <p>Don't worry, we'll send you an email to reset your password.</p>
                            <div class="form-group xs-pt-20 {{ $errors->has('email') ? ' has-error' : '' }}">
                                <input type="email" name="email" required placeholder="Your Email" autocomplete="off" class="form-control" value="{{ old('email') }}" />
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {{--<p class="xs-pt-5 xs-pb-20">Don't remember your email? <a href="#">Contact Support</a>.</p>--}}
                            <div class="form-group xs-pt-5">
                                <button type="submit" class="btn btn-block btn-primary btn-xl">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--            <div class="splash-footer">&copy; 2016 Your Company</div>-->
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
