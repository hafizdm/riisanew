<?php

namespace App\Http\Controllers\SPD;
use \PDF;
use App\SPD;
use \App\User;
use \App\Employee;
use App\SpdReport;
use Carbon\Carbon;
use App\SpdApproval;
use Carbon\CarbonPeriod;
use App\SpdReportApproval;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SpdNeedHrdApproval;
use App\Notifications\SpdNeedRequestClear;
use App\Notifications\SpdNeedUserRejected;
use App\Notifications\SpdNeedFinanceRequest;
use App\Notifications\SpdReportNeedHrdApproval;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SpdReportNeedUserApproval;

class SPDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['spd'] = SPD::where('nik', Auth::user()->username)->orderBy('created_at', 'desc')->get();
        $spdlimit = Employee::select('spd_limit')->where('nik', Auth::user()->username)->first();
        
        return view('spd/index')->with($data);
    }

    public function pdf()
    {
        $data['spd'] = SPD::all();
        return view('spd/pdf')->with($data);
    }

    public function downloadpdf($id) {
        set_time_limit(300);
        $data = SPD::find($id);
        
        $pdf = PDF::loadview('spd/downloadpdfnew', compact('data'))->setPaper('a4','potrait');
        // dd($data);  
        $fileName = $data->form_date;
        return $pdf->stream("Surat Perjalanan Dinas"." ".$fileName. '.pdf');
        
    }

    public function reportpdf($id) {
        set_time_limit(300);
        $data = SPD::find($id);
        
        $sisaExpense = $data->balance_received - $data->spdReport->expense_received;

        $status = 'Refund';

        if ($sisaExpense == 0) {
        $status = 'Cash Clear';
        }

        if ($sisaExpense < 0) {
        $status = 'Reimbursable';
        }

        $pdf = PDF::loadview('spdreport/cetakpdfreport', compact('data', 'sisaExpense', 'status'))->setPaper('a4','potrait');
        // dd($data);  
        $fileName = $data->form_date;
        
        return $pdf->stream("SPD Report"." ".$fileName. '.pdf');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['karyawan'] = Employee::where('nik','=', Auth::user()->username)->first();
        return view('spd/create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->user_login->spd_limit < 1){
            return redirect('pengajuan-spd')->with('failed', 'Limit Pengajuan SPD anda sudah habis, silahkan melaukan Report terlebih dahulu!');
        }

        try{
            $spd = new SPD();
            $spd->nama = $request->get('nama');
            $spd->no_surat = "";
            $spd->nik = $request->get('nik');
            $spd->divisi_id = $request->get('divisi_id');
            $spd->asal = $request->get('asal');
            $spd->tujuan = $request->get('tujuan');
            $spd->travel_type = $request->get('travel_type');
            $spd->tgl_keberangkatan = $request->get('tgl_keberangkatan');
            $spd->tgl_pulang = $request->get('tgl_pulang');
            $spd->form_date = $request->get('form_date');
            $spd->assignment_type = $request->get('assignment_type');
            $spd->purpose = $request->get('purpose');
            $spd->travel_by = $request->get('travel_by');
            $spd->advance_payment = $request->get('advance_payment');
            $spd->idr = $request->get('idr');
            $spd->sign_received = $request->get('sign_received');
            $spd->note = $request->get('note');

            $jabatan = auth()->user()->user_login->jabatan;

            $spd->eat_per_day = 0;
            $spd->allowance = 0;

            // Add 1 day to include start date
            $totalDays = now()->parse($spd->tgl_keberangkatan)->diffInDays($spd->tgl_pulang) + 1;

            if ($spd->travel_type == 'Domestic') {
                $spd->eat_per_day = $jabatan->eat_per_day_domestic;
                $spd->allowance = $jabatan->allowance_per_day_domestic;
            }

            if ($spd->travel_type == 'International') {
                $spd->eat_per_day = $jabatan->eat_per_day_international;
                $spd->allowance = $jabatan->allowance_per_day_international;
            }

            $spd->total_eat = $spd->eat_per_day * $totalDays;
            $spd->total_allowance = $spd->allowance * $totalDays;
            $spd->balance_received = $spd->total_eat + $spd->total_allowance + $spd->idr;
            $spd->save();

            $spdApproval = new SpdApproval();
            $spdApproval->spd_id = $spd->id;
            $spdApproval->karyawan_id = auth()->user()->user_login->spd_report_to;
            $spdApproval->hr_status = 0; // request approval
            $spdApproval->status = 0; // request approval
            $spdApproval->save();

            auth()->user()->user_login->decrement('spd_limit', 1); //perintah untuk mengurangi SPD limit apabila SPD dibuat

            $spd->no_surat = implode('/', [
              'RII',
              'HC-SPD',
              $spd->created_at->format('m'),
              $spd->created_at->format('y'),
              str_pad($spd->id, 5, '0', STR_PAD_LEFT)
            ]);
            $spd->save();

            // Static receiver
            Notification::route('mail', 'hrd@rapidinfrastruktur.com')
            ->notify(new SpdNeedHrdApproval($spd));

            return redirect('pengajuan-spd')->with('success', 'Data berhasil ditambahkan');
        } catch(\Exception $e){
            report($e);
           return redirect('pengajuan-spd')->with('failed', 'Silahkan Cek Kembali Inputan Anda');
        }
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
        return view('spd/edit')->with($data);
    }

    public function editReport($id)
    {
        $data['spd'] = SPD::find($id);
        return view('spdreport/edit')->with($data);
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
        try{
            $spd =  SPD::find($id);
            $spd->form_date = $request->get('form_date');
            $spd->nama = $request->get('nama');
            $spd->nik = $request->get('nik');
            $spd->divisi_id = $request->get('divisi_id');
            $spd->asal = $request->get('asal');
            $spd->tujuan = $request->get('tujuan');
            $spd->travel_type = $request->get('travel_type');
            $spd->tgl_keberangkatan = $request->get('tgl_keberangkatan');
            $spd->tgl_pulang = $request->get('tgl_pulang');
            $spd->form_date = $request->get('form_date');
            $spd->assignment_type = $request->get('assignment_type');
            $spd->purpose = $request->get('purpose');
            $spd->travel_by = $request->get('travel_by');
            $spd->advance_payment = $request->get('advance_payment');
            $spd->idr = $request->get('idr');
            $spd->sign_received = $request->get('sign_received');
            $spd->note = $request->get('note');
            $spd->balance_received = $spd->total_eat + $spd->total_allowance + $spd->idr;
            if ($spd->travel_type == 'Domestic') {
                $spd->eat_per_day = auth()->user()->user_login->jabatan->eat_per_day_domestic;
                $spd->allowance = auth()->user()->user_login->jabatan->allowance_per_day_domestic;
            } else if ($spd->travel_type == 'International') {
                $spd->eat_per_day = auth()->user()->user_login->jabatan->eat_per_day_international;
                $spd->allowance = auth()->user()->user_login->jabatan->allowance_per_day_international;
            }
            $spd->save();

            

            return redirect('/pengajuan-spd')->with('success', 'Data  berhasil di Update');
        }
        catch(\Exception $e){
            return redirect('pengajauan-spd')->with('failed', 'Silahkan Cek Kembali Inputan Anda');
         }
    }

    public function updateReport(Request $request, $id)
    {
        try{
            $spd =  SPD::find($id);
            
            if (request()->hasFile('upload_report')) {
              $fileInput = request()->file('upload_report');
              $fileName = str_replace('/', '-', $spd->no_surat) . '.' . $fileInput->getClientOriginalExtension();
              $fileInput->move('uploads/SpdReport/report', $fileName);
        
              $spd->spdReport->upload_report = $fileName;
            }
        
            $spd->spdReport->cash_out = $request->get('cash_out');
            $spd->spdReport->expense_received = request()->input('expense_received');
            $spd->spdReport->report_tgl_keberangkatan = request()->input('report_tgl_keberangkatan');
            $spd->spdReport->report_tgl_pulang = request()->input('report_tgl_pulang');
            $spd->spdReport->total_eat_report = request()->input('total_eat_report');
            $spd->spdReport->total_allowance_report = request()->input('total_allowance_report');
        
            $spd->spdReport->save();
        
            return redirect('/add-report')->with('success', 'Data  berhasil di Update');
        } catch(\Exception $e) {
            return redirect()->route('edit-report', $spd->id)->with('failed', 'Silahkan Cek Kembali Inputan Anda');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spd = SPD::destroy($id);
        if($spd){
            auth()->user()->user_login->increment('spd_limit', 1);
            return response()->json([
                'success'=> 'SPD berhasil dihapus'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'SPD gagal dihapus'
            ]);
        }
        
    }

    public function deleteReport($id)
    {
        $spdReport = SpdReport::destroy($id);
        if($spdReport){
            return response()->json([
                'success'=> 'SPD berhasil dihapus'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'SPD gagal dihapus'
            ]);
        }
    }

    // public function showUploadSPD($id)
    // {
    //     $data['spd']= SPD::find($id);
    //     return view('spd/upload_form_spd')->with($data);
    // }

    // public function showUploadReport($id)
    // {
    //     $data['spd_reports']= SPD::find($id);
    //     return view('spdreport/upload_form_report')->with($data);
    // }

    // public function updateUploadSpd(Request $request,$id)
    // {
    //     $data = SPD::find($id);

        
    //     $files = $request->file('upload_file');
        
    //     // return $files;
    //     $destinationPath = 'uploads/'.$request->nik.'/'.'Spd'; // upload path
    //     $file = "Spd_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
    //     $files->move($destinationPath, $file);
    //     $uploadSpd= $file;

    //     $data->upload_file = $uploadSpd;
    //     $data->updated_at = Carbon::now()->toDateTimeString();
    //     $data->save();

    //     return redirect('pengajuan-spd')->with('success', 'File successfully updated');
    // }

    // public function updateUploadReport(Request $request,$id)
    // {
    //     $data = SPD::find($id);

        
    //     $files = $request->file('upload_file');
        
    //     // return $files;
    //     $destinationPath = 'uploads/'.$request->nik.'/'.'SpdReport'; // upload path
    //     $file = "SpdReport_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
    //     $files->move($destinationPath, $file);
    //     $uploadReport= $file;

    //     $data->spdReport->upload_file = $uploadReport;
    //     $data->spdReport->save();

    //     return redirect('add-report')->with('success', 'File successfully updated');
    // }

    public function indexRequest()
    {
        // dd(Auth::user()->user_login->id);
        $data['spd'] = SPD::query()
            ->whereHas('employee', function ($query) {
                return $query->where('karyawan.spd_report_to', Auth::user()->user_login->id);
            })
            ->whereHas('spdApproval', function ($query) {
                return $query->where('spd_approvals.hr_status', 1)->where('spd_approvals.status', 0);
            })
            ->get();

        // dd($data);   

        return view('spdrequest.index')->with($data);
    }




    public function indexReport() //untuk halaman user approval
    {
        $data['spd_report'] = SPD::query()
            ->with('spdReport')
            ->whereHas('spdReport', function ($query) {
                return $query->whereHas('spdReportApproval', function ($q) {
                return $q->where('spd_report_approvals.status', 0);
                });
            })
            ->whereHas('spdApproval', function ($query) {
                return $query->where('spd_approvals.status', 1);
            })
            ->whereHas('employee', function ($query) {
                return $query->where('karyawan.spd_report_to', Auth::user()->user_login->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('spdreport.index')->with($data);

    }

    public function addReport() //untuk halaman request addreport
    {
        $data['spd_report'] = SPD::query()
            ->with('spdReport')
            ->whereHas('spdReport')
            ->whereHas('spdApproval', function ($query) {
                $query->where('spd_approvals.status', 1);
            })
            ->where('nik', Auth::user()->username)
            ->orderBy('created_at', 'desc')
            ->get();

        $data['spd'] = SPD::query()
            ->whereDoesntHave('spdReport')
            ->whereHas('spdApproval', function ($query) {
                $query->where('spd_approvals.status', 1);
            })
            ->where('nik', Auth::user()->username)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('spdreport.addreport')->with($data);
    }

    public function addReportStore()
    {
        $spd = SPD::query()
            ->whereHas('spdApproval', function ($query) {
                $query->where('spd_approvals.status', 1);
            })
            ->where('nik', Auth::user()->username)
            ->orderBy('created_at', 'desc')
            ->find(request()->input('spd_id'));

        $fileInput = request()->file('upload_report');
        $fileName = str_replace('/', '-', $spd->no_surat) . '.' . $fileInput->getClientOriginalExtension();
        $fileInput->move('uploads/SpdReport/report', $fileName);

        $spdreport = new SpdReport(); 
        $spdreport->spd_id=$spd->id;
        $spdreport->cash_out= request()->input('cash_out');
        $spdreport->expense_received = request()->input('expense_received');
        $spdreport->report_tgl_keberangkatan = request()->input('report_tgl_keberangkatan');
        $spdreport->report_tgl_pulang = request()->input('report_tgl_pulang');
        $spdreport->total_eat_report = request()->input('total_eat_report');
        $spdreport->total_allowance_report = request()->input('total_allowance_report');
        $spdreport->upload_report = $fileName;
        $spdreport->save();

        $spdReportApproval = new SpdReportApproval(); 
        $spdReportApproval->spd_id = $spd->id;
        $spdReportApproval->spd_report_id = $spdreport->id;
        $spdReportApproval->status = 0;
        $spdReportApproval->hr_status = 0;
        $spdReportApproval->save();

         //Dynamic receiver
         $spd->employee->reportTo->notify(new SpdReportNeedUserApproval($spd));

        return redirect('add-report')->with('success', 'File successfully updated');
        // dd(request(), $spd);
    }

    public function spdReportAjax($id)
    {
        $spd = SPD::query()
            ->whereHas('spdApproval', function ($query) {
                $query->where('spd_approvals.status', 1);
            })
            ->where('nik', Auth::user()->username)
            ->orderBy('created_at', 'desc')
            ->find($id);
        return response()->json($spd); 
    }

    public function spdApproved($id)
    {
        
        $spd = SPD::find($id);
        $spdApproval = $spd->spdApproval;

        $spdApproval->status = 1; // status approved
        $spdApproval->save();

        Notification::route('mail', 'grace@rapidinfrastruktur.com')
            ->notify(new SpdNeedFinanceRequest($spd));
    }

    public function spdRejected($id)
    {
        $spd = SPD::find($id);
        $spdApproval = $spd->spdApproval;

        $spdApproval->status = 2; // status Rejected
        $spdApproval->save();

        $spd->employee->notify(new SpdNeedUserRejected($spd));
    }

    public function reportApproved($id)
    {
        $spd = SPD::find($id);
        $spdReportApproval = $spd->spdReport->spdReportApproval;

        $spdReportApproval->status = 1; // status approved
        $spdReportApproval->save();

        Notification::route('mail', 'hrd@rapidinfrastruktur.com')
        ->notify(new SpdReportNeedHrdApproval($spd));
    }

    public function reportRejected($id)
    {
        $spd = SPD::find($id);
        $spdReportApproval = $spd->spdReport->spdReportApproval;

        $spdReportApproval->status = 2; // status rejected
        $spdReportApproval->save();
    }

}
