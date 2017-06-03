<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>404</title>
	<style type="text/css">
		body{
			text-align: center;
		}
		h1{
			padding-top: 120px;
		    font-weight: normal;
		    font-size: 40px;
		    color: #333;
			font-family: -apple-system, "Helvetica Neue", "Arial", "PingFang SC", "Hiragino Sans GB", "Microsoft YaHei", "WenQuanYi Micro Hei", sans-serif;
		}
		p{
			font-size: 18px;
		}
		a{
			text-decoration: none;
			color: #337ab7;
			margin-right: 10px;
		}
	</style>
</head>
<body>
	@inject('alert', 'App\Widgets\Alert')
	<h1>@if($alert->hasMessage()) {!! $alert->getData()['message'] !!} @else 404 没有找到相关内容@endif</h1>
	@php
		$previous = URL::previous();
	@endphp
	<p>
		@if($previous != URL::current() && isSameHost($previous))
			<a href="{!! $previous !!}">返回上一页</a>
		@endif
		<a href="{!! URL::to('/') !!}">返回首页</a></p>
</body>
</html>