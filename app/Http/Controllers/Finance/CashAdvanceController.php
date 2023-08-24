<?php

namespace App\Http\Controllers\Finance;
use App\CashAdvanceRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;


class CashAdvanceController extends Controller
{
    public function index()
    {
        $data = CashAdvanceRequest::query()
        ->where('status', [4, 5]) // waiting_director_approval
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
}
