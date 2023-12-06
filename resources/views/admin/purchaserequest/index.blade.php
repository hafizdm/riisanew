@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <span class="fonts header-style">
        <b>PURCHASE REQUEST ITEM</b>
    </span>
    <br>
      <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="#">Purchase Request Item</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-body">
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%" style="white-space: nowrap !important;">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Request Number</th>
                            <th>Date Prepared</th>
                            <th>Budget Category</th>
                            <th>Employee Name</th>
                            <th>Nik</th>
                            <th>Position</th>
                            <th>Date Required</th>
                            <th>Total Purchase</th>
                            <th>Item File</th>
                            <th>Status of Request</th>
                            <th>Upload File PO</th>
                            <th>Action</th>                      
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($purchaseRequest as $k => $d)
                        @php
                              $totalBalance = 'Rp. '.number_format($d->total_balance, 0, ',', '.');
                        @endphp
                    
                        <tr>
                          <td>{{$k + 1}}</td>
                          <td>{{$d->prf_number}}</td>
                          <td>{{date('d-M-Y', strtotime($d->prepared_date))}}</td>
                          <td>{{$d->purchaseRequestCategory->category_name}}</td>
                          <td>{{$d->employee->nama}}</td>
                          <td>{{$d->employee->nik}}</td>
                          <td>{{$d->employee->jabatan->jenis_jabatan}}</td>
                          <td>{{date('d-M-Y', strtotime($d->required_date))}}</td>
                          <td> {{$totalBalance}} </td>
                          <td>
                            <a href="/uploads/PurchaseRequest/attachmentFile/{{$d->attachment_file}}" target="_blank" class="btn btn-default btn-xs" style="color: dodgerblue;">View file</a>
                          </td>
                          <td>
                            @if ($d->status == 0 || $d->status == 2)
                            <span class="label label-warning">Request Process</span>
                            @elseif ($d->status == 1 || $d->status == 3)
                            <span class="label label-danger">Rejected</span>
                            @elseif ($d->status == 4)
                            <span class="label label-primary">PO Process</span>
                            @elseif ($d->status == 5)
                            <span class="label label-success">PO Clear</span>
                            @elseif ($d->status == 6)
                            <span class="label label-danger">Payment Cancel</span>
                            @endif
                          </td> 
                          <td>
                            @if($d->status == 4)
                                    <span></span>
                                @elseif($d->status == 5)
                                    <a href="{{route('upload_prf_list',$d->id)}}" class="btn btn-default btn-xs" style="color: dodgerblue;">Upload file</span></a>
                                    @if($d->upload_file != NULL || $d->upload_file != "")
                                      <a href="{{url('uploads/PurchaseRequest/'.$d->upload_file)}}" target="_blank" class="btn btn-default btn-xs" style="color: dodgerblue;">View file</a>
                                    @else 
    
                                    @endif
                                    
                                @else
                                    <span></span>
                                @endif 
                          </td>
                          <td>
                              <a href="{{url('pdf-prf', $d->id)}}" class="btn btn-primary btn-xs"><span class='glyphicon glyphicon-print'></span></a>  
                              <a href="{{route('edit-prf-list', $d)}}" class="btn btn-warning btn-xs"><span class='glyphicon glyphicon-pencil'></span></a>                          
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
      </div>
      <!-- /.box -->

    </section>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>
$(function() {
  var mainTable = $('#data-table').DataTable();
  var selectedRow;
  $('#data-table').on('click', '.delete', function(e) {
    e.preventDefault();
    selectedRow = mainTable.row($(this).parents('tr'));
    $("#modal-konfirmasi").modal('show');
    $("#modal-konfirmasi").find("#confirm-delete").data("id", $(this).data('id'));
    $("#konfirmasi-body").text("Are you sure to delete this data?");
  });

  $('#confirm-delete').click(function() {
    var deleteButton = $(this);
    var id = deleteButton.data("id");
    deleteButton.button('loading');

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url: 'pengajuan-advance/' + id,
      type: 'POST',
      dataType: 'JSON',
      success: function (response) {
        deleteButton.button('reset');
        selectedRow.remove().draw();
        $("#modal-konfirmasi").modal('hide');
        Swal.fire({
          title: response.success,
          type: 'success',
          confirmButtonText: 'Close',
          confirmButtonColor: '#AAA',
          onClose: function () {}
        })
      }
    });
  });
});
</script>
@endpush
