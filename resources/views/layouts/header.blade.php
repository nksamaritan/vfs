<nav class="navbar navbar-default navbar-fixed-top be-top-header">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="{{url('/dashboard')}}" class="navbar-brand"></a><a href="javascript:void(0);" class="be-toggle-left-sidebar"><span
                        class="icon mdi mdi-menu"></span></a></div>
        <div class="be-right-navbar">
            <ul class="nav navbar-nav navbar-right be-user-nav">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><img
                                src="{{url('img/avatar.png')}}" alt="Avatar"><span class="user-name">Admin</span></a>
                    <ul role="menu" class="dropdown-menu">
                        <li>
                            <div class="user-info">
                                <div class="user-name">{{ Auth::user()->name }}</div>
                                <div class="user-position online">{{trans('app.available')}}</div>
                            </div>
                        </li>
                        <li><a href="{{url('/user/profile')}}"><span class="icon mdi mdi-face"></span> {{trans('app.my_profile')}}</a></li>
                        <li><a href="{{url('/change-password')}}"><span class="icon mdi mdi-lock"></span> {{trans('app.change_password')}}</a></li>
                        <li><a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><span
                                        class="icon mdi mdi-power"></span> {{trans('app.logout')}}</a></li>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </ul>
                </li>
            </ul>
            {{--<div class="page-title"><span>Ims one world</span></div>--}}
           {{-- <ul class="nav navbar-nav navbar-right be-icons-nav">
                <!--              <li class="dropdown"><a href="#" role="button" aria-expanded="false" class="be-toggle-right-sidebar"><span class="icon mdi mdi-settings"></span></a></li>-->
                <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false"
                                        class="dropdown-toggle"><span class="icon mdi mdi-notifications"></span><span
                                class="indicator"></span></a>
                    <ul class="dropdown-menu be-notifications">
                        <li>
                            <div class="title">Notifications<span class="badge">3</span></div>
                            <div class="list">
                                <div class="be-scroller">
                                    <div class="content">
                                        <ul>
                                            <li class="notification notification-unread">
                                                <a href="#">
                                                    <div class="image"><img src="{{url('img/avatar2.png')}}"
                                                                            alt="Avatar"></div>
                                                    <div class="notification-info">
                                                        <div class="text"><span class="user-name">User</span> accepted
                                                            your invitation to join the team.
                                                        </div>
                                                        <span class="date">2 min ago</span></div>
                                                </a>
                                            </li>
                                            <li class="notification">
                                                <a href="#">
                                                    <div class="image"><img src="{{url('img/avatar3.png')}}"
                                                                            alt="Avatar"></div>
                                                    <div class="notification-info">
                                                        <div class="text"><span class="user-name">User 1</span> is now
                                                            following you
                                                        </div>
                                                        <span class="date">2 days ago</span></div>
                                                </a>
                                            </li>
                                            <li class="notification">
                                                <a href="#">
                                                    <div class="image"><img src="{{url('img/avatar4.png')}}"
                                                                            alt="Avatar"></div>
                                                    <div class="notification-info">
                                                        <div class="text"><span class="user-name">John Doe</span> is
                                                            watching your main repository
                                                        </div>
                                                        <span class="date">2 days ago</span></div>
                                                </a>
                                            </li>
                                            <li class="notification">
                                                <a href="#">
                                                    <div class="image"><img src="{{url('img/avatar5.png')}}"
                                                                            alt="Avatar"></div>
                                                    <div class="notification-info"><span class="text"><span
                                                                    class="user-name">Emily Carter</span> is now following you</span><span
                                                                class="date">5 days ago</span></div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="footer"><a href="#">View all notifications</a></div>
                        </li>
                    </ul>
                </li>
            </ul>--}}
        </div>
    </div>
</nav>