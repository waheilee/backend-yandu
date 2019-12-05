<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Free HTML5 Website Template" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />

    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('web/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/style.css')}}">
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark probootstrap-navabr-dark">
    <div class="container">
        <a class="navbar-brand" href="index.html">严度</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#probootstrap-nav" aria-controls="probootstrap-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="probootstrap-nav">
            <ul class="navbar-nav ml-auto">
                {{--<li class="nav-item"><a href="index.html" class="nav-link">Home</a></li>--}}
                {{--<li class="nav-item"><a href="about.html" class="nav-link">About</a></li>--}}
                {{--<li class="nav-item"><a href="services.html" class="nav-link">Services</a></li>--}}
                {{--<li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>--}}
                {{--<li class="nav-item probootstrap-cta probootstrap-seperator"><a href="#" class="nav-link">Sign up</a></li>--}}
                <li class="nav-item probootstrap-cta probootstrap-seperator"><a href="{{route('login')}}" class="nav-link">登录</a></li>
            </ul>

        </div>
    </div>
</nav>


<section class="probootstrap-cover">
    <div class="container">
        <div class="row probootstrap-vh-100 align-items-center text-center">
            <div class="col-sm">
                <div class="probootstrap-text">
                    <h1 class="probootstrap-heading text-white mb-4">除醛、安全、保障</h1>
                    <div class="probootstrap-subheading mb-5">
                        <p class="h4 font-weight-normal">提供快速专业的除醛、空气净化等服务</p>
                    </div>
                    {{--<p><a href="#" class="btn btn-primary mr-2 mb-2">Get This for Free</a><a href="#" class="btn btn-primary btn-outline-white mb-2">Visit uiCookies</a></p>--}}
                </div>
            </div>
        </div>
    </div>
</section>

