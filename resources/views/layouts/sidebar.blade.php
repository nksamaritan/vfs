<?php $userPermission = GetUserPermissions(); ?>
<div class="be-left-sidebar">
    <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">{{trans('app.admin_home')}}</a>
        <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
                <div class="left-sidebar-content">
                    <ul class="sidebar-elements">
                        <li class="divider">{{trans('app.menu')}}</li>
                        <li class="{{$dashboardTab or ''}}" title="Dashboard"><a href="{{url('/dashboard')}}"><i
                                        class="icon mdi mdi-home"></i><span>{{trans('app.admin_home')}}</span></a>
                        </li>
                        @if(in_array("master_manage",$userPermission))
                            <li class="parent {{$masterManagementTab or ''}}" title="Master Managemet"><a href="#"><i
                                            class="icon mdi mdi-account mdi-18px"></i><span>{{trans('app.master_managemet')}}</span></a>
                                <ul class="sub-menu">
                                    @if(in_array("user_management",$userPermission))
                                        <li class="{{$userTab or ''}}">
                                            <a href="{{url('/user/list')}}">{{trans('app.user')}} {{trans('app.management')}}</a>
                                        </li>
                                    @endif
                                    @if(in_array("role_manage",$userPermission))
                                        <li class="{{$roleTab or ''}}">
                                            <a href="{{url('/role/list')}}">{{trans('app.role')}} {{trans('app.management')}}</a>
                                        </li>
                                    @endif
                                   {{-- <li class="{{$permissionTab or ''}}">
                                        <a href="{{url('/permission/list')}}">{{trans('app.permission')}} {{trans('app.management')}}</a>
                                    </li>--}}

                                </ul>
                            </li>
                        @endif
                        <li title="Reports"><a href="{{url('/maintanance')}}"><i class="icon fa fa-file-text-o"
                                                                                 aria-hidden="true"></i><span>{{trans('app.reports')}}</span></a>
                        </li>

                        <li title="profile" class="{{$profileTab or ''}}"><a href="{{url('/user/profile')}}"><i
                                        class="icon mdi mdi-face"></i></i><span>{{trans('app.my_profile')}}</span></a>
                        </li>
                        <li title="Change Password" class="{{$changePasswordTab or ''}}"><a
                                    href="{{url('/change-password')}}"><i class="icon mdi mdi-lock"></i></i>
                                <span>{{trans('app.change_password')}}</span></a>
                        </li>

                    </ul>
                    </li>
                    </ul>
                    </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>