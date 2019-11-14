<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="../../pages/dashboards/dashboard.html">
                <img src="../../assets/img/brand/logo.png" class="navbar-brand-img" alt="...">
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link " href="#navbar-dashboards" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-dashboards">
                            <i class="ni ni-shop text-primary"></i>
                            <span class="nav-link-text">Dashboards</span>
                        </a>
                        <div class="collapse" id="navbar-dashboards">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item @if(strpos(Route::getCurrentRoute()->uri, 'admin/home') !== false) active @endif">
                                    <a href="{{ url('admin/home') }}" class="nav-link">首页</a>
                                </li>
                                {{--<li class="nav-item">--}}
                                    {{--<a href="../../pages/dashboards/alternative.html" class="nav-link">Alternative</a>--}}
                                {{--</li>--}}
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                            <i class="ni ni-ungroup text-orange"></i>
                            <span class="nav-link-text">我要派单</span>
                        </a>
                        <div class="collapse @if(strpos(Route::getCurrentRoute()->uri, 'admin/project') !== false) show @endif" id="navbar-examples">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item @if(strpos(Route::getCurrentRoute()->uri, 'admin/project') !== false) active @endif">
                                    <a href="{{ url('admin/project') }}" class="nav-link">需求订单列表</a>
                                </li>
                                <li class="nav-item @if(strpos(Route::getCurrentRoute()->uri, 'admin/project/create') !== false) active @endif">
                                    <a href="{{ url('admin/project/create') }}" class="nav-link">发布需求</a>
                                </li>
                                <li class="nav-item @if(strpos(Route::getCurrentRoute()->uri, 'admin/project/intention') !== false) active @endif">
                                    <a href="{{ url('admin/project/intention') }}" class="nav-link">意向商户列表</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-components" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-components">
                            <i class="ni ni-ui-04 text-info"></i>
                            <span class="nav-link-text">我要接单</span>
                        </a>
                        <div class="collapse" id="navbar-components">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="../../pages/components/buttons.html" class="nav-link">Buttons</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../../pages/components/cards.html" class="nav-link">Cards</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../../pages/components/grid.html" class="nav-link">Grid</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../../pages/components/notifications.html" class="nav-link">Notifications</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../../pages/components/icons.html" class="nav-link">Icons</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../../pages/components/typography.html" class="nav-link">Typography</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#navbar-multilevel" class="nav-link" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-multilevel">Multi level</a>
                                    <div class="collapse show" id="navbar-multilevel" style="">
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item">
                                                <a href="#!" class="nav-link ">Third level menu</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#!" class="nav-link ">Just another link</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#!" class="nav-link ">One last link</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>

                </ul>
                <!-- Divider -->
                <!-- Heading -->

            </div>
        </div>
    </div>
</nav>
