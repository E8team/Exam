@extends('layouts.auth')
@section('title')
    重新选择课程
@endsection
@section('login_right')
    <div class="login_right">
        <div class="btn-group">
            <a href="#" class="btn btn-default user_name">欢迎&nbsp;{{Auth::user()->name}}&nbsp;同学</a>
            <a href="{{ route('logout') }}" class="btn btn-info user_exit">退出</a>
        </div>
    </div>
@endsection
@section('content')
	<!--重新选择课程-->
	<div class="container mks_container_information">
		<div class="mks_container_main">
			<div class="mks_container_form">
				<h2>重选课程</h2>
				<form method="post" action="{{route('re_choose')}}">
					<div class="again">
  						<p>您现在可以重新选择考试课程！</p>
  					</div>
            @foreach($courses as $course)
  					<label class="checkbox-inline">
              <input type="checkbox" @if(!$userSelectedCourses->where('id', $course->id)->isEmpty()) checked @endif name="course_ids[]"  value="{!! $course->id !!}">{!! $course->name !!}
            </label>
            @endforeach

  					<input type="submit" class="btn btn-info btn-lg next_btn" value="提交" />
  				</form>
			</div>
		</div>
	</div>
@endsection
