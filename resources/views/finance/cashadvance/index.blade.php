@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <span class="fonts header-style">
        <b>CASH ADVANCE REQUEST APPROVAL</b>
    </span>
    <br>
      <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="{{url('history-spd')}}">SPD History</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-body">
          <div style="margin-bottom: 20px">
            <a href="list-expense" class="btn btn-warning">Expense Report</a>
          </div>
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%" style="white-space: nowrap !important;">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Request Number</th>
                            <th>Date Request</th>
                            <th>Employee Name</th>
                            <th>NIK</th>
                            <th>Position</th>
                            <th>Purpose</th>
                            <th>Balance Received</th>
                            <th>Item File</th>
                            <th>Status Of Request</th>
                            <th>Payment Slip</th>
                            <th>Action</th>                            
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $d)
                      @php
                        $balanceReceived = 'Rp. '.number_format($d->balance_received, 0, ',', '.');
                      @endphp
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$d->no_advance}}</td>
                            <td>{{$d->request_date}}</td>
                            <td>{{$d->employee->nama}}</td>
                            <td>{{$d->employee->nik}}</td>
                            <td>{{$d->employee->jabatan->jenis_jabatan}}</td>
                            <td>{{$d->allocation}}</td>
                            <td>{{$balanceReceived}}</td>
                            <td>
                              <a href="/uploads/CashAdvance/itemfile/{{$d->item_file}}" target="_blank" class="btn btn-default btn-xs" style="color: dodgerblue;">View file</a>
                              
                            </td>
                            <td>
                              @if ($d->status == 0 || $d->status == 2)
                                <span class="label label-warning">Request Process</span>
                              @elseif ($d->status == 1 || $d->status == 3)
                                <span class="label label-danger">Rejected</span>
                              @elseif ($d->status == 4)
                                <span class="label label-warning">Payment Process</span>
                              @elseif ($d->status == 5)
                                <span class="label label-success">Payment Clear</span>
                              @elseif ($d->status == 6)
                                <span class="label label-danger">Payment Cancel</span>
                              @endif
                            </td>
                            <td>
                              <a href="{{route('upload-payment',$d->id)}}" class="btn btn-default btn-xs" style="color: dodgerblue;">Upload file</span></a>
                              @if($d->upload_payment != NULL || $d->upload_payment != "")
                                  <a href="{{url('uploads/CashAdvance/'.$d->upload_payment)}}" target="_blank" class="btn btn-default btn-xs" style="color: dodgerblue;">View file</a>
                              @endif                                   
                            </td>
                            <td>
                              <a href="{{url('pdf-advance',$d->id)}}" class="btn btn-primary btn-xs"><span class='glyphicon glyphicon-print'></span></a> 
                              <a href="{{route('edit_payment_request',$d->id)}}" class="btn btn-warning btn-xs"><span class='glyphicon glyphicon-pencil'></span></a> 
                            </td>
                            
                            {{-- <td>
                                @if($d->idr == '')
                                    <span> </span>
                                @else 
                                    @rupiah($d->idr),00
                                    <!--{{$d->idr}}-->
                                @endif
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{--  end of car data  --}}
        </div>
        <!-- /.box-body -->
        <div class="box-footer"></div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>
$(function(){
   $('#data-table').DataTable();
});
</script>
@endpush
