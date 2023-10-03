<?php

namespace App\Http\Controllers\Finance;

use App\Notifications\SpdNeedFinanceCancel;
use App\SPD;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Routing\Controller;
use App\Notifications\SpdNeedRequestClear;

class SPDController extends Controller
{
    public function index()
    {
        $data['spd'] = SPD::whereHas('spdApproval', function ($query){
            return $query->whereIn('status', ['1']);
        })
        ->orderBy('created_at', 'desc')
        ->get();
        // dd($data['spd'][0]->id);
        return view('finance/spd/index')->with($data);
    }

    public function edit($id)
    {
        $data['spd'] = SPD::find($id);
        
        return view('finance/spd/edit')->with($data);
    }

    public function paymentApproved($id)
    {
        $spd = SPD::find($id);
        $spdApproval = $spd->spdApproval;

        $spdApproval->finance_status = 1; // status approved
        $spdApproval->save();

        $spd->employee->notify(new SpdNeedRequestClear($spd));

      
    }

    public function paymentCancel($id)
    {
        $spd = SPD::find($id);
        $spdApproval = $spd->spdApproval;

        $spdApproval->finance_status = 2; // status Rejected
        $spdApproval->save();

        $spd->employee->notify(new SpdNeedFinanceCancel($spd));
    }

    public function uploadSpd($id)
    {
        $data['spd']= SPD::find($id);
        return view('finance/spd/upload_form_spd')->with($data);
    }

    public function updateSpdUpload(Request $request,$id)
    {
        $data = SPD::find($id);

        
        $files = $request->file('upload_file');
        
        // return $files;
        $destinationPath = 'uploads/'.$request->nik.'/'.'Spd'; // upload path
        $file = "Spd_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
        $files->move($destinationPath, $file);
        $uploadSpd= $file;

        $data->upload_file = $uploadSpd;
        $data->updated_at = Carbon::now()->toDateTimeString();
        $data->save();

        return redirect('list-spd')->with('success', 'File successfully updated');
    }

    public function indexReport()
    {
        $data['spd_report'] = SPD::query()
            ->with('spdReport', 'spdReport.spdReportApproval')
            ->whereHas('spdApproval', function ($query) {
                return $query->where('spd_approvals.hr_status', 1);
            })
            ->whereHas('spdReport', function ($query) {
                return $query->whereHas('spdReportApproval', function ($q) {
                    return $q->where('spd_report_approvals.hr_status', 1);
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();
        return view('finance/spdreport/index')->with($data);
    }   

    public function editReport($id)
    {
        $data['spd'] = SPD::find($id);
        return view('finance/spdreport/edit')->with($data);
    }

    public function reportApproved($id)
    {
        $spd = SPD::find($id);
        $spdReportApproval = $spd->spdReport->spdReportApproval;
    
        $spdReportApproval->finance_status = 1; // status approved
        $spdReportApproval->save();
    
        $spd->employee->increment('spd_limit', 1);

        $spd->employee->notify(new SpdNeedRequestClear($spd));
    }

    public function uploadReport($id)
    {
        $data['spd_reports']= SPD::find($id);
        return view('finance/spdreport/upload_form_report')->with($data);
    }

    public function updateReportUpload(Request $request,$id)
    {
        $data = SPD::find($id);

        
        $files = $request->file('upload_file');
        
        // return $files;
        $destinationPath = 'uploads/'.$request->nik.'/'.'SpdReport'; // upload path
        $file = "SpdReport_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
        $files->move($destinationPath, $file);
        $uploadReport= $file;

        $data->spdReport->upload_file = $uploadReport;
        $data->spdReport->save();

        return redirect('list-spd-report')->with('success', 'File successfully updated');
    }
}
