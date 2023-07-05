<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpdReport extends Model
{
    protected $casts = [
        'report_tgl_keberangkatan' => 'date', //casting merubah format tanggal
        'report_tgl_pulang' => 'date', //casting merubah format tanggal
    ];

    

    public function spdReportApproval()
    {
        return $this->hasOne('App\SpdReportApproval');
    }
}
