<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SpdNeedFinanceRequest extends Notification
{
    use Queueable;
    
    protected $spd;

    public function __construct($spd)
    {
        $this->spd = $spd;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('SPD Request Approval')
                    ->greeting("Dear Bapak/Ibu Finance Division")
                    ->line("{$this->spd->employee->nama} telah mengajukan Surat Perjalanan Dinas. Mohon untuk segera dilakukan pembayaran uang muka terlebih dahulu pada website riisa.rapidinfrastruktur.com")
                    ->action('Buka RIISA', url('http://riisa.rapidinfrastruktur.com'))
                    ->line('Terima kasih.');
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
