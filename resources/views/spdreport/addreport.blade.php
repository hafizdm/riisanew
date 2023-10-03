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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".tambahspdreport"><span class="glyphicon glyphicon-plus"></span> Add Report SPD</button>
          </div>

        <div class="table-responsive">
            <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%" style="white-space: nowrap !important;">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>SPD Number</th>
                        <th>Form Date</th>
                        <th>Travel Type</th>
                        <th>From</th>
                        <th>Destination</th>
                        <th>Date Departure</th>
                        <th>Date Return</th>
                        <th>Total Expense</th>
                        <th>Contigensies</th>
                        <th>Upload Report</th>
                        <th>Status of Request</th> 
                        <th>Next Process</th>
                        <th>File Payment</th>
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
                        <td>{{$d->travel_type}}</td>
                        <td>{{$d->asal}}</td>
                        <td>{{$d->tujuan}}</td>
                        <td>{{date('d-M-Y', strtotime($d->spdReport->report_tgl_keberangkatan))}}</td>
                        <td>{{date('d-M-Y', strtotime($d->spdReport->report_tgl_pulang))}}</td>
                        <td>{{$expenseReceived}}</td>
                        <td>{{$cashOut}}</td>
                        <td><a href="{{url('uploads/SpdReport/report/'.$d->spdReport->upload_report)}}" target="_blank" class="btn btn-default btn-xs" style="color: dodgerblue;">View file</a></td>
                        <td>
                          @if($d->spdReport->spdReportApproval->hr_status == 0 )
                                  <span class="label label-warning">Request Process</span>
                                  @elseif($d->spdReport->spdReportApproval->hr_status == 2 )
                                  <span class="label label-danger">Request Rejected</span>
                                  @elseif($d->spdReport->spdReportApproval->status == 0 )
                                  <span class="label label-warning">Request Process</span>
                                  @elseif($d->spdReport->spdReportApproval->status == 2 )
                                  <span class="label label-danger">Request Rejected</span>
                                  @elseif($d->spdReport->spdReportApproval->finance_status == 0)
                                  <span class="label label-warning">Payment Process</span>
                                  @elseif($d->spdReport->spdReportApproval->finance_status == 1)
                                  <span class="label label-success">Payment Slip</span> 
                                  @elseif($d->spdReport->spdReportApproval->finance_status == 2)
                                  <span class="label label-danger">Payment Cancel</span> 
                          @endif
                        </td>
                        <td>
                          @if ($d->spdReport->spdReportApproval->status == 0)
                            Review Manager/PM/VP
                            
                            @elseif ($d->spdReport->spdReportApproval->status == 2)
                            Rejected by Manager/PM
                            @elseif ($d->spdReport->spdReportApproval->hr_status == 0)
                            Waiting Approval HC
                            @elseif ($d->spdReport->spdReportApproval->hr_status == 2)
                            Rejected by HC
                            @elseif ($d->spdReport->spdReportApproval->finance_status == 0)
                            Finance (Upload Invoice)
                            @elseif ($d->spdReport->spdReportApproval->finance_status == 1)
                            Payment Slip
                            @elseif ($d->spdReport->spdReportApproval->finance_status == 2)
                            Payment Cancel
                          @endif
                        </td>
                        <td>
                          @if($d->spdReport->upload_file != NULL || $d->spdReport->upload_file != "")
                            <a href="{{url('uploads/SpdReport/'.$d->spdReport->upload_file)}}" target="_blank" class="btn btn-default btn-xs" style="color: dodgerblue;">View file</a>
                          @else
                          @endif
                        </td>
                        <td>
                            <a href="{{url('reportpdf',$d->id)}}" class="btn btn-primary btn-xs"><span class='glyphicon glyphicon-print'></span></a>
                            <a href="{{route('edit-report',$d->id)}}" class="btn btn-warning btn-xs"><span class='glyphicon glyphicon-pencil'></span></a>
                            
                            @if($d->spdReport->spdReportApproval->status != 1 && $d->spdReport->spdReportApproval->hr_status != 1)
                              <button class='btn btn-xs btn-danger delete' data-id="{{$d->spdReport->id}}"><span class='glyphicon glyphicon-trash'></span></button>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</section>

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


@include('spdreport.create')
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
    console.log('delete.click');
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
        url: "spd-report/"+id,
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

