@extends('layouts.auth')
@section('title')重置密码@endsection
@section('login_right')
    <div class="login_right">
        <a class="reg" href="{{route('login')}}">登录</a>
    </div>
@endsection
@section('content')
    <div class="container mks_container">
        <div class="mks_container_main">
            <div class="mks_container_form">
                <h2>重置密码</h2>
                <form method="post" action="{{ route('password.request') }}">
                    {{--把发送的token带回去验证--}}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label>邮箱</label>
                        <input type="text" name="email" class="form-control" placeholder="请输入注册时的邮箱" {{old('email')}} required>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label>新密码</label>
                        <input type="password" name="password" class="form-control" placeholder="密码长度为最低6位" {{old('password')}} required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label>重复密码</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="请与新密码保持一致" {{old('password_confirmation')}} required>
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                    <input type="submit" class="btn btn-info btn-lg next_btn" value="确认重置"/>
                </form>
                <div class="forget"><a href="{{url('/')}}">放弃修改，返回首页</a></div>
            </div>
        </div>
    </div>
@endsection
