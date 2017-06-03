@extends('layouts.app')
@section('title')模拟考试中@endsection
@push('js')
<script type="text/javascript">
 // 切换主题

  $(function () {
    $('.color_model>li').click(function() {
      var $this = $(this);
      $this.parent().find('li').removeClass("active");
      $this.addClass("active");
      document.body.className = $this.attr('data-mode');
    })
  });

  // 改变字号

  $(function () {
    $('.font>li').click(function () {
      var $this = $(this);
      $this.parent().find('li').removeClass("active");
      $this.addClass("active");
      document.body.className = $this.attr('data-size');
    })
  });

  // 固定定位

  $(function () {
    var $remindBox = $('.remind_box');
    var $remindBoxTop = $remindBox.offset().top;
    function toggleFixed() {
        if($remindBoxTop - $(document).scrollTop() <= 20 ){
            $remindBox.css({
                "position": "fixed",
                "width": $remindBox.parent().width(),
                "top": "20px"
            });
        } else {
            $remindBox.css({
                "position": "static"
            });
        }
    }
    toggleFixed();
    $(window).resize(function () {
        toggleFixed();
    })
    $(document).scroll(function () {
        toggleFixed();
    })
  });

  // show 字体、模式

  $(function () {
    var $settingBtn = $('.setting');
    $('.m_setting_btn').click(function (event) {
      $settingBtn.fadeToggle("fast");
      event.stopPropagation();
    });
    $('.setting>.mask').click(function () {
      $settingBtn.fadeToggle("fast");
    })
  });

  // 锚点动画

  $(function () {
    function goSubject(targetId) {
        var $target = $('[data-id = ' + targetId + ']');
        $target.parent().find('li.active').removeClass('active');
        $target.addClass('active');
        $(document.body).animate({
            scrollTop: $target.offset().top - 20
        }, 300);
    }
    var $subjectList = $('.subject_list');
      var hash = window.location.hash.substr(1);
      if(hash.length > 0){
        goSubject(window.location.hash.substr(1));
      }
      $subjectList.find('li>a').click(function () {
        var targetId = this.getAttribute('href').substr(1);
        goSubject(targetId);
    });
  })

  // 手机列表显示
  $(function() {
    var $remindBoxXs = $('.remind_box_xs');
    var $remindMask = $('.remind_box_body>.mask');
    function remindSwitch() {
      $remindBoxXs.toggleClass('remind_box_switch');
      $remindMask.fadeToggle();
      $(document.body).toggleClass('modal-open');
    }
    $remindMask.click(function() {
      remindSwitch();
    });
    $remindBoxXs.click(function() {
      remindSwitch();
    });
  });

  // 交卷
  $(function (){
    $('#assignment_btn').click(function(event){
      $('#assignment').modal('toggle');
      event.stopPropagation();
    });
  });
  // 倒计时
  $(function(){
    var remainingTime = {!! $remainingTime !!};
    var time = document.getElementById('time');
    setTime();
    setInterval(function () {
      setTime();
    },1000);
    function conversionToMinutes (secondNum, len) {
      if(secondNum !== undefined){
        secondNum = parseInt(secondNum)
        let minute = parseInt(secondNum / 60)
        let second = parseInt(secondNum % 60)
        if(minute >= 0 && second >= 0){
        	minute = String(minute)
        	second = String(second)
        	return new Array(len - minute.length + 1).join('0') + ((minute + ':' + new Array(2 - second.length + 1).join('0') + second).split('').join(''))
        } else {
        	return '0'
        }
      }
    }
    function setTime(){
      time.innerHTML = conversionToMinutes(remainingTime--, 3);
    }
  })
  // ajax提交答案
  $(function(){
    $('.option_item').click(function(){
      var $this = $(this);
      var $currentTopic = $this.parents('.exam_item');
      $.ajax('/api/submit', {
        type: "POST",
        data: {
          'topic_id': $currentTopic.attr('data-topic-id'),
          'selected_option_id':  $this.attr('data-id'),
          'type':  'mock',
          'mock_record_id': {!! $mockRecord->id !!}
        },
        success: function(res){
          console.log(res)
        },
        error: function(err){},
        dataType: 'JSON'
      });
    })
  })
