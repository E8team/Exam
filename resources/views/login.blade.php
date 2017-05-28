@extends('layouts.auth')
@section('title')
    <title>登录</title>
@endsection

@section('content')
    <div class="container mks_container">
        <div class="mks_container_main">
            <div class="mks_container_form">
                <h2>用户登录</h2>
                <form method="post" action="##">
                    <div class="form-group">
                        <label for="exampleInputstudent_id">学号</label>
                        <input type="text" class="form-control" id="student_id" placeholder="请输入学号">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">密码</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="请输入密码"	>
                    </div>
                    <a href="index.html" type="button" class="btn btn-info btn-lg next_btn">登录</a>
                </form>
                <div class="forget"><a href="forget.html" >忘记密码</a></div>
            </div>
        </div>
    </div>
@endsection
