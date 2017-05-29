@extends('layouts.auth')
@section('title')
    选择课程
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
                        <label class="col-sm-8 form-control-static control-main">{{$user_class['department']}}</label>
                    </div>
                    <div class="form-group form_text">
                        <label class="col-sm-4 control-label control-title">专业</label>
                        <label class="col-sm-8 form-control-static control-main">{{$user_class['major']}}</label>
                    </div>
                    <div class="form-group form_text">
                        <label class="col-sm-4 control-label control-title">班级</label>
                        <label class="col-sm-8 form-control-static control-main">{{$user_class['grade'].'级'.$user_class['class'].'班'}}</label>
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
