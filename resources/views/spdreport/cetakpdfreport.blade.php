@php
    if ($data->travel_type == 'Domestic') {
        $balanceReceived = 'Rp. '.number_format($data->balance_received, 0, ',', '.');   
        $eatDay = 'Rp. '.number_format($data->eat_per_day, 0, ',', '.');   
        $total_eat = 'Rp. '.number_format($data->total_eat, 0, ',', '.');   
        $allowance = 'Rp. '.number_format($data->allowance, 0, ',', '.');   
        $totalAllowance = 'Rp. '.number_format($data->total_allowance, 0, ',', '.');   
        $additionalCost = 'Rp. '.number_format($data->idr, 0, ',', '.');   
        $totaleatReport = 'Rp. '.number_format($data->spdReport->total_eat_report, 0, ',', '.');   
        $totalallowanceReport = 'Rp. '.number_format($data->spdReport->total_allowance_report, 0, ',', '.');   
        $cashOut = 'Rp. '.number_format($data->spdReport->cash_out, 0, ',', '.');   
        $expenseReport = 'Rp. '.number_format($data->spdReport->expense_received, 0, ',', '.');     
        $sisaExpense = 'Rp. '.number_format($sisaExpense, 0, ',', '.');     

    } else {
        $balanceReceived = '$ '.$data->balance_received;
        $eatDay = '$ '.number_format($data->eat_per_day, 0, ',', '.');   
        $total_eat = '$ '.$data->total_eat;
        $allowance = '$ '.number_format($data->allowance, 0, ',', '.');   
        $totalAllowance = '$ '.number_format($data->total_allowance, 0, ',', '.');   
        $additionalCost = '$ '.number_format($data->idr, 0, ',', '.');   
        $totaleatReport = '$ '.number_format($data->spdReport->total_eat_report, 0, ',', '.');   
        $totalallowanceReport = '$ '.number_format($data->spdReport->total_allowance_report, 0, ',', '.');   
        $cashOut = '$ '.number_format($data->spdReport->cash_out, 0, ',', '.');   
        $expenseReport = '$ '.number_format($data->spdReport->expense_received, 0, ',', '.'); 
        $sisaExpense = '$. '.number_format($sisaExpense, 0, ',', '.');     

        

    }  
@endphp



<!DOCTYPE html>
<html>

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=Generator content="Microsoft Word 15 (filtered)">
<style>

 /* Font Definitions */
 @font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;}
@font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:8.0pt;
	margin-left:0in;
	line-height:107%;
	font-size:11.0pt;
	font-family:"Calibri",sans-serif;}
.MsoChpDefault
	{font-family:"Calibri",sans-serif;}
.MsoPapDefault
	{margin-bottom:8.0pt;
	line-height:107%;}
@page WordSection1
	{size:595.3pt 841.9pt;
	margin:1.0in 1.0in 1.0in 1.0in;}
div.WordSection1
	{page:WordSection1;}

</style>

</head>

<body lang=EN-ID style='word-wrap:break-word'>

