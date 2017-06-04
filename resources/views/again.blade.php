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
				<form method="post" action="##">
					<div class="again">
  						<p>抱歉！您与注册时选择的课程不一致，请重新选择考试课程！</p>
  					</div>
  					<label class="checkbox-inline">
						<input type="checkbox" id="inlineCheckbox1" value="option1">马克思主义基本原理概率
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" id="inlineCheckbox2" value="option2">中国近代史纲要
					</label>
  					<a href="##" type="submit" class="btn btn-info btn-lg next_btn">确认</a>
  				</form>
			</div>
		</div>
	</div>
@endsection