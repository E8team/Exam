<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta name="renderer" content="webkit">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - 马克思学院在线考试系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{!! asset('static/css/comm.css') !!}">
    <link rel="stylesheet" href="{!! asset('static/css/login.css') !!}">
    @yield('styles')
</head>
<body>
<!-- 导航栏 -->
<div class="nav">
    <div class="container">
        <a class="logo" href="{{url('/')}}">
            <img src="{!! asset('static/images/logo.png') !!}">
        </a>
        <p class="title">马克思学院考试系统</p>
        <div class="login_right">
            @if (Auth::guest())
                还没有账号，点击 <a href="{{route('register')}}">注册</a>
            @else
                <a class="btn btn-default">欢迎{{Auth::user()->name}}同学</a>
                <a href="{{ route('logout') }}" class="btn btn-info">退出</a>
            @endif
        </div>
    </div>
</div>
{!! Facades\App\Widgets\Alert::render() !!}
@yield('content')
<!-- 底部 -->
<div class="footer_nav">E8网络技术联盟</div>
</body>
</html>
