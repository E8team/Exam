<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta name="renderer" content="webkit">
    <meta charset="utf-8">
    @section('title')
    @endsection
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="./lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{!! asset(mix('static/css/comm.css')) !!}">
    <link rel="stylesheet" href="{!! asset(mix('static/login.css')) !!}">
    {{--@section('styles')
    @endsection--}}
</head>
</head>
<body>
<!-- 导航栏 -->
<div class="nav">
    <div class="container">
        <a class="logo" href="javascript:;">
            <img src="{!! asset(mix('static/images/logo.png')) !!}">
        </a>
        <p class="title">马克思学院考试系统</p>
        <div class="login_right">
            已有账号，直接 <a href="#">登录</a>
        </div>
    </div>
</div>
@yield('content')
<!-- 底部 -->
<div class="footer_nav">E8网络技术联盟</div>
</body>
</html>
