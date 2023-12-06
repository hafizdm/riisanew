@extends('templates.header')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <span class="fonts header-style">
        <b>Add Scope of Approval</b>
    </span>
    <ol class="breadcrumb">
      <li><a href="{{url("")}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><a href="#">Scope of work</a></li>
      
    </ol>
  </section>
  <br>
    <div class="container">
        <div class="row">
                <div class="col-lg-6">
                <form role="form" name="formdata" method="post" action="{{url("scope-approval/store")}}">
                        {{csrf_field()}}   
                        
                        <div class="form-group">
                            <label for="category_name">Scope of Name</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Masukkan Nama Cost Account" required>
                        </div>
                        <div class="form-group">
                            <label for="approver_employee_id">Approved By</label>
                            <select name="approver_employee_id" id="approver_employee_id" class="form-control select2">
                                {{-- <option disabled>Select approved by</option> --}}
                                
                                @foreach($employee as $emp)
                                    <option value="{{$emp->id}}">{{$emp->nama}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="budget_type">Category Budget</label>
                            <select name="budget_type" id="budget_type" class="form-control select2">
                                <option value="1">HO</option>
                                <option value="2">Project</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
	                      <a href="{{url('scope-approval')}}" class="btn btn-danger">Cancel</a>
	              
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

   
