<!-- Modal -->
<div class="modal fade tambahspdreport"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <center><h4 class="modal-title" id="exampleModalLabel"><b>Submission of
              <br>
                Official Report (SPD)</b></h4></center>
                <br>
        </div>
        
        <div class="modal-body">
            <form role="form" name="formdata" method="post" enctype="multipart/form-data" action="{{route("spd-report")}}">
                @csrf
            <div class="row">
               
              <!-- end of bilah kiri -->

              <!-- bilah tengah -->
                <div class="col-xs-12 col-xl-6 col-lg-6">

                    <div class="form-group">
                        <label for="spd_id">SPD Number*</label>
                        <select class="form-control select2"  name="spd_id" id="spd_id" style="width: 100%;" required>
                            <option selected readonly value="0">-- Pilih SPD Number -- </option>
                            @foreach($spd as $s)
                                <option value='{{$s->id}}'>{{$s->no_surat}}</option> 
                            @endforeach       
                        </select>
                        
                    </div>

                    <div class="form-group nama_wrapper">
                        <label for="nama">Name*</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{Auth::user()->user_login->nama}}" placeholder="" readonly >
                        
                    </div>

                    <div class="form-group nik_wrapper">
                        <label for="nik">Employee Number*</label>
                        <input type="text" class="form-control" id="nik" name="nik" value="{{Auth::user()->user_login->nik}}" placeholder="" readonly >
                        <span id="nik" class="help-block" > {{ $errors->first('nik') }} </span>
                    </div>

                    <div class="form-group divisi_wrapper">
                        <label for="divisi_nama">Department*</label>
                            <input type="text" class="form-control" id="divisi_nama" name="divisi_nama" value="{{Auth::user()->user_login->divisi_id != 0 ? Auth::user()->user_login->divisi->nama : '-'}}" placeholder="" readonly >
                            <input type="hidden" class="form-control" id="divisi_id" name="divisi_id" value="{{Auth::user()->user_login->divisi_id}}">
                            
                    </div>

                    <div class="form-group divisi_wrapper">
                        <label for="divisi_nama">Position*</label>
                            <input type="text" class="form-control" id="divisi_nama" name="divisi_nama" value="{{Auth::user()->user_login->divisi_id != 0 ? Auth::user()->user_login->jabatan->jenis_jabatan : '-'}}" placeholder="" readonly >
                            <input type="hidden" class="form-control" id="divisi_id" name="divisi_id" value="{{Auth::user()->user_login->divisi_id}}">
                            
                    </div>

                    <div class="form-group travel_wrapper">
                        <label for="travel_type"> Travel Type*</label>
                        <select class="form-control select2" name="travel_type" id="travel_type" style="width: 100%;" required>
                        <option selected disabled>Travel Type</option>
                        <option value='Domestic'>Domestic</option>
                        <option value='International'>International</option>
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
                    

                    <div class="form-group asal_wrapper">
                        <label for="asal">From*</label>
                        <input type="text" id="asal" name="asal" rows="4" cols="50" class="form-control" required/>
                   </div>
 
                    <div class="form-group tujuan_wrapper">
                        <label for="tujuan">Destination*</label>
                        <input type="text" id="tujuan" name="tujuan" rows="4" cols="50" class="form-control" required/>
                        
                    </div>

                    <div class="form-group departure_wrapper">
                        <label for="tgl_keberangkatan">Date Departure*</label>
                        <input type="date" data-date-format="yyyy/mm/dd" class="form-control" id="tgl_keberangkatan" name="tgl_keberangkatan"  placeholder="yyyy/mm/dd" required >
                        
                    </div>

                    <div class="form-group return_wrapper">
                        <label for="tgl_pulang">Date Return*</label>
                        <input type="date" data-date-format="yyyy/mm/dd" class="form-control" id="tgl_pulang" name="tgl_pulang"  placeholder="yyyy/mm/dd" required >
                       
                    </div>

                    
                </div>
              <!-- end of bilah kiri -->

              <!-- bilah tengah -->
                <div class="col-xs-12 col-xl-6 col-lg-6">
                                        

                    <div class="form-group eat_wrapper">
                        <label for="total_eat">Total Eat</label>
                        <input type="number" id="total_eat" value="0" name="total_eat"  class="form-control" disabled/>
                    </div>
                    
                    
                    <div class="form-group allowance_wrapper">
                        <label for="total_allowance">Total Allowance</label>
                        <input type="number" id="total_allowance" value="0" name="total_allowance"  class="form-control" disabled/>
                    </div>
                    
                    <div class="form-group additional_wrapper">
                        <label for="idr">Additional Cost</label>
                        <input type="number" name="idr" id="idr" rows="4" cols="50" class="form-control" placeholder="don't use (.) or(,) Ex: 1000000" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"/>
                        
                    </div>

                    <div class="form-group balance_wrapper">
                        <label for="total_balance">Total Balance Received</label>
                        <input type="number" id="total_balance" value="0" name="total_balance"  class="form-control" disabled/>
                    </div>

                    <div class="form-group travel_by_wrapper">
                        <label for="travel_by">Travel By*</label>
                        <input type="text" id="travel_by" name="travel_by"  class="form-control" required/>
                        
                    </div>

                    <div class="form-group report_tgl_keberangkatan_wrapper">
                        <label for="report_tgl_keberangkatan">Date Departure Report*</label>
                        <input type="date" data-date-format="yyyy/mm/dd" class="form-control" id="report_tgl_keberangkatan" name="report_tgl_keberangkatan"  placeholder="yyyy/mm/dd" required >
                        
                    </div>

                    <div class="form-group report_tgl_pulang_wrapper">
                        <label for="report_tgl_pulang">Date Return Report*</label>
                        <input type="date" data-date-format="yyyy/mm/dd" class="form-control" id="report_tgl_pulang" name="report_tgl_pulang"  placeholder="yyyy/mm/dd" required >
                        
                    </div>

                    <div class="form-group total_eat_report_wrapper">
                        <label for="total_eat_report">Total Eat Report</label>
                        <input type="number" id="total_eat_report" value="0" name="total_eat_report"  class="form-control" readonly>
                    </div>

                    <div class="form-group total_allowance_report_wrapper">
                        <label for="total_allowance_report">Total Allowance Report</label>
                        <input type="number" id="total_allowance_report" value="0" name="total_allowance_report"  class="form-control" readonly>
                    </div>

                    <div class="form-group cash_out_wrapper">
                        <label for="cash_out">Contigensies*</label>
                        <input type="number" id="cash_out" name="cash_out"  class="form-control" required/>                     
                    </div>

                    <div class="form-group expense_received_wrapper">
                        <label for="expense_received">Total Expanse</label>
                        <input type="number" id="expense_received" value="0" name="expense_received"  class="form-control" readonly>
                    </div>

                    <div class="form-group upload_report_wrapper">
                        <label for="upload_report">Upload Report*</label>
                        <input type="file" id="upload_report" name="upload_report"  class="form-control" required/>                      
                    </div>

                    
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{url("add-report")}}" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
  </div>
   

  <!-- End Off Modal -->