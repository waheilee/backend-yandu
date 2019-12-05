@extends('admin.layout.index')
@section('contend_head')
    <div class="header bg-yandu pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">首页</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">首页</a></li>
                                {{--<li class="breadcrumb-item active" aria-current="page">默认</li>--}}
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        {{--<a href="#" class="btn btn-sm btn-neutral">New</a>--}}
                        {{--<a href="#" class="btn btn-sm btn-neutral">Filters</a>--}}
                    </div>
                </div>
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">浏览量</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$page_views}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                            <i class="ni ni-active-40"></i>
                                        </div>
                                    </div>
                                </div>
                                {{--<p class="mt-3 mb-0 text-sm">--}}
                                    {{--<span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>--}}
                                    {{--<span class="text-nowrap">Since last month</span>--}}
                                {{--</p>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">查看联系方式次数</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$contact_views}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                            <i class="ni ni-chart-pie-35"></i>
                                        </div>
                                    </div>
                                </div>
                                {{--<p class="mt-3 mb-0 text-sm">--}}
                                    {{--<span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>--}}
                                    {{--<span class="text-nowrap">Since last month</span>--}}
                                {{--</p>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">保单剩余</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$policy}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                            <i class="ni ni-money-coins"></i>
                                        </div>
                                    </div>
                                </div>
                                {{--<p class="mt-3 mb-0 text-sm">--}}
                                    {{--<span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>--}}
                                    {{--<span class="text-nowrap">Since last month</span>--}}
                                {{--</p>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">项目总数</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$projects}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                            <i class="ni ni-chart-bar-32"></i>
                                        </div>
                                    </div>
                                </div>
                                {{--<p class="mt-3 mb-0 text-sm">--}}
                                    {{--<span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>--}}
                                    {{--<span class="text-nowrap">Since last month</span>--}}
                                {{--</p>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    @endsection
@section('contend')
    <div class="row">

        <div class="col-xl-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <h3 class="mb-0"></h3>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <form>
                        <div class="bootstrap-tagsinput">
                            @foreach($service as $item)
                                <a href="{{route('service_detail').'?id='.$item->id}}" class="btn btn-outline-secondary btn-lg my-2">{{$item->name}}</a>
                                {{--<button type="button" class="btn btn-outline-secondary btn-lg my-2">{{$item->name}}</button>--}}

                            @endforeach
                        </div>
                        <input type="text" class="form-control" value="Bucharest, Cluj, Iasi, Timisoara, Piatra Neamt" data-toggle="tags" style="display: none;">
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-xl-12">
            <!-- Members list group card -->
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <!-- Title -->
                    <h5 class="h3 mb-0">行业咨询</h5>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- List group -->
                    <ul class="list-group list-group-flush list my--3">
                        @foreach($news as $item)
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <!-- Avatar -->
                                        <a href="{{route('news_detail').'?id='.$item->id}}" class=" rounded-lg" >
                                            <img class="avatar-xl" alt="Image placeholder" src="http://yandu2019.oss-cn-beijing.aliyuncs.com/{{$item->cover}}" style="width: 200px;height: 130px">
                                        </a>
                                    </div>

                                    <div class="col ml--2">
                                        <div class="col-md-8">
                                            <h4 class="mb-0">
                                                <a href="{{route('news_detail').'?id='.$item->id}}">{{$item->title}}</a>
                                            </h4>

                                            <small><p class="text-sm lh-160">{{$item->summary}}</p></small>
                                        </div>
                                    </div>
                                    <div class="col-auto text-sm lh-160">
                                        浏览量：{{$item->views}}
                                        {{--<button type="button" class="btn btn-sm btn-primary">Add</button>--}}
                                    </div>
                                </div>
                            </li>
                            @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>

    @endsection