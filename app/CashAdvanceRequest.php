<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashAdvanceRequest extends Model
{
    protected $table = 'cash_advance_request';
    protected $fillable = [
        'karyawan_id', 'request_date', 'remarks', 'allocation', 'reason', 'balance_received', 'item_file',
        ];

    public function employee(){
        return $this->belongsTo('App\Employee', 'karyawan_id' );
    }

    public function cashAdvanceRequestItems()
    {
        return $this->hasMany('App\CashAdvanceRequestItem');
    }

    public function expenseReports()
    {
        return $this->hasMany('App\ExpenseReport');
    }
}
