@extends('layouts.auth')
@section('title')
    <title>忘记密码</title>
@endsection
@section('styles')
    <link rel="stylesheet" href="{!! asset(mix('static/login.css')) !!}">
@endsection
@section('content')
    <div class="container mks_container">
        <div class="mks_container_main">
            <div class="mks_container_form">
                <h2>忘记密码</h2>
                <form method="post" action="##">
                    <div class="form-group">
                        <label for="exampleInputstudent_id">学号</label>
                        <input type="text" class="form-control" id="student_id" placeholder="请输入学号">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">邮箱地址</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                    </div>
                    <!--<div class="form-group">
                      <label for="exampleInputPassword1">验证码</label>
                      <div>
                      <input type="text" class="form-control verification" id="exampleInputPassword1" placeholder="请输入您收到的验证码">
                      <button type="submit" class="btn btn-default verification_btn">获取验证码</button></div>
                    </div>-->
                    <a href="reset.html" type="button" class="btn btn-info btn-lg next_btn">提交</a>
                </form>
                <div class="forget"><a href="#">返回登录</a></div>
            </div>
        </div>
    </div>
@endsection
