@extends('layouts.app')
@section('title')随机答题中@endsection
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

  //
  $(function(){
    $('.page_select').change(function(){
      if(this.value)
        window.location = this.value;
    });
  });
  // 改变字号
  $(function () {
    $('.font>li').click(function () {
      var $this = $(this);
      $this.parent().find('li').removeClass("active");
      $this.addClass("active");
      document.body.setAttribute('size', $this.attr('data-size'));
    })
  });

  // 进度条
  $(function(){
    var $progressBarM = $('.progress_bar_m');
    var $examStateBoxTop = $('.exam_state').offset().top + $('.exam_state').height();

    $(window,document).scroll(function(){
      if($examStateBoxTop <= $(document).scrollTop()){
        $progressBarM.fadeIn();
      }else{
        $progressBarM.fadeOut();
      }
    });
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
    $(window,document).scroll(function () {
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
  function goSubject(targetId) {
      var $target = $('[data-id = ' + targetId + ']');
      $target.parent().find('li.active').removeClass('active');
      $target.addClass('active');
      $('html,body').animate({
          scrollTop: $target.offset().top - 20
      }, 300);
  }
  $(function () {
    var $subjectList = $('.subject_list');
      var hash = window.location.hash.substr(1);
      if(hash.length > 0){
        goSubject(window.location.hash.substr(1));
      }
      document.body.onhashchange = function () {
          goSubject(window.location.hash.substr(1));
      }
//      $subjectList.find('li>a').click(function () {
//        var targetId = this.getAttribute('href').substr(1);
//        goSubject(targetId);
//      });
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

  // 重新答题
  $(function (){
    $('#assignment_btn').click(function(event){
      $('#assignment').modal('toggle');
      event.stopPropagation();
    });
  });

  // ajax提交答案
  var submitCount = {!! $practiceRecordsCount = $practiceSubmitCount->submit_count !!};
  var allCount = {!!config('exam.practice_topics_count') !!};
  var isIE8 = navigator.appName == "Microsoft Internet Explorer" && navigator.appVersion .split(";")[1].replace(/[ ]/g,"") == "MSIE8.0"
  $(function(){
    var $pageDone = $('.page_done');
    var $submitCount = $('.submit_count');
    function progress(submitCount){

      if(submitCount === undefined){
        submitCount = ++window.submitCount;
      }
      $submitCount.html(submitCount);
      var propor = (submitCount / allCount) * 100;
      $pageDone.css('width', propor + '%');
    }
    function inc(){
      progress();
    }
    progress(submitCount);
    $('.view_ans').click(function(){
      var $this = $(this);
      var rightAns = $this.attr("data-ans");
      if(rightAns){
        $this.html("正确答案："+rightAns);
      }
    });
    $('.option_item').click(function(){
      var $this = $(this);
      var $currentTopic = $this.parents('.exam_item');
      var $viewAnsBtn = $currentTopic.find('.view_ans');
      if($currentTopic.attr('answered')){
        return;
      }
      $this.addClass('option_wait');
      $currentTopic.attr('answered', true);
      var $currentTopicSerialBtn = $('a[href="#' + $currentTopic.attr('data-id') + '"]');

      jQuery.ajax('/api/submit', {
        type: "post",
        contentType: "application/x-www-form-urlencoded;charset=utf-8",
        async: !isIE8,
        data: {
          'topic_id': $currentTopic.attr('data-topic-id'),
          'selected_option_id':  $this.attr('data-id'),
          'type':  'practice'
        },
        success: function(res, textStatus, jqXHR){
          if(jqXHR.status == 204) return;
          $this.removeClass('option_wait');
          inc();
          if(res.is_correct){
            $this.addClass('option_right_active');
            $currentTopicSerialBtn.addClass('right');
          }else{
            $this.addClass('option_error_active');
            $currentTopicSerialBtn.addClass('error');
            $viewAnsBtn.show();
            $viewAnsBtn.attr('data-ans', res.correct_option_ans);
          }
        },
        error: function(err){
            console.log(err)
        }
      });
    })
  })
</script>
@endpush
@section('content')
<div class="container">
  <div class="exam_state">
    <div class="progress_bar">
      <div class="progress_box">
        <em class="page_done"></em>
      </div>
      <div class="txt">

        <span class="submit_count">{{$practiceRecordsCount}}</span>
        / {{config('exam.practice_topics_count') }}
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
        </div>
        <!-- 提醒框内容 -->
        <div class="remind_content">
          <ul id="subject-list" class="subject_list">
            @foreach($topics as $k => $topic)
              <li><a class="@if(!$topic->submitRecords->isEmpty()) {!! $topic->submitRecords->first()->is_correct?'right':'error' !!} @endif" href="#topic_{!! $topic->id !!}">{!! $topic->topic_num !!}</a></li>
            @endforeach
          </ul>
          <nav aria-label="Page navigation" class="text-center">

            {!! $topics->links('pagination.simple-default') !!}

          </nav>
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
          <div class="btn-group" role="group">
            <a type="button" href="{!! route('menu', ['courseId'=>$courseId]) !!}" class="btn btn-default">返回</a>
            <a type="button" class="answer_again btn btn-danger" data-target="#assignment" data-toggle="modal">重新答题</a>
          </div>
        </div>
      </div>
    </div>
    <!-- 题目列表 -->
    <div class="exam_body col-md-8 col-lg-8 col-sm-12">
      <div class="exam_main">
        <ul class="exam_list">
          @foreach($topics as $k => $topic)
            <li @if(!$topic->submitRecords->isEmpty())answered="true"@endif class="exam_item" data-id="topic_{!! $topic->id !!}" data-topic-id="{!! $topic->id !!}">
              <p class="subject">
                <span class="num">{!! $topic->topic_num !!}</span>
                <span class="passing_rate">[通过率: @if($topic->correct_submit_count !=0){!! round($topic->correct_submit_count / $topic->total_submit_count,2) !!}@else 0 @endif%]</span>
                {!! $topic->title !!}
                <button type="button" class="view_ans btn-sm btn btn-link @if(!$topic->submitRecords->isEmpty() && !$topic->submitRecords->first()->is_correct) show" data-ans="{!! $topic->getAns() !!}" @else " @endif>查看答案</button>
              </p>
              <ul class="option_list">
                @foreach($topic->options as $option)
                <li data-id="{!! $option->id !!}" class="option_item @if(!$topic->submitRecords->isEmpty() && $topic->submitRecords->first()->selected_option_id == $option->id) {!! $topic->submitRecords->first()->is_correct?'option_right_active':'option_error_active' !!} @endif">
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
        <nav aria-label="Page navigation" class="text-center">
          <div class="hidden-xs">
            {!! $topics->links() !!}
          </div>
          <div class="hidden-lg hidden-md hidden-sm">
              {!! $topics->links('pagination.simple-default') !!}
          </div>
        </nav>
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
        <span class="object_num"><b class="submit_count">{{$practiceRecordsCount}}</b>/{{config('exam.practice_topics_count')}}</span>
        <span class="menu"><i class="glyphicon glyphicon-th-large"></i></span>
      </div>
      <a class="btn btn-danger assignment_btn" id="assignment_btn" data-toggle="modal">重新答题</a>
    </div>
    <div class="subject_list_body">
      <!-- 显示所有的题目序号 -->
      <ul id="subject-list" class="subject_list">
        @foreach($topics as $k => $topic)
          <li><a class="@if(!$topic->submitRecords->isEmpty()) {!! $topic->submitRecords->first()->is_correct?'right':'error' !!} @endif" href="#topic_{!! $topic->id !!}">{!! $topic->topic_num !!}</a></li>
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
        <p>1：点击【确认】，将清空以前的练习记录重新开始练习！</p>
        <p>2：点击【取消】，将关闭本窗口，继续答题！</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">取消</button>
        <a href="{!! route('reset_practice',$courseId) !!}" type="button" class="btn btn-default">确认</a>
      </div>
    </div>
  </div>
</div>
<!-- 进度条 -->
<div class="progress_bar_m">
  <em class="page_done"></em>
</div>
@endsection
