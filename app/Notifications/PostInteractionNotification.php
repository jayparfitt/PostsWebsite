<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class PostInteractionNotification extends Notification
{
    public $interaction;
    /**
     * Create a new notification instance.
     */
    public function __construct($interaction)
    {
        $this->interaction = $interaction;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'post_id' => $this->interaction['post_id'],
            'comment_id' => $this->interaction['comment_id'] ?? null,
            'interactionName' => $this->interaction['interactionName'],
            'message' => $this->interaction['message']
        ];
    }
}
