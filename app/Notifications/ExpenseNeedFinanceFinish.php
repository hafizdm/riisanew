<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ExpenseNeedFinanceFinish extends Notification
{
    use Queueable;
    
    protected $expenseReport;

    public function __construct($expenseReport)
    {
        $this->expenseReport = $expenseReport;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Expense Report Approval')
                    ->greeting("Dear Bapak/Ibu {$this->expenseReport->cashAdvanceRequest->employee->nama}")
                    ->line("Finance Division telah menyelesaikan proses transaksi Expense Report anda, mohon untuk segera melihat bukti transaksi melalui website riisa.rapidinfrastruktur.com")
                    ->action('Buka RIISA', url('http://riisa.rapidinfrastruktur.com'))
                    ->line('Terima kasih.');
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
