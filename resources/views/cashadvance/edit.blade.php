@extends('templates.header')
@php
 $isEnabled = $cash_advance_request->status == 0;   
@endphp

@section('content')
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  </head>

  <section class="content-header">
    <br>

    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="#">Cash Advance</a></li>
    </ol>
  </section>

  <div class="modal-header">
    <h2 class="modal-title" id="exampleModalLabel"><b>Edit Cash Advance</b></h2>
  </div>

  <section class="content">
    <div class="box">
      <div class="box-body">
        <div id="notif"></div>
        <form action="{{ route('update_advance', $cash_advance_request->id) }}" method="POST" enctype="multipart/form-data">
          @method('PATCH')
          @csrf
          <div class="row">
            <div class="col-xs-12 col-xl-6 col-lg-6">
              <div class="form-group">
                <label for="nama">Name*</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{$cash_advance_request->employee->nama}}" placeholder="" readonly >
              </div>

              <div class="form-group">
                <label for="nama">Nik*</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{$cash_advance_request->employee->nik}}" placeholder="" readonly >
              </div>

              <div class="form-group">
                <label for="request_date">Date Request*</label>
                <input type="date" data-date-format="yyyy/mm/dd" class="form-control" id="request_date" name="request_date"  placeholder="yyyy/mm/dd"  value="{{ $cash_advance_request->request_date }}" required >
              </div>
            </div>

            <!-- bilah kanan -->
            <div class="col-xs-12 col-xl-6 col-lg-6">
              <div class="form-group">
                <label for="nama">Divisi*</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{$cash_advance_request->employee->divisi->nama}}" placeholder="" readonly >
              </div>

              <div class="form-group">
                <label for="nama">Position*</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{$cash_advance_request->employee->jabatan->jenis_jabatan}}" placeholder="" readonly >
              </div>

              <div class="form-group">
                <label for="remarks">Remarks*</label>
                <input type="text" class="form-control" id="remarks" name="remarks"  {{ $isEnabled ? '' : 'disabled' }}  value="{{ $cash_advance_request->remarks}}" placeholder=""  >
              </div>
            </div>
          </div>

          <div class="panel panel-default">
            <div class="panel-heading">Form Add Detail Advance</div>

            <div class="panel-body">
              <div class="control-group">
                <div class="items"></div>

                <div class="row">
                  @if($cash_advance_request->status == 0)
                  <div class="col-xs-6 col-lg-2">
                    <label></label>
                    <button class="btn btn-success add-more" type="button">
                      <i class="glyphicon glyphicon-plus"></i> Add
                    </button>
                  </div>
                  @endif
                </div>

                <div class="row">
                  <div class="col-xs-5 col-xl-2 col-lg-3">
                    <label>Balance Received</label>
                    <input type="text" id="balance_received" name="balance_received" class="form-control" readonly>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xs-12 col-xl-6 col-lg-6">
            <div class="form-group">
              <label>Allocation*</label>
              <input type="text" name="allocation" value="{{$cash_advance_request->allocation}}" {{ $isEnabled ? '' : 'disabled' }} class="form-control">
            </div>

            <div class="form-group">
              <label>Reason</label>
              <textarea name="reason" rows="4" cols="50" {{ $isEnabled ? '' : 'disabled' }} class="form-control" required>{{$cash_advance_request->reason}}</textarea>
            </div>

            <div class="form-group upload_report_wrapper">
              <label>Item File*</label>
              <input type="file" name="item_file" {{ $isEnabled ? '' : 'disabled' }} class="form-control" />
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ url('pengajuan-advance') }}" class="btn btn-danger">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- fungsi javascript untuk menampilkan form dinamis  -->
  <!-- penjelasan :
  saat tombol add-more ditekan, maka akan memunculkan div dengan class copy -->
  
  <script type="text/javascript">
    function recalculateBalanceReceived() {
      let sum = 0;
      $('.total').each(function() {
          sum += Number($(this).val());
      });

      $('#balance_received').val(sum);
    }

    var id = 0;
    function addRow(data = null) {
     
      if (data == null) {
        data = {
          id: '',
          description: '',
          estimate_unit_price: 0,
          qty: 1,
          total: 0
        };
      }
      

      id++;

      const templateString = `
        <div class="row item-row item-row-${id}">
          <input type="hidden" name="items[${id}][id]" value="${data.id}" />
          <div class="col-xs-6 col-lg-2">
            <label>Description</label>
            <input type="text" name="items[${id}][description]" {{ $isEnabled ? '' : 'disabled' }} class="description form-control" value="${data.description}">
          </div>

          <div class="col-xs-6 col-lg-2">
            <label>Estimate Unite Price</label>
            <input type="number" name="items[${id}][unit_price]" {{ $isEnabled ? '' : 'disabled' }} class="unit_price form-control" value="${data.estimate_unit_price}">
          </div>

          <div class="col-xs-6 col-lg-2">
            <label>Quantity</label>
            <input type="number" name="items[${id}][qty]" {{ $isEnabled ? '' : 'disabled' }} class="qty form-control" value="${data.qty}">
          </div>

          <div class="col-xs-6 col-lg-2">
            <label>Estimate Total price</label>
            <input type="number" name="items[${id}][total]" class="total form-control" value="0" readonly>
          </div>

          <div class="col-xs-6 col-lg-2">
            @if($cash_advance_request->status == 0)
            <label></label>
            <button class="btn btn-danger remove remove-${id}" type="button">
              <i class="glyphicon glyphicon-remove"></i> Remove 
            </button>
            @endif
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
          recalculateBalanceReceived();
        });

        $(qty).on('change', function() {
          const unitPriceVal = $(unitPrice).val();
          const qtyVal = $(qty).val();
          const totalVal = unitPriceVal * qtyVal;

          $(total).val(totalVal);
          recalculateBalanceReceived();
        });

        
        $(qty).trigger('change')
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

      // Add rows on first load
      const dataItems = {!! json_encode($cash_advance_request->cashAdvanceRequestItems) !!};
      dataItems.forEach(function(item) {
        addRow(item);
      });

      setTimeout(recalculate, 500)
    });
  </script>
@endsection