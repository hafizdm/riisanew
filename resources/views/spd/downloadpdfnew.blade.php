@php
    if ($data->travel_type == 'Domestic') {
        $balanceReceived = 'Rp. '.number_format($data->balance_received, 0, ',', '.');   
        $eatDay = 'Rp. '.number_format($data->eat_per_day, 0, ',', '.');   
        $total_eat = 'Rp. '.number_format($data->total_eat, 0, ',', '.');   
        $allowance = 'Rp. '.number_format($data->allowance, 0, ',', '.');   
        $totalAllowance = 'Rp. '.number_format($data->total_allowance, 0, ',', '.');   
        $additionalCost = 'Rp. '.number_format($data->idr, 0, ',', '.');   
    } else {
        $balanceReceived = '$ '.$data->balance_received;
        $eatDay = '$ '.number_format($data->eat_per_day, 0, ',', '.');   
        $total_eat = '$ '.$data->total_eat;
        $allowance = '$ '.number_format($data->allowance, 0, ',', '.');   
        $totalAllowance = '$ '.number_format($data->total_allowance, 0, ',', '.');   
        $additionalCost = '$ '.number_format($data->idr, 0, ',', '.');   
        

    }  
@endphp

<!DOCTYPE html>
<head>
    <title>Surat Perjalanan Dinas</title>
    <meta charset="utf-8">
    
</head>

