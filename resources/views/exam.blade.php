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
    <div class="col-md-4 col-lg-4 hidden-sm hidden-xs">
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
    <div class="col-md-8 col-lg-8 col-sm-12">
      <div class="exam_main">
        <ul class="exam_list">
          <li class="exam_item">
            <p class="subject">1.在控制台运行一个 Java 程序 Test . class ，使用的命令正确的是( )</p>
            <ul class="option_list">
              <li class="option_right_active option_item">
                <label>
                  <input type="radio" name="tobic_1" checked>
                  <span class="letter">A</span>java Test . class
                </label>
              </li>
              <li class="option_item">
                <label>
                  <input type="radio" name="tobic_1">
                  <span class="letter">B</span>java Test . class
                </label>
              </li>
              <li class="option_item">
                <label>
                  <input type="radio" name="tobic_1">
                  <span class="letter">C</span>java Test . class
                </label>
              </li>
              <li class="option_item">
                <label>
                  <input type="radio" name="tobic_1">
                  <span class="letter">D</span>java Test . class
                </label>
              </li>
            </ul>
          </li>
          <li class="exam_item">
            <p class="subject">1.在控制台运行一个 Java 程序 Test . class ，使用的命令正确的是( ) <a href="javascript:;" class="btn btn-link">正确答案</a></p>
            <ul class="option_list">
              <li class="option_item">
                <label>
                  <input type="radio" name="tobic_1" checked>
                  <span class="letter">A</span>java Test . class
                </label>
              </li>
              <li class="option_item">
                <label>
                  <input type="radio" name="tobic_1">
                  <span class="letter">B</span>java Test . class
                </label>
              </li>
              <li class="option_error_active option_item">
                <label>
                  <input type="radio" name="tobic_1">
                  <span class="letter">C</span>java Test . class
                </label>
              </li>
              <li class="option_item">
                <label>
                  <input type="radio" name="tobic_1">
                  <span class="letter">D</span>java Test . class
                </label>
              </li>
            </ul>
          </li>
          <li class="exam_item">
            <p class="subject">1.在控制台运行一个 Java 程序 Test . class ，使用的命令正确的是( )</p>
            <ul class="option_list">
              <li class="option_error_active option_item">
                <label>
                  <input type="radio" name="tobic_1" checked>
                  <span class="letter">A</span>java Test . class
                </label>
              </li>
              <li class="option_item">
                <label>
                  <input type="radio" name="tobic_1">
                  <span class="letter">B</span>java Test . class
                </label>
              </li>
              <li class="option_item">
                <label>
                  <input type="radio" name="tobic_1">
                  <span class="letter">C</span>java Test . class
                </label>
              </li>
              <li class="option_item">
                <label>
                  <input type="radio" name="tobic_1">
                  <span class="letter">D</span>java Test . class
                </label>
              </li>
            </ul>
          </li>
          <li class="exam_item">
            <p class="subject">1.在控制台运行一个 Java 程序 Test . class ，使用的命令正确的是( )</p>
            <ul class="option_list">
              <li class="option_error_active option_item">
                <label>
                  <input type="radio" name="tobic_1" checked>
                  <span class="letter">A</span>java Test . class
                </label>
              </li>
              <li class="option_item">
                <label>
                  <input type="radio" name="tobic_1">
                  <span class="letter">B</span>java Test . class
                </label>
              </li>
              <li class="option_item">
                <label>
                  <input type="radio" name="tobic_1">
                  <span class="letter">C</span>java Test . class
                </label>
              </li>
              <li class="option_item">
                <label>
                  <input type="radio" name="tobic_1">
                  <span class="letter">D</span>java Test . class
                </label>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- 手机页面设置 -->
<div class="remind_box_xs hidden-lg hidden-md hidden-sm container">
  <div class="show_state">
    <!-- 显示设置、对的题目数、错的题目数、共多少题和做了多少题 -->
    <span class="menu"><i class="glyphicon glyphicon-th"></i></span>
    <div class="menu_info">
      <div class="right">
        <span><i class="glyphicon glyphicon-ok"></i></span>
        0
      </div>
      <div class="error">
        <span><i class="glyphicon glyphicon-remove"></i></span>
        0
      </div>
      <span class="object_num"><b>1</b>/500</span>
    </div>
  </div>
  <div class="subject_list">
    <!-- 显示所以的题目序号 -->
  </div>
</div>
<!-- 设置字体、模式 -->
<div class="setting hidden-lg hidden-md hidden-sm container">
  <div class="setting_box">
    <h2  class="title">设置字体、模式</h2>
     <ul class="font">
      <li>
        大
      </li>
      <li class="active">
        中
      </li>
      <li>
        小
      </li>
    </ul>
    <ul class="color_model">
      <li>
        <span><i class="glyphicon glyphicon-eye-open"></i></span>
        <p>护眼模式</p>
      </li>
      <li>
        <span><i class="glyphicon glyphicon-adjust"></i></span>
        <p>夜间模式</p>
      </li>
      <li>
        <span class="active"><i class="glyphicon glyphicon-certificate"></i></span>
        <p>日间模式</p>
      </li>
    </ul>
  </div>
</div>
@endsection