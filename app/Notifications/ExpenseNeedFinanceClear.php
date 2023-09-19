<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ExpenseNeedFinanceClear extends Notification
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
                    ->greeting("Dear Bapak/Ibu Finance Division")
                    ->line("{$this->expenseReport->cashAdvanceRequest->employee->nama} telah mengajukan pembuatan Expense Report. Mohon untuk segera menyelesaikan transaksi yang bersangkutan pada website riisa.rapidinfrastruktur.com")
                    ->action('Buka RIISA', url('http://riisa.rapidinfrastruktur.com'))
                    ->line('Terima kasih.');
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
