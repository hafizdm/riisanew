@extends('templates.header')

@php
 $isEnabled = $spd->employee->spd_report_to != Auth::user()->user_login->id && $spd->spdReport->spdReportApproval->hr_status == 0;   
@endphp
@section('content')
<section class="content">
<div class="row">
    <div class="col-xs-12 col-xl-8 col-md-8">
        <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title fonts"><b>Edit Form SPD</b></h3>
        </div>
        <br>
        <div class="box-body">
            <div id="notif" ></div>
            <!-- form karyawan -->
            <div class="row">
                <!-- bilah kiri -->
            <div class="col-xs-12 col-xl-6 col-lg-6">
                <form role="form" name="formdata" method="post" action="{{route('update-spd', $spd->id)}}">
                    @method('PATCH')
                    @csrf
                <div class="form-group">
                    <label for="tgl_keberangkatan">Form Date</label>
                    <input type="date" data-date-format="yyyy/mm/dd" class="form-control" disabled id="form_date" name="form_date" placeholder="yyyy/mm/dd" value="{{$spd->form_date != '' ? $spd->form_date : ''}}">
                </div> 
                <div class="form-group">
                    <label for="nama">Name*</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{$spd->nama}}" placeholder="" readonly >
                </div>

                <div class="form-group" id="nik">
                    <label for="nik">Employee Number*</label>
                    <input type="text" class="form-control" id="nik" name="nik" value="{{$spd->nik}}" placeholder="" readonly >
                </div>

                <div class="form-group">
                    <label for="divisi_nama">Department*</label>
                    <input type="text" class="form-control" id="divisi_nama" name="divisi_nama" value="{{$spd->get_divisi->nama ?: '-'}}" placeholder="" readonly >
                    <input type="hidden" class="form-control" id="divisi_id" name="divisi_id" value="{{$spd->divisi_id}}">
                </div>
                
                <div class="form-group">
                    <label for="divisi_nama">Position*</label>
                    <input type="text" class="form-control" id="divisi_nama" name="divisi_nama" value="{{$spd->employee->jabatan->jenis_jabatan ?: '-'}}" placeholder="" readonly >
                    <input type="hidden" class="form-control" id="divisi_id" name="divisi_id" value="{{$spd->divisi_id}}">
                </div>

                <div class="form-group">
                    <label for="travel_type"> Travel Type*</label>
                    <select class="form-control select2"  disabled name="travel_type" id="travel_type" style="width: 100%;" required>
                    <option selected disabled>-- Travel Type -- </option>
                    <option value='Domestic' {{$spd->travel_type == 'Domestic' ? 'selected' : ''  }}>Domestic</option>
                    <option value='International' {{$spd->travel_type == 'International' ? 'selected' : ''  }}>International</option>
                    </select>
                </div>

                <div class="form-group eat_per_day_wrapper">
                    <label for="eat_per_day">Eat Perday</label>
                    <input type="number" id="eat_per_day" value="0" name="eat_per_day"  class="form-control" disabled/>
                </div>
                
                
                <div class="form-group allowance_per_day_wrapper">
                    <label for="allowance_per_day">Allowance Perday</label>
                    <input type="number" id="allowance_per_day" value="0" name="allowance_per_day"  class="form-control" disabled/>
                </div>

                <div class="form-group">
                    <label for="assignment_type"> Assignment Type*</label>
                    <select class="form-control select2" disabled name="assignment_type" id="assignment_type" style="width: 100%;" value="{{$spd->assignment_type}}" required>
                    <option selected disabled>-- Assignment Type -- </option>

                    <option value='Normal' {{$spd->assignment_type == 'Normal' ? 'selected' : ''  }}>Normal</option>
                    <option value='On Duty 24 Hours' {{$spd->assignment_type == 'On Duty 24 Hours' ? 'selected' : ''  }}>On Duty 24 Hours</option>
                    <option value='Visit' {{$spd->assignment_type == 'Visit' ? 'selected' : ''  }}>Visit</option>
                    </select>
                </div>

                <div class="form-group" id="purpose">
                    <label for="purpose">Purpose*</label>
                    <textarea id="purpose" name="purpose" rows="4" cols="50" class="form-control" disabled required>{{$spd->purpose}}</textarea>
                </div>

                <div class="form-group" id="asal">
                    <label for="asal">From*</label>
                    <input type="text" id="asal" name="asal" rows="4" cols="50" class="form-control" disabled value="{{$spd->asal}}">
                </div>

                <div class="form-group" id="tujuan">
                    <label for="tujuan">Destination*</label>
                    <input type="text" id="tujuan" name="tujuan" rows="4" cols="50" class="form-control" disabled value="{{$spd->tujuan}}" >
                </div>
            </div>

            <div class="col-xs-12 col-xl-6 col-lg-6">
                <div class="form-group">
                    <label for="tgl_keberangkatan">Date Departure*</label>
                    <input type="date" data-date-format="yyyy/mm/dd" class="form-control" disabled id="tgl_keberangkatan" name="tgl_keberangkatan"  placeholder="yyyy/mm/dd"  value="{{$spd->tgl_keberangkatan != '' ? $spd->tgl_keberangkatan : '' }}" >
                </div>

                <div class="form-group">
                    <label for="tgl_pulang">Date Return*</label>
                    <input type="date" data-date-format="yyyy/mm/dd" class="form-control" disabled id="tgl_pulang" name="tgl_pulang"  placeholder="yyyy/mm/dd"  value="{{$spd->tgl_pulang != '' ? $spd->tgl_pulang : '' }}">
                </div>

                <div class="form-group">
                        <label for="total_eat">Total Eat</label>
                        <input type="number" class="form-control" disabled id="total_eat" name="total_eat"  value="{{$spd->total_eat != '' ? $spd->total_eat : '' }}" >
                </div>
                
                <div class="form-group">
                <label for="total_allowance">Total Allowance</label>
                <input type="number" class="form-control" disabled id="total_allowance" name="total_allowance"  value="{{$spd->total_allowance != '' ? $spd->total_allowance : '' }}" >
                </div>

                <div class="form-group">
                <label for="idr">Additional Cost</label>
                <input type="idr" name="idr" id="idr" rows="4" cols="50" class="form-control" disabled value="{{$spd->idr}}">
                </div>

                <div class="form-group">
                <label for="total_balance">Total Balance Received</label>
                <input type="number" id="total_balance" value="0" name="total_balance"  class="form-control" disabled/>
                </div>

                <div class="form-group" id="travel_by">
                    <label for="travel_by">Travel By*</label>
                    <input type="tavel_by" name="travel_by" rows="4" cols="50" class="form-control" disabled value="{{$spd->travel_by}}">
                </div>

                <div class="form-group">
                    <label for="advance_payment"> Advance Payment*</label>
                    <select class="form-control select2" disabled name="advance_payment" id="advance_payment" style="width: 100%;"  value="{{$spd->advance_payment}}">
                    <option selected disabled>--Advance Payment -- </option>
                    <option value='Yes' {{$spd->advance_payment == 'Yes' ? 'selected' : ''  }}>Yes</option>
                    <option value='No' {{$spd->advance_payment == 'No' ? 'selected' : ''  }}>No</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="cash_out">Cash Out*</label>
                    <input type="number" id="cash_out" name="cash_out"  class="form-control" disabled value="{{$spd->spdReport->cash_out}}" required/>
                    
                </div>
                

                <div class="form-group report_tgl_keberangkatan_wrapper">
                    <label for="report_tgl_keberangkatan">Date Departure Report*</label>
                    <input type="date" data-date-format="yyyy/mm/dd" class="form-control" id="report_tgl_keberangkatan"  name="report_tgl_keberangkatan" value="{{$spd->spdReport->report_tgl_keberangkatan->format('Y-m-d')}}" placeholder="yyyy/mm/dd" readonly >
                    
                </div>

                <div class="form-group report_tgl_pulang_wrapper">
                    <label for="report_tgl_pulang">Date Return Report*</label>
                    <input type="date" data-date-format="yyyy/mm/dd" class="form-control" id="report_tgl_pulang"  name="report_tgl_pulang" value="{{$spd->spdReport->report_tgl_pulang->format('Y-m-d')}}" placeholder="yyyy/mm/dd" readonly >
                    
                </div>

                {{-- @dump($spd->spdReport) --}}
                <div class="form-group total_eat_report_wrapper">
                    <label for="total_eat_report">Total Eat Report</label>
                    <input type="number" id="total_eat_report"  name="total_eat_report" value="{{$spd->spdReport->total_eat_report}}"  class="form-control" readonly>
                </div>

                <div class="form-group total_allowance_report_wrapper">
                    <label for="total_allowance_report">Total Allowance Report</label>
                    <input type="number" id="total_allowance_report"  name="total_allowance_report" value="{{$spd->spdReport->total_allowance_report}}"  class="form-control" readonly>
                </div>

                <div class="form-group cash_out_wrapper">
                    <label for="cash_out">Contigensies*</label>
                    <input type="number" id="cash_out" name="cash_out"  value="{{$spd->spdReport->cash_out}}"  class="form-control"  disabled/>                     
                </div>

                <div class="form-group expense_received_wrapper">
                    <label for="expense_received">Total Expanse</label>
                    <input type="number" id="expense_received"  name="expense_received"  value="{{$spd->spdReport->expense_received}}" class="form-control" readonly>
                </div>

                


                @if($spd->spdReport && $spd->spdReport->spdReportApproval->hr_status == 0)
                <div class="dropdown">
                    <button type="button" class="btn btn-secondary dropdown-toggle btn-xs" data-toggle="dropdown">
                        Action 
                        <span class="fa fa-caret-down"></span> 
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:;" class="approved_spd_report"><i class="fa fa-check" aria-hidden="true" style="color:blue"></i>Approve</a></li>
                        <li><a href="javascript:;" class="rejected_spd_report"><i class="fa fa-ban" style="color:red" aria-hidden="true"></i>Reject</a></li>
                    </ul>
                    </div>
                @endif
            </div>
    </form>
        </div>
        </div>
    </div>
    </div>
    </div>
    </section>

