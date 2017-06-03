@extends('layouts.app')
@section('title')菜单@endsection
@section('content')

<div class="container">
  <div class="menu_body">
    <!-- 左边 -->
    <div class="personal_center col-md-4 col-lg-4 ">
      <div class="head_portrait">
          <h2>{!! $course->name !!}</h2>
      </div>
      <div class="personal_info">
        <div class="info_item">
          <p>姓　名：</p>
          <span>{{$user->name}}</span>
        </div>
        <div class="info_item">
          <p>学　号：</p>
          <span>{!! $user->student_num !!}</span>
        </div>
        <div class="info_item">
          <p>邮箱：</p>
          <span>{!! $user->email !!}</span>
        </div>
        <div class="info_item">
          <p>院　系：</p>
          <span>{{$departmentClass->getDepartment()->title}}</span>
        </div>
        <div class="info_item">
          <p>专　业：</p>
          <span>{{$departmentClass->getMajor()->title}}</span>
        </div>
        <div class="info_item">
          <p>班　级：</p>
          <span>{{$departmentClass->getGrade()->title.'级'.$departmentClass->title.'班'}}</span>
        </div>
      </div>
    </div>

    <!-- 右边 -->
    <div class="pattern_info col-md-8 col-lg-8 col-sm-12 col-xs-12">
      <!-- 顺序练习 -->
      <div class="simulation">
        <h2 class="title">顺序练习</h2>
        <div class="content">
          <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <ul class="main">
              <li>
                <em class="right"></em>
                <span>做对11题</span>
                <span>占比0.8%</span>
              </li>
              <li>
                <em class="error"></em>
                <span>做错9题</span>
                <span>占比0.6%</span>
              </li>
              <li>
                <em class="no"></em>
                <span>未做1305题</span>
                <span>占比98.6%</span>
              </li>
            </ul>
          </div>
          <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <ul class="choose_btn">
              <li><button type="button" class="btn btn-info">继续练习</button></li>
              <li><button type="button" class="btn btn-primary">重新开始</button></li>
              <li><button type="button" class="btn btn-danger">错题重做</button></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- 全真模拟 -->
      <div class="practice">
        <h2 class="title">全真模拟</h2>
        <div class="content">
          <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <div class="data">
              <div class="cumula_ball">
                <span>累计做题数</span>
                <p>2504</p>
              </div>
              <ul>
                <li>
                  <p class="num">12</p>
                  <p>及格次数</p>
                </li>
                <li>
                  <p class="num">20</p>
                  <p>累计考试次数</p>
                </li>
                <li>
                  <p class="num">96</p>
                  <p>历史最高</p>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <div class="practice_btn">
              <button type="button" class="btn btn-info">模拟考试</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
