<?php

namespace App\Http\Controllers\CashAdvance;

use App\ExpenseReport;
use App\CashAdvanceRequest;
use Illuminate\Http\Request;
use App\CashAdvanceRequestItem;
use App\ExpenseReportItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CashAdvanceController extends Controller
{
    public function index()
    {
        $data = CashAdvanceRequest::query()->where('karyawan_id', Auth::user()->user_login->id)->get();

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
            $data = CashAdvanceRequest::findOrFail($id);
            $data->karyawan_id = Auth::user()->user_login->id;
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
                $cashAdvanceRequestItem = CashAdvanceRequestItem::firstOrNew(['id' => $item['id']]);

                $cashAdvanceRequestItem->cash_advance_request_id = $data->id;
                $cashAdvanceRequestItem->description = $item['description'];
                $cashAdvanceRequestItem->qty = $item['qty'];
                $cashAdvanceRequestItem->estimate_unit_price = $item['unit_price'];
                $cashAdvanceRequestItem->save();
            }


            return redirect('pengajuan-advance')->with('success', 'Data berhasil ditambahkan');
        } catch(\Exception $e){
            
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
    }

    public function userRejected($id)
    {
        $data = CashAdvanceRequest::find($id);
        $data->status = 1;
        $data->save();
    }

    public function directorApproved($id)
    {
        $data = CashAdvanceRequest::find($id);
        $data->status = 4;
        $data->save();
    }

    public function directorRejected($id)
    {
        $data = CashAdvanceRequest::find($id);
        $data->status = 3;
        $data->save();
    }

    //EXPENSE REPORT CONTROLLER//

    public function indexExpense()
    {
        $expenseReports = ExpenseReport::query()
            ->whereHas('cashAdvanceRequest', function ($query) {
                return $query->where('karyawan_id', Auth::user()->user_login->id);
            })
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
        try{
           
            $expenseReport = ExpenseReport::findOrFail($id);
            $cashAdvance = $expenseReport->cashAdvanceRequest;

            $expenseReport->cash_advance_request_id = $cashAdvance->id;
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

            foreach ($request->get('items', []) as $item) {
                // dd($item['description']);

                $expenseReportItem = ExpenseReportItem::firstOrNew(['id' => $item['id']]);

                $expenseReportItem->expense_report_id = $expenseReport->id;
                $expenseReportItem->description = $item['description'];
                $expenseReportItem->qty = $item['qty'];
                $expenseReportItem->estimate_unit_price = $item['unit_price'];
                $expenseReportItem->save();
            }
            

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
    }

    public function userRejectedExpense($id)
    {
        $expenseReport = ExpenseReport::find($id);
        $expenseReport->status = 1;
        $expenseReport->save();
    }

    public function directorApprovedExpense($id)
    {
        $expenseReport = ExpenseReport::find($id);
        $expenseReport->status = 4;
        $expenseReport->save();
    }

    public function directorRejectedExpense($id)
    {
        $expenseReport = ExpenseReport::find($id);
        $expenseReport->status = 3;
        $expenseReport->save();  
    }
  
}