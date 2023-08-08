@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Permissions List</a></li>
        </ol>
    </div>
     
    @if (\Session::has('msg'))
    <div class="alert alert-success alert-dismissible fade show">
        <ul>
            <li>{!! \Session::get('msg') !!}</li>
        </ul>
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
        </button>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Permissions List</h4>
                    <div class="btn-toolbar mb-2 mb-md-0 mx-5">
                        <div class="btn-group">
                            <a href="{{route('registerpermission')}}"><button type="button" class="btn btn-outline-success .btn-rounded ">+ Add Permission</button></a>  
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="" class="customdatatable display min-w850">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                      <th scope="col">Name</th>
                                      <th scope="col">Action</th>
                                  </tr>
                            </thead>
                            <tbody>
            
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    $(document).ready(function () {
      
      var table = $('.customdatatable').DataTable({
        processing: true,
        // oLanguage: {
        // oPaginate: {
        //     sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
        //     sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
        //   }
        // },
        serverSide: true,
        ajax: "{{ url('permissionmaster') }}",
          // success:function(data){
          //         if(data!=null){
          //             console.log(data);
          //         }else{
          //             console.log(data.error);
          //         }
          //     },
          columns: [
              {data: 'id', name: 'id',class:"id"},
              {data: 'name', name: 'name',class:"name"},
              {data: 'action', name: 'action'},
          ]
      });
  
    });
  
</script>
@endsection