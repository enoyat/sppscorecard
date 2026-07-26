<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected Ticket $ticket;
    protected string $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(Ticket $ticket, string $message)
    {
        $this->ticket = $ticket;
        $this->message = $message;
    }

    /**
     * Notification channel.
     */
    public function via(object $notifiable): array
    {
        return [
            'database',
            // 'mail', // Aktifkan jika ingin kirim email
        ];
    }

    /**
     * Database Notification
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'ticket_id' => $this->ticket->id,

            'title' => $this->ticket->title,

            'message' => $this->message,

            'status' => $this->ticket->status,

            'priority' => $this->ticket->priority,

            'created_by' => $this->ticket->user->name,

            'assigned_to' => optional($this->ticket->assignee)->name,

            'url' => route('tickets.show', $this->ticket->id),

            'icon' => 'fa-solid fa-ticket',

            'color' => $this->getColor(),

            'created_at' => now()->toDateTimeString(),
        ];
    }

    /**
     * Email Notification (Optional)
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Ticket Notification')
            ->greeting('Halo ' . $notifiable->name)
            ->line($this->message)
            ->line('Ticket : ' . $this->ticket->title)
            ->line('Status : ' . $this->ticket->status)
            ->action(
                'Lihat Ticket',
                route('tickets.show', $this->ticket->id)
            )
            ->line('Terima kasih.');
    }

    /**
     * Array Notification
     */
    public function toArray(object $notifiable): array
    {
        return $this->toDatabase($notifiable);
    }

    /**
     * Warna badge berdasarkan priority
     */
    private function getColor(): string
    {
        return match ($this->ticket->priority) {
            'High' => 'danger',
            'Medium' => 'warning',
            'Low' => 'success',
            default => 'secondary',
        };
    }
}