@extends('templates.header')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <span class="fonts header-style">
        <b>Tambah Data Resource</b>
    </span>
    <ol class="breadcrumb">
      <<li><a href="{{url("")}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{url("barang")}}">Resource</a></li>
      <li class="active"><a href="#">Tambah Data</a></li>
    </ol>
  </section>
  <br>
    <div class="container">
        <div class="row">
                <div class="col-lg-6">
                <form role="form" name="formdata" method="post" action="{{url("resource/store")}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="nama">Nama Resource</label>
                            <input type="nama" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama resource" required>
                            <span id="nama" class="help-block" > {{ $errors->first('nama') }} </span>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
	                    <a href="{{url('resource')}}" class="btn btn-danger">Batal</a>
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
// $('.select2').select2()

</script>
@endpush

   
