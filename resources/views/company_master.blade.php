@extends('layouts.app')

@section('content')
    
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Masters</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Company Master</a></li>
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
                        <h4 class="card-title"><i class="fa-regular fa-rectangle-list mr-3"></i>Company Master</h4>
                        <div class="btn-toolbar mb-2 mb-md-0 mx-5">
                            <div class="btn-group">
                                <a href="{{url('companyregister')}}"><button type="button" class="btn light btn-success .btn-rounded ">+ Add Company</button></a>  
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="" class="customdatatable display min-w850">
                                <thead>
                                    <tr>
                                        <th scope="col">COMPANY ID</th>
                                        <th scope="col">COMPANY NAME</th>
                                        <th scope="col">COMPANY ADDRESS</th>
                                        <th scope="col">COMPANY CITY</th>
                                        <th scope="col">COMPANY GST</th>
                                        <th scope="col">CONTACT PERSON NAME</th>
                                        <th scope="col">CONTACT PERSON NUMBER</th>
                                        <th scope="col">CONTACT PERSON EMAIL</th>
                                        <th scope="col">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="col">COMPANY ID</th>
                                        <th scope="col">COMPANY NAME</th>
                                        <th scope="col">COMPANY ADDRESS</th>
                                        <th scope="col">COMPANY CITY</th>
                                        <th scope="col">COMPANY GST</th>
                                        <th scope="col">CONTACT PERSON NAME</th>
                                        <th scope="col">CONTACT PERSON NUMBER</th>
                                        <th scope="col">CONTACT PERSON EMAIL</th>
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
        ajax: "{{ url('companymaster') }}",
        columns: [
            {data: 'id', name: 'id',class:"company_id"},
            {data: 'company_name', name: 'company_name', class:"company_name    "},
            {data: 'company_address', name: 'company_address',class:"company_address",},
            {data: 'city', name: 'company_city',class:"company_city",},
            {data: 'gst_number', name: 'gst_number',class:"gst_number"},
            {data: 'contactperson_name', name: 'contactperson_name',class:"contactperson_name"},
            {data: 'contactperson_number', name: 'contactperson_number',class:"contactperson_number"},
            {data: 'contactperson_email', name: 'contactperson_email',class:"contactperson_email"},
          
            {data: 'action', name: 'action'},
        ]
        });
    
    });
</script>

@endsection