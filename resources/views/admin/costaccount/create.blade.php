@extends('templates.header')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <span class="fonts header-style">
        <b>Add Scope of Work</b>
    </span>
    <ol class="breadcrumb">
      <<li><a href="{{url("")}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{url("barang")}}">Cost Account</a></li>
      <li class="active"><a href="#">Scope of work</a></li>
      
    </ol>
  </section>
  <br>
    <div class="container">
        <div class="row">
                <div class="col-lg-6">
                <form role="form" name="formdata" method="post" action="{{url("cost-account/store")}}">
                        {{csrf_field()}}   
                        
                        <div class="form-group">
                            <label for="nama">Scope of Work</label>
                            <input type="nama" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Cost Account" required>
                            <span id="nama" class="help-block" > {{ $errors->first('nama') }} </span>
                        </div>
                        <div class="form-group">
                            <label for="nama">Approved By</label>
                            <select name="approved" id="approved" class="form-control select2">
                                {{-- <option disabled>Select approved by</option> --}}
                                @foreach($employee as $emp)
                                    <option value="{{$emp->nik}}">{{$emp->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama">Category</label>
                            <select name="chart_timesheet" id="chart_timesheet" class="form-control select2">
                                <option value="HO">HO</option>
                                <option value="Proposal">Proposal</option>
                                <option value="Project">Project</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
	                      <a href="{{url('cost-account')}}" class="btn btn-danger">Cancel</a>
	              
                </form>
                </div>
            </div>
    </div>  
    <!-- Main content -->
    <section class="content">
     
    @endsection
    @push('script')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script type="text/javascript" >
    function reset(){
        $('.select2').val(null).trigger('change');
    }

//Initialize Select2 Elements
    $('.select2').select2()

</script>
@endpush

   
