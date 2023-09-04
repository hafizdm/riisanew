<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseReportItem extends Model
{
    public function expenseReport() {
        return $this->belongsTo('App\ExpenseReport');
    }
}
