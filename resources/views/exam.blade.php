@extends('layouts.app')
@section('content')
<div class="up_top_padding container">
  <div class="exam_state">
    <div class="crumbs">
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Library</a></li>
        <li class="active">Data</li>
      </ol>
    </div>
    <div class="progress_bar">
      <div class="progress_box">
        <em class="page_done"></em>
      </div>
      <div class="txt">
        <span>已完成23题</span>
        / 共500题
      </div>
    </div>
  </div>
</div>
@endsection