@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    
<script>
$(function () {
const eatPerDayDomestic = '{{ $spd->employee->jabatan->eat_per_day_domestic }}';
const eatPerDayInternational = '{{ $spd->employee->jabatan->eat_per_day_international }}';
const allowancePerDayDomestic = '{{ $spd->employee->jabatan->allowance_per_day_domestic }}';
const allowancePerDayInternational = '{{ $spd->employee->jabatan->allowance_per_day_international }}';

if ($('#travel_type').val() == '') {
    $('.eat_per_day_wrapper').hide();
    $('#eat_per_day').val(0);

    $('.allowance_per_day_wrapper').hide();
    $('#allowance_per_day').val(0);
}

if ($('#travel_type').val() == 'Domestic') {
    $('#eat_per_day').val(eatPerDayDomestic);
    $('.eat_per_day_wrapper').show();

    $('#allowance_per_day').val(allowancePerDayDomestic);
    $('.allowance_per_day_wrapper').show();
}

if ($('#travel_type').val() == 'International') {
    $('#eat_per_day').val(eatPerDayInternational);
    $('.eat_per_day_wrapper').show();

    $('#allowance_per_day').val(allowancePerDayInternational);
    $('.allowance_per_day_wrapper').show();
}

$('#travel_type').on('change', function () {
    console.log('travel type changed');
    if ($('#travel_type').val() == 'Domestic') {
        console.log('travel type domestic');
        $('#eat_per_day').val(eatPerDayDomestic);
        $('.eat_per_day_wrapper').show();

        $('#allowance_per_day').val(allowancePerDayDomestic);
        $('.allowance_per_day_wrapper').show();
    }

    if ($('#travel_type').val() == 'International') {
        console.log('travel type international');
        $('#eat_per_day').val(eatPerDayInternational);
        $('.eat_per_day_wrapper').show();

        $('#allowance_per_day').val(allowancePerDayInternational);
        $('.allowance_per_day_wrapper').show();
    }
});

    function calculateTotal() {
    var eatPerDay = parseInt($('#eat_per_day').val());
    var allowancePerDay = parseInt($('#allowance_per_day').val());
    var tglPulang = moment($('#tgl_pulang').val());
    var tglKeberangkatan = moment($('#tgl_keberangkatan').val());
    var days = moment.duration(tglPulang.diff(tglKeberangkatan)).asDays() + 1;
    var total_allowance = parseInt(allowancePerDay*days);
    var total_eat = parseInt(eatPerDay*days);
    var idr = parseInt($('#idr').val());
    
    $('#total_eat').val(total_eat);
    $('#total_allowance').val(total_allowance);
    $('#total_balance').val(total_allowance + total_eat + idr);
}

calculateTotal();
$('#travel_type').on('change', function () {
    calculateTotal();
});

$('#tgl_keberangkatan').on('change', function () {
    calculateTotal();
});

$('#tgl_pulang').on('change', function () {
    calculateTotal();
});

$('#idr').on('change', function () {
    calculateTotal();
});
 

$('.approved_spd_report').click(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

        $.ajax({
            url: "/spd-report-hrd/{{$spd->id}}/approve",
            type: 'GET',
            success: function(data) {
                window.location.href = '/spd-report-hrd';
            }
        });
    });

    $('.rejected_spd_report').click(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "/spd-report-hrd/{{$spd->id}}/reject",
            type: 'GET',
            success: function(data) {
                window.location.href = '/spd-report-hrd';
            }
        });
    });
});



                
</script>

@endpush