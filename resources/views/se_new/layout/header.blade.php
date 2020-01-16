<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- 搜索框 -->
            {{--<form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">--}}
                {{--<div class="form-group mb-0">--}}
                    {{--<div class="input-group input-group-alternative input-group-merge">--}}
                        {{--<div class="input-group-prepend">--}}
                            {{--<span class="input-group-text"><i class="fas fa-search"></i></span>--}}
                        {{--</div>--}}
                        {{--<input class="form-control" placeholder="Search" type="text">--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">--}}
                    {{--<span aria-hidden="true">×</span>--}}
                {{--</button>--}}
            {{--</form>--}}
            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center ml-md-auto">
                <li class="nav-item d-xl-none">
                    <!-- Sidenav toggler -->
                    <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </li>

            </ul>
            <ul class="navbar-nav align-items-center ">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="@if(empty(Auth::user()->logo)) {{asset('assets/img/logo.jpeg')}} @else {{getAliOssUrl().Auth::user()->logo}} @endif">
                  </span>
                            <div class="media-body ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->company }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('admin/se_new/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="ni ni-user-run"></i>
                            <span>退出登录</span>
                        </a>

                        <form id="logout-form" action="{{ url('admin/se_new/logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>


