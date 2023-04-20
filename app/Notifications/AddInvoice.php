<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddInvoice extends Notification
{
    use Queueable;
    private $invoice_id;
    private $invoice_number;

    /**
     * Create a new notification instance.
     */
    public function __construct($invoice_id,$invoice_number)
    {
        $this->invoice_id=$invoice_id;
        $this->invoice_number=$invoice_number;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
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
        $url = 'http://localhost/inovices_proj/public/InvoicesDetails/'.$this->invoice_id;
        return (new MailMessage)
                    ->line($this->invoice_number.'تمت اضافة الفاتوره ')
                    ->subject('اضافة فاتورة جديدة')
                    ->action($this->invoice_number.'عرض الفاتوره', $url)
                    ->line('Thank you for using our invoicements application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
