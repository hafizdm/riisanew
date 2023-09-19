<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ExpenseNeedDirectorApproval extends Notification
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
                    ->greeting("Dear Bapak/Ibu Adi Sutopo Suharyo (Director)")
                    ->line("{$this->expenseReport->cashAdvanceRequest->employee->nama} telah mengajukan pembuatan Expense Report. Mohon untuk segera di Review terlebih dahulu pada website riisa.rapidinfrastruktur.com")
                    ->action('Buka RIISA', url('http://riisa.rapidinfrastruktur.com'))
                    ->line('Terima kasih.');
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
