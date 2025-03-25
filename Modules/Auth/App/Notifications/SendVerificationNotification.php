<?php

namespace Modules\Auth\App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendVerificationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public ?string $name, public ?string $code)
    {
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        $name = $this->name;
        $code = $this->code;

        return (new MailMessage)
            ->subject("Vérification Compte {$name}")
            ->greeting("Bonjour {$name}.")
            ->line("Votre code de vérification est: {$code}.")
            ->line("merci d'utiliser notre application");
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        $name = $this->name;
        $code = $this->code;

        return [
            'title' => "Vérification Compte {$name}",
            'body' => "Votre code de vérification est: {$code}."
        ];
    }

    public function toBroadcast($notifiable)
    {
        $name = $this->name;
        $code = $this->code;

        return [
            'title' => "Vérification Compte {$name}",
            'body' => "Votre code de vérification est: {$code}."
        ];
    }
}
