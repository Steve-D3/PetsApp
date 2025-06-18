<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class ResetPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        Log::info('Sending ResetPassword notification via mail', [
            'email' => $notifiable->email,
            'token' => $this->token
        ]);
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        Log::info('Building ResetPassword email', [
            'email' => $notifiable->email,
            'reset_url' => $resetUrl
        ]);

        return (new MailMessage)
            ->subject('Reset Password Notification')
            ->markdown('emails.password-reset', [
                'resetUrl' => $resetUrl,
                'expire' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')
            ]);
    }
}
