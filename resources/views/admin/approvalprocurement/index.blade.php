@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <span class="fonts header-style">
        <b>Data Scope of Work</b>
    </span>
    <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="{{url('cost-account')}}">Scope of Work </a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-body">
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

            {{-- sub menu  --}}
             <div style="margin-bottom: 20px">
                <a href="{{url('scope-approval/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add Scope of Work</a>
            </div> 
            {{-- end of sub menu  --}}

            {{-- table data of car  --}}
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Scope of Work </th>
                            <th>Approved By</th>
                            <th>Type Budget</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $k => $d)
                        <tr>
                            <td>{{$k + 1}}</td>
                            <td>{{$d->category_name}}</td>
                            <td>{{$d->employee->nama}}</td>
                            <td>
                                @if ($d->budget_type == 1)
                                Head Office
                            @elseif($d->budget_type == 2)
                                Project
                            @else
                            @endif
                            </td>
                            
                            <td>
                                <a href="{{route('edit-category', $d)}}" class="btn btn-warning btn-xs"><span class='glyphicon glyphicon-pencil'></span></a>
                                <button class='btn btn-xs btn-danger delete' data-id="{{$d->id}}"><span class='glyphicon glyphicon-trash'></span></button></td>
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
            {{-- end of car data  --}}
        </div>
        <!-- /.box-body -->
        <div class="box-footer"></div>
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
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
<!-- end of modal konfirmasi -->
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
    $("#konfirmasi-body").text("Are you sure for remove this?");
  });

  $('#confirm-delete').click(function(){
      var deleteButton = $(this);
      var id           = deleteButton.data("id");

      deleteButton.button('loading');

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax(
      {
        url: "scope-approval/"+id,
        type: 'POST',
        dataType: "JSON",
        data: {
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
});
</script>
@endpush


