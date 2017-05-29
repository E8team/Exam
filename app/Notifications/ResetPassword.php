<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as BaseResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends BaseResetPassword
{

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
       return (new MailMessage)
            ->line('您收到此电子邮件，因为我们收到了您的密码重置请求.')
            ->action('重置密码', url(config('app.url').route('password.reset', $this->token, false)))
            ->line('如果您不想重置密码，则不需要进一步的操作.');
    }

}
