<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequestCategory extends Model
{
    public function employee()
    {
        return $this->belongsTo('App\Employee','approver_employee_id');
    }
}
