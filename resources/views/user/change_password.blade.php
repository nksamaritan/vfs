@extends('layouts.common')
@section('pageTitle')
    {{trans('app.change_password')}}
@endsection
@push('externalCssLoad')

@endpush
@push('internalCssLoad')

@endpush
@section('content')
    <div class="be-content">

        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default panel-border-color panel-border-color-primary">
                        <div class="panel-heading panel-heading-divider">Change Password</div>
                        <div class="panel-body">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{url('/update_password')}}" name="app_add_form" id="app_form" style="border-radius: 0px;" method="post" class="form-horizontal group-border-dashed">

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Old Password</label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="password" name="old_password" id="old_password" placeholder="Old Password" class="form-control input-sm required" value="{{old('old_password')}}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">New Password</label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="password" name="new_password" id="new_password" placeholder="New Password" class="form-control input-sm required" value="{{old('new_password')}}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Confirm Password</label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="form-control input-sm required" value="{{old('confirm_password')}}" />
                                    </div>
                                </div>

                                {{ csrf_field() }}
                                <div class="col-sm-6 col-md-8 savebtn">
                                    <p class="text-right">
                                        <button type="submit" class="btn btn-space btn-info btn-lg">Change Password</button>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('externalJsLoad')
<script src="{{url('js/plugins/validate/jquery.validate.min.js')}}" type="text/javascript"></script>

@endpush
@push('internalJsLoad')
<script type="text/javascript">
    $(document).ready(function () {
        app.validate.init();

    });
</script>
@endpush