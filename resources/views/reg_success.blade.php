@extends('layouts.auth')
@section('title')
    注册成功
@endsection
@section('login_right')
    <div class="login_right">
        <div class="btn-group">
            <a href="#" class="btn btn-default user_name">欢迎&nbsp;{{Auth::user()->name}}&nbsp;同学</a>
            <a href="{{ route('logout') }}" class="btn btn-info user_exit">退出</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="container mks_container">
        <div class="mks_container_main prompt prompt_success">
            <div class="title prompt_title prompt_title_h3 center-block">
                <img src="{!! asset('static/images/true.png') !!}"><h3>恭喜您注册成功</h3>
            </div>
            <a href="{{route('choose')}}" ><button type="button" class="btn btn-info btn-lg next_btn login_btn">选择课程</button></a>
        </div>
    </div>
@endsection
