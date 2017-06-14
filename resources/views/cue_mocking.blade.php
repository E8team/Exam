@extends('layouts.auth')
@section('title')提示@endsection
@section('content')
  <div class="container prompt_box">
    <form method="post" action="{!! route('end_mock') !!}">
      <p class="content">检测到您未提交上次的"随机答题"，是否继续答题还是交卷？</p>
      <p>开始答题时间：{!! $mockRecord->created_at->toDateTimeString() !!}</p>
      <div class="prompt_btn">
        <a href="{!! route('mock', ['mock_record_id'=>$mockRecord->id]) !!}" type="button" class="btn btn-success">继续答题</a>
          {!! csrf_field() !!}
          <input type="hidden" name="mockRecordId" value="{!! $mockRecord->id !!}">
          <button  type="submit" class="btn btn-primary">交卷</button>
      </div>
    </form>
  </div>
@endsection
