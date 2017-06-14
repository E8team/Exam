@extends('layouts.auth')
@section('title')提示@endsection
@section('content')
  <div class="container prompt_box">
    <form method="post" action="{!! route('end_mock') !!}">
      <p class="content">您上次的"随机答题"已经结束</p>
      <p>开始答题时间：{!! $mockRecord->created_at->toDateTimeString() !!}</p>
      <p>结束答题时间：{!! $mockRecord->ended_at->toDateTimeString() !!}</p>
      <div class="prompt_btn">
          {!! csrf_field() !!}
          <input type="hidden" name="mock_record_id" value="{!! $mockRecord->id !!}">
          <button  type="submit" class="btn btn-primary">交卷</button>
      </div>
    </form>
  </div>
@endsection
