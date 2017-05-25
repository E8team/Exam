@extends('layouts.app')
@section('content')
<div class="up_top_padding container">
  <div class="exam_state">
    <div class="crumbs">
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Library</a></li>
        <li class="active">Data</li>
      </ol>
    </div>
    <div class="progress_bar">
      <div class="progress_box">
        <em class="page_done"></em>
      </div>
      <div class="txt">
        <span>已完成23题</span>
        / 共500题
      </div>
    </div>
  </div>
  <!--练习部分-->
  <div class="exam_body">
    <div class="col-md-4">
      <div class="remind_box">
        <!-- 提醒框头部 -->
        <div class="header">
          <h3 class="title">题号</h3>
          <div class="count_down">
            结束倒计时
            <span class="time">00:48:39</span>
          </div>
          <div class="seting">
            <i class="glyphicon glyphicon-cog"></i>
            <div class="seting_body">
              这里面是设置
            </div>
          </div>
        </div>
        <!-- 提醒框内容 -->
        <div class="remind_content">
          <ul class="subject_list">
            <li><a class="error" href="javascript:;">1</a></li>
            <li><a class="error" href="javascript:;">2</a></li>
            <li><a class="right" href="javascript:;">3</a></li>
            <li><a class="right" href="javascript:;">4</a></li>
            <li><a class="right" href="javascript:;">5</a></li>
            <li><a href="javascript:;">6</a></li>
            <li><a class="error" href="javascript:;">7</a></li>
            <li><a class="error" href="javascript:;">8</a></li>
            <li><a class="right" href="javascript:;">9</a></li>
            <li><a class="right" href="javascript:;">10</a></li>
            <li><a class="right" href="javascript:;">11</a></li>
            <li><a href="javascript:;">12</a></li>
            <li><a class="error" href="javascript:;">13</a></li>
            <li><a class="error" href="javascript:;">14</a></li>
            <li><a class="right" href="javascript:;">15</a></li>
            <li><a class="right" href="javascript:;">16</a></li>
            <li><a class="right" href="javascript:;">17</a></li>
            <li><a href="javascript:;">18</a></li>
          </ul>
        </div>
        <div class="footer">
          <ul class="subject_state">
            <li>
              <span>错误</span>
              <em class="error"></em>
            </li>
            <li>
              <span>正确</span>
              <em class="right"></em>
            </li>
            <li>
              <span>未做</span>
              <em></em>
            </li>
          </ul>
          <a type="button" class="btn btn-primary">交卷</a>
        </div>
      </div>
    </div>
    <!-- 题目列表 -->
    <div class="col-md-8">
      <div class="exam_main">
        <ul class="exam_list">
          <li class="exam_item">
            <p class="subject">1.在控制台运行一个 Java 程序 Test . class ，使用的命令正确的是( )</p>
            <ul class="option_list">
              <li class="option_item">
                <label>
                  <input type="radio" name="tobic_1" checked>
                  A.java Test . class
                </label>
              </li>
              <li class="option_item">
                <label>
                  <input type="radio" name="tobic_1">
                  B.java Test . class
                </label>
              </li>
              <li class="option_item">
                <label>
                  <input type="radio" name="tobic_1">
                  C.java Test . class
                </label>
              </li>
              <li class="option_item">
                <label>
                  <input type="radio" name="tobic_1">
                  D.java Test . class
                </label>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection