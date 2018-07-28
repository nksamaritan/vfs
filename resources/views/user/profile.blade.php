@extends('layouts.common')
@section('pageTitle')
    {{__('app.default_profile_title',["app_name" => __('app.app_name'),"module"=> __('app.user')])}}
@endsection
@push('externalCssLoad')
@endpush
@push('internalCssLoad')
<style>
    .col-sm-6 .control-label{text-align: left !important; font-weight: bold;}
</style>
@endpush
@section('content')
    <div class="be-content">

        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default panel-border-color panel-border-color-primary">
                        <div class="panel-heading panel-heading-divider">User Profile</div>
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
                            <form action="{{url('/user/update')}}" name="app_profile_form" id="app_form" style="border-radius: 0px;" method="post" class="form-horizontal group-border-dashed">

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">First Name </label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control input-sm required" value="{{$details->first_name}}" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Last Name </label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control input-sm required" value="{{$details->last_name}}" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">User Role </label>
                                    <div class="col-sm-6 col-md-4">
                                        <label class="col-md-12 control-label">{{($details->Role)?$details->Role->code:"---"}}<label>
                                        <input type="hidden" name="role_id" id="role_id" placeholder="Employee Code" class="form-control input-sm" value="{{$details->role_id}}" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Reporting Head </label>
                                    <div class="col-sm-6 col-md-4">
                                        <label class="col-md-12 control-label">{{($details->ParentUser)?$details->ParentUser->name:"---"}}<label>
                                        <input type="hidden" name="parent_id" id="parent_id" placeholder="Employee Code" class="form-control input-sm" value="{{$details->parent_id}}" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Email</label>
                                    <div class="col-sm-6 col-md-4">
                                        <label class="col-md-12 control-label">{{$details->email}}<label>
                                        <input type="hidden" name="email" id="email" placeholder="Email Editress" class="form-control input-sm required email" readonly value="{{$details->email}}" />
                                    </div>
                                </div>

                                <?php
                                $status_check = "";
                                if ($details->status == '1') {
                                    $status_check = "checked";
                                }
                                ?>

                                <div class="form-group" style="display: none;">
                                    <label class="col-sm-4 control-label">Status<span class="error">*</span></label>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="switch-button switch-button-lg">
                                            <input name="status" id="swt1" {{$status_check}} type="checkbox" value="1" />
                                            <span>
                                                 <label for="swt1"></label>
                                             </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="change_redirect_state" id="change_redirect_state" value="1" />

                                {{ csrf_field() }}
                                <input type="hidden" name="id" id="id" value="{{$details->id}}" />
                                <div class="col-sm-6 col-md-8 savebtn">
                                    <p class="text-right">
                                        <button type="submit" class="btn btn-space btn-info btn-lg">Update Profile</button>
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
@endpush
@push('internalJsLoad')

@endpush