<body>
  
    <table border=1 cellspacing=0 cellpadding=0
    style='border-collapse:collapse;border:none'>
    <tr style='height:62.5pt'>
     <td width=282 style='width:211.25pt;border:solid windowtext 1.0pt;padding:
     0in 5.4pt 0in 5.4pt;height:62.5pt'>
     <p align=center style='margin-bottom:0in;text-align:center;
     line-height:normal'><b>PT. RAPID INFRASTRUKTUR INDONESIA</b></p>
     </td>
     <td width=319 style='width:239.55pt;border:solid windowtext 1.0pt;
     border-left:none;padding:0in 5.4pt 0in 5.4pt;height:62.5pt'>
     <p align=center style='margin-top:12.0pt;margin-right:0in;
     margin-bottom:0in;margin-left:0in;text-align:center;line-height:normal'><b><span
     style='font-size:12.0pt'>HUMAN CAPITAL MANAGEMENT DIVISION</span></b></p>
     <p align=center style='margin-bottom:0in;text-align:center;
     line-height:normal'><b><span style='font-size:12.0pt'>SURAT PERJALANAN DINAS</span></b></p>
     </td>
    </tr>
   </table>
   
   <p align=center style='margin-top:12.0pt;text-align:center;
   line-height:150%'><b>NO SPD : {{ $data->no_surat }}</b></p>
   
   <table border=0 cellspacing=0 cellpadding=0
    style='border-collapse:collapse;border:none'>
    <tr>
     <td width=94 style='width:70.4pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;text-align:justify;line-height:115%'><b>Name
     </b></p>
     </td>
     <td width=18 style='width:13.75pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;text-align:justify;line-height:115%'>: </p>
     </td>
     <td width=188 style='width:140.85pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;line-height:115%'>{{ $data->employee->nama}}</p>
     </td>
     <td width=126 style='width:94.25pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;line-height:115%'><b>Position</b></p>
     </td>
     <td width=18 style='width:13.5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;line-height:115%'>:</p>
     </td>
     <td width=157 style='width:118.05pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;line-height:115%'>{{ $data->employee->jabatan->jenis_jabatan }}</p>
     </td>
    </tr>
    <tr>
     <td width=94 style='width:70.4pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;text-align:justify;line-height:115%'><b>NIK</b></p>
     </td>
     <td width=18 style='width:13.75pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;text-align:justify;line-height:115%'>: </p>
     </td>
     <td width=188 style='width:140.85pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;line-height:115%'>{{ $data->nik }}</p>
     </td>
     <td width=126 style='width:94.25pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;line-height:115%'><b>Costs</b></p>
     </td>
     <td width=18 style='width:13.5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;line-height:115%'>:</p>
     </td>
     <td width=157 style='width:118.05pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;line-height:115%'>{{ $data->assignment_type }} </p>
     </td>
    </tr>
    <tr>
     <td width=94 style='width:70.4pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;text-align:justify;line-height:115%'><b>Department</b></p>
     </td>
     <td width=18 style='width:13.75pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;text-align:justify;line-height:115%'>: </p>
     </td>
     <td width=188 style='width:140.85pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;line-height:115%'>{{ $data->employee->divisi->nama }}</p>
     </td>
     <td width=126 style='width:94.25pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;line-height:115%'><b>Date departure</b></p>
     </td>
     <td width=18 style='width:13.5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;line-height:115%'>:</p>
     </td>
     <td width=157 style='width:118.05pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;line-height:115%'>{{ $data->tgl_keberangkatan }}</p>
     </td>
    </tr>
    <tr>
     <td width=94 style='width:70.4pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;text-align:justify;line-height:115%'><b>Travel Type</b></p>
     </td>
     <td width=18 style='width:13.75pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;text-align:justify;line-height:115%'>: </p>
     </td>
     <td width=188 style='width:140.85pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;line-height:115%'>{{ $data->travel_type }}</p>
     </td>
     <td width=126 style='width:94.25pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;line-height:115%'><b>Date Return </b></p>
     </td>
     <td width=18 style='width:13.5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;line-height:115%'>:</p>
     </td>
     <td width=157 style='width:118.05pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;line-height:115%'>{{ $data->tgl_pulang }}</p>
     </td>
    </tr>
    <tr>
     <td width=94 style='width:70.4pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;text-align:justify;line-height:115%'><b>From</b></p>
     </td>
     <td width=18 style='width:13.75pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;text-align:justify;line-height:115%'>: </p>
     </td>
     <td width=188 style='width:140.85pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;line-height:115%'>{{ $data->asal }}</p>
     </td>
     <td width=126 style='width:94.25pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;line-height:115%'><b>travel By</b></p>
     </td>
     <td width=18 style='width:13.5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;line-height:115%'>:</p>
     </td>
     <td width=157 style='width:118.05pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;line-height:115%'>{{ $data->travel_by }}</p>
     </td>
    </tr>
    <tr>
     <td width=94 style='width:70.4pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;text-align:justify;line-height:115%'><b>Destination</b></p>
     </td>
     <td width=18 style='width:13.75pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;text-align:justify;line-height:115%'>: </p>
     </td>
     <td width=188 style='width:140.85pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;line-height:115%'>{{$data->tujuan}}</p>
     </td>
     <td width=126 style='width:94.25pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;line-height:115%'><b>Reason</b></p>
     </td>
     <td width=18 style='width:13.5pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;line-height:115%'>:</p>
     </td>
     <td width=157 style='width:118.05pt;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
     0in;margin-left:0in;line-height:115%'>{{ $data->purpose }}</p>
     </td>
    </tr>
   </table>
   
   <p style='margin-bottom:0in;line-height:0%'><b><i>&nbsp;</i></b></p>
   
   <p style='margin-bottom:0in;line-height:150%'><b><i>Cost
   Breakdown :</i></b></p>
   
   <table border=1 cellspacing=0 cellpadding=0
    style='border-collapse:collapse;border:none'>
    <tr>
     <td width=192 style='width:143.75pt;border:solid windowtext 1.0pt;padding:
     0in 5.4pt 0in 5.4pt'>
     <p align=center style='margin-bottom:0in;text-align:center;
     line-height:150%'><b>Component</b></p>
     </td>
     <td width=117 style='width:88.05pt;border:solid windowtext 1.0pt;border-left:
     none;padding:0in 5.4pt 0in 5.4pt'>
     <p align=center style='margin-bottom:0in;text-align:center;
     line-height:150%'><b>Total Days</b></p>
     </td>
     <td width=137 style='width:102.95pt;border:solid windowtext 1.0pt;border-left:
     none;padding:0in 5.4pt 0in 5.4pt'>
     <p align=center style='margin-bottom:0in;text-align:center;
     line-height:150%'><b>Cost</b></p>
     </td>
     <td width=155 style='width:116.05pt;border:solid windowtext 1.0pt;border-left:
     none;padding:0in 5.4pt 0in 5.4pt'>
     <p align=center style='margin-bottom:0in;text-align:center;
     line-height:150%'><b>Total</b></p>
     </td>
    </tr>
    <tr>
     <td width=192 style='width:143.75pt;border:solid windowtext 1.0pt;
     border-top:none;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-bottom:0in;line-height:150%'>Meals</p>
     </td>
     <td width=117 style='width:88.05pt;border-top:none;border-left:none;
     border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
     padding:0in 5.4pt 0in 5.4pt'>
     <p align=center style='margin-bottom:0in;text-align:center;
     line-height:150%'><b>{{ now()->parse($data->tgl_keberangkatan)->diffInDays($data->tgl_pulang)+1 }}</b></p>
     </td>
     <td width=137 style='width:102.95pt;border-top:none;border-left:none;
     border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
     padding:0in 5.4pt 0in 5.4pt'>
     <p align=center style='margin-bottom:0in;text-align:center;
     line-height:150%'><b>{{ $eatDay }}</b></p>
     </td>
     <td width=155 style='width:116.05pt;border-top:none;border-left:none;
     border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
     padding:0in 5.4pt 0in 5.4pt'>
     <p align=center style='margin-bottom:0in;text-align:center;
     line-height:150%'><b>{{ $total_eat }}</b></p>
     </td>
    </tr>
    <tr>
     <td width=192 style='width:143.75pt;border:solid windowtext 1.0pt;
     border-top:none;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-bottom:0in;line-height:150%'>Allowance </p>
     </td>
     <td width=117 style='width:88.05pt;border-top:none;border-left:none;
     border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
     padding:0in 5.4pt 0in 5.4pt'>
     <p align=center style='margin-bottom:0in;text-align:center;
     line-height:150%'><b>{{ now()->parse($data->tgl_keberangkatan)->diffInDays($data->tgl_pulang)+1 }}</b></p>
     </td>
     <td width=137 style='width:102.95pt;border-top:none;border-left:none;
     border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
     padding:0in 5.4pt 0in 5.4pt'>
     <p align=center style='margin-bottom:0in;text-align:center;
     line-height:150%'><b>{{ $allowance }}</b></p>
     </td>
     <td width=155 style='width:116.05pt;border-top:none;border-left:none;
     border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
     padding:0in 5.4pt 0in 5.4pt'>
     <p align=center style='margin-bottom:0in;text-align:center;
     line-height:150%'><b>{{$totalAllowance }}</b></p>
     </td>
    </tr>
    <tr>
     <td width=192 style='width:143.75pt;border:solid windowtext 1.0pt;
     border-top:none;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-bottom:0in;line-height:150%'>Contigensies</p>
     <p style='margin-bottom:0in;line-height:150%'>(Taxi, Laundry,
     Bensin, Tol)</p>
     </td>
     <td width=117 style='width:88.05pt;border-top:none;border-left:none;
     border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
     padding:0in 5.4pt 0in 5.4pt'>
     <p align=center style='margin-bottom:0in;text-align:center;
     line-height:150%'><b>{{ now()->parse($data->tgl_keberangkatan)->diffInDays($data->tgl_pulang)+1 }}</b></p>
     </td>
     <td width=137 style='width:102.95pt;border-top:none;border-left:none;
     border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
     padding:0in 5.4pt 0in 5.4pt'>
     <p align=center style='margin-bottom:0in;text-align:center;
     line-height:150%'><b>&nbsp;</b></p>
     </td>
     <td width=155 style='width:116.05pt;border-top:none;border-left:none;
     border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
     padding:0in 5.4pt 0in 5.4pt'>
     <p align=center style='margin-bottom:0in;text-align:center;
     line-height:150%'><b>{{$additionalCost}}</b></p>
     </td>
    </tr>
    <tr>
     <td width=446 colspan=3 style='width:334.75pt;border:solid windowtext 1.0pt;
     border-top:none;padding:0in 5.4pt 0in 5.4pt'>
     <p style='margin-bottom:0in;line-height:150%'><b>Balance
     Received</b></p>
     </td>
     <td width=155 style='width:116.05pt;border-top:none;border-left:none;
     border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
     padding:0in 5.4pt 0in 5.4pt'>
     <p align=center style='margin-bottom:0in;text-align:center;
     line-height:150%'><b>{{ $balanceReceived }}</b></p>
     </td>
    </tr>
   </table>
   
   <p style='margin-top:12.0pt;margin-right:0in;margin-bottom:
   0in;margin-left:0in'>Jakarta, {{ date('d-M-Y', strtotime($data->form_date)) }}</p>
   
   <table border=1 cellspacing=0 cellpadding=0
    style='border-collapse:collapse;border:none'>
    <tr style='height:26.95pt'>
     <td width=200 style='width:150.25pt;border:solid windowtext 1.0pt;
     padding:0in 5.4pt 0in 5.4pt;height:26.95pt'>
     <p align=center style='margin-bottom:0in;text-align:center;
     line-height:normal'><b>Employee Request</b></p>
     </td>
     <td width=200 style='width:150.25pt;border:solid windowtext 1.0pt;
     border-left:none;padding:0in 5.4pt 0in 5.4pt;height:26.95pt'>
     <p align=center style='margin-bottom:0in;text-align:center;
     line-height:normal'><b>Human Capital</b></p>
     </td>
     <td width=200 style='width:150.3pt;border:solid windowtext 1.0pt;
     border-left:none;padding:0in 5.4pt 0in 5.4pt;height:26.95pt'>
     <p align=center style='margin-bottom:0in;text-align:center;
     line-height:normal'><b>Approval User</b></p>
     </td>
    </tr>
    <tr style='height:76.0pt'>
     <td width=200 style='width:150.25pt;border:solid windowtext 1.0pt;
     border-top:none;padding:0in 5.4pt 0in 5.4pt;height:76.0pt'>
     <p align=center style='margin-top:0.7in;text-align:center;
     line-height:normal'>{{ $data->employee->nama}}</p>
     </td>
     <td width=200 style='width:150.25pt;border-top:none;border-left:
     none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
     padding:0in 5.4pt 0in 5.4pt;height:76.0pt'>
     <p align=center style='margin-top:0.7in;text-align:center;
     line-height:normal'>Jacobus Krisnawan</p>
     </td>
     <td width=200 style='width:150.3pt;border-top:none;border-left:
     none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
     padding:0in 5.4pt 0in 5.4pt;height:76.0pt'>
     <p align=center style='margin-top:0.7in;text-align:center;
     line-height:normal'>{{ $data->spdApproval->karyawan->nama }}</p>
     </td>
    </tr>
   </table>
   
   <p style='margin-top:2.0pt;margin-right:0in;margin-bottom:0in;margin-left:0in;text-align:justify;line-height:115%'><b>Advance Payment : {{$data->advance_payment}}</b></p>
   <p style='margin-top:2.0pt;margin-bottom:0in'><b>Sign Received : </b></p>

   <p style='margin-bottom:0in;line-height:60%'><b><i>&nbsp;</i></b></p>

   <div>
    <p style="margin-top:18pt">
      <b>RAPID INFRASTRUKTUR</b>
      <br />
      Talavera Office Park, 12<sup>th</sup>
    Floor, Jl. T.B. Simatupang No. 23, RT 003/RW 001, Cilandak Bar., Kec. Cilandak, Kota Jakarta Selatan, Jakarta 12430
      <br />
      <a href="http://www.rapidinfrastruktur.com">www.rapidinfrastruktur.com</a><span> | +61 21-80667339</span></p>
   </div>
   
</body>

</html>
