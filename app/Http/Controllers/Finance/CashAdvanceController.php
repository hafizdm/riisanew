<?php

namespace App\Http\Controllers\Finance;
use App\CashAdvanceRequest;
use App\ExpenseReport;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;


class CashAdvanceController extends Controller
{
    public function index()
    {
        $data = CashAdvanceRequest::query()
        ->whereIn('status', [4, 5]) // waiting payment slip
        ->get();
        
        return view('finance/cashadvance/index', compact('data'));
    }

    public function uploadAdvance($id)
    {
        $data['cash_advance_request']= CashAdvanceRequest::find($id);
        return view('finance/cashadvance/upload_payment')->with($data);
    }

    public function updateAdvanceUpload(Request $request,$id)
    {
        $data = CashAdvanceRequest::find($id);

        
        $files = $request->file('upload_file');
        
        // return $files;
        $destinationPath = 'uploads/'.$request->nik.'/'.'CashAdvance'; // upload path
        $file = "PaymentSlip_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
        $files->move($destinationPath, $file);
        $uploadAdvance= $file;

        $data->upload_payment = $uploadAdvance;
        $data->updated_at = Carbon::now()->toDateTimeString();
        $data->save();

        return redirect('list-advance')->with('success', 'File successfully updated');
    }

    public function editPayment($id)
    {
        $data['cash_advance_request'] = CashAdvanceRequest::with('cashAdvanceRequestItems')->find($id);
        return view('finance/cashadvance/edit')->with($data);
    }

    public function paymentSlip($id)
    {
        $data = CashAdvanceRequest::find($id);
        $data->status = 5;
        $data->save();
    }

    public function indexExpense()
    {
        $expenseReport= ExpenseReport::query()
        ->whereIn('status', [4, 5]) // waiting payment slip
        ->get();
        
        return view('finance/expensereport/index', compact('expenseReport'));
    }

    public function uploadExpense($id)
    {
        $data['expense_reports']= ExpenseReport::find($id);
        return view('finance/expensereport/upload_expense')->with($data);
    }

    public function updateExpenseUpload(Request $request,$id)
    {
        $data = ExpenseReport::find($id);

        
        $files = $request->file('file_upload');
        
        // return $files;
        $destinationPath = 'uploads/'.$request->nik.'/'.'ExpenseReport'; // upload path
        $file = "ExpenseFile_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
        $files->move($destinationPath, $file);
        $uploadExpense= $file;

        $data->file_upload = $uploadExpense;
        $data->updated_at = Carbon::now()->toDateTimeString();
        $data->save();

        return redirect('list-expense')->with('success', 'File successfully updated');
    }
}
