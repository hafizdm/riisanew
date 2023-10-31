@php
    if ($data->travel_type == 'Domestic') {
        $balanceReceived = 'Rp. '.number_format($data->balance_received, 0, ',', '.'); 
        $eatDay = 'Rp. '.number_format($data->eat_per_day, 0, ',', '.');  
        $total_eat = 'Rp. '.number_format($data->total_eat, 0, ',', '.'); 
        $allowance = 'Rp. '.number_format($data->allowance, 0, ',', '.');   
        $totalAllowance = 'Rp. '.number_format($data->total_allowance, 0, ',', '.');   
        $additionalCost = 'Rp. '.number_format($data->idr, 0, ',', '.');     
        $cashOut = 'Rp. '.number_format($data->spdReport->cash_out, 0, ',', '.');     
        $expensesReport = 'Rp. '.number_format($expensesReport, 0, ',', '.');     
    } else {
        $balanceReceived = '$ '.$data->balance_received;
        $eatDay = '$ '.number_format($data->eat_per_day, 0, ',', '.');
        $total_eat = '$ '.$data->total_eat;
        $allowance = '$ '.number_format($data->allowance, 0, ',', '.');   
        $totalAllowance = '$ '.number_format($data->total_allowance, 0, ',', '.');   
        $additionalCost = '$ '.number_format($data->idr, 0, ',', '.');     
        $cashOut = '$ '.number_format($data->spdReport->cash_out, 0, ',', '.');  
        $expensesReport = '$ '.number_format($expensesReport, 0, ',', '.');  

    }  
@endphp

<!DOCTYPE html>

<head>
    <title>Report SPD</title>
    <meta charset="utf-8">
    
</head>

