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
  function goSubject(targetId) {
      var $target = $('[data-id = ' + targetId + ']');
      $target.parent().find('li.active').removeClass('active');
      $target.addClass('active');
      $(document.body).animate({
          scrollTop: $target.offset().top - 20
      }, 300);
  }
  $(function () {
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
      time.innerHTML = conversionToMinutes(remainingTime--, 2);
    }
  })
  // ajax提交答案
  $(function(){
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
      $.ajax('/api/submit', {
        type: "POST",
        data: {
          'topic_id': $currentTopic.attr('data-topic-id'),
          'selected_option_id':  $this.attr('data-id'),
          'type':  'mock',
          'mock_record_id': {!! $mockRecord->id !!}
        },
        success: function(res, textStatus, jqXHR){
          if(jqXHR.status == 204) return;
          $this.removeClass('option_wait');
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
        <div class="remind_content">@defaultColor: #fff;
        @nightColor: #252B37;
        @eyeColor: #D4DFE3;
        @defauleFont: 16px;

        // 定义模式和字体
        .nightColor{
          background-color: #1c1f2b;
          color: #bdcadb;
        }
        .eyeColor{
          color: #704214;
          background: #f3eacb;
        }

        // 大字体
        body[size="largeFont"]{
          .exam_item .subject{
            font-size: @defauleFont + 1!important;
          }
          .option_item label{
            font-size: @defauleFont - 1!important;
            >.letter{
              font-size: @defauleFont + 3!important;
            }
          }
        }

        // 小字体
        body[size="smallFont"]{
          .exam_item .subject{
            font-size: @defauleFont - 1!important;
          }
          .option_item label{
            font-size: @defauleFont - 3!important;
            >.letter{
              font-size: @defauleFont + 2!important;
            }
          }
        }

        // 手机版题目列表开关
        .remind_box_switch{
          transform: translateY(0)!important;
        }

        .confirma_box p{
          margin-bottom: 15px;
          font-size: @defauleFont;
        }
        .exam_state{
          background-color: #fff;
          margin: 30px 0;
          border: 1px solid #E0E3E9;
          .breadcrumb{
            margin: 0;
            background-color: #fff;
          }
          .progress_bar{
            border-top: 1px solid #f1f3f5;
            padding: 0px 20px;
            height: 50px;
            background-color: #f9f9f9;
            position: relative;
            padding-right: 100px;
            .progress_box{
              margin: 19px 15px 0;
              width: 100%;
              border-radius: 20px;
              margin-bottom: 0;
              height: 12px;
              background-color: #e7e9ea;
              .page_done{
                height: 100%;
                display: block;
                border-radius: 20px;
                background-color: @themeColor;
                overflow: hidden;
                width: 30%;
                transition: width .3s;
              }
            }
            .txt{
              position: absolute;
              right: 15px;
              top: 15px;
              span{
                color: @themeColor;
              }
            }
          }
        }
        // 考试
        .exam_body{
          // 提醒
          .remind_box{
            background-color: @defaultColor;
            border-radius: 5px;
            // 提醒头部
            .header{
              border-bottom: 1px solid #F1F1F1;
              position: relative;
              height: 55px;
              padding: 0 15px;
              &:after{
                content: "";
                position: absolute;
                bottom: 0;
                left: 0;
                height: 1px;
                background-color: #E45C40;
                width: 100px;
              }
              .title{
                float: left;
                line-height: 55px;
                font-size: 18px;
              }
              .count_down{
                text-align: center;
                line-height: 55px;
                .time{
                  color: @themeColor;
                }
              }
              .seting{
                position: absolute;
                right: 0px;
                top: 8px;
                padding: 10px;
                i{
                  font-size: 18px;
                  color: #444;
                  transition: all .8s;
                }
                &:hover i{
                  transform: rotate(360deg);
                }
                &:hover .seting_body{
                  display: block;
                }
                .seting_body{
                  padding: 10px;
                  background-color: #fff;
                  position: absolute;
                  top: 30px;
                  width: 250px;
                  left: -100px;
                  display: none;
                  z-index: 999;
                }
              }
            }
            // 提醒框内容
            .remind_content{
              padding: 15px;
              border-bottom: 1px solid #F1F1F1;
              .subject_list{
                overflow: hidden;
                li{
                  float: left;
                  a{
                    display: inline-block;
                    width: 32px;
                    height: 32px;
                    text-align: center;
                    line-height: 32px;
                    margin: 0 6px 5px 0;
                    color: #666;
                    font-size: 14px;
                    border: 1px solid #E6E8EC;
                    border-radius: 3px;
                    text-decoration: none;
                    &:hover{
                      background-color: #f1f1f1;
                    }
                  }
                  a.error{
                    background-color: #E45C40;
                    color: #fff;
                  }
                  a.right{
                    background-color: #47AD76;
                    color: #fff;
                  }
                }
              }
            }
            // 提醒尾部
            .footer{
              padding: 15px;
              position: relative;
              overflow: hidden;
              .subject_state{
                li{
                  float: left;
                  margin-right: 28px;
                  position: relative;
                  span{

                  }
                  em{
                    position: absolute;
                    right: -20px;
                    top: 3px;
                    display: inline-block;
                    height: 15px;
                    width: 15px;
                    border: 1px solid #E6E8EC;
                  }
                  em.error{
                    background-color: #E45C40;
                  }
                  em.right{
                    background-color: #47AD76;
                  }
                }
              }
              .btn{
                position: absolute;
                right: 20px;
                top: 9px;
                background-color: @themeColor;
                border: none;
              }
            }
          }
          // 题目列表
          .exam_main{
            .exam_list{
              .active{
                border: 1px solid #47AD76!important;
                animation: emphasize .2s .3s;
              }
              .exam_item{
                background-color: @defaultColor;
                margin-bottom: 30px;
                border-radius: 5px;
                border: 1px solid #e0e3e9;
                .active{
                  border-color: #47AD76;
                }
                .subject{
                  font-size: @defauleFont;
                  margin-bottom: 15px;
                  background-color: #f9f9fa;
                  padding: 15px;
                  table-layout: fixed;
                  word-break: break-all;
                  position: relative;
                  padding-left: 40px;
                  .view_ans{
                    outline: none;
                    display: none;
                    text-decoration: none;
                    line-height: normal;
                    padding-top: 0;
                    padding-bottom: 0;
                  }
                  span{
                    position: absolute;
                    top: 15px;
                    left: 15px;
                  }
                }
                .option_list{
                  padding: 10px 30px 15px;
                  .option_item{
                    margin-bottom: 10px;
                    background-color: #F5F5F5;
                    padding: 10px;
                    position: relative;
                    border: 1px solid #F5F5F5;
                    transition: all .2s;
                    cursor: pointer;
                    &:hover{
                      border: 1px solid #00b33b;
                    }
                    input{
                      opacity: 0;
                      filter:alpha(opacity=0);
                    }
                    label{
                      height: 100%;
                      width: 100%;
                      padding-left: 20px;
                      position: relative;
                      font-weight: normal;
                      font-size: @defauleFont - 2;
                      cursor: pointer;
                      table-layout:fixed;
                      word-break: break-all;
                      .letter{
                        position: absolute;
                        top: 0px;
                        left: 10px;
                        font-size: @defauleFont + 2;
                        margin-right: 15px;
                      }
                    }
                  }
                  .option_wait{
                    border: 1px solid #5bc0de;
                    color: #5bc0de;
                    &:hover{
                      border-color: #5bc0de;
                    }
                    &:after{
                      border-top: 30px solid #5bc0de;
                    }
                  }
                  .option_right_active{
                    border: 1px solid #00b33b;
                    color: #00b33b;
                    &:hover{
                      border-color: #00b33b;
                    }
                    &:after{
                      border-top: 30px solid #00b33b;
                    }
                  }
                  .option_error_active{
                    border: 1px solid #E45C40;
                    color: #E45C40;
                    &:hover{
                      border-color: #E45C40;
                    }
                    &:after{
                      border-top: 30px solid #E45C40;
                    }
                  }
                  .option_right_active, .option_error_active, .option_wait{
                    &:after{
                      content: '';
                      position: absolute;
                      top: 0;
                      left: 0;
                      width: 0;
                      height: 0;
                      border-bottom: 30px solid transparent;
                      border-right: 30px solid transparent;
                      z-index: 9;
                    }
                    &:before{
                      content: '';
                      position: absolute;
                      left: 3px;
                      top: 4px;
                      width: 10px;
                      height: 10px;
                      border-radius: 5px;
                      background: #fff;
                      color: #fff;
                      z-index: 10;
                    }
                  }
                }
              }
            }
          }
        }

        @keyframes emphasize {
          0%{
            transform: scale(1);
          }
          50%{
            transform: scale(1.03);
          }
          100%{
            transform: scale(1);
          }
        }
        .remind_box_body{
          .mask{
            position: fixed;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            background-color: #000;
            opacity: 0.1;
            filter:alpha(opacity=10);
            z-index: 998;
            display: none;
          }
        }
        .remind_box_xs{
          background-color: #fff;
          border-top: 1px solid #e0e3e9;
          position: fixed;
          left: 0;
          bottom: 0;
          width: 100%;
          z-index: 999;
          transform: translateY(400px);
          transition: transform .1s ease-out;
          .show_state{
            height: 50px;
            position: relative;
            .menu,.m_setting_btn{
              padding: 10px;
              font-size: 18px;
            }
            .m_setting_btn{
              position: absolute;
              top: 5px;
              left: 15px;
            }
            .assignment_btn{
              position: absolute;
              top: 10px;
              right: 15px;
              background-color: #E45C40;
              border: none;
            }
            .menu_info{
              line-height: 50px;
              width: 260px;
              margin: 0 auto;
              .object_num{
                margin-left: 15px;
              }
              .time{
                color: #E45C40;
              }
            }
          }
          .subject_list_body{
            padding-top: 10px;
            height: 400px;
            overflow-y: scroll;
            >.subject_list{
              overflow: hidden;
              text-align: center;
              >li{
                display: inline-block;
                a{
                  display: inline-block;
                  width: 40px;
                  height: 40px;
                  text-align: center;
                  line-height: 40px;
                  margin-bottom: 15px;
                  margin-right: 8px;
                  margin-left: 8px;
                  color: #666;
                  font-size: 14px;
                  border: 1px solid #E6E8EC;
                  border-radius: 100px;
                  text-decoration: none;
                  &:hover{
                    background-color: #f1f1f1;
                  }
                }
                a.error{
                  background-color: #E45C40;
                  color: #fff;
                }
                a.right{
                  background-color: #47AD76;
                  color: #fff;
                }
              }
            }
          }
        }

        //设置字体、模式
        .setting{
          position: fixed;
          left: 0;
          top: 0;
          right: 0;
          bottom: 0;
          width: 100%;
          height: 100%;
          z-index: 101;
          display: none;
          >.setting_box{
            left: 0;
            bottom: 50px;
            position: fixed;
            padding-top: 15px;
            width: 100%;
            padding-bottom: 20px;
            background-color: #fff;
            z-index: 999;
            >.title{
              padding: 0 0 15px 15px;
              font-size: 16px;
              border-bottom: 1px solid #e0e3e9;
              color: #888;
            }
            >.font{
              margin-bottom: 20px;
              text-align: center;
              padding-top: 15px;
              >li{
                display: inline-block;
                border: 1px solid #e0e3e9;
                height: 40px;
                width: 40px;
                text-align: center;
                line-height: 40px;
                font-size: 16px;
                margin-right: 20px;
                border-radius: 100px;
              }
              >li.active{
                background-color: #31b0d5;
                color: #fff;
                border-color: #46b8da;
              }
            }
            .color_model{
              text-align: center;
              >li{
                display: inline-block;
                text-align: center;
                margin-right: 30px;
                >span{
                  border: 1px solid #e0e3e9;
                  border-radius: 100px;
                  padding: 7px 10px;
                  margin-bottom: 15px;
                  display: inline-block;
                }
                &.active{
                  >span{
                    background-color: #31b0d5;
                    border-color: #46b8da;
                    color: #fff;
                  }
                }
              }
            }
          }
          .mask{
            position: absolute;
            left: 0;
            top: 0;@extends('layouts.app')
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
                  document.body.setAttribute('size', $this.attr('data-size'));
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
              function goSubject(targetId) {
                  var $target = $('[data-id = ' + targetId + ']');
                  $target.parent().find('li.active').removeClass('active');
                  $target.addClass('active');
                  $(document.body).animate({
                      scrollTop: $target.offset().top - 20
                  }, 300);
              }
              $(function () {
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
                var time = $('.time_count_down');
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
                  time.html(conversionToMinutes(remainingTime--, 2));
                }
              })
              // ajax提交答案
              $(function(){
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
                  $.ajax('/api/submit', {
                    type: "POST",
                    data: {
                      'topic_id': $currentTopic.attr('data-topic-id'),
                      'selected_option_id':  $this.attr('data-id'),
                      'type':  'mock',
                      'mock_record_id': {!! $mockRecord->id !!}
                    },
                    success: function(res, textStatus, jqXHR){
                      if(jqXHR.status == 204) return;
                      $this.removeClass('option_wait');
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
                        <span class="time time_count_down"></span>
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
                          <li><a class="@if(!$topic->submitRecord->isEmpty()) {!! $topic->submitRecord->first()->is_correct?'right':'error' !!} @endif" href="#topic_{!! $topic->id !!}">{!! $k+1 !!}</a></li>
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
                        <li @if(!$topic->submitRecord->isEmpty())answered="true"@endif class="exam_item" data-id="topic_{!! $topic->id !!}" data-topic-id="{!! $topic->id !!}">
                          <p class="subject"><span>{!! $k+1 !!}</span> . {!! $topic->title !!}
                            <button type="button" class="view_ans btn-sm btn btn-link">查看答案</button>
                          </p>
                          <ul class="option_list">
                            @foreach($topic->options as $option)
                            <li data-id="{!! $option->id !!}" class="option_item @if(!$topic->submitRecord->isEmpty() && $topic->submitRecord->first()->selected_option_id == $option->id) {!! $topic->submitRecord->first()->is_correct?'option_right_active':'option_error_active' !!} @endif">
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
                    <span>结束倒计时</span>
                    <span class="time time_count_down"></span>
                    <span class="object_num"><b>1</b>/500</span>
                    <span class="menu"><i class="glyphicon glyphicon-th-large"></i></span>
                  </div>
                  <a class="btn btn-primary assignment_btn" id="assignment_btn" data-toggle="modal">交卷</a>
                </div>
                <div class="subject_list_body">
                  <!-- 显示所有的题目序号 -->
                  <ul id="subject-list" class="subject_list">
                    @foreach($topics as $k => $topic)
                      <li><a class="@if(!$topic->submitRecord->isEmpty()) {!! $topic->submitRecord->first()->is_correct?'right':'error' !!} @endif" href="#topic_{!! $topic->id !!}">{!! $k+1 !!}</a></li>
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
                    <button type="button" class="btn btn-primary" data-dismiss="modal">继续答题</button>
                    <button type="button" class="btn btn-default">确认交卷</button>
                  </div>
                </div>
              </div>
            </div>
            @endsection

            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            background-color: #000;
            opacity: 0.1;
            filter:alpha(opacity=10);
            z-index: 998;
          }
        }

        @media(max-width:768px){
          .exam_body{padding:0;}
        }

          <ul id="subject-list" class="subject_list">
            @foreach($topics as $k => $topic)
              <li><a class="@if(!$topic->submitRecord->isEmpty()) {!! $topic->submitRecord->first()->is_correct?'right':'error' !!} @endif" href="#topic_{!! $topic->id !!}">{!! $k+1 !!}</a></li>
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
            <li @if(!$topic->submitRecord->isEmpty())answered="true"@endif class="exam_item" data-id="topic_{!! $topic->id !!}" data-topic-id="{!! $topic->id !!}">
              <p class="subject"><span>{!! $k+1 !!}</span> . {!! $topic->title !!}
                <button type="button" class="view_ans btn-sm btn btn-link">查看答案</button>
              </p>
              <ul class="option_list">
                @foreach($topic->options as $option)
                <li data-id="{!! $option->id !!}" class="option_item @if(!$topic->submitRecord->isEmpty() && $topic->submitRecord->first()->selected_option_id == $option->id) {!! $topic->submitRecord->first()->is_correct?'option_right_active':'option_error_active' !!} @endif">
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
          <li><a class="@if(!$topic->submitRecord->isEmpty()) {!! $topic->submitRecord->first()->is_correct?'right':'error' !!} @endif" href="#topic_{!! $topic->id !!}">{!! $k+1 !!}</a></li>
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
        <button type="button" class="btn btn-primary" data-dismiss="modal">继续答题</button>
        <button type="button" class="btn btn-default">确认交卷</button>
      </div>
    </div>
  </div>
</div>
@endsection
