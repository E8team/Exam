@extends('layouts.auth')
@section('title')登录@endsection
@section('login_right')
    <div class="login_right">
        <a class="reg" href="{{route('register')}}">注册</a>
    </div>
@endsection
@section('content')
    <div class="container mks_container">
        <div class="mks_container_main">
            <div class="mks_container_form">
                <h2>用户登录</h2>
                <form method="post" action="{{route('login')}}">
                    {!! csrf_field() !!}
                    <div class="form-group{!! $errors->has('student_num') ? ' has-error' : '' !!}">
                        <label for="student_id">学号</label>
                        <input type="text" class="form-control" id="student_id" name="student_num" value="{{ old('student_num') }}" placeholder="请输入学号">
                        @if ($errors->has('student_num'))
                            <span class="help-block">
                                <strong>{{ $errors->first('student_num') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{!! $errors->has('password') ? ' has-error' : '' !!}">
                        <label for="password">密码</label>
                        <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}" placeholder="请输入密码">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <input type="submit" class="btn btn-info btn-lg next_btn" value="登录"/>
                </form>
                <div class="forget"><a href="{{ route('password.request') }}" >忘记密码</a></div>
            </div>
        </div>
    </div>
@endsection
