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
        $url = config('app.frontend_url') . '/reset-password?' . http_build_query([
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset()
        ]);

        return (new MailMessage)
            ->subject('Reset Password Notification')
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', $url)
            ->line('This password reset link will expire in ' . config('auth.passwords.' . config('auth.defaults.passwords') . '.expire') . ' minutes.')
            ->line('If you did not request a password reset, no further action is required.');
    }
}
