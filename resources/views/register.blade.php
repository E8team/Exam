@extends('layouts.auth')
@section('title')
    <title>注册</title>
@endsection

@section('content')
    <div class="container mks_container">
        <div class="mks_container_main">
            <div class="mks_container_form">
                <h2>账号注册</h2>
                <form method="post" action="##">
                    <div class="form-group">
                        <label for="exampleInputstudent_id">学号</label>
                        <input type="text" name="student_num" class="form-control" id="student_id" placeholder="请输入学号">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputid_number">身份证号码</label>
                        <input type="text" name="id_card" class="form-control" id="id_number" placeholder="身份证号码后6位">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">邮箱地址</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">设置密码</label>
                        <input type="password"  class="form-control" id="exampleInputPassword1" placeholder="密码长度需要在 6~24 位之间"	>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">确认密码</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="请再次输入密码">
                    </div>
                    <a href="reg_2.html" type="button" class="btn btn-info btn-lg next_btn">下一步</a>
                </form>
            </div>
        </div>
    </div>
@endsection
