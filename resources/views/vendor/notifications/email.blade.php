@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level == 'error')
# Whoops!
@else
# Hello!
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
            $color = 'green';
            break;
        case 'error':
            $color = 'red';
            break;
        default:
            $color = 'blue';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

<!-- Salutation -->
@if (! empty($salutation))
{{ $salutation }}
@else
此致,<br>{{ config('app.name') }}
@endif

<!-- Subcopy -->
@isset($actionText)
@component('mail::subcopy')
如果您点击 "{{ $actionText }}" 按钮有困难, 您也可以复制下面的链接到您的浏览器中地址栏粘贴访问:
[{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent
@endisset
@endcomponent
