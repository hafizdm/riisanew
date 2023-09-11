<!DOCTYPE html>
<head>
  <title>Cash Advance</title>
  <meta charset="utf-8">
</head>
<body>
  <table border=1 cellspacing=0 cellpadding=0 style='border-collapse:collapse;border:none'>
    <tr style='height:62.5pt'>
      <td width=282 style='width:211.25pt;border:solid windowtext 1.0pt;padding:
        0in 5.4pt 0in 5.4pt;height:62.5pt'>
        <p style='margin-bottom:0in;text-align:center;
        '>
          <b>PT. RAPID INFRASTRUKTUR INDONESIA</b>
        </p>
      </td>
      <td width=319 style='width:239.55pt;border:solid windowtext 1.0pt;
        border-left:none;padding:0in 5.4pt 0in 5.4pt;height:62.5pt'>
        <p style='margin-top:12.0pt;margin-right:0in;
          margin-bottom:0in;margin-left:0in;text-align:center;'>
          <b>
            <span style='font-size:12=.0pt'>FINANCE DIVISION</span>
          </b>
        </p>
        <p style='margin-bottom:0in;text-align:center;
            '>
          <b>
            <span style='font-size:12.0pt'>EXPENSE REPORT</span>
          </b>
        </p>
      </td>
    </tr>
  </table>
  <p style='margin-top:12.0pt;text-align:center;
      line-height:150%'>
    <b>Advance Number : {{ $data->cashAdvanceRequest->no_advance }}</b>
  </p>
  <table border=0 cellspacing=0 cellpadding=0 style='border-collapse:collapse;border:none'>
    <tr>
      <td width=94 style='font-size:10.0pt'>
        <p style='margin-top:9.0pt;margin-right:0in;margin-bottom:
              0in;margin-left:0in;text-align:justify;line-height:115%'>
          <b>Name </b>
        </p>
      </td>
      <td width=18 style='width:13.75pt;padding:0in 5.4pt 0in 5.4pt'>
        <p style='margin-top:9.0pt;margin-right:0in;margin-bottom:
            0in;margin-left:0in;text-align:justify;line-height:115%'>: </p>
      </td>
      <td width=188 style='font-size:10.0pt'>
        <p style='margin-top:9.0pt;margin-right:0in;margin-bottom:
            0in;margin-left:0in;line-height:115%'>{{ $data->cashAdvanceRequest->employee->nama }}</p>
    </tr>
    <tr>
      <td width=94 style='font-size:10.0pt'>
        <p style='margin-top:9.0pt;margin-right:0in;margin-bottom:
              0in;margin-left:0in;text-align:justify;line-height:115%'>
          <b>Position</b>
        </p>
      </td>
      <td width=18 style='width:13.75pt;padding:0in 5.4pt 0in 5.4pt'>
        <p style='margin-top:9.0pt;margin-right:0in;margin-bottom:
              0in;margin-left:0in;text-align:justify;line-height:115%'>: </p>
      </td>
      <td width=188 style='font-size:10.0pt'>
        <p style='margin-top:9.0pt;margin-right:0in;margin-bottom:
              0in;margin-left:0in;line-height:115%'>{{ $data->cashAdvanceRequest->employee->jabatan->jenis_jabatan  }}</p>
      </td>
    </tr>
    <tr>
      <td width=94 style='font-size:10.0pt'>
        <p style='margin-top:9.0pt;margin-right:0in;margin-bottom:
              0in;margin-left:0in;text-align:justify;line-height:115%'>
          <b>Allocation</b>
        </p>
      </td>
      <td width=18 style='width:13.75pt;padding:0in 5.4pt 0in 5.4pt'>
        <p style='margin-top:9.0pt;margin-right:0in;margin-bottom:
              0in;margin-left:0in;text-align:justify;line-height:115%'>: </p>
      </td>
      <td width=188 style='font-size:10.0pt'>
        <p style='margin-top:9.0pt;margin-right:0in;margin-bottom:
              0in;margin-left:0in;line-height:115%'>{{ $data->cashAdvanceRequest->allocation }}</p>
      </td>
    </tr>
    <tr>
      <td width=94 style='font-size:10.0pt'>
        <p style='margin-top:9.0pt;margin-right:0in;margin-bottom:
              0in;margin-left:0in;text-align:justify;line-height:115%'>
          <b>Date Request</b>
        </p>
      </td>
      <td width=18 style='width:13.75pt;padding:0in 5.4pt 0in 5.4pt'>
        <p style='margin-top:9.0pt;margin-right:0in;margin-bottom:
              0in;margin-left:0in;text-align:justify;line-height:115%'>: </p>
      </td>
      <td width=188 style='font-size:10.0pt'>
        <p style='margin-top:9.0pt;margin-right:0in;margin-bottom:
              0in;margin-left:0in;line-height:115%'>{{ date('d-M-Y', strtotime($data->request_date)) }}</p>
      </td>
    </tr>
  </table>
  <p style='margin-bottom:0in;line-height:0%'>
    <b>
      <i>&nbsp;</i>
    </b>
  </p>
  <table border="1" cellpacing="0" cellpadding="0" style="border-collapse:collapse;border:none">
    <thead>
      <tr style='height:9.25pt'>
        <td width=30 rowspan=2 style='width:10.8pt;border:solid windowtext 1.0pt;
              padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
          <p style='margin-bottom:0in;text-align:center;
                line-height:100%'>
            <b>
              <span style='font-size:10.0pt;line-height:100%'>No</span>
            </b>
          </p>
        </td>
        <td width=83 rowspan=2 style='width:40.6pt;border:solid windowtext 1.0pt;
                border-left:none;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
          <p style='margin-bottom:0in;text-align:center;
                  line-height:100%'>
            <b>
              <span style='font-size:10.0pt;line-height:100%'>Date</span>
            </b>
          </p>
        </td>
        <td width=161 rowspan=2 style='width:90.55pt;border:solid windowtext 1.0pt;
                  border-left:none;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
          <p style='margin-bottom:0in;text-align:center;
                    line-height:100%'>
            <b>
              <span style='font-size:10.0pt;line-height:100%'>Detail Description</span>
            </b>
          </p>
        </td>
        <td width=290 colspan=3 style='width:100.85pt;border:solid windowtext 1.0pt;
                    border-left:none;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
          <p style='margin-bottom:0in;text-align:center;
                      line-height:100%'>
            <b>
              <span style='font-size:10.0pt;line-height:100%'>Ammount</span>
            </b>
          </p>
        </td>
        <td width=89 rowspan=2 style='width:40.05pt;border:solid windowtext 1.0pt;
                      border-left:none;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
          <p style='margin-bottom:0in;text-align:center;
                        line-height:100%'>
            <b>
              <span style='font-size:10.0pt;line-height:100%'>Cost Center</span>
            </b>
          </p>
        </td>
        <td width=95 rowspan=2 style='width:70.9pt;border:solid windowtext 1.0pt;
                        border-left:none;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
          <p style='margin-bottom:0in;text-align:center;
                          line-height:100%'>
            <b>
              <span style='font-size:10.0pt;line-height:100%'>Remarks</span>
            </b>
          </p>
        </td>
      </tr>
      <tr>
        <td width=119 style='width:70.35pt;border-top:none;border-left:
                          none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                          padding:0in 5.4pt 0in 5.4pt'>
          <p style='margin-bottom:0in;text-align:center;
                            line-height:100%'>
            <b>
              <span style='font-size:10.0pt;line-height:100%'>Estimate</span>
            </b>
          </p>
        </td>
        <td width=35 style='width:15.9pt;border-top:none;border-left:none;
                            border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                            padding:0in 5.4pt 0in 5.4pt'>
          <p style='margin-bottom:0in;text-align:center;
                              line-height:100%'>
            <b>
              <span style='font-size:10.0pt;line-height:100%'>Qty</span>
            </b>
          </p>
        </td>
        <td width=137 style='width:70.6pt;border-top:none;border-left:
                              none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                              padding:0in 5.4pt 0in 5.4pt'>
          <p style='margin-bottom:0in;text-align:center;
                                line-height:100%'>
            <b>
              <span style='font-size:10.0pt;line-height:100%'>Total</span>
            </b>
          </p>
        </td>
      </tr>
    </thead>
    <tbody>
      @foreach($data->expenseReportItems as $item)
      @php
        $estimatePrice = 'Rp. '.number_format($item->estimate_unit_price, 0, ',', '.');
        $balanceReceived = 'Rp. '.number_format($data->cashAdvanceRequest->balance_received, 0, ',', '.');      
        $cashOut = 'Rp. '.number_format($data->cash_out, 0, ',', '.');     
        $totalExpense = 'Rp. '.number_format($data->total_expense, 0, ',', '.');     
        $totalPrice = 'Rp. '.number_format($item->estimate_unit_price * $item->qty, 0, ',', '.');      
      @endphp
        <tr style='height:9.25pt'>
          <td width=30 style='width:10.8pt;border:solid windowtext 1.0pt;
                padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
            <p style='margin-bottom:0in;text-align:center;
                  line-height:100%'>
              
                <span style='font-size:10.0pt;line-height:100%'>{{ $loop->iteration }}</span>
              
            </p>
          </td>
          <td width=83 style='width:40.6pt;border:solid windowtext 1.0pt;
                  border-left:none;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
            <p style='margin-bottom:0in;text-align:center;
                    line-height:100%'>
              
                <span style='font-size:10.0pt;line-height:100%'>{{ date('d-M-Y', strtotime($data->request_date)) }}</span>
              
            </p>
          </td>
          <td width=161 style='width:90.55pt;border:solid windowtext 1.0pt;
                    border-left:none;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
            <p style='margin-bottom:0in;text-align:center;
                      line-height:100%'>
              
                <span style='font-size:10.0pt;line-height:100%'>{{ $item->description }}</span>
              
            </p>
          </td>
          <td width=119 style='width:70.35pt;border-top:none;border-left:
                            none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                            padding:0in 5.4pt 0in 5.4pt'>
            <p style='margin-bottom:0in;text-align:center;
                              line-height:100%'>
              
                <span style='font-size:10.0pt;line-height:100%'>{{$estimatePrice }}</span>
              
            </p>
          </td>
          <td width=35 style='width:15.9pt;border-top:none;border-left:none;
                              border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                              padding:0in 5.4pt 0in 5.4pt'>
            <p style='margin-bottom:0in;text-align:center;
                                line-height:100%'>
              
                <span style='font-size:10.0pt;line-height:100%'>{{ $item->qty }}</span>
              
            </p>
          </td>
          <td width=137 style='width:70.6pt;border-top:none;border-left:
                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                padding:0in 5.4pt 0in 5.4pt'>
            <p style='margin-bottom:0in;text-align:center;
                                  line-height:100%'>
              
                <span style='font-size:10.0pt;line-height:100%'>{{ $totalPrice  }}</span>
              
            </p>
          </td>
          @if ($loop->first)
            <td width=89 rowspan="{{ $loop->count }}" style='width:40.05pt;border:solid windowtext 1.0pt;border-left:none;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
            </td>
            <td width=95 rowspan="{{ $loop->count }}" style='width:70.9pt;border:solid windowtext 1.0pt;
                            border-left:none;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
              <p style='margin-bottom:0in;text-align:center;
                              line-height:100%'>
                
                  <span style='font-size:10.0pt;line-height:100%'>{{ $data->cashAdvanceRequest->remarks}}</span>
                
              </p>
            </td>
          @endif
        </tr>
        @endforeach
        <tr>
            <td width=30 style='width:10.8pt;border:solid windowtext 1.0pt;
            padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
            <p style='margin-bottom:0in;text-align:center;
                line-height:100%'>
            <b>
                <span style='font-size:10.0pt;line-height:100%'></span>
            </b>
            </p>
            </td>
            <td width=83 style='width:40.6pt;border:solid windowtext 1.0pt;
                    border-left:none;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
                <p style='margin-bottom:0in;text-align:center;
                        line-height:100%'>
                <b>
                    <span style='font-size:10.0pt;line-height:100%'></span>
                </b>
                </p>
            </td>
            <td  d width=161 style='width:90.55pt;border:solid windowtext 1.0pt;border-right:none;
                        border-left:none;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
                <p style='margin-bottom:0in;text-align:center;
                        line-height:100%'>
                <b>
                    <span style='font-size:10.0pt;line-height:100%'>Cash Out</span>
                </b>
                </p>
            </td>
            <td width=119 style='width:70.35pt;border-top:none;border-left:
                                none;border-bottom:solid windowtext 1.0pt;border-right:none windowtext 1.0pt;
                                padding:0in 5.4pt 0in 5.4pt'>
                <p style='margin-bottom:0in;text-align:center;
                                line-height:100%'>
                <b>
                    <span style='font-size:10.0pt;line-height:100%'></span>
                </b>
                </p>
            </td>
            <td width=35 style='width:15.9pt;border-top:none;border-left:none;
                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                padding:0in 5.4pt 0in 5.4pt'>
                <p style='margin-bottom:0in;text-align:center;
                                    line-height:100%'>
                <b>
                    <span style='font-size:10.0pt;line-height:100%'></span>
                </b>
                </p>
            </td>
            <td width=137 style='width:70.6pt;border-top:none;border-left:
                                    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                    padding:0in 5.4pt 0in 5.4pt'>
                <p style='margin-bottom:0in;text-align:center;
                                    line-height:100%'>
                <b>
                    <span style='font-size:10.0pt;line-height:100%'>{{ $cashOut }}</span>
                </b>
                </p>
            </td>
        
            <td width=89 rowspan="" style='width:40.05pt;border:solid windowtext 1.0pt;border-left:none;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
            </td>
            <td width=95 rowspan="" style='width:70.9pt;border:solid windowtext 1.0pt;
                            border-left:none;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
            <p style='margin-bottom:0in;text-align:center;
                            line-height:100%'>
                <b>
                <span style='font-size:10.0pt;line-height:100%'></span>
                </b>
            </p>
            </td>  
        </tr>  

        <tr>
            <td width=30 style='width:10.8pt;border:solid windowtext 1.0pt;
            padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
            <p style='margin-bottom:0in;text-align:center;
                line-height:100%'>
            <b>
                <span style='font-size:10.0pt;line-height:100%'></span>
            </b>
            </p>
            </td>
            <td width=83 style='width:40.6pt;border:solid windowtext 1.0pt;
                    border-left:none;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
                <p style='margin-bottom:0in;text-align:center;
                        line-height:100%'>
                <b>
                    <span style='font-size:10.0pt;line-height:100%'></span>
                </b>
                </p>
            </td>
            <td  d width=161 style='width:90.55pt;border:solid windowtext 1.0pt;border-right:none;
                        border-left:none;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
                <p style='margin-bottom:0in;text-align:center;
                        line-height:100%'>
                <b>
                    <span style='font-size:10.0pt;line-height:100%'>Advance Received</span>
                </b>
                </p>
            </td>
            <td width=119 style='width:70.35pt;border-top:none;border-left:
                                none;border-bottom:solid windowtext 1.0pt;border-right:none windowtext 1.0pt;
                                padding:0in 5.4pt 0in 5.4pt'>
                <p style='margin-bottom:0in;text-align:center;
                                line-height:100%'>
                <b>
                    <span style='font-size:10.0pt;line-height:100%'></span>
                </b>
                </p>
            </td>
            <td width=35 style='width:15.9pt;border-top:none;border-left:none;
                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                padding:0in 5.4pt 0in 5.4pt'>
                <p style='margin-bottom:0in;text-align:center;
                                    line-height:100%'>
                <b>
                    <span style='font-size:10.0pt;line-height:100%'></span>
                </b>
                </p>
            </td>
            <td width=137 style='width:70.6pt;border-top:none;border-left:
                                    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                    padding:0in 5.4pt 0in 5.4pt'>
                <p style='margin-bottom:0in;text-align:center;
                                    line-height:100%'>
                <b>
                    <span style='font-size:10.0pt;line-height:100%'>{{ $balanceReceived }}</span>
                </b>
                </p>
            </td>
        
            <td width=89 rowspan="" style='width:40.05pt;border:solid windowtext 1.0pt;border-left:none;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
            </td>
            <td width=95 rowspan="" style='width:70.9pt;border:solid windowtext 1.0pt;
                            border-left:none;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
            <p style='margin-bottom:0in;text-align:center;
                            line-height:100%'>
                <b>
                <span style='font-size:10.0pt;line-height:100%'></span>
                </b>
            </p>
            </td>  
        </tr>  

        <tr>
            <td width=30 style='width:10.8pt;border:solid windowtext 1.0pt;
            padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
            <p style='margin-bottom:0in;text-align:center;
                line-height:100%'>
            <b>
                <span style='font-size:10.0pt;line-height:100%'></span>
            </b>
            </p>
            </td>
            <td width=83 style='width:40.6pt;border:solid windowtext 1.0pt;
                    border-left:none;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
                <p style='margin-bottom:0in;text-align:center;
                        line-height:100%'>
                <b>
                    <span style='font-size:10.0pt;line-height:100%'></span>
                </b>
                </p>
            </td>
            <td  d width=161 style='width:90.55pt;border:solid windowtext 1.0pt;border-right:none;
                        border-left:none;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
                <p style='margin-bottom:0in;text-align:center;
                        line-height:100%'>
                <b>
                    <span style='font-size:10.0pt;line-height:100%'>Expense Total</span>
                </b>
                </p>
            </td>
            <td width=119 style='width:70.35pt;border-top:none;border-left:
                                none;border-bottom:solid windowtext 1.0pt;border-right:none windowtext 1.0pt;
                                padding:0in 5.4pt 0in 5.4pt'>
                <p style='margin-bottom:0in;text-align:center;
                                line-height:100%'>
                <b>
                    <span style='font-size:10.0pt;line-height:100%'></span>
                </b>
                </p>
            </td>
            <td width=35 style='width:15.9pt;border-top:none;border-left:none;
                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                padding:0in 5.4pt 0in 5.4pt'>
                <p style='margin-bottom:0in;text-align:center;
                                    line-height:100%'>
                <b>
                    <span style='font-size:10.0pt;line-height:100%'></span>
                </b>
                </p>
            </td>
            <td width=137 style='width:70.6pt;border-top:none;border-left:
                                    none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                    padding:0in 5.4pt 0in 5.4pt'>
                <p style='margin-bottom:0in;text-align:center;
                                    line-height:100%'>
                <b>
                    <span style='font-size:10.0pt;line-height:100%'>{{ $totalExpense }}</span>
                </b>
                </p>
            </td>
        
            <td width=89 rowspan="" style='width:40.05pt;border:solid windowtext 1.0pt;border-left:none;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
            </td>
            <td width=95 rowspan="" style='width:70.9pt;border:solid windowtext 1.0pt;
                            border-left:none;padding:0in 5.4pt 0in 5.4pt;height:10.25pt'>
            <p style='margin-bottom:0in;text-align:center;
                            line-height:100%'>
                <b>
                <span style='font-size:10.0pt;line-height:100%'></span>
                </b>
            </p>
            </td>  
        </tr>  
    </tbody>   
  </table>
  <p style='margin-bottom:1in;line-height:0%;'>

  <table border="1" cellpacing="0" cellpadding="0" style="border-collapse:collapse;border:none" width="703px  ">
    <tr>
      <td>
        &nbsp; <b>Reason </b> :
         {{ $data->cashAdvanceRequest->reason }}
      </td>
    </tr>
  </table>

  <div>
    <p>Status Expense : <span style="color:{{ $status == 'Cash Clear' ? '#00B050' : 'red' }}">{{ $status }}</span></p>
  </div>

  {{-- <p style='margin-bottom:10in;line-height:0%;page-break-after:none'>
    <b>
      <i>&nbsp;</i>
    </b>
  </p> --}}
  
  <p style='margin-bottom:0in;line-height:0%;'>&nbsp;</p>
  <table border=1 cellspacing=0 cellpadding=0 style='margin-left:0;border-collapse:collapse;border:none'>
    <tr>
      <td width=160 style='width:100.15pt;border:solid windowtext 1.0pt;
                                padding:0in 5.4pt 0in 5.4pt'>
        <p style='margin-bottom:0in;text-align:center;
                                  '>
          <b>
            <span style='font-size:8.0pt'>Request By :</span>
          </b>
        </p>
      </td>
      <td width=147 style='width:100.15pt;border:solid windowtext 1.0pt;
                                  border-left:none;padding:0in 5.4pt 0in 5.4pt'>
        <p style='margin-bottom:0in;text-align:center;
                                    '>
          <b>
            <span style='font-size:8.0pt'>Review By :</span>
          </b>
        </p>
      </td>
      <td width=147 style='width:90.15pt;border:solid windowtext 1.0pt;
                                    border-left:none;padding:0in 5.4pt 0in 5.4pt'>
        <p style='margin-bottom:0in;text-align:center;
                                      '>
          <b>
            <span style='font-size:8.0pt'>Approval By :</span>
          </b>
        </p>
      </td>
      <td width=147 style='width:90.15pt;border:solid windowtext 1.0pt;
                                      border-left:none;padding:0in 5.4pt 0in 5.4pt'>
        <p style='margin-bottom:0in;text-align:center;
                                        '>
          <b>
            <span style='font-size:8.0pt'>Prepared By :</span>
          </b>
        </p>
      </td>
      <td width=148 style='width:95.15pt;border:solid windowtext 1.0pt;
                                        border-left:none;padding:0in 5.4pt 0in 5.4pt'>
        <p style='margin-bottom:0in;text-align:center;'>
          <b>
            <span style='font-size:8.0pt'>Acknowladge By :</span>
          </b>
        </p>
      </td>
    </tr>
    <tr style='height:84.1pt'>
      <td width=160 style='width:100.15pt;border:solid windowtext 1.0pt;
                                          border-top:none;padding:0in 5.4pt 0in 5.4pt;height:84.1pt'>
        <p style='margin-bottom:0in;text-align:justify;line-height:
                                            normal'>
          <span style='font-size:8.0pt;font-family:"Avenir Next LT Pro",sans-serif'>&nbsp;</span>
        </p>
      </td>
      <td width=147 style='width:100.15pt;border-top:none;border-left:
                                            none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                            padding:0in 5.4pt 0in 5.4pt;height:84.1pt'>
        <p style='margin-bottom:0in;text-align:justify;line-height:
                                              normal'>
          <span style='font-size:8.0pt;font-family:"Avenir Next LT Pro",sans-serif'>&nbsp;</span>
        </p>
      </td>
      <td width=147 style='width:90.15pt;border-top:none;border-left:
                                              none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                              padding:0in 5.4pt 0in 5.4pt;height:84.1pt'>
        <p style='margin-bottom:0in;text-align:justify;line-height:
                                                normal'>
          <span style='font-size:8.0pt;font-family:"Avenir Next LT Pro",sans-serif'>&nbsp;</span>
        </p>
      </td>
      <td width=147 style='width:90.15pt;border-top:none;border-left:
                                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                                padding:0in 5.4pt 0in 5.4pt;height:84.1pt'>
        <p style='margin-bottom:0in;text-align:justify;line-height:
                                                  normal'>
          <span style='font-size:8.0pt;font-family:"Avenir Next LT Pro",sans-serif'>&nbsp;</span>
        </p>
      </td>
      <td width=148 style='width:95.15pt;border-top:none;border-left:
                                                  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                                  padding:0in 5.4pt 0in 5.4pt;height:84.1pt'>
        <p style='margin-bottom:0in;text-align:justify;line-height:
                                                    normal'>
          <span style='font-size:8.0pt;font-family:"Avenir Next LT Pro",sans-serif'>&nbsp;</span>
        </p>
      </td>
    </tr>
    <tr>
      <td width=160 style='width:100.15pt;border:solid windowtext 1.0pt;
                                                    border-top:none;padding:0in 5.4pt 0in 5.4pt'>
        <p style='margin-bottom:0in;text-align:center;
                                                      '>
          <span style='font-size:8.0pt;font-family:"Avenir Next LT Pro",sans-serif'>{{ $data->cashAdvanceRequest->employee->nama }}</span>
        </p>
      </td>
      <td width=147 style='width:100.15pt;border-top:none;border-left:
                                                      none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                                      padding:0in 5.4pt 0in 5.4pt'>
        <p style='margin-bottom:0in;text-align:center;
                                                        '>
          <span style='font-size:8.0pt;font-family:"Avenir Next LT Pro",sans-serif'>{{ $data->cashAdvanceRequest->employee->reportTo->nama }}</span>
        </p>
      </td>
      <td width=147 style='width:90.15pt;border-top:none;border-left:
                                                        none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                                        padding:0in 5.4pt 0in 5.4pt'>
        <p style='margin-bottom:0in;text-align:center;
                                                          '>
          <span style='font-size:8.0pt;font-family:"Avenir Next LT Pro",sans-serif'>Adi Sutopo Suharyo</span>
        </p>
      </td>
      <td width=147 style='width:90.15pt;border-top:none;border-left:
                                                          none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                                          padding:0in 5.4pt 0in 5.4pt'>
        <p style='margin-bottom:0in;text-align:center;
                                                            '>
          <span style='font-size:8.0pt;font-family:"Avenir Next LT Pro",sans-serif'>Grace Eunieke</span>
        </p>
      </td>
      <td width=148 style='width:95.15pt;border-top:none;border-left:
                                                            none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                                            padding:0in 5.4pt 0in 5.4pt'>
        <p style='margin-bottom:0in;text-align:center;
                                                              '>
          <span style='font-size:8.0pt;font-family:"Avenir Next LT Pro",sans-serif'>Lalu Bintang Indera</span>
        </p>
      </td>
    </tr>
  </table>
</body>
</html>