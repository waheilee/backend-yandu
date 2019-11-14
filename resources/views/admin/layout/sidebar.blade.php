<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="../../pages/dashboards/dashboard.html">
                <img src="{{asset('assets/img/brand/logo.png')}}" class="navbar-brand-img" alt="...">
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
                                <li class="nav-item @if(strpos(Route::getCurrentRoute()->uri, 'admin/project/index') !== false) active @endif">
                                    <a href="{{ url('admin/project/index') }}" class="nav-link">我发布的需求</a>
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
                        <div class="collapse @if(strpos(Route::getCurrentRoute()->uri, 'admin/demand') !== false) show @endif"  id="navbar-components">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item @if(strpos(Route::getCurrentRoute()->uri, 'admin/demand/index') !== false) active @endif">
                                    <a href="{{ url('admin/demand/index') }}" class="nav-link">需求市场</a>
                                </li>
                                <li class="nav-item @if(strpos(Route::getCurrentRoute()->uri, 'admin/demand/join/index') !== false) active @endif">
                                    <a href="{{ url('admin/demand/join/index') }}" class="nav-link">我参与的项目</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../../pages/components/grid.html" class="nav-link">我合作的项目</a>
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
