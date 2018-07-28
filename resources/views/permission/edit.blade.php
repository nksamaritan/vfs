@extends('layouts.common')
@section('pageTitle')
    {{__('app.default_edit_title',["app_name" => __('app.app_name'),"module"=> __('app.permission')])}}
@endsection
@push('externalCssLoad')

@endpush
@push('internalCssLoad')

@endpush
@section('content')
    <div class="be-content">
        <div class="page-head">
            <h2>{{trans('app.permission')}} {{trans('app.management')}}</h2>
            <ol class="breadcrumb">
                <li><a href="{{url('/dashboard')}}">{{trans('app.admin_home')}}</a></li>
                <li><a href="{{url('/permission/list')}}">{{trans('app.permission')}} {{trans('app.management')}}</a></li>
                <li class="active">{{trans('app.edit')}} {{trans('app.permission')}}</li>
            </ol>
        </div>
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default panel-border-color panel-border-color-primary">
                        <div class="panel-heading panel-heading-divider">{{trans('app.edit')}} {{trans('app.permission')}}</div>
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
                            <form action="{{url('/permission/update')}}" name="app_edit_form" id="app_form" style="border-radius: 0px;" method="post" class="form-horizontal group-border-dashed">

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">{{trans('app.permission')}} Name</label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="text" name="name" id="name" placeholder="{{trans('app.permission')}} Name" class="form-control input-sm required" value="{{$details->name}}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Code</label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="text" name="code" id="code" readonly placeholder="Code" class="form-control input-sm required" value="{{$details->code}}" />
                                    </div>
                                </div>
                                {{ csrf_field() }}
                                <input type="hidden" name="id" id="id" value="{{$details->id}}" />
                                <div class="col-sm-6 col-md-8 savebtn">
                                    <p class="text-right">
                                        <button type="submit" class="btn btn-space btn-info btn-lg">Update {{trans('app.permission')}}</button>
                                        <a href="{{url('/permission/list')}}" class="btn btn-space btn-danger btn-lg">Cancel</a>
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
<script type="text/javascript">
    $(document).ready(function () {
        app.validate.init();
    });
</script>
@endpush