@extends('admin.layout.index')
@section('css')

@endsection
@section('contend_head')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        {{--<h6 class="h2 text-white d-inline-block mb-0">发布需求列表</h6>--}}
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                {{--<li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>--}}
                                {{--<li class="breadcrumb-item"><a href="#">首页</a></li>--}}
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
@endsection
@section('contend')
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">

                </div>
                <div class="card-body col-md-10 center">
                    <div class="text-center">

                        <h1 class="card-title mb-3 ">@if(empty($row->title)){{$row->name}}@else{{$row->title}}@endif</h1>

                    </div>
                    <div class="text-center">
                        <div class="h3 font-weight-300 mr-9 ml-9">
                            发布时间：<i class="ni location_pin mr-2"></i>@if(empty($row->created_at)){{$row->updated_at}}@else{{$row->created_at}}@endif
                        </div>
                    </div>
                    {!! $row->content !!}
                    <p class="card-text mb-4">

                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')


@endsection