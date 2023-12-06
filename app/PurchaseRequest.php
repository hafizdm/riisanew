<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    public function purchaseRequestItems()
    {
        return $this->hasMany('App\PurchaseRequestItem');
    }

    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }

    public function approverEmployee() {
        return $this->belongsTo('App\Employee', 'approver_employee_id');
    }

    public function purchaseRequestCategory() {
        return $this->belongsTo('App\PurchaseRequestCategory', 'purchase_request_category_id');
    }
}
