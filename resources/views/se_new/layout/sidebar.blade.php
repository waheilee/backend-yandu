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
                    <li class="nav-item  @if(strpos(Route::getCurrentRoute()->uri, 'admin/se_new/home') !== false) active @endif">
                        <a  class="nav-link " href="{{ url('admin/se_new/home') }}"  role="button"  aria-controls="navbar-dashboards">
                            <i class="ni ni-shop text-primary"></i>
                            <span class="nav-link-text">首页</span>
                        </a>
                    </li>
                </ul>
                <!-- Divider -->
                <!-- Heading -->

            </div>
        </div>
    </div>
</nav>
