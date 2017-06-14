@extends('layouts.auth')
@section('title')提示@endsection
@section('content')
  <div class="container prompt_box">
    <form method="post" action="{!! route('end_mock') !!}">
      <p class="content">您上次的"随机答题"已经结束</p>
      <div class="prompt_btn">
        <a  type="button" class="btn btn-success">继续答题</a>
          {!! csrf_field() !!}
          <input type="hidden" name="mock_record_id" value="{!! $mockRecord->id !!}">
          <button  type="submit" class="btn btn-primary">交卷</button>
      </div>
    </form>
  </div>
@endsection
