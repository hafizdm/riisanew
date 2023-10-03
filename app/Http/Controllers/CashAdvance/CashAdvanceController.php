<?php

namespace App\Http\Controllers\CashAdvance;

use \PDF;
use App\SPD;
use App\ExpenseReport;
use App\ExpenseReportItem;
use App\CashAdvanceRequest;
use Illuminate\Http\Request;
use App\CashAdvanceRequestItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ExpenseNeedFinanceClear;
use App\Notifications\ExpenseNeedUserApproval;
use App\Notifications\ExpenseNeedUserRejected;
use App\Notifications\CashAdvanceNeedUserApproval;
use App\Notifications\CashAdvanceNeedUserRejected;
use App\Notifications\ExpenseNeedDirectorApproval;
use App\Notifications\ExpenseNeedDirectorRejected;
use App\Notifications\CashAdvanceNeedFinanceApproval;
use App\Notifications\CashAdvanceNeedDirectorApproval;
use App\Notifications\CashAdvanceNeedDirectorRejected;

class CashAdvanceController extends Controller
{
    public function index()
    {
        $data = CashAdvanceRequest::query()->where('karyawan_id', Auth::user()->user_login->id)->orderBy('id', 'desc')->get();

        return view('cashadvance/index', compact('data'));
    }

    public function create()
    {
        return view('cashadvance/create');
    }

    public function store(Request $request)
    {
        // dd(request()->input());
        try{
            $data = new CashAdvanceRequest();
            $data->karyawan_id = Auth::user()->user_login->id;
            $data->no_advance = "";
            $data->request_date = $request->get('request_date');
            $data-> remarks = $request->get('remarks');
            $data->allocation = $request->get('allocation');
            $data->reason = $request->get('reason');
            $data->balance_received = $request->get('balance_received');
            if (request()->hasFile('item_file')) {
                $fileInput = request()->file('item_file');
                $fileName = str_replace('/', '-', $data->id) . '.' . $fileInput->getClientOriginalExtension();
                $fileInput->move('uploads/CashAdvance/itemfile', $fileName);
          
                $data->item_file = $fileName;
              }
            $data->status = 0; //waiting user approval
            

            $data->save();
    
            foreach ($request->get('items', []) as $item) {
                $cashAdvanceRequestItem = new CashAdvanceRequestItem();
                $cashAdvanceRequestItem->cash_advance_request_id = $data->id;
                $cashAdvanceRequestItem->description = $item['description'];
                $cashAdvanceRequestItem->qty = $item['qty'];
                $cashAdvanceRequestItem->estimate_unit_price = $item['unit_price'];
                $cashAdvanceRequestItem->save();
            }

           

            // Add 1 day to include start date
            

           

            $data->no_advance = implode('/', [
              'RII',
              'FN-CA',
              $data->created_at->format('m'),
              $data->created_at->format('y'),
              str_pad($data->id, 5, '0', STR_PAD_LEFT)
            ]);
            $data->save();

            // Dynamic receiver
            $data->employee->reportTo->notify(new CashAdvanceNeedUserApproval($data));

            return redirect('pengajuan-advance')->with('success', 'Data berhasil ditambahkan');
        } catch(\Exception $e){
            report($e);
           return redirect('pengajuan-advance')->with('failed', 'Silahkan Cek Kembali Inputan Anda');
        }
    }

    public function edit($id)
    {
        $data['cash_advance_request'] = CashAdvanceRequest::with('cashAdvanceRequestItems')->find($id);
        return view('cashadvance/edit')->with($data);
    }