<div class=WordSection1>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr style='height:62.5pt'>
  <td width=282 style='width:211.25pt;border:solid windowtext 1.0pt;padding:
  0in 5.4pt 0in 5.4pt;height:62.5pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><b><span style='font-size:12.0pt'>PT. RAPID INFRASTRUKTUR
  INDONESIA</span></b></p>
  </td>
  <td width=319 style='width:239.55pt;border:solid windowtext 1.0pt;border-left:
  none;padding:0in 5.4pt 0in 5.4pt;height:62.5pt'>
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
  <td width=100 valign=top style='width:75.1pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>Nama</b></p>
  </td>
  <td width=16 valign=top style='width:11.8pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>:</b></p>
  </td>
  <td width=166 valign=top style='width:124.35pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>{{ $data->employee->nama}}</b></p>
  </td>
  <td width=119 valign=top style='width:89.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>Date Departure</b></p>
  </td>
  <td width=16 valign=top style='width:11.8pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>:</b></p>
  </td>
  <td width=185 valign=top style='width:138.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>{{ $data->spdReport->report_tgl_keberangkatan->format('Y-m-d') }}</b></p>
  </td>
 </tr>
 <tr>
  <td width=100 valign=top style='width:75.1pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>Nik</b></p>
  </td>
  <td width=16 valign=top style='width:11.8pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>:</b></p>
  </td>
  <td width=166 valign=top style='width:124.35pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>{{ $data->nik }}</b></p>
  </td>
  <td width=119 valign=top style='width:89.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>Date
  Return</b></p>
  </td>
  <td width=16 valign=top style='width:11.8pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>:</b></p>
  </td>
  <td width=185 valign=top style='width:138.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>{{ $data->spdReport->report_tgl_pulang->format('Y-m-d') }}</b></p>
  </td>
 </tr>
 <tr>
  <td width=100 valign=top style='width:75.1pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>Department</b></p>
  </td>
  <td width=16 valign=top style='width:11.8pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>:</b></p>
  </td>
  <td width=166 valign=top style='width:124.35pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>{{ $data->employee->divisi->nama }}</b></p>
  </td>
  <td width=119 valign=top style='width:89.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>From</b></p>
  </td>
  <td width=16 valign=top style='width:11.8pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>:</b></p>
  </td>
  <td width=185 valign=top style='width:138.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>{{ $data->asal }}</b></p>
  </td>
 </tr>
 <tr>
  <td width=100 valign=top style='width:75.1pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>Position</b></p>
  </td>
  <td width=16 valign=top style='width:11.8pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>:</b></p>
  </td>
  <td width=166 valign=top style='width:124.35pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>{{ $data->employee->jabatan->jenis_jabatan }} </b></p>
  </td>
  <td width=119 valign=top style='width:89.25pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>Destination</b></p>
  </td>
  <td width=16 valign=top style='width:11.8pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>:</b></p>
  </td>
  <td width=185 valign=top style='width:138.5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>{{ $data->tujuan }}</b></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><b>&nbsp;</b></p>

<p class=MsoNormal><b>Cash Advance :</b></p>

<div align=center>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr>
  <td width=192 valign=top style='width:143.75pt;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><b>Component</b></p>
  </td>
  <td width=109 valign=top style='width:81.65pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><b>Total Days</b></p>
  </td>
  <td width=150 valign=top style='width:112.7pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><b>Cost</b></p>
  </td>
  <td width=150 valign=top style='width:112.7pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><b>Total</b></p>
  </td>
 </tr>
 <tr>
  <td width=192 valign=top style='width:143.75pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>Meals</b></p>
  </td>
  <td width=109 style='width:81.65pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><b>{{ now()->parse($data->tgl_pulang)->diffInDays($data->tgl_pulang)+1 }}</b></p>
  </td>
  <td width=150 valign=top style='width:112.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>{{ $eatDay }}</b></p>
  </td>
  <td width=150 style='width:112.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>{{ $total_eat }}</b></p>
  </td>
 </tr>
 <tr>
  <td width=192 valign=top style='width:143.75pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>Allowance</b></p>
  </td>
  <td width=109 style='width:81.65pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><b>{{ now()->parse($data->tgl_pulang)->diffInDays($data->tgl_pulang)+1 }}</b></p>
  </td>
  <td width=150 valign=top style='width:112.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>{{ $allowance }}</b></p>
  </td>
  <td width=150 style='width:112.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>{{ $totalAllowance }}</b></p>
  </td>
 </tr>
 <tr>
  <td width=192 valign=top style='width:143.75pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>Contigensies</b></p>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>(Taxi,
  Laundry, Bensin Tol)</b></p>
  </td>
  <td width=109 style='width:81.65pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><b>{{ now()->parse($data->tgl_pulang)->diffInDays($data->tgl_pulang)+1 }}</b></p>
  </td>
  <td width=150 valign=top style='width:112.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>&nbsp;</b></p>
  </td>
  <td width=150 style='width:112.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>{{$additionalCost}}</b></p>
  </td>
 </tr>
 <tr>
  <td width=192 valign=top style='width:143.75pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>Total
  Advance</b></p>
  </td>
  <td width=109 valign=top style='width:81.65pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>&nbsp;</b></p>
  </td>
  <td width=150 valign=top style='width:112.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>&nbsp;</b></p>
  </td>
  <td width=150 valign=top style='width:112.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>{{$balanceReceived}}</b></p>
  </td>
 </tr>
