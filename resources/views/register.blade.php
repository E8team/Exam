@extends('layouts.auth')
@section('title')注册@endsection
@section('login_right')
    <div class="login_right">
        已有账号？点击 <a class="reg" href="{{route('login')}}">登录</a>
    </div>
@endsection
@section('content')
    <div class="container mks_container">
        <div class="mks_container_main">
            <div class="mks_container_form">
                <h2>账号注册</h2>
                <form method="post" action="{{ route('register') }}">
                    <div class="form-group{!! $errors->has('student_num') ? ' has-error' : '' !!}">
                        <label for="student_num">学号</label>
                        <input type="text" name="student_num" value="{{old('student_num')}}" class="form-control" id="student_id" placeholder="请输入学号">
                        @if ($errors->has('student_num'))
                            <span class="help-block">
                                <strong>{{ $errors->first('student_num') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{!! $errors->has('id_card') ? ' has-error' : '' !!}">
                        <label for="exampleInputid_number">身份证号后六位</label>
                        <input type="text" name="id_card" value="{{old('id_card')}}" class="form-control" id="id_number" placeholder="身份证号码后6位">
                        @if ($errors->has('id_card'))
                            <span class="help-block">
                                <strong>{{ $errors->first('id_card') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{!! $errors->has('email') ? ' has-error' : '' !!}">
                        <label for="exampleInputEmail1">邮箱地址</label>
                        <input type="email" name="email" value="{{old('email')}}" class="form-control" id="exampleInputEmail1"
                               placeholder="Email">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{!! $errors->has('password') ? ' has-error' : '' !!}">
                        <label for="exampleInputPassword1">设置密码</label>
                        <input type="password" name="password" value="{{old('password')}}" class="form-control" id="exampleInputPassword1"
                               placeholder="密码长度需要在 6~24 位之间">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{!! $errors->has('password_confirmation') ? ' has-error' : '' !!}">
                        <label for="exampleInputPassword1">确认密码</label>
                        <input type="password" name="password_confirmation"  class="form-control"
                               id="exampleInputPassword1" placeholder="请再次输入密码">
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                    <input type="submit" class="btn btn-info btn-lg next_btn" value="下一步"/>
                </form>
            </div>
        </div>
    </div>
@endsection
