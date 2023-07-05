@extends('templates.header')

@section('content')

<section class="content">

    <div class="box">
        <div class="box-body">
          <div class="row">
            <div class="col-md-10 col-xs-12 col-xl-10">
              @if(session()->get('success'))
                <div class="alert alert-success alert-dismissible fade in"> {{ session()->get('success') }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
              @elseif(session()->get('failed'))
                <div class="alert alert-danger alert-dismissible fade in">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <h4><i class="icon fa fa-ban"></i> Alert !</h4>
                  {{ session()->get('failed') }}
                </div>
              @endif
            </div>
          </div>

          <div style="margin-bottom: 20px">
            
          </div>

        <div class="table-responsive">
            <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%" style="white-space: nowrap !important;">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>SPD Number</th>
                        <th>Report Date</th>
                        <th>Employee Name</th>
                        <th>Employee Number</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th width="80%">Travel Type</th>
                        <th>Date Departure</th>
                        <th>Date Return</th>
                        <th>Travel By</th>
                        <th>From</th>
                        <th>Destination</th>
                        <th>Total Expense</th>
                        <th>Contigensies</th>
                        <th>File Report</th>
                        <th>Approval User</th>                  
                        <th>Approval HC</th>  
                        <th>Upload File</th>                
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                </thead>
                <tbody>
                @foreach($spd_report as $k => $d)
                @php
                if ($d->travel_type == 'Domestic') {
                    $expenseReceived = 'Rp. '.number_format($d->spdReport->expense_received, 0, ',', '.');
                    $cashOut = 'Rp. '.number_format($d->spdReport->cash_out, 0, ',', '.');
                } else {
                    $expenseReceived = '$ '.$d->spdReport->expense_received;
                    $cashOut = '$ '.number_format($d->spdReport->cash_out, 0, ',', '.');
                }
                @endphp
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$d->no_surat}}</td>
                        <td>{{ date('d-M-Y', strtotime($d->form_date)) }}</td>
                        <td>{{$d->nama}}</td>
                        <td>{{$d->nik}}</td>
                        <td>{{$d->get_divisi->nama}}</td>
                        <td>{{$d->employee->jabatan->jenis_jabatan}}</td>
                        <td>{{$d->travel_type}}</td>
                        <td>{{date('d-M-Y', strtotime($d->spdReport->report_tgl_keberangkatan))}}</td>
                        <td>{{date('d-M-Y', strtotime($d->spdReport->report_tgl_pulang))}}</td>
                        <td>{{$d->travel_by}}</td>
                        <td>{{$d->asal}}</td>
                        <td>{{$d->tujuan}}</td>
                        <td>{{$expenseReceived}}</td>
                        <td>{{$cashOut}}</td> 
                        <td><a href="{{url('/uploads/SpdReport/report', $d->spdReport->upload_report)}}" target="_blank" class="btn btn-default btn-xs" style="color: dodgerblue;">View file</a></td>
                        <td>
                          @if($d->spdReport->spdReportApproval && $d->spdReport->spdReportApproval->status == 0)
                          <span class="label label-warning">Waiting approval HC</span>
                          @elseif($d->spdReport->spdReportApproval && $d->spdReport->spdReportApproval->status == 1)
                            <span class="label label-success">Approved by HC</span>
                          @else
                            <span class="label label-danger">Rejected</span>
                          @endif
                        </td>
                        <td>
                          @if($d->spdReport->spdReportApproval && $d->spdReport->spdReportApproval->hr_status == 0)
                          <span class="label label-warning">Waiting approval HC</span>
                          @elseif($d->spdReport->spdReportApproval && $d->spdReport->spdReportApproval->hr_status == 1)
                            <span class="label label-success">Approved by HC</span>
                          @else
                            <span class="label label-danger">Rejected</span>
                          @endif
                        </td>
                        <td>
                          @if($d->spdReport->upload_file != NULL || $d->spdReport->upload_file != "")
                            <a href="{{url('uploads/SpdReport/'.$d->spdReport->upload_file)}}" target="_blank" class="btn btn-default btn-xs" style="color: dodgerblue;">View file</a>
                          @else
                          @endif
                        </td>
                        <td>
                            <a href="{{route('edit-report-hrd',$d->id)}}" class="btn btn-warning btn-xs"><span class='glyphicon glyphicon-pencil'></span></a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</section>
    

@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>
$(function(){
   var mainTable = $('#data-table').DataTable();
   var selectedRow;
  $('#data-table').on('click', '.delete', function (e) {
    e.preventDefault();
    selectedRow = mainTable.row( $(this).parents('tr') );
    $("#modal-konfirmasi").modal('show');
    $("#modal-konfirmasi").find("#confirm-delete").data("id", $(this).data('id'));
    $("#konfirmasi-body").text("Are you sure to delete this data?");
  });
  
  $('#confirm-delete').click(function(){
      var deleteButton = $(this);
      var id           = deleteButton.data("id");
      console.log(id);
      deleteButton.button('loading');
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax(
      {
        url: "pengajuan-spd/"+id,
        type: 'POST',
        dataType: "JSON",
        data: {
          // _method:"DELETE"
          // "id": id
        },
        success: function (response)
        {
          deleteButton.button('reset');
          selectedRow.remove().draw();
          $("#modal-konfirmasi").modal('hide');
          Swal.fire({
            title: response.success,
            // text: response.success,
            type: 'success',
            confirmButtonText: 'Close',
            confirmButtonColor: '#AAA',
            onClose: function(){
            }
          })
        },
        error: function(xhr) {
          console.log(xhr.responseText);
        }
      });
  });

  if ($('#travel_type').val() == null) {
    $('.eat_per_day').hide();
    $('.allowance_per_day').hide();
}
  $('#travel_type').on('change', function () {
    $('.eat_per_day').show();
    $('.allowance_per_day').show();
    if ($('#travel_type').val() == 'Domestic') {
        $('.domestic').show();
        $('.international').hide();
    }

    if ($('#travel_type').val() == 'International') {
        $('.domestic').hide();
        $('.international').show();
    }
}); 
});
</script>
@endpush
