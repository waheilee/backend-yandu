@extends('admin.layout.index')
@section('css')
    <link href="{{asset('assets/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/build/toastr.css') }}">
    <link rel="stylesheet" href="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css')}}">



@endsection
@section('contend_head')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">我要派单</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">首页</a></li>
                                <li class="breadcrumb-item active" aria-current="page">发布需求</li>
                            </ol>
                        </nav>
                    </div>
                    {{--<div class="col-lg-6 col-5 text-right">--}}
                    {{--<a href="#" class="btn btn-sm btn-neutral">New</a>--}}
                    {{--<a href="#" class="btn btn-sm btn-neutral">Filters</a>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
@endsection
@section('contend')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-wrapper">
                <!-- Form controls -->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">发布需求</h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body col-md-8 center">
                        <form id="project_form">
                            <input type="hidden" name="id" value="{{$model->id}}">
                            <div class="form-group">
                                <label class="form-control-label" for="">项目名称</label>
                                <input type="text" class="form-control" name="project_name" id="project_name" value="{{$model->project_name}}" placeholder="项目名称">
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group " >
                                        <label class="form-control-label">项目省分 </label>
                                        <select class="form-control" id="s_province" name="s_province"></select> 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group " >
                                        <label class="form-control-label">市 </label>
                                        <select class="form-control" id="s_city" name="s_city" ></select> 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group " >
                                        <label class="form-control-label">县 </label>
                                        <select class="form-control" id="s_county" name="s_county" ></select> 
                                    </div>
                                </div>
                                <input type="hidden" name="province" id="province_s" value="{{$model->province}}">
                                <input type="hidden" name="city" id="city_s" value="{{$model->city}}">
                                <input type="hidden" name="county"  id="county_s" value="{{$model->county}}">
                                <div id="show"></div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="">详细地址</label>
                                <input type="text" class="form-control" name="address" id="address" value="{{$model->address}}"  placeholder="项目详细地点">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group date" id="begin_time">
                                        <label class="form-control-label" for="begin_time">项目开始时间</label>
                                        <input class="form-control" type="text" value="{{$model->begin_time}}" name="begin_time" >
                                        <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group date" id="end_time">
                                        <label class="form-control-label" for="end_time">项目预计结束时间</label>
                                        <input class="form-control" type="text" value="{{$model->end_time}}" name="end_time" >
                                        <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="size">项目大小(平米数)</label>
                                <input type="text" class="form-control" name="size" id="size" placeholder="施工面积大小" value="{{$model->size}}">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="budget">项目预算价格</label>
                                <input type="text" class="form-control" id="budget" name="budget" placeholder="本项目预算价格" value="{{$model->budget}}">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="cash_deposit">保证金金额(乙方所需缴纳的保证金额,根据项目预算的1%手续)</label>
                                <input type="text" class="form-control" id="cash_deposit" name="cash_deposit"  placeholder="" readonly="readonly" value="{{$model->cash_deposit}}">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="people_num">根据项目大小最低使用人数</label><span class="heading-title text-warning mb-0" id="peo" style="font-size: 1rem"></span>
                                <input type="text" class="form-control" name="people_num" id="people_num" placeholder="乙方必须达到最低使用人数才能参加本项目" value="{{$model->people_num}}">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="phone">联系方式</label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="4008-010-911" value="4008-010-911" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="content">项目详细介绍</label>
                                <script id="container" name="content" type="text/plain">{!! $model->content !!}</script>
                            </div>
                            <div class="row">
                                <div class="col-xs">
                                    <div class="form-group">
                                        <input class="" type="checkbox"  value="1" name="state" id="state" checked>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <a href="" data-toggle="modal" data-target="#modal-default">《严度平台免责申明》</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <button type="button" class="btn btn-primary btn-lg btn-block" onclick="submit()">提交</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">《严度平台免责申明》</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <div class="modal-body" style="max-height: 500px; overflow-y:auto;">
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;text-align: center;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 21px;font-family: &#39;.PingFang SC&#39;">免责声明</span></span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"></span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">一、第一条</span></span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold"><span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">总则</span></span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"></span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);text-indent: 0;white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont"><span style="box-sizing: border-box;padding: 0px">1.<span style="box-sizing: border-box;padding: 0px;font-variant-numeric: normal;font-variant-east-asian: normal;font-stretch: normal;font-size: 9px;line-height: normal;font-family: &#39;Times New Roman&#39;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">用户是指有意或已经登录并利用【严度派（杭州）科技有限公司】公司（以下简称严度）所拥有的提供相关空气净化产品及服务的交易网站平台（以下简称本平台）的法人、组织或自然人（以下简称用户或您）。</span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);text-indent: 0;white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont"><span style="box-sizing: border-box;padding: 0px">2.<span style="box-sizing: border-box;padding: 0px;font-variant-numeric: normal;font-variant-east-asian: normal;font-stretch: normal;font-size: 9px;line-height: normal;font-family: &#39;Times New Roman&#39;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">您在接受本平台服务之前，请务必仔细阅读并同意本声明。</span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);text-indent: 0;white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont"><span style="box-sizing: border-box;padding: 0px">3.<span style="box-sizing: border-box;padding: 0px;font-variant-numeric: normal;font-variant-east-asian: normal;font-stretch: normal;font-size: 9px;line-height: normal;font-family: &#39;Times New Roman&#39;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">您直接或通过各类方式间接使用本平台服务和数据的行为，都将被视作已无条件接受本声明所涉全部内容；若您对本声明的任何条款有异议，请停止使用本平台所提供的全部服务。</span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont">&nbsp;</span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">二、第二条</span></span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold"><span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">用户承诺</span></span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"></span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">您以各种方式使用本平台服务和数据（包括但不限于发表、上传、转载、浏览及利用本平台或本平台用户发布产品或服务）的过程中，不得以任何方式利用本平台直接或间接从事违反中国法律、以及社会公德的行为，且用户应当恪守下述承诺：</span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont">1.<span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">发布、转载或提供的内容符合中国法律、社会公德；</span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont">2.<span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">不得干扰、损害和侵犯本平台的各种合法权利与利益；</span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont">3.<span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">遵守本平台以及与之相关的网络服务的协议、指导原则、管理细则等。</span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont">4.<span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">您声明并保证不会删除、隐匿或改变本平台的产品和服务中显示或其中包含的任何知识产权或其他所有权声明；不会以任何方式干扰或企图干扰本平台及其产品和服务的正常运行，或者制作、发布、传播可能造成前述后果的工具、方法等。</span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont">5.<span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">您声明并保证您使用本平台产品和服务以及第三方产品和服务，和</span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont">/</span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">或通过本平台的产品和服务进行发布拥有合法权利内容的时候，应遵循诚实信用原则，不损害社会公共利益。</span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont">6.<span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">您保证不会发布、传播、提供含有任何政治、宗教迷信、淫秽、色情、不道德、欺诈、诽谤、侮辱等内容。您发布的内容不会侵犯任何法律法规或第三方的任何权利，如因您发布的内容导致本平台或其他第三方遭受损失的，您应承担全部责任。</span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont">7.<span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">不得利用本平台从事洗钱、窃取商业秘密、窃取个人信息等违法犯罪活动。</span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont">8.<span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">不得教唆他人从事本条所禁止的行为。</span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont">9.<span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">不得利用在本平台注册的账户进行牟利性经营活动。</span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont">10.<span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">不利用本平台从事其他法律法规禁止的行为。</span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold">&nbsp;</span></span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">三、第三条</span></span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold"><span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">权利及免责声明</span></span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"></span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont">1.<span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">本平台有权对违反前条用户承诺的内容予以删除，若用户因此触犯相关法律，本平台对此不承担任何法律责任。</span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont">2.<span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">本平台仅为用户发布的内容提供存储空间，本平台不对用户发表、转载的内容提供任何形式的保证：不保证内容满足您的要求，不保证本平台的服务不会中断。因网络状况、通讯线路、第三方网平台或管理部门的要求等任何原因而导致您不能正常使用本平台，本平台不承担任何法律责任。</span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont">3.<span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">用户在本平台发表的内容（包含但不限于本平台目前各产品功能里的内容）仅表明发表者其个人的立场和观点，并不代表本平台的立场或观点。作为内容的发表者，需自行对所发表内容负责，因所发表内容引发的一切纠纷，由该内容的发表者承担全部法律及连带责任。本平台不承担任何法律及连带责任。</span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont">4.<span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">用户在本平台发布侵犯他人知识产权或其他合法权益的内容，本平台有权予以删除，并保留移交司法机关处理的权利。</span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont">5.<span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">本平台对用户上传的产品、服务等内容的真实性等不负事先审查义务；上传人应当在确信自己没有侵害他人权益的前提之下，向本平台上传相关内容，否则应当自行承担有关法律责任。</span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont">6.<span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">如果您认为本平台的产品和服务侵犯了您的合法权益，请及时向本平台书面反馈信息，并提供有效身份证明、相关权属证明、详细侵权情况说明以及对于自身提供的上述资料的真实性的书面保证，本平台在收到上述书面材料并经核实后，将会第一时间移除被控侵权内容，但不承担任何相关法律责任和经济责任</span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont">7.<span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">鉴于网络服务的特殊性，本平台有权在无需通知您的情况下根据本平台及其关联企业的整体运营情况或相关运营规范、规则等，可以随时终止服务或停止运营。若由此给您造成损失的，您同意放弃追究本平台的责任。对于此类情形下可能造成的风险，请您充分了解并同意自行承担由此可能造成的一切不利后果和损失。</span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont">8.<span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">在法律允许的最大限度内，本平台明确表示不对其产品和服务做出任何明示、暗示和强制的担保，包括但不限于安全性、可靠性、稳定性、及时性、适销性、针对特定用途的适用性以及不侵犯所有权或其他权益的担保。通过本平台达成的任何针对产品或服务的交易，所产生的所有权利义务及纠纷均有交易当事方自行负责。本平台不承担任何责任。（但法律法规明确规定的除外）</span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold">&nbsp;</span></span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">四、第四条</span></span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold"><span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">不可抗力</span></span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"></span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold">1.<span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">不可抗力是指不能预见、不能克服并不能避免且对一方或双方造成重大影响的客观事件，包括但不限于自然灾害如洪水、地震、瘟疫流行和风暴等以及社会事件如战争、动乱、法规政策颁布和修改、行政行为、政府决定等。</span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"></span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold">2.<span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">出现上述情况时，本平台将努力在第一时间与相关单位配合，及时进行修复，若由此给您造成损失的，您同意放弃追究本平台的责任。</span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"></span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold">&nbsp;</span></span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">五、第五条</span></span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold"><span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">个人信息保护</span></span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"></span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold">1.<span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">本平台有可能主动收集包括但不限于以下数据和信息：</span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"></span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">①</span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold"><span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">为了优化给您提供的产品和服务，本平台有可能收集您的浏览器性质、操作系统种类、给您提供接入服务的</span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold">ISP</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">域名等，以优化在您计算机或手机屏幕上显示的页面；</span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"></span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">②</span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold"><span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">为了给您提供软件升级服务，需要收集您</span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold">PC</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">端、移动端所安装软件的相关信息，例如：软件名称及版本等；</span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"></span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">③</span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold"><span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">本平台进行客流量统计，从而改进网站的管理和服务，或进行网络行为的调查或研究。</span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"></span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold">2.<span style="box-sizing: border-box;font-weight: bolder;padding: 0px">&nbsp;</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">本平台保护您的个人身份信息、个人网上通信内容、个人消费信息、银行卡信息，以及其他能够据此直接或者间接识别出您个人身份的隐私信息。根据应您的要求，本平台有权将您的个人信息（包括：您的姓名、联系方式及需要接受的服务）提供给第三方，以便第三方联系您并提供相应服务。本协议所述的数据和信息，即您使用本平台平台产品和服务，以及第三方产品和服务中产生的数据和信息不属于本条款所指的隐私信息。</span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"></span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold">3.<span style="box-sizing: border-box;font-weight: bolder;padding: 0px">&nbsp;</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">平台保证不向第三方公开、提供或共享您的隐私信息，但以下情形除外：</span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"></span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">①</span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold"><span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">本平台已获得您的明确授权；</span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"></span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">②</span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold"><span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">本平台为提升产品和服务质量；</span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"></span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">③</span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold"><span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">本根据有关的法律法规要求，本平台负有披露义务的；</span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"></span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">④</span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold"><span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">司法机关或行政机关基于法定程序要求本平台提供的；</span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"></span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">⑤</span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold"><span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">为维护社会公共利益及本平台合法权益，在合理范围内进行披露的。</span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"></span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold">4.<span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">本平台尊重并尽最大努力保护您的隐私信息，但是不能保证现有的安全技术措施能确保您的个人信息不受任何形式的侵犯。您对上述情况充分理解并知晓，对因信息安全技术措施被破解失效、网络遭受病毒入侵、黑客攻击等非本平台过错导致的损失，相关风险和后果均由您自己承担，本平台不承担任何责任。</span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"></span>
                            </p>
                            <p style="box-sizing: border-box;margin: 0 0 3px;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 19px;font-family: AppleSystemUIFontBold">&nbsp;</span></span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">六、第六条</span></span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFontBold"><span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">附则</span></span><span style="box-sizing: border-box;font-weight: bolder;padding: 0px"></span>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont">1.<span style="box-sizing: border-box;padding: 0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">对本声明的解释、修改及更新权均属于本平台所有。</span>
                            </p>
                            <p style="box-sizing: border-box;margin-top: 10px;margin-bottom: 10px;line-height: 1.5;padding: 0px;color: rgb(82, 95, 127);font-family: &#39;Open Sans&#39;, sans-serif;white-space: normal;background-color: rgb(255, 255, 255)">
                                <br/>
                            </p>
                            <p style="box-sizing: border-box;font-size: 14px;line-height: 1.5;padding: 0px;font-family: DengXian;color: rgb(82, 95, 127);white-space: normal;background-color: rgb(255, 255, 255)">
                                <span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: AppleSystemUIFont">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="box-sizing: border-box;padding: 0px;font-size: 16px;font-family: &#39;.PingFang SC&#39;">请自觉遵守上述声明。凡有侵权行为的个人、法人或其它组织，必须立即停止侵权并对其因侵权造成的一切后果承担全部责任和相应赔偿。否则我们将依据中华人民共和国相关法律、法规追究其经济和法律责任。</span>
                            </p>
                            <p>
                                <br/>
                            </p>

                        </div>

                        <div class="modal-footer">
                            {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                            <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-datepicker/dist/locales/bootstrap-datepicker.zh-CN.min.js')}}"></script>
    <script src="{{asset('assets/vendor/moment/min/moment-with-locales.min.js')}}"></script>
    <script src="{{asset('assets/vendor/toastr/build/toastr.min.js') }}"></script>
    <script src="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('assets/js/area.js')}}" type="text/javascript"></script>
    <script type="text/javascript">_init_area();</script>
    <script type="text/javascript">

        // var Gid  = document.getElementById ;
        //
        // var showArea = function(){
        //
        //     Gid('show').innerHTML = "<h3>省" + Gid('s_province').value + " - 市" + Gid('s_city').value + " - 县/区" + Gid('s_county').value + "</h3>"
        //
        // }
        //
        // Gid('s_county').setAttribute('onchange','showArea()');



    </script>

    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });


    </script>
    <script>
        $('#budget').on('blur',function(){
            var budget = document.getElementById('budget').value;
            var cash_deposit = budget*0.01
            $("#cash_deposit").attr("value",cash_deposit);
            // document.getElementById('cash_deposit').value=cash_deposit;
        });
        $('#size').on('blur',function(){
            var size = document.getElementById('size').value;
            var worker = get_worker_num(size);
            // console.log(worker)
            $("#peo").html("(建议使用人数:"+worker+"人)");
            // document.getElementById('cash_deposit').value=cash_deposit;
        });
        function get_worker_num(num){
            var str ="";
             if (num<500) {
                str=2
            }else if(num>500 && num<1000){
                str=3;
            }else if(num>1000 && num<5000){
                str=4;
            }else if(num>5000 && num<20000){
                str=5;
            }else if(num>20000 && num<50000){
                str=8;
            }else if(num>50000 && num<200000){
                str=10;
            }else if(num>200000){
                 str=15
             }

            return str;
        }
        $("#begin_time").datepicker({
            format: 'yyyy-mm-dd',//格式
            minView:'month',//最小显示的控件
            language: 'zh-CN',//显示的语言
            autoclose:true//自动关闭
        })
        $("#end_time").datepicker({
            format: 'yyyy-mm-dd',//格式
            minView:'month',//最小显示的控件
            language: 'zh-CN',//显示的语言
            autoclose:true//自动关闭
        })

    </script>
    <script>
        function submit(){
            var project_name = document.getElementById('project_name').value;
            var address = document.getElementById('address').value;
            var begin_time = document.getElementById('begin_time').value;
            var end_time = document.getElementById('end_time').value;
            var size = document.getElementById('size').value;
            var budget = document.getElementById('budget').value;
            var people_num = document.getElementById('people_num').value;
            if(project_name === '') {toastr.warning('请填写项目名称');return false;}
            if(address === '') {toastr.warning('请填写项目地址');return false;}
            if(begin_time === '') {toastr.warning('请选择项目开始时间');return false;}
            if(end_time === '') {toastr.warning('请选择项目结束时间');return false;}
            if(size === '') {toastr.warning('请填写项目大小');return false;}
            if(budget === '') {toastr.warning('项目预算为多少？');return false;}
            if(people_num === '') {toastr.warning('本项目最低需要几人？');return false;}
            if(!$("input[type='checkbox']").prop('checked')){toastr.warning('请阅读《严度平台免责申明》后勾选申明');return false;}

            // if($('input[name="state"]').prop("checked")){toastr.warning('请阅读申明后勾选申明');return false;}

            var formData = new FormData($('#project_form')[0]);

            $.ajax({
                type: 'POST',
                url: '/admin/project/edit',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                },
                success : function (data) {
                    if(data.status){
                        Swal.fire({
                            title: data.message,
                            type: 'success',
                            focusConfirm: false, //聚焦到确定按钮
                            showCloseButton: true,//右上角关闭
                            timer: 2000
                        })
                        setTimeout(function(){
                            location.href = '{{url('admin/project/index')}}';
                        },2000);
                    }else {
                        $.each(data.errors, function(idx, obj) {
                            toastr.warning(obj[0]);
                            // alert(obj[0]);
                            return false;
                        });
                    }
                }
            })

        }
    </script>

@endsection