<body>
    <table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
        style='border-collapse:collapse;border:none'>
        <tr style='height:62.5pt'>
        <td width=282 style='width:211.25pt;border:solid windowtext 1.0pt;padding:
        0in 5.4pt 0in 5.4pt;height:62.5pt'>
        <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
        line-height:normal'><b>PT. RAPID INFRASTRUKTUR INDONESIA</b></p>
        </td>
        <td width=319 valign=top style='width:239.55pt;border:solid windowtext 1.0pt;
        border-left:none;padding:0in 5.4pt 0in 5.4pt;height:62.5pt'>
        <p class=MsoNormal align=center style='margin-top:12.0pt;margin-right:0in;
        margin-bottom:0in;margin-left:0in;text-align:center;line-height:normal'><b><span
        style='font-size:12.0pt'>HUMAN CAPITAL MANAGEMENT DIVISION</span></b></p>
        <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
        line-height:normal'><b><span style='font-size:12.0pt'>LAPORAN PERTANGGUNG
        JAWABAN</span></b></p>
        </td>
        </tr>
      </table>

        <p class=MsoNormal align=center style='margin-top:12.0pt;text-align:center;
        line-height:150%'><b>NO SPD : {{ $data->no_surat }}</b></p>

        <table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
        style='border-collapse:collapse;border:none'>
        <tr>
        <td width=114 style='width:85.25pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'>Nama</p>
        </td>
        <td width=18 valign=top style='width:13.5pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'><b>:</b></p>
        </td>
        <td width=189 valign=top style='width:141.4pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'>{{ $data->employee->nama}}</p>
        </td>
        <td width=105 style='width:78.9pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'>Travel Type</p>
        </td>
        <td width=18 valign=top style='width:13.85pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'><b>:</b></p>
        </td>
        <td width=157 valign=top style='width:117.9pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'>{{ $data->travel_type }}</p>
        </td>
        </tr>
        <tr>
        <td width=114 style='width:85.25pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'>Nik</p>
        </td>
        <td width=18 valign=top style='width:13.5pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'><b>:</b></p>
        </td>
        <td width=189 valign=top style='width:141.4pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'>{{ $data->nik }}</p>
        </td>
        <td width=105 style='width:78.9pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'>From</p>
        </td>
        <td width=18 valign=top style='width:13.85pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'><b>:</b></p>
        </td>
        <td width=157 valign=top style='width:117.9pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'>{{ $data->asal }}</p>
        </td>
        </tr>
        <tr>
        <td width=114 style='width:85.25pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'>Department</p>
        </td>
        <td width=18 valign=top style='width:13.5pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'><b>:</b></p>
        </td>
        <td width=189 valign=top style='width:141.4pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'>{{ $data->employee->divisi->nama }}</p>
        </td>
        <td width=105 style='width:78.9pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'>Destination</p>
        </td>
        <td width=18 valign=top style='width:13.85pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'><b>:</b></p>
        </td>
        <td width=157 valign=top style='width:117.9pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'>{{$data->tujuan}}</p>
        </td>
        </tr>
        <tr>
        <td width=114 style='width:85.25pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'>Position</p>
        </td>
        <td width=18 valign=top style='width:13.5pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'><b>:</b></p>
        </td>
        <td width=189 valign=top style='width:141.4pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'>{{ $data->employee->jabatan->jenis_jabatan }}</p>
        </td>
        <td width=105 style='width:78.9pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'>Purpose</p>
        </td>
        <td width=18 valign=top style='width:13.85pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'><b>:</b></p>
        </td>
        <td width=157 valign=top style='width:117.9pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'><b>{{ $data->purpose }}</b></p>
        </td>
        </tr>
        <tr>
        <td width=114 style='width:85.25pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'>Date Departure</p>
        </td>
        <td width=18 valign=top style='width:13.5pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'><b>:</b></p>
        </td>
        <td width=189 valign=top style='width:141.4pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'>{{ $data->tgl_keberangkatan }}</p>
        </td>
        <td width=105 style='width:78.9pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'>Date Return</p>
        </td>
        <td width=18 valign=top style='width:13.85pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'><b>:</b></p>
        </td>
        <td width=157 valign=top style='width:117.9pt;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-top:12.0pt;margin-right:0in;margin-bottom:
        0in;margin-left:0in;line-height:normal'>{{ $data->tgl_pulang }}</p>
        </td>
        </tr>
        </table>

        {{-- <p class=MsoNormal style='margin-bottom:0in'><b><i></i></b></p> --}}

        <p class=MsoNormal style='margin-bottom:0in; margin-top:0.2in'><b><i>Expense Report</i>:</b></p>

        <table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
        style='border-collapse:collapse;border:none'>
        <tr style='height:27.85pt'>
        <td width=180 style='width:134.75pt;border:solid windowtext 1.0pt;padding:
        0in 5.4pt 0in 5.4pt;height:27.85pt'>
        <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
        line-height:150%'><b>Description</b></p>
        </td>
        <td width=121 style='width:90.65pt;border:solid windowtext 1.0pt;border-left:
        none;padding:0in 5.4pt 0in 5.4pt;height:27.85pt'>
        <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
        line-height:150%'><b>Total Days</b></p>
        </td>
        <td width=150 style='width:112.7pt;border:solid windowtext 1.0pt;border-left:
        none;padding:0in 5.4pt 0in 5.4pt;height:27.85pt'>
        <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
        line-height:150%'><b>Cost</b></p>
        </td>
        <td width=150 style='width:112.7pt;border:solid windowtext 1.0pt;border-left:
        none;padding:0in 5.4pt 0in 5.4pt;height:27.85pt'>
        <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
        line-height:150%'><b>Total</b></p>
        </td>
        </tr>
        <tr>
        <td width=180 style='width:134.75pt;border:solid windowtext 1.0pt;border-top:
        none;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-bottom:0in;line-height:150%'>Meals</p>
        </td>
        <td width=121 style='width:90.65pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
        line-height:150%'>{{ now()->parse($data->tgl_keberangkatan)->diffInDays($data->tgl_pulang)+1 }}</p>
        </td>
        <td width=150 style='width:112.7pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-bottom:0in;line-height:150%'><b>{{ $eatDay }}</b></p>
        </td>
        <td width=150 style='width:112.7pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-bottom:0in;line-height:150%'><b>{{ $total_eat }}</b></p>
        </td>
        </tr>
        <tr>
        <td width=180 style='width:134.75pt;border:solid windowtext 1.0pt;border-top:
        none;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-bottom:0in;line-height:150%'>Allowance</p>
        </td>
        <td width=121 style='width:90.65pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
        line-height:150%'>{{ now()->parse($data->tgl_keberangkatan)->diffInDays($data->tgl_pulang)+1 }}</p>
        </td>
        <td width=150 style='width:112.7pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-bottom:0in;line-height:150%'><b>{{ $allowance }}</b></p>
        </td>
        <td width=150 style='width:112.7pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-bottom:0in;line-height:150%'><b>{{$totalAllowance }}</b></p>
        </td>
        </tr>
        <tr>
        <td width=180 style='width:134.75pt;border:solid windowtext 1.0pt;border-top:
        none;padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-bottom:0in;line-height:150%'>Additional Cost
        </p>
        <p class=MsoNormal style='margin-bottom:0in;line-height:150%'>(Taxi, Laundry,
        Bensin, Tol)</p>
        </td>
        <td width=121 style='width:90.65pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
        line-height:150%'>{{ now()->parse($data->tgl_keberangkatan)->diffInDays($data->tgl_pulang)+1 }}</p>
        </td>
        <td width=150 style='width:112.7pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-bottom:0in;line-height:150%'>&nbsp;</p>
        </td>
        <td width=150 style='width:112.7pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        padding:0in 5.4pt 0in 5.4pt'>
        <p class=MsoNormal style='margin-bottom:0in;line-height:150%'><b>{{$additionalCost}}</b></p>
        </td>
        </tr>
        <tr style='height:21.1pt'>
        <td width=451 colspan=3 style='width:338.1pt;border:solid windowtext 1.0pt;
        border-top:none;padding:0in 5.4pt 0in 5.4pt;height:21.1pt'>
        <p class=MsoNormal style='margin-bottom:0in;line-height:150%'><b>Total
        Balance Received</b></p>
        </td>
        <td width=150 style='width:112.7pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        padding:0in 5.4pt 0in 5.4pt;height:21.1pt'>
        <p class=MsoNormal style='margin-bottom:0in;line-height:150%'><b>{{ $balanceReceived }}</b></p>
        </td>
        </tr>
        <tr style='height:22.0pt'>
        <td width=451 colspan=3 style='width:338.1pt;border:solid windowtext 1.0pt;
        border-top:none;padding:0in 5.4pt 0in 5.4pt;height:22.0pt'>
        <p class=MsoNormal style='margin-bottom:0in;line-height:150%'><b>Cash Out</b></p>
        </td>
        <td width=150 style='width:112.7pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        padding:0in 5.4pt 0in 5.4pt;height:22.0pt'>
        <p class=MsoNormal style='margin-bottom:0in;line-height:150%'><b>{{ $cashOut }}</b></p>
        </td>
        </tr>
        <tr style='height:22.0pt'>
        <td width=451 colspan=3 style='width:338.1pt;border:solid windowtext 1.0pt;
        border-top:none;padding:0in 5.4pt 0in 5.4pt;height:22.0pt'>
        <p class=MsoNormal style='margin-bottom:0in;line-height:150%'><b>Expense
        Report</b></p>
        </td>
        <td width=150 style='width:112.7pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        padding:0in 5.4pt 0in 5.4pt;height:22.0pt'>
        <p class=MsoNormal style='margin-bottom:0in;line-height:150%'><b>{{ $expensesReport }}</b></p>
        </td>
        </tr>
        </table>

        <p class=MsoNormal><b>
            <i>
              Status:
              <span style='color:{{ $status == 'Cash Clear' ? '#00B050' : 'red' }}'>{{ $status }}</span>
            </i>
          </b></p>

        <p class=MsoNormal></p>

        <p class=MsoNormal>Jakarta, {{ date('d-M-Y', strtotime($data->form_date)) }}</p>

        <table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
        style='border-collapse:collapse;border:none'>
        <tr style='height:23.35pt'>
        <td width=216 style='width:161.75pt;border:solid windowtext 1.0pt;padding:
        0in 5.4pt 0in 5.4pt;height:23.35pt'>
        <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
        line-height:normal'><b>Human Capital</b></p>
        </td>
        <td width=222 style='width:166.5pt;border:solid windowtext 1.0pt;border-left:
        none;padding:0in 5.4pt 0in 5.4pt;height:23.35pt'>
        <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
        line-height:normal'><b>Approval User</b></p>
        </td>
        </tr>
        <tr style='height:71.5pt'>
        <td width=216 valign=bottom style='width:161.75pt;border:solid windowtext 1.0pt;
        border-top:none;padding:0in 5.4pt 0in 5.4pt;height:71.5pt'>
        <p class=MsoNormal align=center style='margin-top:0.7in;text-align:center;
        line-height:normal'>Jacobus Krisnawan</p>
        </td>
        <td width=222 valign=bottom style='width:166.5pt;border-top:none;border-left:
        none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        padding:0in 5.4pt 0in 5.4pt;height:71.5pt'>
        <p class=MsoNormal align=center style='margin-top:0.7in;text-align:center;
        line-height:normal'>{{ $data->spdApproval->karyawan->nama }}</p>
        </td>
        </tr>
    </table>

    <div>
        <p>
          <b>RAPID INFRASTRUKTUR</b>
          <br />
          Talavera Office Park, 12<sup>th</sup>
        Floor, Jl. T.B. Simatupang No. 23, RT 003/RW 001, Cilandak Bar., Kec. Cilandak, Kota Jakarta Selatan, Jakarta 12430
          <br />
          <a href="https://www.rapidinfrastruktur.com">www.rapidinfrastruktur.com</a><span> | +61 21-80667339</span></p>
    </div>

</body>

</html>