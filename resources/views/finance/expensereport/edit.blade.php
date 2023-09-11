@extends('templates.header')

@section('content')
  <section class="content-header">
    <br>

    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="#">Expense Report</a></li>
    </ol>
  </section>

  <div class="modal-header">
    <h2 class="modal-title" id="exampleModalLabel"><b>Expense Report Approval</b></h2>
  </div>

  <section class="content">
    <div class="box">
      <div class="box-body">
        <div id="notif"></div>
        <form action="{{ route('store_pengajuan_expense') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-xs-12 col-xl-6 col-lg-6">
              <div class="form-group">
                <label for="nama">Name*</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{$expenseReport->cashAdvanceRequest->employee->nama}}" placeholder="" readonly >
              </div>

              <div class="form-group">
                <label for="nik">Nik*</label>
                <input type="text" class="form-control" id="nik" name="nik" value="{{$expenseReport->cashAdvanceRequest->employee->nik}}" placeholder="" readonly >
              </div>

              <div class="form-group">
                <label for="request_date">Date Request*</label>
                <input type="date" data-date-format="yyyy/mm/dd" class="form-control" id="request_date" name="request_date"  placeholder="yyyy/mm/dd"  value="{{ $expenseReport->request_date }}" readonly>
              </div>
            </div>

            <!-- bilah kanan -->
            <div class="col-xs-12 col-xl-6 col-lg-6">
              <div class="form-group">
                <label for="divisi">Divisi*</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{$expenseReport->cashAdvanceRequest->employee->divisi->nama}}" placeholder="" readonly >
              </div>

              <div class="form-group">
                <label for="position">Position*</label>
                <input type="text" class="form-control" id="position" name="position" value="{{$expenseReport->cashAdvanceRequest->employee->jabatan->jenis_jabatan}}" placeholder="" readonly >
              </div>

              <div class="form-group">
                <label for="remarks">Remarks*</label>
                <input type="text" class="form-control" id="remarks" name="remarks" value="{{ $expenseReport->cashAdvanceRequest->remarks }}" placeholder=""  readonly >
              </div>
            </div>
          </div>

          <div class="panel panel-default">
            <div class="panel-heading">Form Add Detail Expense</div>

            <div class="panel-body">
              <div class="control-group">
                <div class="items"></div>

                <div class="row">
                  <div class="col-xs-6 col-lg-2">
                    <label></label>
                    
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-5 col-xl-2 col-lg-3">
                    <label>Cash Out</label>
                    <input type="text" id="cash_out" name="cash_out" class="form-control" value="{{ $expenseReport->cash_out }}" readonly>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-5 col-xl-2 col-lg-3">
                    <label>Cash Advance</label>
                    <input type="text" id="cash_advance_balance_received" name="cash_advance_balance_received" class="form-control" value="{{ $expenseReport->cashAdvanceRequest->balance_received }}" readonly>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-5 col-xl-2 col-lg-3">
                    <label>Total Expense</label>
                    <input type="text" id="total_expense" name="total_expense" class="form-control" value="{{ $expenseReport->total_expense }}" readonly>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xs-12 col-xl-6 col-lg-6">
            <div class="form-group">
              <label>Allocation*</label>
              <input type="text" id="cash_advance_allocation" name="allocation" value="{{ $expenseReport->cashAdvanceRequest->allocation }}" class="form-control" readonly>
            </div>

            <div class="form-group">
              <label>Reason</label>
              <textarea id="cash_advance_reason" name="reason"  rows="4" cols="50" class="form-control" readonly>{{ $expenseReport->cashAdvanceRequest->reason }}</textarea>
            </div>

            

            <div class="dropdown">
              @if($expenseReport->status == 4)
                <button type="button" class="btn btn-secondary dropdown-toggle btn-xs" data-toggle="dropdown">
                    Action
                    <span class="fa fa-caret-down"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="javascript:;" class="approved_expense"><i class="fa fa-check" aria-hidden="true" style="color:blue"></i>Process Clear</a></li>
                </ul>
              @endif
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
@endsection

@push('script')
  <script type="text/javascript">
    function recalculateCashOut() {
      let cashOut = 0;
      let cashAdvanceBalanceReceived = Number($('#cash_advance_balance_received').val());
      $('.total').each(function() {
          cashOut += Number($(this).val());
      });

      $('#cash_out').val(cashOut);
      $('#total_expense').val(Number(cashOut - cashAdvanceBalanceReceived));
    }

    var id = 0;
    function addRow(data = null) {
      id++;

      if (data === null) {
        data = {
          description: '',
          estimate_unit_price: '',
          qty: '',
          total: '',
        }
      }
      const total = data.qty * data.estimate_unit_price
      const templateString = `
        <div class="row item-row item-row-${id}">
          <div class="col-xs-6 col-lg-2">
            <label>Description</label>
            <input type="text" name="items[${id}][description]" class="description form-control" value="${data.description}" readonly>
          </div>

          <div class="col-xs-6 col-lg-2">
            <label>Estimate Unite Price</label>
            <input type="number" name="items[${id}][unit_price]" class="unit_price form-control" value="${data.estimate_unit_price}" readonly>
          </div>

          <div class="col-xs-6 col-lg-2">
            <label>Quantity</label>
            <input type="number" name="items[${id}][qty]" class="qty form-control" value="${data.qty}" readonly>
          </div>

          <div class="col-xs-6 col-lg-2">
            <label>Estimate Total price</label>
            <input type="number" name="items[${id}][total]" class="total form-control" value="${total}" readonly>
          </div>

          <div class="col-xs-6 col-lg-2">
            <label></label>
            
          </div>
        </div>
      `

      $('.items').append(templateString);

      recalculate();
    }

    function recalculate() {
      const items = $('.control-group > .items > .item-row');

      // loop through item using javascript
      items.each(function(index, item) {
        const unitPrice = $(item).find('.unit_price');
        const qty = $(item).find('.qty');
        const total = $(item).find('.total');

        $(unitPrice).on('change', function() {
          const unitPriceVal = $(unitPrice).val();
          const qtyVal = $(qty).val();
          const totalVal = unitPriceVal * qtyVal;

          $(total).val(totalVal);
          recalculateCashOut();
        });

        $(qty).on('change', function() {
          const unitPriceVal = $(unitPrice).val();
          const qtyVal = $(qty).val();
          const totalVal = unitPriceVal * qtyVal;

          $(total).val(totalVal);
          recalculateCashOut();
        });
      });
    }

    $(document).ready(function() {
      $(".add-more").click(function(){
        addRow();
      });

      // saat tombol remove dklik row akan dihapus
      $("body").on("click", ".remove",function(){
        $(this).parents(".row").remove();

        recalculate();
      });

      const dataItems = {!! json_encode($expenseReport->expenseReportItems) !!};
      dataItems.forEach(function (item) {
        addRow(item);
      });

      setTimeout(recalculate, 500)
      
        $('.approved_expense').click(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/list-expense/{{$expenseReport->id}}/approve",
                type: 'GET',
                success: function(data) {
                    window.location.href = '/list-expense';
                }
            });
        });
    });
  </script>
@endpush