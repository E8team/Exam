@extends('layouts.auth')
@section('title')
    <title>注册成功</title>
@endsection

@section('content')
    <div class="container mks_container">
        <div class="mks_container_main prompt prompt_success">
            <div class="title prompt_title prompt_title_h3 center-block">
                <img src="img/true.png"><h3>恭喜您注册成功</h3>
            </div>
            <a href="login.html" type="button" class="btn btn-info btn-lg next_btn login_btn">立即登录</a>
        </div>
    </div>
@endsection
