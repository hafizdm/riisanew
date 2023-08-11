<?php

namespace App\Http\Controllers\CashAdvance;

use App\CashAdvanceRequest;
use App\CashAdvanceRequestItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashAdvanceController extends Controller
{
    public function index()
    {
        $data = CashAdvanceRequest::all();

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

    public function indexExpense()
    {
        return view('expensereport/index');
    }

    public function indexRequest()
    {
        return view('cashadvance/advancerequest/index');
    }

    public function indexApproval()
    {
        return view('cashadvance/approvalco/index');
    }
}