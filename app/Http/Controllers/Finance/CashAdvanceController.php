<?php

namespace App\Http\Controllers\Finance;
use App\Http\Controllers\Controller;


class CashAdvanceController extends Controller
{
    public function index()
    {
        return view('finance/cashadvance/index');
    }
}
