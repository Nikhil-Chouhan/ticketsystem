@extends('layouts.app')

@section('content')

@section('content')

    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Masters</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Service Master</a></li>
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
        
        @if (\Session::has('redalert'))
            <div class="alert alert-danger alert-dismissible fade show">
                <ul>
                    <li>{!! \Session::get('redalert') !!}</li>
                </ul>
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fa-regular fa-rectangle-list mr-3"></i>Service Master</h4>
                        <div class="btn-toolbar mb-2 mb-md-0 mx-5">
                            <div class="btn-group">
                                <a href="{{url('serviceregister')}}"><button type="button" class="btn light btn-success .btn-rounded ">+ Add Service</button></a>  
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="" class="customdatatable display min-w850">
                                <thead>
                                    <tr>
                                        <th scope="col">SERVICE ID</th>
                                        <th scope="col">SERVICE NAME</th>
                                        <th scope="col">SERVICE DESCRIPTION</th>
                                        <th scope="col">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="col">SERVICE ID</th>
                                        <th scope="col">SERVICE NAME</th>
                                        <th scope="col">SERVICE DESCRIPTION</th>
                                        <th scope="col">ACTION</th>
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
        ajax: "{{ url('servicemaster') }}",
        columns: [
            {data: 'id', name: 'id',class:"service_id"},
            {data: 'service_name', name: 'service_name', class:"service_name    "},
            {data: 'service_description', name: 'service_description',class:"service_description",},
            {data: 'action', name: 'action'},
        ]
        });
    
    });
</script>

@endsection