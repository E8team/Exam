@extends('layouts.app')
@section('content')
<!-- 背景 -->
<div class="up_top_padding bg_box">
	<h2>马克思学院在线练习系统</h2>
	<h3>在这里你可以了解中华上下五千年</h3>
	<a type="button" class="btn btn-info btn-lg">注册一个学生账号</a>
	<div class="chevron-down"><i class="glyphicon glyphicon-chevron-down"></i></div>
</div>
<!-- 选课 -->
<div class="container course">
	<h2 class="text-center title">选择你的课程</h2>
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 course_item">
		<div class="content">
			<div class="main">
				<img src="{!! asset('/images/shi.png') !!}">
			</div>
			<div class="footer">
				<p>中国近代史纲要</p>
			</div>
		</div>
	</div>

	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 course_item">
		<div class="content">
			<div class="main ma">
				<img src="{!! asset('/images/ma.png') !!}">
			</div>
			<div class="footer">
				<p>马克思主义基本原理概论</p>
			</div>
		</div>
	</div>
</div>
@endsection
