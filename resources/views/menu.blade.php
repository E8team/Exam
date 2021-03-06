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
          <p>邮　箱：</p>
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
                <span>做对 {{$practiceInfo['correct']}} 题</span>
                <span>占比 {{$practiceInfo['correct_rate']}} %</span>
              </li>
              <li>
                <em class="error"></em>
                <span>做错 {{$practiceInfo['mistake']}} 题</span>
                <span>占比 {{$practiceInfo['mistake_rate']}} %</span>
              </li>
              <li>
                <em class="no"></em>
                <span>未做 {{$practiceInfo['unfinished']}} 题</span>
                <span>占比 {{$practiceInfo['unfinished_rate']}} %</span>
              </li>
            </ul>
          </div>
          <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <ul class="choose_btn">
              {{--<li><a type="button" class="btn btn-info">继续练习</a></li>--}}
              <li><a href="{{route('practice',$course->id)}}" type="button" class="btn btn-success">继续答题</a></li>
              <li><a href="{!! route('reset_practice', $course->id) !!}" type="button" class="btn btn-danger">重新开始</a></li>
              {{--<li><a type="button" class="btn btn-danger">错题重做</a></li>--}}
            </ul>
          </div>
        </div>
      </div>
      <!-- 全真模拟 -->
      <div class="practice">
        <h2 class="title">随机答题</h2>
        <div class="content">
          <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <div class="data">
              <div class="cumula_ball">
                <span>累计答题数</span>
                <p>{{$topicInfo['recordCount']}}</p>
              </div>
              <ul>
                <li>
                  <p class="num">{{$topicInfo['passCount']}}</p>
                  <p>及格次数</p>
                </li>
                <li>
                  <p class="num">{{$topicInfo['examCount']}}</p>
                  <p>考试次数</p>
                </li>
                <li>
                  <p class="num">{{$topicInfo['maxScore']}}</p>
                  <p>历史最高</p>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <form action="{!! route('create_mock') !!}" method="post">
              <div class="practice_btn">
                {!! csrf_field() !!}
                <input type="hidden" name="course_id" value="{!! $course->id !!}">
                <button type="submit" class="btn btn-info">随机答题</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
