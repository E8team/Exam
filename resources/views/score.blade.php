@extends('layouts.app')
@section('title')答题结束@endsection
@section('styles')
	<link rel="stylesheet" href="{!! asset('static/css/score.css') !!}" >
@endsection
@push('js')
<script type="text/javascript">
	$(function () {
        $('#time').html(window.conversionToMinutes({!! $mockRecord->ended_at->diffInSeconds($mockRecord->created_at, true) !!}, 2));
    })
</script>
@endpush
@section('content')
<!-- 成绩分析 -->
	<div class="container mks_container  score">
		<div class=" mks_container_score">
			<h2>答题结束！</h2>
			<div class="container_score_body">
				<div class="title"><h3>试卷得分</h3></div>
				<div class="score_lcon">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="re_num"><em>{!! $mockRecord->score !!}</em>分</div>
					</div>
					<div  class="analysis col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<ul>
						<li class="dtsj"><i></i>答题时间<span id="time"></span></li>
						<li class="dtl"><i></i>答题量<span>{!! $mockRecord->submit_count.'/'.$mockTopicsCount !!}道</span></li>
						<li class="dd"><i></i>答对<span>{!! $mockRecord->correct_count.'/'.$mockRecord->submit_count !!}道</span></li>
						<li class="dc"><i></i>答错<span>{!! $wrongCount.'/'.$mockRecord->submit_count !!}道</span></li>
						<li class="ld"><i></i>漏答<span>{!! ($mockTopicsCount-$mockRecord->submit_count).'/'.$mockTopicsCount !!}道</span></li>
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