    public function update(Request $request, $id)
{
    try{
        // dd($request->all());
        $employee = Auth::user()->user_login;
        $cashAdvance = $employee->cashAdvanceRequests()->findOrFail($id);
        $cashAdvance->request_date = $request->get('request_date');
        $cashAdvance->remarks = $request->get('remarks');
        $cashAdvance->allocation = $request->get('allocation');
        $cashAdvance->reason = $request->get('reason');
        $cashAdvance->balance_received = (int)$request->get('balance_received');

        if (request()->hasFile('item_file')) {
            $fileInput = request()->file('item_file');
            $fileName = str_replace('/', '-', $cashAdvance->id) . '.' . $fileInput->getClientOriginalExtension();
            $fileInput->move('uploads/CashAdvance/itemfile', $fileName);

            $cashAdvance->item_file = $fileName;
        }

        $cashAdvance->status = 0; // waiting user approval
        $cashAdvance->save();

        $cashAdvanceRequestItemIds = [];
        foreach ($request->get('items', []) as $item) {
            // Find or initialize new record
            $cashAdvanceRequestItem = $cashAdvance->cashAdvanceRequestItems()
                ->firstOrNew(['id' => $item['id']]);

            $cashAdvanceRequestItem->description = $item['description'];
            $cashAdvanceRequestItem->qty = $item['qty'];
            $cashAdvanceRequestItem->estimate_unit_price = $item['unit_price'];
            $cashAdvanceRequestItem->save();

            $cashAdvanceRequestItemIds[] = $cashAdvanceRequestItem->id;
        }

        // Remove obsolete data
        $cashAdvance->cashAdvanceRequestItems()
            ->whereNotIn('id', $cashAdvanceRequestItemIds)
            ->delete();

        return redirect('pengajuan-advance')->with('success', 'Data berhasil ditambahkan');
    } catch(\Exception $e){
        report($e);
        return redirect('pengajuan-advance')->with('failed', 'Silahkan Cek Kembali Inputan Anda');
    }
}

    public function destroy($id)
    {
        $data = CashAdvanceRequest::destroy($id);
        if($data){
            auth()->user()->user_login;
            return response()->json([
                'success'=> 'Advance Berhasil Dihapus'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'Advance Berhasil Dihapus'
            ]);
        }
    }

    public function indexRequest()
    {
       $data =  CashAdvanceRequest::query()
            ->whereHas('employee', function ($q) {
                $q->where('karyawan.spd_report_to', Auth::user()->user_login->id);
            })
            ->where('status', 0) // waiting_user_approval
            ->get();
            // dd($data);
        return view('cashadvance/advancerequest/index', compact('data'));
    }

    public function editRequest($id)
    {
        $data['cash_advance_request'] = CashAdvanceRequest::with('cashAdvanceRequestItems')->find($id);
        return view('cashadvance/advancerequest/edit')->with($data);
    }

    public function indexDirector()
    {
        $cashAdvance = CashAdvanceRequest::query()
        ->where('status', 2) // waiting_director_approval
        ->get();
        
        return view('cashadvance/approvalco/index', compact('cashAdvance'));
    }

    public function editDirector($id)
    {
        $data['cash_advance_request'] = CashAdvanceRequest::with('cashAdvanceRequestItems')->find($id);

        return view('cashadvance/approvalco/edit')->with($data);
    }

    public function userApproved($id)
    {
        $data = CashAdvanceRequest::find($id);
        $data->status = 2;
        $data->save();
        Notification::route('mail', 'adisutopo@rapidinfrastruktur.com')
            ->notify(new CashAdvanceNeedDirectorApproval($data));
    }

    public function userRejected($id)
    {
        $data = CashAdvanceRequest::find($id);
        $data->status = 1;
        $data->save();

        // Dynamic receiver
        $data->employee->notify(new CashAdvanceNeedUserRejected($data));
    }

    public function directorApproved($id)
    {
        $data = CashAdvanceRequest::find($id);
        $data->status = 4;
        $data->save();
        Notification::route('mail', 'grace@rapidinfrastruktur.com')
            ->notify(new CashAdvanceNeedFinanceApproval($data));
        Notification::route('mail', 'bintang@rapidinfrastruktur.com')
            ->notify(new CashAdvanceNeedFinanceApproval($data));
    }

    public function directorRejected($id)
    {
        $data = CashAdvanceRequest::find($id);
        $data->status = 3;
        $data->save();

        // Dynamic receiver
        $data->employee->notify(new CashAdvanceNeedDirectorRejected($data));
    }

    //EXPENSE REPORT CONTROLLER//

