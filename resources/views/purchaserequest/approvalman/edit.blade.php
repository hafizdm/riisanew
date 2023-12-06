@extends('templates.header')

@php
 $isEnabled = $purchaseRequest->status == 0;   
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
      <li class="active"><a href="#">PRF</a></li>
    </ol>
  </section>

  <div class="modal-header">
    <h2 class="modal-title" id="exampleModalLabel"><b>Purchase Request Form</b></h2>
  </div>

  <section class="content">
    <div class="box">
      <div class="box-body">
        <div id="notif"></div>
        <form action="{{ route('update_pengajuan_prf', $purchaseRequest->id) }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
          <div class="row">
            {{-- bilah kiri --}}
            <div class="col-xs-12 col-xl-3 col-lg-3">
              <div class="form-group">
                <label for="nama">Name*</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{$purchaseRequest->employee->nama}}" placeholder="" readonly >
              </div>

              <div class="form-group">
                <label for="nik">Nik*</label>
                <input type="text" class="form-control" id="nik" name="nik" value="{{$purchaseRequest->employee->nik}}" placeholder="" readonly >
              </div>

              <div class="form-group">
                <label for="purchase_request_category_id">Budget Category*</label>
                <select name="purchase_request_category_id" id="purchase_request_category_id" class="form-control select2" disabled>
                    @foreach($categories as $c)
                        <option value="{{$c->id}}" {{$c->id == $purchaseRequest->purchase_request_category_id ? 'selected' : ''  }} readonly>{{$c->category_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
              <label for="prepared_date">Date Prepared*</label>
              <input type="date" data-date-format="yyyy/mm/dd" class="form-control" id="prepared_date" name="prepared_date"  placeholder="yyyy/mm/dd"  value="{{ $purchaseRequest->prepared_date }}" readonly >
            </div>

            <div class="form-group">
              <label for="required_date">Date Required*</label>
              <input type="date" data-date-format="yyyy/mm/dd" class="form-control" id="required_date" name="required_date"  placeholder="yyyy/mm/dd"  value="{{ $purchaseRequest->required_date }}" readonly >
            </div>

            <div class="form-group">
              <label for="received_date">Date Received*</label>
              <input type="date" data-date-format="yyyy/mm/dd" class="form-control" id="received_date" name="received_date"  placeholder="yyyy/mm/dd"  value="{{ $purchaseRequest->received_date }}" readonly >
            </div>

            </div>

            <!-- bilah Tengah -->
            <div class="col-xs-12 col-xl-3 col-lg-3">
              <div class="form-group">
                <label for="divisi_id">Divisi*</label>
                <input type="text" class="form-control" id="divisi_id" name="divisi_id" value="{{$purchaseRequest->employee->divisi->nama}}" readonly >
              </div>

              <div class="form-group">
                <label for="jenis_jabatan">Position*</label>
                <input type="text" class="form-control" id="jenis_jabatan" name="jenis_jabatan" value="{{$purchaseRequest->employee->jabatan->jenis_jabatan}}" placeholder="" readonly >
              </div>

              <div class="form-group">
                <label for="brand_preference">Brand Freference*</label>
                <input type="text" class="form-control" id="brand_preference" name="brand_preference" value="{{ $purchaseRequest->brand_preference }}" placeholder=""  readonly>
              </div>

              <div class="form-group">
                <label for="suggested_vendor">Sugested Vendor*</label>
                <input type="text" class="form-control" id="suggested_vendor" name="suggested_vendor" value="{{ $purchaseRequest->suggested_vendor }}" placeholder=""  readonly>
              </div>

              <div class="form-group">
                <label for="justification_attached">Justification Attached</label>
                <input type="text" class="form-control" id="justification_attached" name="justification_attached" value="{{ $purchaseRequest->justification_attached }}" placeholder=""  readonly>
              </div>

              <div class="form-group">
                <label for="work_package">Work Packadge</label>
                <input type="text" class="form-control" id="work_package" name="work_package" value="{{ $purchaseRequest->work_package }}" placeholder=""  readonly>
              </div>

            </div>

            <!-- bilah Kanan -->
            <div class="col-xs-12 col-xl-3 col-lg-3">
                <div class="form-group">
                  <label for="receipt_to">Receipt To*</label>
                  <input type="text" class="form-control" id="receipt_to" name="receipt_to" value="{{ $purchaseRequest->receipt_to }}" placeholder="Head Office/Project" readonly>
                </div>
  
                <div class="form-group">
                  <label for="note_receiver">Note Receiver</label>
                  <input type="text" class="form-control" id="note_receiver" name="note_receiver" value="{{ $purchaseRequest->note_receiver }}" placeholder="Note for Receiver" readonly>
                </div>
  
                <div class="form-group">
                  <label for="delivered_by">Via</label>
                  <input type="text" class="form-control" id="delivered_by" name="delivered_by" value="{{ $purchaseRequest->delivered_by }}" placeholder="Plane/Bus/Boat"  readonly>
                </div>

                <div class="form-group">
                    <label for="delivery_to">Delivery To</label>
                    <input type="text" class="form-control" id="delivery_to" name="delivery_to" value="{{ $purchaseRequest->delivery_to }}" placeholder="Enter your delivery name"  readonly>
                </div>

                <div class="form-group">
                    <label for="import">Import</label>
                    <input type="text" class="form-control" id="import" name="import" value="{{ $purchaseRequest->import }}" placeholder=""  readonly>
                </div>

                <div class="form-group">
                    <label for="is_urgent"> Urgent</label>
                    <select class="form-control select2" name="is_urgent" id="is_urgent" style="width: 100%;" >
                    <option selected disabled>-- Urgent --</option>
                    <option value='1' {{$purchaseRequest->is_urgent == '1' ? 'selected' : ''  }} >Yes</option>
                    <option value='0' {{$purchaseRequest->is_urgent == '0' ? 'selected' : ''  }} >No</option>
                    </select>
                    <span class="help-block" > </span>
                </div>
              </div>

              <div class="col-xs-12 col-xl-3 col-lg-3">
                <div class="form-group">
                    <label for="project_ref_number">Project Ref. Number</label>
                    <input type="text" class="form-control" id="project_ref_number" name="project_ref_number" value="{{ $purchaseRequest->project_ref_number }}" placeholder="For Project Numbering" readonly >
                </div>
              </div>
                        
            </div>

          <div class="panel panel-default">
            <div class="panel-heading">Form Add Detail Advance</div>

            <div class="panel-body">
              <div class="control-group">
                <div class="items"></div>

                

                <div class="row">
                  <div class="col-xs-5 col-xl-2 col-lg-3">
                    <label>Total Balance</label>
                    <input type="text" id="total_balance" name="total_balance" class="form-control" readonly>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-xs-12 col-xl-6 col-lg-6">

            <div class="form-group">
              <label>Intended Use</label>
              <textarea name="intended_use" rows="4" cols="50" class="form-control" readonly>{{ $purchaseRequest->intended_use }}</textarea>
            </div>

           

            <div class="dropdown">
                <button type="button" class="btn btn-secondary dropdown-toggle btn-xs" data-toggle="dropdown">
                    Action
                    <span class="fa fa-caret-down"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="javascript:;" class="approved_prf"><i class="fa fa-check" aria-hidden="true" style="color:blue"></i>Approve</a></li>
                    <li><a href="javascript:;" class="rejected_prf"><i class="fa fa-ban" style="color:red" aria-hidden="true"></i>Reject</a></li>
                </ul>
            </div>

           
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
      $('.subtotal').each(function() {
          sum += Number($(this).val());
      });

      $('#total_balance').val(sum);
    }

    var id = 0;
    function addRow(data = null) {
     
      if (data == null) {
        data = {
          id: '',
          item_number: '',
          item_class: '',
          description: '',
          budget_code: '',
          unit: '',
          unit_price: 0,
          qty: 1,
          subtotal: 0
        };
      }
      

      id++;

      const templateString = `
        <div class="row item-row item-row-${id}">
          <input type="hidden" name="items[${id}][id]" value="${data.id}" />
          <div class="col-xs-6 col-lg-2">
            <label>Item Number</label>
            <input type="text" name="items[${id}][item_number]" {{ $isEnabled ? '' : 'disabled' }} class="item_number form-control" value="${data.item_number}" readonly>
          </div>

          <div class="col-xs-6 col-lg-2">
            <label>Item Class</label>
            <input type="text" name="items[${id}][item_class]" {{ $isEnabled ? '' : 'disabled' }} class="item_class form-control" value="${data.item_class}" readonly>
          </div>

          <div class="col-xs-6 col-lg-2">
            <label>Description</label>
            <input type="text" name="items[${id}][description]" {{ $isEnabled ? '' : 'disabled' }} class="description form-control" value="${data.description}" readonly>
          </div>

          <div class="col-xs-6 col-lg-2">
            <label>Unit</label>
            <input type="text" name="items[${id}][unit]" {{ $isEnabled ? '' : 'disabled' }} class="unit form-control" value="${data.unit}" readonly>
          </div>
          
          <div class="col-xs-6 col-lg-2">
            <label>Unite Price</label>
            <input type="number" name="items[${id}][unit_price]" {{ $isEnabled ? '' : 'disabled' }} class="unit_price form-control" value="${data.unit_price}" readonly>
          </div>

          <div class="col-xs-6 col-lg-2">
            <label>Quantity</label>
            <input type="number" name="items[${id}][qty]" {{ $isEnabled ? '' : 'disabled' }} class="qty form-control" value="${data.qty}" readonly>
          </div>

          <div class="col-xs-6 col-lg-2">
            <label>Sub Total price</label>
            <input type="number" name="items[${id}][subtotal]" class="subtotal form-control" value="0" readonly>
          </div>

          <div class="col-xs-6 col-lg-2">
            <label>Budget Code</label>
            <input type="text" name="items[${id}][budget_code]" {{ $isEnabled ? '' : 'disabled' }} class="budget_code form-control" value="${data.budget_code}" readonly>
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
        const subtotal = $(item).find('.subtotal');

        $(unitPrice).on('change', function() {
          const unitPriceVal = $(unitPrice).val();
          const qtyVal = $(qty).val();
          const subtotalVal = unitPriceVal * qtyVal;

          $(subtotal).val(subtotalVal);
          recalculateBalanceReceived();
        });

        $(qty).on('change', function() {
          const unitPriceVal = $(unitPrice).val();
          const qtyVal = $(qty).val();
          const subtotalVal = unitPriceVal * qtyVal;

          $(subtotal).val(subtotalVal);
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
      const dataItems = {!! json_encode($purchaseRequest->purchaseRequestItems) !!};
      dataItems.forEach(function(item) {
        addRow(item);
      });

      setTimeout(recalculate, 500);

      $('.approved_prf').click(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/prf-request/{{$purchaseRequest->id}}/approve",
                type: 'GET',
                success: function(data) {
                    window.location.href = '/prf-request';
                }
            });
        });

        $('.rejected_prf').click(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/prf-request/{{$purchaseRequest->id}}/reject",
                type: 'GET',
                success: function(data) {
                    window.location.href = '/prf-request';
                }
            });
        });
    });

  </script>
  
@endsection


