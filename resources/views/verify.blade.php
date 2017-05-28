@extends('layouts.auth')
@section('title')
    <title>邮箱验证</title>
@endsection

@section('content')
    <div class="container mks_container">
        <div class="mks_container_main prompt">
            <div class="title">
                <span class="glyphicon glyphicon-ok-sign icon_ok" aria-hidden="true"></span><h4>验证邮件发送成功！</h4>
            </div>
            <div class="prompt_main">
                <p>我们向您的邮箱<span class="user_email">1289292586@qq.com</span>发送了一封验证邮件</p>
                <p>为保证您账号的安全和方便您参加我们的活动，邮箱完成验证才能继续学习哦~</p>
            </div>
            <p>如果没收到邮件，您可以查看您的垃圾邮件和被过滤邮件，也可以<a href="reg_4.html">再次发送验证邮件</a></p>
        </div>
    </div>
@endsection
