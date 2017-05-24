<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>马克思学院在线练习系统</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="{!! mix('/css/app.css') !!}">
</head>
<body>
<!-- 导航栏 -->
	<div class="main">
	<!-- 导航栏 -->
		<div class="nav">
			<div class="container">
				<a class="logo" href="javascript:;">
					<img src="{!! asset('/images/logo.png') !!}">
				</a>
				<p class="title">马克思学院考试系统</p>
				<div class="login">
					<div class="btn-group" role="group">
					  <a class="btn btn-default">登录</a>
					  <a class="btn btn-info">注册</a>
					</div>
				</div>
			</div>
		</div>
		@yield('content')
		<div class="footer_nav">E8net</div>
	</div>

	<script src="{!! mix('/js/app.js') !!}"></script>
	<script>
    $(document).ready(function(){
      $('.bg_box').height($(window).height()-60);
    });
    // 
    $(function(){
    	$(".chevron-down").click(function(){
    		$(document.body).animate({
    			'scrollTop': $('.course').offset().top
    		}, 500);
    	})
    })
	</script>
</body>
</html>