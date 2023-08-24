@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <span class="fonts header-style">
        <b>CASH ADVANCE REQUEST</b>
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
            <a href="pengajuan-advance/create" class="btn btn-primary">Add Advance</a>
            <a href="pengajuan-expense" class="btn btn-warning">Expense Report</a>
          </div>
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%" style="white-space: nowrap !important;">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Request Number</th>
                            <th>Date Request</th>
                            <th>Purpose</th>
                            <th>Balance Received</th>
                            <th>Item File</th>
                            <th>Status of Request</th>
                            <th>Next Process</th>
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
                                @endif
                            </td>
                            <td>
                                    @if ($d->status == 0)
                                    Manager/PM
                                    
                                    @elseif ($d->status == 1)
                                    Rejected by Manager/PM
                                    @elseif ($d->status == 2)
                                    Waiting Approval Director
                                    @elseif ($d->status == 3)
                                    Rejected by Director
                                    @elseif ($d->status == 4)
                                    Finance (Upload Invoice)
                                    @elseif ($d->status == 5)
                                    Payment Slip
                                    @endif
                                </td>
                                <td>
                                    @if($d->upload_payment != NULL || $d->upload_payment != "")
                                        <a href="{{url('uploads/CashAdvance/'.$d->upload_payment)}}" target="_blank" class="btn btn-default btn-xs" style="color: dodgerblue;"> View File</a>
                                        @else

                                        @endif
                                </td>  
                                <td>
                                    <a href="#" class="btn btn-primary btn-xs"><span class='glyphicon glyphicon-print'></span></a>  
                                    <a href="{{route('edit_advance',$d->id)}}" class="btn btn-warning btn-xs"><span class='glyphicon glyphicon-pencil'></span></a>  
                                    <a href="{{route('destroy_advance', $d->id)}}" class="btn btn-danger btn-xs"><span class='glyphicon glyphicon-trash'></span></a>  
                                </td>           
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