</table>

</div>

<p class=MsoNormal><b>&nbsp;</b></p>

<p class=MsoNormal><b>Expense Report :</b></p>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr>
  <td width=192 valign=top style='width:143.75pt;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><b>Component</b></p>
  </td>
  <td width=109 valign=top style='width:81.65pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><b>Total Days</b></p>
  </td>
  <td width=150 valign=top style='width:112.7pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><b>Cost</b></p>
  </td>
  <td width=150 valign=top style='width:112.7pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><b>Total</b></p>
  </td>
 </tr>
 <tr>
  <td width=192 valign=top style='width:143.75pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>Meals</b></p>
  </td>
  <td width=109 style='width:81.65pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><b>{{ now()->parse($data->spdReport->report_tgl_pulang)->diffInDays($data->spdReport->report_tgl_pulang)+1 }}</b></p>
  </td>
  <td width=150 valign=top style='width:112.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>{{ $eatDay }}</b></p>
  </td>
  <td width=150 style='width:112.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>{{$totaleatReport}}</b></p>
  </td>
 </tr>
 <tr>
  <td width=192 valign=top style='width:143.75pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>Allowance</b></p>
  </td>
  <td width=109 style='width:81.65pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><b>{{ now()->parse($data->spdReport->report_tgl_pulang)->diffInDays($data->spdReport->report_tgl_pulang)+1 }}</b></p>
  </td>
  <td width=150 valign=top style='width:112.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>{{$allowance}}</b></p>
  </td>
  <td width=150 style='width:112.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>{{$totalallowanceReport}}</b></p>
  </td>
 </tr>
 <tr>
  <td width=192 valign=top style='width:143.75pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>Contigensies</b></p>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>(Taxi,
  Laundry, Bensin Tol)</b></p>
  </td>
  <td width=109 style='width:81.65pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><b>{{ now()->parse($data->spdReport->report_tgl_pulang)->diffInDays($data->spdReport->report_tgl_pulang)+1 }}</b></p>
  </td>
  <td width=150 valign=top style='width:112.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>&nbsp;</b></p>
  </td>
  <td width=150 style='width:112.7pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>{{$cashOut}}</b></p>
  </td>
 </tr>
 <tr>
  <td width=192 valign=top style='width:143.75pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>Total Expense</b></p>
  </td>
  <td width=259 colspan=2 valign=top style='width:194.35pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>&nbsp;</b></p>
  </td>
  <td width=150 valign=top style='width:112.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>{{$expenseReport}}</b></p>
  </td>
 </tr>
 <tr>
  <td width=192 valign=top style='width:143.75pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>Pelaporan
  Expense</b></p>
  </td>
  <td width=259 colspan=2 valign=top style='width:194.35pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>&nbsp;</b></p>
  </td>
  <td width=150 valign=top style='width:112.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><b>{{$sisaExpense}}</b></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><b>Status : <span style='color:{{ $status == 'Cash Clear' ? '#00B050' : 'red' }}'>{{ $status }}</span></b></p>

<p class=MsoNormal style='margin-bottom:0in'>Jakarta, {{ date('d-M-Y', strtotime($data->form_date)) }}</p>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr style='height:26.95pt'>
  <td width=200 style='width:150.25pt;border:solid windowtext 1.0pt;padding:
  0in 5.4pt 0in 5.4pt;height:26.95pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><b>Human Capital</b></p>
  </td>
  <td width=200 style='width:150.25pt;border:solid windowtext 1.0pt;border-left:
  none;padding:0in 5.4pt 0in 5.4pt;height:26.95pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><b>Approval User</b></p>
  </td>
 </tr>
 <tr style='height:76.0pt'>
  <td width=200 valign=bottom style='width:150.25pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:76.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><b>Jacobus Krisnawan</b></p>
  </td>
  <td width=200 valign=bottom style='width:150.25pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:76.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><b>{{ $data->spdApproval->karyawan->nama }}</b></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><b>&nbsp;</b></p>

<p class=MsoNormal><b>&nbsp;</b></p>

<p class=MsoNormal><b>&nbsp;</b></p>

<p class=MsoNormal> </p>

</div>

</body>

</html>








</html>