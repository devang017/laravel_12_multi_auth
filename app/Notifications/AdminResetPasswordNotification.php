<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AdminResetPasswordNotification extends Notification
{
    use Queueable;

    public string $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Admin Password Reset Request')
            ->line('You requested a password reset for your administrator account.')
            ->action('Reset Password', url(route('admin.password.reset', [
                'token' => $this->token,
                'email' => $notifiable->email,
            ], false)))
            ->line('If you didn’t request a password reset, no action is required.');
    }
}
