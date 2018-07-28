@extends('layouts.common')
@section('pageTitle')
    {{__('app.default_add_title',["app_name" => __('app.app_name'),"module"=> __('app.user')])}}
@endsection
@push('externalCssLoad')
<link rel="stylesheet" href="{{url('css/plugins/jquery.datetimepicker.css')}}" type="text/css" />
@endpush
@push('internalCssLoad')

@endpush
@section('content')
    <div class="be-content">
        <div class="page-head">
            <h2>{{trans('app.user')}} {{trans('app.management')}}</h2>
            <ol class="breadcrumb">
                <li><a href="{{url('/dashboard')}}">{{trans('app.admin_home')}}</a></li>
                <li><a href="{{url('/user/list')}}">{{trans('app.user')}} {{trans('app.management')}}</a></li>
                <li class="active">{{trans('app.add')}} {{trans('app.user')}}</li>
            </ol>
        </div>
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default panel-border-color panel-border-color-primary">
                        <div class="panel-heading panel-heading-divider">{{trans('app.add')}} {{trans('app.user')}}</div>
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
                            <form action="{{url('/user/store')}}" name="app_add_form" id="app_form" style="border-radius: 0px;" method="post" class="form-horizontal group-border-dashed">

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">First Name <span class="error">*</span></label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control input-sm required" value="{{old('first_name')}}" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Last Name <span class="error">*</span></label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control input-sm required" value="{{old('last_name')}}" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">{{trans('app.user')}} {{trans('app.role')}} <span class="error">*</span></label>
                                    <div class="col-sm-6 col-md-4">
                                        <select class="form-control input-sm required" name="role_id" id="role_id">
                                            <option value="">{{trans('app.select')}} {{trans('app.role')}}</option>
                                            @if(count($roleData) > 0)
                                                @foreach($roleData as $row)
                                                    <option value="{{$row->id}}">{{$row->code}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Email Address <span class="error">*</span></label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="text" name="email" id="email" placeholder="Email Address" class="form-control input-sm required email" value="{{old('email')}}" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Password <span class="error">*</span></label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="password" name="password" id="password" placeholder="Password" class="form-control input-sm required" value="{{old('password')}}" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Confirm Password <span class="error">*</span></label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="form-control input-sm required" value="{{old('confirm_password')}}" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Status<span class="error">*</span></label>
                                    <div class="col-sm-6 col-md-4">

                                        <div class="switch-button switch-button-lg">
                                             <input name="status" id="swt1" checked type="checkbox" value="1" />
                                             <span>
                                                 <label for="swt1"></label>
                                             </span>
                                         </div>
                                    </div>
                                </div>

                                {{ csrf_field() }}

                                <div class="col-sm-6 col-md-8 savebtn">
                                    <p class="text-right">
                                        <button type="submit" class="btn btn-space btn-info btn-lg">{{trans('app.add')}} {{trans('app.user')}}</button>
                                        <a href="{{url('/user/list')}}" class="btn btn-space btn-danger btn-lg">Cancel</a>
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
<script src="{{url('js/plugins/jquery.datetimepicker.js')}}" type="text/javascript"></script>
<script src="{{url('js/modules/user.js')}}"></script>
@endpush
@push('internalJsLoad')
<script type="text/javascript">
    app.validate.init(app.user.action.event.custome_validations());
    app.user.action.event.common();

</script>
@endpush