@component('mail::message')

    尊敬的&nbsp;{{$user->name}}&nbsp;：<br>

   欢迎您使用马克思学院在线考试系统！您的账户已经创建。<br>
    您只需点击下面的按钮即可激活您的账户。

@component('mail::button', ['url' => route('email-verification.check', $user->verification_token) . '?email=' . urlencode($user->email) ])
点击这里激活您的账户
@endcomponent

激活您的账户后，您就可以在自己的主页选择你要考试的课程提前练习或者模拟做题。

此致,<br>
{{ config('app.name') }}
@endcomponent