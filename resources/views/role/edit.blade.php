@extends('layouts.common')
@section('pageTitle')
    {{__('app.default_edit_title',["app_name" => __('app.app_name'),"module"=> __('app.role')])}}
@endsection
@push('externalCssLoad')

@endpush
@push('internalCssLoad')

@endpush
@section('content')
    <div class="be-content">
        <div class="page-head">
            <h2>{{trans('app.role')}} {{trans('app.management')}}</h2>
            <ol class="breadcrumb">
                <li><a href="{{url('/dashboard')}}">{{trans('app.admin_home')}}</a></li>
                <li><a href="{{url('/role/list')}}">{{trans('app.role')}} {{trans('app.management')}}</a></li>
                <li class="active">{{trans('app.edit')}} {{trans('app.role')}}</li>
            </ol>
        </div>
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default panel-border-color panel-border-color-primary">
                        <div class="panel-heading panel-heading-divider">{{trans('app.edit')}} {{trans('app.role')}}</div>
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
                            <form action="{{url('/role/update')}}" name="app_edit_form" id="app_form" style="border-radius: 0px;" method="post" class="form-horizontal group-border-dashed">

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">{{trans('app.role')}} Type</label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="text" name="role_type" id="role_type" placeholder="{{trans('app.role')}} Type" class="form-control input-sm required" value="{{$details->role_type}}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Code</label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="text" name="code" id="code" readonly placeholder="Code" class="form-control input-sm required" value="{{$details->code}}" />
                                    </div>
                                </div>

                                <?php $role_prms_data = $details->Permissions; ?>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Assign Permissions</label>
                                    <div class="col-sm-6 col-md-4">
                                        <div style="max-height: 140px; overflow-y: scroll;">
                                            @if(count($permissionData) > 0)
                                                <input type="checkbox" class="check_all_prms" id="check_all_prms" />&nbsp;&nbsp;&nbsp;<label for="check_all_prms">Select All Permissions</label><br>
                                                @foreach($permissionData as $row)
                                                    <?php $check_status = "";  ?>
                                                    @if(count($role_prms_data) > 0)

                                                        @foreach($role_prms_data as $data)
                                                            @if($row->id == $data->permission_id)
                                                               <?php $check_status = "checked";  ?>
                                                            @endif
                                                         @endforeach
                                                    @endif
                                                    <input type="checkbox" class="permissions" value="{{$row->id}}" {{$check_status}} name="permission_ids[]" id="permission_id_{{$row->id}}" />&nbsp;&nbsp;&nbsp;<label for="permission_id_{{$row->id}}">{{$row->name}}</label><br>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                {{ csrf_field() }}
                                <input type="hidden" name="id" id="id" value="{{$details->id}}" />
                                <div class="col-sm-6 col-md-8 savebtn">
                                    <p class="text-right">
                                        <button type="submit" class="btn btn-space btn-info btn-lg">Update {{trans('app.role')}}</button>
                                        <a href="{{url('/role/list')}}" class="btn btn-space btn-danger btn-lg">Cancel</a>
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

        $(".check_all_prms").click(function (){
            if($(".check_all_prms:checked").length > '0'){
                $(".permissions").prop('checked',true);
            }else{
                $(".permissions").prop('checked',false);
            }

        });
        check_all_prms();
        $(".permissions").click(function () {
            check_all_prms();
        });

    });

    function check_all_prms() {
        if($(".permissions").length != $(".permissions:checked").length){
            $(".check_all_prms").prop('checked',false);
        }else{
            $(".check_all_prms").prop('checked',true);
        }
    }

</script>
@endpush