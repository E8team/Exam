@extends('layouts.auth')
@section('title')忘记密码@endsection
@section('content')
    <div class="container mks_container">
        <div class="mks_container_main">
            <div class="mks_container_form">
                <h2>忘记密码</h2>
                <form method="post" action="{{route('password.email')}}">
                    <div class="form-groupv{!! $errors->has('email') ? ' has-error' : '' !!}">
                        <label for="exampleInputEmail1">邮箱地址</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"  value="{{old('email')}}" placeholder="请输入您的邮箱">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <input type="submit" class="btn btn-info btn-lg next_btn" value="发送邮箱验证链接" />
                </form>
                <div class="forget"><a href="{{route('login')}}">返回登录</a></div>
            </div>
        </div>
    </div>
@endsection
