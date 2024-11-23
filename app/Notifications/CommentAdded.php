<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentAdded extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $comment;

    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New Comment on Your Task')
                    ->line("A new comment was added to your task: {$this->comment->task->title}.")
                    ->line("Comment: {$this->comment->content}")
                    ->action('View Task', url("/show-tasks/{$this->comment->task->id}"))
                    ->line('Thank you for using our application!');
    }
}
