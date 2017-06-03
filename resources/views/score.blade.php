@extends('layouts.app')
@section('title')成绩@endsection
@section('styles')
	<link rel="stylesheet" href="{!! asset('static/css/score.css') !!}" >
@endsection
@section('content')
<!-- 成绩分析 -->
	<div class="container mks_container  score">
		<div class=" mks_container_score">
			<h2>恭喜你，通过本次考试！</h2>
			<div class="container_score_body">
				<div class="title"><h3>试卷得分</h3></div>
				<div class="score_lcon">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="re_num"><em>90</em>分</div>
					</div>
					<div  class="analysis col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<ul>
						<li class="dtsj"><i></i>答题时间<span>30分20秒</span></li>
						<li class="dtl"><i></i>答题量<span>49/50道</span></li>
						<li class="dd"><i></i>答对<span>46/49道</span></li>
						<li class="dc"><i></i>答错<span>46/49道</span></li>
						<li class="ld"><i></i>漏答<span>1/50道</span></li>							
					</ul>
					</div>
				</div>
				<div class="btn_group">
					<div class="btn_group_body">
						<button type="button" class="btn btn-success btn1">重新考试</button>
						<button type="button" class="btn btn-info btn2">退出</button>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection