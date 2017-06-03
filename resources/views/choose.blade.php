@extends('layouts.auth')
@section('title')
    选择课程
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
    <div class="container mks_container_information">
        <div class="mks_container_main">
            <div class="mks_container_form">
                <h2>选择课程</h2>
                <form method="post" action="{{route('choose')}}">
                    <div class="form-group form_text">
                        <label class="col-sm-4 control-label control-title">学号</label>
                        <label class="col-sm-8 form-control-static control-main">{{$user->student_num}}</label>
                    </div>
                    <div class="form-group form_text">
                        <label class="col-sm-4 control-label control-title">姓名</label>
                        <label class="col-sm-8 form-control-static control-main">{{$user->name}}</label>
                    </div>
                    <div class="form-group form_text">
                        <label class="col-sm-4 control-label control-title">院系</label>
                        <label class="col-sm-8 form-control-static control-main">{{$departmentClass->getDepartment()->title}}</label>
                    </div>
                    <div class="form-group form_text">
                        <label class="col-sm-4 control-label control-title">专业</label>
                        <label class="col-sm-8 form-control-static control-main">{{$departmentClass->getMajor()->title}}</label>
                    </div>
                    <div class="form-group form_text">
                        <label class="col-sm-4 control-label control-title">班级</label>
                        <label class="col-sm-8 form-control-static control-main">{{$departmentClass->getGrade()->title.'级'.$departmentClass->title.'班'}}</label>
                    </div>
                    <div class="form-group{!! $errors->has('course_ids') ? ' has-error' : '' !!}">
                        <label for="exampleInputEmail1">考试课程</label>
                        @if ($errors->has('course_ids'))
                            <span class="help-block">
                                <strong>{{ $errors->first('course_ids') }}</strong>
                            </span>
                        @endif
                    </div>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="course_ids[]" id="inlineCheckbox1" value="1">马克思主义基本原理概率
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="course_ids[]" id="inlineCheckbox2" value="2">中国近代史纲要
                    </label>
                    <input type="submit" class="btn btn-info btn-lg next_btn" value="提交"/>
                </form>
            </div>
        </div>
    </div>
@endsection
