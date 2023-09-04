@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      {{-- <span class="fonts header-style">
        <b>SPD Submission Form (Official Travel Letter)</b>
    </span> --}}
    <br>
      <ol class="breadcrumb">
        <li><a href="{{url('pengajuan-advance')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="#">Cash Advance</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-body">
          


          {{--  sub menu  --}}
          <div style="margin-bottom: 20px">
            <a href="pengajuan-expense/create" class="btn btn-primary">Add Expense</a>
               
          </div>
          {{--  end of sub menu  --}}

            {{--  table data of car  --}}
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%" style="white-space: nowrap !important;">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Advance Number</th>
                            <th>Date Request</th>
                            <th>Purpose</th>
                            <th>Balance Received</th>
                            <th>Cash Out</th>
                            <th>File Invoice</th>
                            <th>Status of Request</th>
                            <th>Next Process</th>
                            <th>File Upload</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    </thead>
                    <tbody>
                      @foreach($expenseReports as $d)
                      @php
                        $balanceReceived = 'Rp. '.number_format($d->cashAdvanceRequest->balance_received, 0, ',', '.');
                        $cashOut = 'Rp. '.number_format($d->cash_out, 0, ',', '.');
                      @endphp
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$d->cashAdvanceRequest->no_advance}}</td>
                            <td>{{$d->request_date}}</td>
                            <td>{{$d->cashAdvanceRequest->allocation}}</td>
                            <td>{{$balanceReceived}}</td>
                            <td>{{$cashOut}}</td>
                            <td> 
                              <a href="/uploads/ExpenseReport/fileInvoice/{{$d->file_invoice}}" target="_blank" class="btn btn-default btn-xs" style="color: dodgerblue;">View file</a>
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
                              Transaction Clear
                              @endif
                            </td>
                            <td>
                              <a href="#" target="_blank" class="btn btn-default btn-xs" style="color: dodgerblue;">View file</a>
                            </td>  
                            <td>
                              <a href="#" class="btn btn-primary btn-xs"><span class='glyphicon glyphicon-print'></span></a>  
                              <a href="{{route('edit_expense',$d->id)}}" class="btn btn-warning btn-xs"><span class='glyphicon glyphicon-pencil'></span></a>  
                              <a href="#" class="btn btn-danger btn-xs"><span class='glyphicon glyphicon-trash'></span></a>  
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
    <!-- /.content -->
    <!-- modal konfirmasi -->

    <div class="modal fade" id="modal-konfirmasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
        </div>
        <div class="modal-body" id="konfirmasi-body"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" data-id="" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Deleting..." id="confirm-delete">Delete</button>
        </div>
        </div>
      </div>
    </div>
    <!-- end of modal konfirmais -->


    @endsection

