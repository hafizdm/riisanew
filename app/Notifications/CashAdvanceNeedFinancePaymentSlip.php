<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CashAdvanceNeedFinancePaymentSlip extends Notification
{
    use Queueable;
    
    protected $cashAdvance;

    public function __construct($cashAdvance)
    {
        $this->cashAdvance = $cashAdvance;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Cash Advance Request Approval')
                    ->greeting("Dear Bapak/Ibu {$this->cashAdvance->employee->nama}")
                    ->line(" Finance Division telah menyelesaikan proses transaksi Cash Advance anda, mohon untuk segera melihat bukti transaksi melalui website riisa.rapidinfrastruktur.com")
                    ->action('Buka RIISA', url('http://riisa.rapidinfrastruktur.com'))
                    ->line('Terima kasih.');
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
