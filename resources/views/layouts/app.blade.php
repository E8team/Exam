<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title') - 马克思学院在线考试系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{!! asset(mix('static/css/app.css')) !!}" >
    @yield('styles')
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{ asset('static/js/es5-shim.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/es5-sham.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/respond.min.js') }}"></script>
    <![endif]-->
    <script src="{!! asset(mix('static/js/app.js')) !!}"></script>
</head>
<body>
<!-- 导航栏 -->
<div class="main">
    <!-- 导航栏 -->
    <div class="nav">
        <div class="container">
            <a class="logo" href="{{url('/')}}">
                <img src="{!! asset('static/images/logo.png') !!}">
            </a>
            <p class="title">马克思学院考试系统</p>
            @if (Route::has('login'))
                <div class="top-right links">
                    <div class="login">
                        <div class="btn-group" role="group">
                            @if (Auth::check())
                                <a href="#" class="btn btn-default">{{Auth::user()->name}}</a>
                                <a href="{{ route('logout') }}" class="btn btn-info">退出</a>
                            @else
                                <a href="{{route('login')}}" class="btn btn-default">登录</a>
                                <a href="{{route('register')}}" class="btn btn-info">注册</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @yield('content')
    <div class="footer_nav">E8net</div>
</div>

@yield('js')
@stack('js')
<script>
    $(function () {
        $(".chevron-down").click(function () {
            $(document.body).animate({
                'scrollTop': $('.course').offset().top
            }, 500);
        });
    });
</script>
</body>
</html>
