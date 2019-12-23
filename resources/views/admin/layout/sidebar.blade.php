<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="https://www.yd-hb.com/">
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
                    <li class="nav-item  @if(strpos(Route::getCurrentRoute()->uri, 'admin/home') !== false) active @endif">
                        <a  class="nav-link " href="{{ url('admin/home') }}"  role="button"  aria-controls="navbar-dashboards">
                            <i class="ni ni-shop text-primary"></i>
                            <span class="nav-link-text">首页</span>
                        </a>
                        {{--<div class="collapse" id="navbar-dashboards">--}}
                            {{--<ul class="nav nav-sm flex-column">--}}
                                {{--<li class="nav-item @if(strpos(Route::getCurrentRoute()->uri, 'admin/home') !== false) active @endif">--}}
                                    {{--<a href="{{ url('admin/home') }}" class="nav-link">首页</a>--}}
                                {{--</li>--}}
                                {{--<li class="nav-item">--}}
                                    {{--<a href="../../pages/dashboards/alternative.html" class="nav-link">Alternative</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-examples" data-toggle="collapse" role="button"  aria-controls="navbar-examples">
                            <i class="ni ni-ungroup text-orange"></i>
                            <span class="nav-link-text">我要派单</span>
                        </a>
                        <div class="collapse @if(strpos(Route::getCurrentRoute()->uri, 'admin/project') !== false) show @endif" id="navbar-examples">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item @if(strpos(Route::getCurrentRoute()->uri, 'admin/project/index') !== false) active @endif">
                                    <a href="{{ url('admin/project/index') }}" class="nav-link " @if(strpos(Route::getCurrentRoute()->uri, 'admin/project/index') !== false) style="color: red" @endif >我发布的需求</a>
                                </li>
                                <li class="nav-item @if(strpos(Route::getCurrentRoute()->uri, 'admin/project/create') !== false) active @endif">
                                    <a href="{{ url('admin/project/create') }}" class="nav-link" @if(strpos(Route::getCurrentRoute()->uri, 'admin/project/create') !== false) style="color: red" @endif >发布需求</a>
                                </li>
                                <li class="nav-item @if(strpos(Route::getCurrentRoute()->uri, 'admin/project/intention') !== false) active @endif">
                                    <a href="{{ url('admin/project/intention') }}" class="nav-link" @if(strpos(Route::getCurrentRoute()->uri, 'admin/project/intention') !== false) style="color: red" @endif>意向商户列表</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-components" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-components">
                            <i class="ni ni-ui-04 text-info"></i>
                            <span class="nav-link-text">我要接单</span>
                        </a>
                        <div class="collapse @if(strpos(Route::getCurrentRoute()->uri, 'admin/demand') or strpos(Route::getCurrentRoute()->uri, 'admin/worker') !== false) show @endif"  id="navbar-components">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item @if(strpos(Route::getCurrentRoute()->uri, 'admin/demand/index') !== false) active @endif">
                                    <a href="{{ url('admin/demand/index') }}" class="nav-link" @if(strpos(Route::getCurrentRoute()->uri, 'admin/demand/index') !== false) style="color: red" @endif>项目需求列表</a>
                                </li>
                                <li class="nav-item @if(strpos(Route::getCurrentRoute()->uri, 'admin/demand/join/index') !== false) active @endif">
                                    <a href="{{ url('admin/demand/join/index') }}" class="nav-link" @if(strpos(Route::getCurrentRoute()->uri, 'admin/demand/join/index') !== false) style="color: red" @endif>我参与的项目</a>
                                </li>
                                {{--<li class="nav-item @if(strpos(Route::getCurrentRoute()->uri, 'admin/demand/partner/index') !== false) active @endif">--}}
                                    {{--<a href="{{ url('admin/demand/partner/index') }}" class="nav-link">我合作的项目</a>--}}
                                {{--</li>--}}
                                <li class="nav-item @if(strpos(Route::getCurrentRoute()->uri, 'admin/worker/index') !== false) active @endif">
                                    <a href="{{ url('admin/worker/index') }}" class="nav-link" @if(strpos(Route::getCurrentRoute()->uri, 'admin/worker/index') !== false) style="color: red" @endif>施工人员管理</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-policy" data-toggle="collapse" role="button"  aria-controls="navbar-policy">
                            <i class="ni ni-folder-17 text-info"></i>
                            <span class="nav-link-text">保单管理</span>
                        </a>
                        <div class="collapse @if(strpos(Route::getCurrentRoute()->uri, 'admin/policies') !== false) show @endif"  id="navbar-policy">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item @if(strpos(Route::getCurrentRoute()->uri, 'admin/policies/index') !== false) active @endif">
                                    <a href="{{ url('admin/policies/index') }}" class="nav-link" @if(strpos(Route::getCurrentRoute()->uri, 'admin/policies/index') !== false) style="color: red" @endif>空气治理质量责任险</a>
                                </li>
                                <li class="nav-item @if(strpos(Route::getCurrentRoute()->uri, 'admin/policies/employer/index') !== false) active @endif">
                                    <a href="{{ url('admin/policies/employer/index') }}" class="nav-link" @if(strpos(Route::getCurrentRoute()->uri, 'admin/policies/employer/index') !== false) style="color: red" @endif>雇主责任险</a>
                                </li>
                                {{--<li class="nav-item @if(strpos(Route::getCurrentRoute()->uri, 'admin/worker/index') !== false) active @endif">--}}
                                    {{--<a href="{{ url('admin/worker/index') }}" class="nav-link">施工人员管理</a>--}}
                                {{--</li>--}}
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item  @if(strpos(Route::getCurrentRoute()->uri, 'admin/merchant') !== false) active @endif">
                        <a  class="nav-link " href="{{ url('admin/merchant') }}"  role="button"  aria-controls="navbar-dashboards">
                            <i class="ni ni-circle-08 text-default"></i>
                            <span class="nav-link-text">个人中心</span>
                        </a>
                    </li>

                </ul>
                <!-- Divider -->
                <!-- Heading -->

            </div>
        </div>
    </div>
</nav>
