<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseReport extends Model
{
    public function cashAdvanceRequest() {
        return $this->belongsTo('App\CashAdvanceRequest');
    }

    public function expenseReportItems() {
        return $this->hasMany('App\ExpenseReportItem');
    }
}
