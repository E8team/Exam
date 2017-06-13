@extends('layouts.auth')
@section('title')登录@endsection
@section('content')
  <div class="container prompt_box">
    <p class="content">检测到您未提交上次的模拟，是否继续答题还是重新模拟？</p>
    <div class="prompt_btn">
      <a  type="button" class="btn btn-success">继续答题</a>
      <a  type="button" class="btn btn-primary">重新答题</a>
    </div>
  </div>
@endsection
