<?php

namespace App\Http\Controllers\HRD;
use App\SPD;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Notifications\SpdNeedUserApproval;

class SPDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['spd'] = SPD::whereHas('spdApproval', function ($query){
            return $query->whereIn('hr_status', [0, 1, 2]);
        })
        ->orderBy('created_at', 'desc')
        ->get();
        // dd($data['spd'][0]->id);
        return view('hrd/spd/index')->with($data);
    }

    public function spdReport()
    {
        $data['spd_report'] = SPD::query()
            ->with('spdReport', 'spdReport.spdReportApproval')
            ->whereHas('spdApproval', function ($query) {
                return $query->where('spd_approvals.status', 1);
            })
            ->whereHas('spdReport', function ($query) {
                return $query->whereHas('spdReportApproval', function ($q) {
                    return $q->where('spd_report_approvals.status', 1);
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();
        return view('hrd/spdreport/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['spd'] = SPD::find($id);
        
        return view('hrd/spd/edit')->with($data);
    }

    public function editReport($id)
    {
        $data['spd'] = SPD::find($id);
        return view('hrd/spdreport/edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function spdApproved($id)
    {
        $spd = SPD::find($id);
        $spdApproval = $spd->spdApproval;

        $spdApproval->hr_status = 1; // status approved
        $spdApproval->save();

        // Dynamic receiver
        $spd->employee->reportTo->notify(new SpdNeedUserApproval($spd));
    }

    public function spdRejected($id)
    {
        $spd = SPD::find($id);
        $spdApproval = $spd->spdApproval;

        $spdApproval->hr_status = 2; // status Rejected
        $spdApproval->save();
    }

    public function reportApproved($id)
    {
        $spd = SPD::find($id);
        $spdReportApproval = $spd->spdReport->spdReportApproval;
    
        $spdReportApproval->hr_status = 1; // status approved
        $spdReportApproval->save();
    
        $spd->employee->increment('spd_limit', 1);
    }

    public function reportRejected($id)
    {
        $spd = SPD::find($id);
        $spdReportApproval = $spd->spdReport->spdReportApproval;

        $spdReportApproval->hr_status = 2; // status rejected
        $spdReportApproval->save();
    }
}