    public function indexExpense()
    {
        $expenseReports = ExpenseReport::query()
            ->whereHas('cashAdvanceRequest', function ($query) {
                return $query->where('karyawan_id', Auth::user()->user_login->id);
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('expensereport/index', compact('expenseReports'));
    }

    public function createExpense()
    {
        $expenseRequests = CashAdvanceRequest::query()
        ->whereDoesntHave('expenseReports', function ($query) {
          return $query->whereNotIn('status', [1, 3]);
        })
        ->where('karyawan_id', Auth::user()->user_login->id)
        ->where('status', 5)
        ->get();
        return view('expensereport/create', compact('expenseRequests'));
    }

    public function storeExpense(Request $request)
    {
        // dd($request->get('items'));
        try{
            $cashAdvance = CashAdvanceRequest::find($request->input('cash_advance_request_id'));
            $expenseReport = new ExpenseReport();

            $expenseReport->cash_advance_request_id = $cashAdvance->id;
            $expenseReport->request_date = $request->input('request_date');
            $expenseReport->remarks = $request->get('remarks');
            $expenseReport->cash_out = $request->input('cash_out');
            $expenseReport->total_expense = $request->input('total_expense');
            $expenseReport->file_invoice = $request->input('total_expense');
            if (request()->hasFile('file_invoice')) {
                $fileInput = request()->file('file_invoice');
                $fileName = str_replace('/', '-', $expenseReport->id) . '.' . $fileInput->getClientOriginalExtension();
                $fileInput->move('uploads/ExpenseReport/fileInvoice', $fileName);
        
                $expenseReport->file_invoice = $fileName;
            }

            
            $expenseReport->status = 0;
            $expenseReport->save();

            foreach ($request->get('items', []) as $item) {
                // dd($item['description']);
                $expenseReportItem = new ExpenseReportItem();
                $expenseReportItem->expense_report_id = $expenseReport->id;
                $expenseReportItem->description = $item['description'];
                $expenseReportItem->qty = $item['qty'];
                $expenseReportItem->estimate_unit_price = $item['unit_price'];
                $expenseReportItem->save();
            }

            // Dynamic receiver
            $expenseReport->cashAdvanceRequest->employee->reportTo->notify(new ExpenseNeedUserApproval($expenseReport));

        return redirect('pengajuan-expense')->with('success', 'Data berhasil ditambahkan');
        } catch(\Exception $e){
            report($e);
           return redirect('pengajuan-expense')->with('failed', 'Silahkan Cek Kembali Inputan Anda');
        }
       
    }

    public function editExpense($id)
    {
        $expenseReport = ExpenseReport::with(['expenseReportItems', 'cashAdvanceRequest'])->find($id);
        // dd($expenseReport);
        return view('expensereport/edit', compact('expenseReport'));
    }

    public function updateExpense(Request $request, $id)
    {
        try {
            $expenseReport = ExpenseReport::query()
                ->whereHas('cashAdvanceRequest', function ($query) {
                    return $query->where('karyawan_id', Auth::user()->user_login->id);
                })
                ->findOrFail($id);

            $expenseReport->request_date = $request->input('request_date');
            $expenseReport->cash_out = $request->input('cash_out');
            $expenseReport->total_expense = $request->input('total_expense');
            $expenseReport->file_invoice = $request->input('total_expense');

            if (request()->hasFile('file_invoice')) {
                $fileInput = request()->file('file_invoice');
                $fileName = str_replace('/', '-', $expenseReport->id) . '.' . $fileInput->getClientOriginalExtension();
                $fileInput->move('uploads/ExpenseReport/fileInvoice', $fileName);

                $expenseReport->file_invoice = $fileName;
            }
            $expenseReport->status = 0;
            $expenseReport->save();

            $expenseReportItemIds = [];
            foreach ($request->get('items', []) as $item) {
                // Find or initialize new record
                $expenseReportItem = $expenseReport->expenseReportItems()
                    ->firstOrNew(['id' => $item['id']]);

                $expenseReportItem->description = $item['description'];
                $expenseReportItem->qty = $item['qty'];
                $expenseReportItem->estimate_unit_price = $item['unit_price'];
                $expenseReportItem->save();

                $expenseReportItemIds[] = $expenseReportItem->id;
            }

            // Remove obsolete data
            $expenseReport->expenseReportItems()
                ->whereNotIn('id', $expenseReportItemIds)
                ->delete();

            return redirect('pengajuan-expense')->with('success', 'Data berhasil ditambahkan');
        } catch(\Exception $e){
            report($e);
            return redirect('pengajuan-expense')->with('failed', 'Silahkan Cek Kembali Inputan Anda');
        }
    }

    public function destroyExpense($id)
    {
        $data = ExpenseReport::destroy($id);
        if($data){
            auth()->user()->user_login;
            return response()->json([
                'success'=> 'Advance Berhasil Dihapus'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'Advance Berhasil Dihapus'
            ]);
        }
    }

    public function indexExpenseRequest()
    {
        $expenseReport = ExpenseReport::query()
            ->whereHas('cashAdvanceRequest', function ($q1) {
                $q1->whereHas('employee', function ($q2) {
                    $q2->where('spd_report_to', Auth::user()->user_login->id);
                });
            })
            ->where('status', 0) // waiting_user_approval
            ->get();
    
        // dd($expenseReport);
        return view('expensereport/expenserequest/index', compact('expenseReport'));
    }

    public function editExpenseRequest($id)
    {
        $expenseReport = ExpenseReport::with(['expenseReportItems', 'cashAdvanceRequest'])->find($id);
        // dd($expenseReport);
        return view('expensereport/expenserequest/edit', compact('expenseReport'));
    }

    public function indexExpenseDirector()
    {
        $expenseReport = ExpenseReport::query()
        ->where('status', 2) // waiting_director_approval
        ->get();
        return view('expensereport/approvalco/index', compact('expenseReport'));
    }

    public function editExpenseDirector($id)
    {
        $expenseReport = ExpenseReport::with(['expenseReportItems', 'cashAdvanceRequest'])->find($id);
        // dd($expenseReport);
        return view('expensereport/approvalco/edit', compact('expenseReport'));
    }

    public function userApprovedExpense($id)
    {
        $expenseReport = ExpenseReport::find($id);
        $expenseReport->status = 2;
        $expenseReport->save();

        Notification::route('mail', 'adisutopo@rapidinfrastruktur.com')
            ->notify(new ExpenseNeedDirectorApproval($expenseReport));
    }

    public function userRejectedExpense($id)
    {
        $expenseReport = ExpenseReport::find($id);
        $expenseReport->status = 1;
        $expenseReport->save();

        $expenseReport->cashAdvanceRequest->employee->notify(new ExpenseNeedUserRejected($expenseReport));
    }

    public function directorApprovedExpense($id)
    {
        $expenseReport = ExpenseReport::find($id);
        $expenseReport->status = 4;
        $expenseReport->save();

        Notification::route('mail', 'grace@rapidinfrastruktur.com')
            ->notify(new ExpenseNeedFinanceClear($expenseReport));
        Notification::route('mail', 'bintang@rapidinfrastruktur.com')
            ->notify(new ExpenseNeedFinanceClear($expenseReport));
    }

    public function directorRejectedExpense($id)
    {
        $expenseReport = ExpenseReport::find($id);
        $expenseReport->status = 3;
        $expenseReport->save();  

        $expenseReport->cashAdvanceRequest->employee->notify(new ExpenseNeedDirectorRejected($expenseReport));

    }

    public function pdfAdvance($id)
    {
        set_time_limit(300);
        $data = CashAdvanceRequest::find($id);
        
        $pdf = PDF::loadview('cashadvance/cetak', compact('data'))->setPaper('a4','potrait');
        // dd($data);  
        $fileName = $data->request_date;
        return $pdf->stream("Cash Advance"." ".$fileName. '.pdf');
    }

    public function pdfExpense($id)
    {
        set_time_limit(300);
        $data = ExpenseReport::find($id);
        
        $sisaExpense = $data->cashAdvanceRequest->balance_received - $data->cash_out;

        $status = 'Refund';

        if ($sisaExpense == 0) {
        $status = 'Cash Clear';
        }

        if ($sisaExpense < 0) {
        $status = 'Reimbursable';
        }

        $pdf = PDF::loadview('expensereport/cetak', compact('data', 'sisaExpense', 'status'))->setPaper('a4','potrait');
        // dd($data);  
        $fileName = $data->form_date;
        
        return $pdf->stream("Expense Report"." ".$fileName. '.pdf');
    }

    public function indexPaymentRequest()
    {
        return view('cashadvance/indexpayment');
    }
  
}