</script>
@endpush
@section('content')
<div class="container">
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
        <span>23</span>
        / 500
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
            <span class="time" id="time"></span>
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
          <ul id="subject-list" class="subject_list">
            @foreach($topics as $k => $topic)
              <li><a class="@if(!$topic->submitRecord->isEmpty()) {!! $topic->submit_record->is_correct?'righe':'error' !!} @endif" href="#topic_{!! $topic->id !!}">{!! $k+1 !!}</a></li>
            @endforeach
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
          <a type="button" class="btn btn-primary" data-target="#assignment" data-toggle="modal">交卷</a>
        </div>
      </div>
    </div>
    <!-- 题目列表 -->
    <div class="exam_body col-md-8 col-lg-8 col-sm-12">
      <div class="exam_main">
        <ul class="exam_list">
          @foreach($topics as $k => $topic)
            <li class="exam_item" data-id="topic_{!! $topic->id !!}" data-topic-id="{!! $topic->id !!}">
              <p class="subject"><span>{!! $k+1 !!}</span> . {!! $topic->title !!}</p>
              <ul class="option_list">
                @foreach($topic->options as $option)
                <li data-id="1" class="option_item">
                  <label>
                    <input type="radio" name="tobic_{!! $option->id !!}" checked>
                    <span class="letter">{!! chr(ord('A') + $loop->index) !!}. </span>{{ $option->title }}
                  </label>
                </li>
                @endforeach
              </ul>
            </li>
          @endforeach

        </ul>
      </div>
    </div>
  </div>
</div>
<!-- 手机页面设置 -->
<div class="remind_box_body hidden-lg hidden-md hidden-sm">
  <div class="remind_box_xs container">
    <div class="show_state">
      <!-- 显示设置、对的题目数、错的题目数、共多少题和做了多少题 -->
      <span class="m_setting_btn"><i class="glyphicon glyphicon-font"></i></span>
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
        <span class="menu"><i class="glyphicon glyphicon-th-large"></i></span>
      </div>
      <a class="btn btn-primary assignment_btn" id="assignment_btn" data-toggle="modal">交卷</a>
    </div>
    <div class="subject_list_body">
      <!-- 显示所有的题目序号 -->
      <ul id="subject-list" class="subject_list">
        @foreach($topics as $k => $topic)
          <li><a class="@if(!$topic->submitRecord->isEmpty()) {!! $topic->submit_record->first()->is_correct?'righe':'error' !!} @endif" href="#topic_{!! $topic->id !!}">{!! $k+1 !!}</a></li>
        @endforeach
      </ul>
    </div>
  </div>
  <div class="mask"></div>
</div>
<!-- 设置字体、模式 -->
<div class="setting hidden-lg hidden-md hidden-sm container">
  <div class="setting_box">
    <h2  class="title">设置字体、模式</h2>
     <ul class="font">
      <li data-size="largeFont">
        大
      </li>
      <li class="active">
        中
      </li>
      <li data-size="smallFont">
        小
      </li>
    </ul>
    <ul class="color_model">
      <li data-mode="eyeColor">
        <span><i class="glyphicon glyphicon-eye-open"></i></span>
        <p>护眼模式</p>
      </li>
      <li data-mode="nightColor">
        <span><i class="glyphicon glyphicon-adjust"></i></span>
        <p>夜间模式</p>
      </li>
      <li data-mode="day" class="active">
        <span><i class="glyphicon glyphicon-certificate"></i></span>
        <p>日间模式</p>
      </li>
    </ul>
  </div>
  <div class="mask"></div>
</div>
<!-- dialog -->
<div class="modal fade" tabindex="-1" id="assignment" role="dialog" aria-labelledby="assignment">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body confirma_box">
        <p>操作提示：</p>
        <p>1：点击【确认交卷】，将提交考试成绩，结束考试！</p>
        <p>2：点击【继续考试】，将关闭本窗口，继续考试！</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">继续答题</button>
        <button type="button" class="btn btn-primary">确认交卷</button>
      </div>
    </div>
  </div>
</div>
@endsection