$(function () {
    function hideAllField(){
      $('.nama_wrapper').hide()
      $('.nik_wrapper').hide()
      $('.divisi_wrapper').hide()
      $('.travel_wrapper').hide()
      $('.eat_per_day_wrapper').hide()
      $('.allowance_per_day_wrapper').hide()
      $('.asal_wrapper').hide()
      $('.tujuan_wrapper').hide()
      $('.departure_wrapper').hide()
      $('.return_wrapper').hide()
      $('.eat_wrapper').hide()
      $('.allowance_wrapper').hide()
      $('.additional_wrapper').hide()
      $('.balance_wrapper').hide()
      $('.travel_by_wrapper').hide()
      $('.report_tgl_keberangkatan_wrapper').hide()
      $('.report_tgl_pulang_wrapper').hide()
      $('.total_eat_report_wrapper').hide()
      $('.total_allowance_report_wrapper').hide()
      $('.expense_received_wrapper').hide()
      $('.upload_report_wrapper').hide()
      $('.cash_out_wrapper').hide()
    }

    hideAllField()
    
    $(".tambahspdreport").on("hidden.bs.modal", function () {
        hideAllField()
        $('#spd_id').val('0')
    });

    $('#spd_id').on('change', function () {

        // TODO: get spd data from ajax
        $.ajax({
            dataType: 'json',
            url: '/spd-report-ajax/'+$(this).val(),
            success: function (data) {
              console.log(data)
              $('#travel_type').val(data.travel_type).attr('disabled', true);
              $('#eat_per_day').val(data.eat_per_day).attr('disabled', true);
              $('#allowance_per_day').val(data.allowance).attr('disabled', true);
              $('#asal').val(data.asal).attr('disabled', true);
              $('#tujuan').val(data.tujuan).attr('disabled', true);
              $('#tgl_keberangkatan').val(data.tgl_keberangkatan).attr('disabled', true);
              $('#tgl_pulang').val(data.tgl_pulang).attr('disabled', true);
              $('#idr').val(data.idr).attr('disabled', true);
              $('#travel_by').val(data.travel_by).attr('disabled', true);
              $('#total_allowance').val(data.total_allowance).attr('disabled', true);
              $('#total_eat').val(data.total_eat).attr('disabled', true);
              $('#total_balance').val(data.balance_received).attr('disabled', true);
            }
          })

        $('.nama_wrapper').val('Nama').show()
        $('.nik_wrapper').val('Nik').show()
        $('.divisi_wrapper').val('divisi').show()
        $('.travel_wrapper').show()   
        $('.eat_per_day_wrapper').show()
        $('.allowance_per_day_wrapper').show()
        $('.asal_wrapper').show()
        $('.tujuan_wrapper').show()
        $('.departure_wrapper').show()
        $('.return_wrapper').show()
        $('.eat_wrapper').show()
        $('.allowance_wrapper').show()
        $('.additional_wrapper').show()
        $('.balance_wrapper').show()
        $('.travel_by_wrapper ').show()
        $('.report_tgl_keberangkatan_wrapper ').show()
        $('.report_tgl_pulang_wrapper ').show()
        $('.total_eat_report_wrapper ').show()
        $('.total_allowance_report_wrapper ').show()
        $('.cash_out_wrapper ').show()
        $('.expense_received_wrapper ').show()
        $('.upload_report_wrapper ').show()
    });

    function recalculateReport() {
      const reportDateDeparture = $('#report_tgl_keberangkatan').val()
      const reportDateReturn = $('#report_tgl_pulang').val()
      const eatPerDay = parseInt($('#eat_per_day').val());
      const allowancePerDay = parseInt($('#allowance_per_day').val());
      const days = moment.duration(moment(reportDateReturn).diff(moment(reportDateDeparture))).asDays() +1;
      const totalEatReport = parseInt(eatPerDay * days);
      const totalAllowanceReport = parseInt(allowancePerDay * days);
      const cashOut = parseInt($('#cash_out').val());

      $('#total_eat_report').val(totalEatReport);
      $('#total_allowance_report').val(totalAllowanceReport);
      $('#expense_received').val(totalEatReport + totalAllowanceReport + cashOut);
    }

    $('#report_tgl_keberangkatan').on('change', function () {
        recalculateReport()
    });

    $('#report_tgl_pulang').on('change', function () {
        recalculateReport()
    });

    $('#cash_out').on('change', function () {
        recalculateReport()
    });
  });  
</script>
@endpush
