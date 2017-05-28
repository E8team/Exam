@extends('layouts.auth')
@section('title')
    <title>选择课程</title>
@endsection

@section('content')
    <div class="container mks_container_information">
        <div class="mks_container_main">
            <div class="mks_container_form">
                <h2>选择课程</h2>
                <form method="post" action="##">
                    <div class="form-group form_text">
                        <label class="col-sm-4 control-label control-title">学号</label>
                        <label class="col-sm-8 form-control-static control-main">1508220235</label>
                    </div>
                    <div class="form-group form_text">
                        <label class="col-sm-4 control-label control-title">姓名</label>
                        <label class="col-sm-8 form-control-static control-main">叶奇</label>
                    </div>
                    <div class="form-group form_text">
                        <label class="col-sm-4 control-label control-title">院系</label>
                        <label class="col-sm-8 form-control-static control-main">计算机学院</label>
                    </div>
                    <div class="form-group form_text">
                        <label class="col-sm-4 control-label control-title">专业</label>
                        <label class="col-sm-8 form-control-static control-main">网络工程(对口)</label>
                    </div>
                    <div class="form-group form_text">
                        <label class="col-sm-4 control-label control-title">班级</label>
                        <label class="col-sm-8 form-control-static control-main">网络工程(对口)15(3)</label>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">考试课程</label>
                    </div>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox1" value="option1">马克思主义基本原理概率
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox2" value="option2">中国近代史纲要
                    </label>
                    <a href="reg_3.html" type="button" class="btn btn-info btn-lg next_btn">提交</a>
                </form>
            </div>
        </div>
    </div>
@endsection
