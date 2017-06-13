<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title') - {!! config('app.name') !!}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{!! asset(mix('static/css/bootstarp.css')) !!}" >
    <link rel="stylesheet" href="{!! asset(mix('static/css/app.css')) !!}" >
    <script src="https://unpkg.com/alloylever@1.0.0/alloy-lever.js"></script>
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
            <p class="title hidden-xs">{!! config('app.name') !!}</p>
            @if (Route::has('login'))
                <div class="top-right links">
                    <div class="login">
                        <div class="btn-group" role="group">
                            @if (Auth::check())
                                <a href="{!! url('/') !!}" class="btn btn-default">欢迎&nbsp;{{Auth::user()->name}}&nbsp;同学</a>
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
    AlloyLever.config({
      cdn:'//s.url.cn/qqun/qun/qqweb/m/qun/confession/js/vconsole.min.js',  //vconsole的CDN地址
      reportUrl: "//a.qq.com",  //错误上报地址
      reportPrefix: 'qun',    //错误上报msg前缀，一般用于标识业务类型
      reportKey: 'msg',        //错误上报msg前缀的key，用户上报系统接收存储msg
      otherReport: {              //需要上报的其他信息
          uin: 491862102
      },
      // entry:""          //请点击这个DOM元素6次召唤vConsole。//你可以通过AlloyLever.entry('#entry2')设置多个机关入口召唤神龙
  })
</script>
</body>
</html>
