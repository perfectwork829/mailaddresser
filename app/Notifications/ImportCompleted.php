<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ImportCompleted extends Notification implements ShouldQueue
{
    use Queueable;

    public $filename;
    public $rows;

    /**
     * Create a new notification instance.
     *
     * @param $filename boolean
     * @param $rows string
     */
    public function __construct($filename, $rows)
    {
        $this->filename = $filename;
        $this->rows = $rows;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Addresses import has been completed.')
            ->line('Imported ' . number_format($this->rows) . ' rows from file ' . $this->filename)
            ->action('Review it', url('/admin/addresses'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
