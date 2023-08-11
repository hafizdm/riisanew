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
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#"><span class="glyphicon glyphicon-plus"></span> Create Expense</button>
               
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
                   
                        <tr>
                            <td>1</td>
                            <td>RII-FINANCE-ADV-001</td>
                            <td>7 Juli 2023</td>
                            <td>Perbaikan Laptop</td>
                            <td>Rp. 500.000</td>
                            <td>Rp. 500.000</td>
                            <td> 
                              <a href="#" target="_blank" class="btn btn-default btn-xs" style="color: dodgerblue;">View file</a>
                            </td>
                            <td>
                              <span class="label label-warning">Request Process</span>
                            </td>
                            <td>Manager/PM</td>
                            <td>
                              <a href="#" target="_blank" class="btn btn-default btn-xs" style="color: dodgerblue;">View file</a>
                            </td>  
                            <td>
                              <a href="#" class="btn btn-primary btn-xs"><span class='glyphicon glyphicon-print'></span></a>  
                              <a href="#" class="btn btn-warning btn-xs"><span class='glyphicon glyphicon-pencil'></span></a>  
                              <a href="#" class="btn btn-danger btn-xs"><span class='glyphicon glyphicon-trash'></span></a>  
                            </td>                       
                        </tr>
                        
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

