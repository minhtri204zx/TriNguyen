<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StatusLinkNotification extends Notification
{
    use Queueable;

    protected $content;
    protected $acount_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($content, $acount_id)
    {
        $this->content = $content;
        $this->acount_id = $acount_id;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    public function toMail()
    {
        return (new MailMessage)
            ->subject('Thông báo thay đổi link')
            ->line($this->content);
    }

    public function toDatabase($notifiable)
    {
        return [
            'content' => $this->content,
            'account_id' => $this->acount_id,
        ];
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
