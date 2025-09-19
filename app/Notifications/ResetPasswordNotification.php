<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordBase;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPasswordBase
{
    public function toMail($notifiable)
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('🔑 Recupera tu contraseña - ' . 'WalterMOTOS')
            ->markdown('emails.reset-password', [
                'url'      => $url,
                'user'     => $notifiable,
                'appName'  => config('app.name'),
                'fromMail' => config('mail.from.address'),
            ]);
    }
}