{{--<section class="probootstrap-section">--}}
    {{--<div class="container">--}}
        {{--<div class="row align-items-center">--}}
            {{--<div class="col-md pr-md-5 pr-0 mb-5">--}}
                {{--<h1 class="mb-4 display-5">More Templates</h1>--}}
                {{--<div class="probootstrap-item mb-4">--}}
                    {{--<h3>Free Download</h3>--}}
                    {{--<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>--}}
                {{--</div>--}}
                {{--<div class="probootstrap-item mb-4">--}}
                    {{--<h3>Keep Updated</h3>--}}
                    {{--<p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>--}}
                {{--</div>--}}
                {{--<div class="probootstrap-item mb-4">--}}
                    {{--<h3>New Releases Every Week</h3>--}}
                    {{--<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="col-md pl-md-5 pl-0 probootstrap-image-grid">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-6">--}}
                        {{--<a class="probootstrap-img-item" href="#"><span class="icon icon-plus"></span><div style="background-image: url(images/img_1.jpg);"></div></a>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-6">--}}
                        {{--<a class="probootstrap-img-item" href="#"><span class="icon icon-plus"></span><div style="background-image: url(images/img_2.jpg);"></div></a>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-6">--}}
                        {{--<a class="probootstrap-img-item" href="#"><span class="icon icon-plus"></span><div style="background-image: url(images/img_3.jpg);"></div></a>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-6">--}}
                        {{--<a class="probootstrap-img-item" href="#"><span class="icon icon-plus"></span><div style="background-image: url(images/img_4.jpg);"></div></a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}
{{--</section>--}}
{{--<div class="tlinks">Collect from <a href="http://www.cssmoban.com/"  title="网站模板">网站模板</a></div>--}}
{{--<section class="probootstrap-section probootstrap-section-feature pb-0 probootstrap-overflow-hidden">--}}
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-6 pl-md-5 pb-5 order-md-2 order-1">--}}
                {{--<h2 class="mb-4 display-5 probootstrap-heading">Free Template by uiCookies</h2>--}}
                {{--<div class="probootstrap-item mb-4">--}}
                    {{--<h3>Free Download</h3>--}}
                    {{--<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>--}}
                {{--</div>--}}
                {{--<div class="probootstrap-item mb-4">--}}
                    {{--<h3>Keep Updated</h3>--}}
                    {{--<p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>--}}
                {{--</div>--}}
                {{--<div class="probootstrap-item mb-4">--}}
                    {{--<h3>New Releases Every Week</h3>--}}
                    {{--<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>--}}
                {{--</div>--}}
                {{--<div class="probootstrap-item mb-4">--}}
                    {{--<h3>Donate Any Amount</h3>--}}
                    {{--<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="col-md-6 pr-md-5 order-md-1 order-2">--}}
                {{--<div class="probootstrap-device">--}}
                    {{--<img src="images/phone_3.png" alt="Free Bootstrap 4 Template" class="img-fluid mb-md-0 mb-5">--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}
{{--</section>--}}

{{--<section class="probootstrap-section">--}}
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-lg">--}}
                {{--<div class="media mb-md-0 mb-3">--}}
                    {{--<div class="probootstrap-icon"><span class="icon-fingerprint display-4"></span></div>--}}
                    {{--<div class="media-body">--}}
                        {{--<h5 class="mt-0">Free Bootstrap 4</h5>--}}
                        {{--<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-lg">--}}
                {{--<div class="media mb-md-0 mb-3">--}}
                    {{--<div class="probootstrap-icon"><span class="icon-users display-4"></span></div>--}}
                    {{--<div class="media-body">--}}
                        {{--<h5 class="mt-0">For The Community</h5>--}}
                        {{--<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-lg">--}}
                {{--<div class="media mb-md-0 mb-3">--}}
                    {{--<div class="probootstrap-icon"><span class="icon-chat display-4"></span></div>--}}
                    {{--<div class="media-body">--}}
                        {{--<h5 class="mt-0">Support Us By Sharing This to Others</h5>--}}
                        {{--<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</section>--}}

{{--<footer class="probootstrap-footer">--}}
    {{--<div class="container">--}}
        {{--<div class="row mb-5">--}}
            {{--<div class="col-md-8">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-lg mb-4"><h2 class="probootstrap-heading"><a href="#">Unlock</a></h2></div>--}}
                    {{--<div class="col-lg">--}}
                        {{--<div class="probootstrap-footer-widget mb-4">--}}
                            {{--<h2 class="probootstrap-heading-2">Company</h2>--}}
                            {{--<ul class="list-unstyled">--}}
                                {{--<li><a href="#" class="py-2 d-block">About</a></li>--}}
                                {{--<li><a href="#" class="py-2 d-block">Jobs</a></li>--}}
                                {{--<li><a href="#" class="py-2 d-block">Press</a></li>--}}
                                {{--<li><a href="#" class="py-2 d-block">News</a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-lg">--}}
                        {{--<div class="probootstrap-footer-widget mb-4">--}}
                            {{--<h2 class="probootstrap-heading-2">Communities</h2>--}}
                            {{--<ul class="list-unstyled">--}}
                                {{--<li><a href="#" class="py-2 d-block">Support</a></li>--}}
                                {{--<li><a href="#" class="py-2 d-block">Sharing is Caring</a></li>--}}
                                {{--<li><a href="#" class="py-2 d-block">Better Web</a></li>--}}
                                {{--<li><a href="#" class="py-2 d-block">News</a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-lg">--}}
                        {{--<div class="probootstrap-footer-widget mb-4">--}}
                            {{--<h2 class="probootstrap-heading-2">Useful links</h2>--}}
                            {{--<ul class="list-unstyled">--}}
                                {{--<li><a href="#" class="py-2 d-block">Bootstrap 4</a></li>--}}
                                {{--<li><a href="#" class="py-2 d-block">jQuery</a></li>--}}
                                {{--<li><a href="#" class="py-2 d-block">HTML5</a></li>--}}
                                {{--<li><a href="#" class="py-2 d-block">Sass</a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-4">--}}
                {{--<div class="probootstrap-footer-widget mb-4">--}}
                    {{--<ul class="probootstrap-footer-social list-unstyled float-md-right float-lft">--}}
                        {{--<li><a href="#"><span class="icon-twitter"></span></a></li>--}}
                        {{--<li><a href="#"><span class="icon-facebook"></span></a></li>--}}
                        {{--<li><a href="#"><span class="icon-instagram"></span></a></li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="col-md text-left">--}}
                {{--<ul class="list-unstyled footer-small-nav">--}}
                    {{--<li><a href="#">Legal</a></li>--}}
                    {{--<li><a href="#">Privacy</a></li>--}}
                    {{--<li><a href="#">Cookies</a></li>--}}
                    {{--<li><a href="#">Terms</a></li>--}}
                    {{--<li><a href="#">About</a></li>--}}
                {{--</ul>--}}
            {{--</div>--}}
            {{--<div class="col-md text-md-right text-left">--}}
                {{--<p><small>Copyright &copy; 2018.proCompany name All rights reserved.More Templates <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></small></p>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</footer>--}}


<script src="{{asset('web/js/jquery-3.2.1.slim.min.js')}}"></script>
<script src="{{asset('web/js/popper.min.js')}}"></script>
<script src="{{asset('web/js/bootstrap.min.js')}}"></script>
<script src="{{asset('web/js/main.js')}}"></script>
</body>
</html>