@extends('layouts.auth')
@section('title')
    <title>重置密码</title>
@endsection

@section('content')
    <div class="container mks_container">
        <div class="mks_container_main">
            <div class="mks_container_form">
                <h2>重置密码</h2>
                <form method="post" action="##">
                    <div class="form-group">
                        <label for="exampleInputPassword1">新密码</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="密码长度需要在 6~24 位之间"	>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">重复密码</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="请与新密码保持一致"	>
                    </div>
                    <a href="login.html" type="button" class="btn btn-info btn-lg next_btn">确认密码</a>
                </form>
                <div class="forget"><a href="index.html" >放弃密码修改，返回首页</a></div>
            </div>
        </div>
    </div>
@endsection
