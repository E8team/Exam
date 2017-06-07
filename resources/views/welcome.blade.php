@extends('layouts.app')
@section('title')欢迎@endsection
@section('content')
<!-- 背景 -->
<div class="up_top_padding bg_box">
	<h2>{!! config('app.name') !!}</h2>
	@if(!Auth::check())
		<a href="{{route('register')}}" type="button" class="btn btn-info btn-lg hidden-xs hidden-md">注册一个学生账号</a>
	@endif
	<div class="chevron-down hidden-xs hidden-md"><i class="glyphicon glyphicon-chevron-down"></i></div>
</div>
<!-- 选课 -->
<div class="container course">
	<h2 class="text-center title">选择你的课程 <a href="{!! route('re_choose') !!}" class="btn btn-link">重选课程</a></h2>
	@if(Auth::check() && Auth::user()->isSelectedCourses())
		@php$courses = Auth::user()->courses;@endphp
		@else
		@php $courses = \App\Models\Course::all();@endphp
	@endif
	@foreach($courses as $course)
		<a href="{!! route('menu', ['courseId' => $course->id]) !!}">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 course_item">
				<div class="content">
					<div class="main">
						<img src="{!! asset('/static/images/'.$course->id.'.png') !!}">
					</div>
					<div class="footer">
						<p>{!! $course->name !!}</p>
					</div>
				</div>
			</div>
		</a>
	@endforeach
</div>
@endsection
