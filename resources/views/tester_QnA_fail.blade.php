@extends('layouts.app')

@section('content')
<style>
    .hiddenField{
        display:none;
    }
</style>

@section('content')

    {{-- <div class="container-fluid">
        <div class="row">
            <main class="col-md-12 px-md-4">

                <div class="card-main main-content">
                <div class=" d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-5">
                    <section class="main-header grid ">
                        <h1>QnA Fail Tickets</h1>
                        <!-- <button-main class="button-main">
                          <i class="fa-solid fa-plus"></i>
                          <span>Add new user</span>
                        </button-main> -->
                    </section>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <!-- Example single danger button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Filter By
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Date</a></li>
                                <li><a class="dropdown-item" href="#">Client Name</a></li>
                                <li><a class="dropdown-item" href="#">Open</a></li>
                                <li><a class="dropdown-item" href="#">Close</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

             
                <div class="table-responsive">
                    <table class="table data-table">
                        <thead>
                            <tr>
                                <th scope="col">TICKET ID</th>
                                <th scope="col">COMPANY ID</th>
                                <th scope="col">BRANCH ID</th>
                                <th scope="col">BRANCH CODE</th>
                                <th scope="col">COMPANY NAME</th>
                                <th scope="col">BRANCH NAME</th>
                                <th scope="col">SUPPORT TYPE</th>
                                <th scope="col">PRODUCT</th>
                                <th scope="col">SERVICE</th>
                                <th scope="col">EXEC NAME</th>
                                <th scope="col">EXEC EMAIL</th>
                                <th scope="col">EXEC NUMBER</th>
                                <th scope="col">RAISED AT</th>
                                <th scope="col">TICKET LEAD</th>
                                <th scope="col">ASSIGNED TO</th>
                                <th class="hiddenField" scope="col">ASSIGNEE ID</th>
                                <th scope="col">TESTER ASSIGNED</th>
                                <th class="hiddenField" scope="col">TESTER ASSIGNED ID</th>
                                <th scope="col">PRIORITY</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
              
                        <tbody>
                        
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div> --}}

    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">My QnA</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Quality & Assurance Failed</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Quality & Assurance Failed</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="" class="customdatatable display min-w850">
                                <thead>
                                    <tr>
                                        <th scope="col">TICKET ID</th>
                                        <th scope="col">COMPANY ID</th>
                                        <th scope="col">BRANCH ID</th>
                                        <th scope="col">BRANCH CODE</th>
                                        <th scope="col">COMPANY NAME</th>
                                        <th scope="col">BRANCH NAME</th>
                                        <th scope="col">SUPPORT TYPE</th>
                                        <th scope="col">PRODUCT</th>
                                        <th scope="col">SERVICE</th>
                                        <th scope="col">EXEC NAME</th>
                                        <th scope="col">EXEC EMAIL</th>
                                        <th scope="col">EXEC NUMBER</th>
                                        <th scope="col">RAISED AT</th>
                                        <th scope="col">TICKET LEAD</th>
                                        <th scope="col">DEPARTMENT</th>
                                        <th scope="col">ASSIGNED TO</th>
                                        <th class="hiddenField" scope="col">ASSIGNEE ID</th>
                                        <th scope="col">TESTER ASSIGNED</th>
                                        <th class="hiddenField" scope="col">TESTER ASSIGNED ID</th>
                                        <th scope="col">PRIORITY</th>
                                        <th scope="col">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="col">TICKET ID</th>
                                        <th scope="col">COMPANY ID</th>
                                        <th scope="col">BRANCH ID</th>
                                        <th scope="col">BRANCH CODE</th>
                                        <th scope="col">COMPANY NAME</th>
                                        <th scope="col">BRANCH NAME</th>
                                        <th scope="col">SUPPORT TYPE</th>
                                        <th scope="col">PRODUCT</th>
                                        <th scope="col">SERVICE</th>
                                        <th scope="col">EXEC NAME</th>
                                        <th scope="col">EXEC EMAIL</th>
                                        <th scope="col">EXEC NUMBER</th>
                                        <th scope="col">RAISED AT</th>
                                        <th scope="col">TICKET LEAD</th>
                                        <th scope="col">DEPARTMENT</th>
                                        <th scope="col">ASSIGNED TO</th>
                                        <th class="hiddenField" scope="col">ASSIGNEE ID</th>
                                        <th scope="col">TESTER ASSIGNED</th>
                                        <th class="hiddenField" scope="col">TESTER ASSIGNED ID</th>
                                        <th scope="col">PRIORITY</th>
                                        <th scope="col">STATUS</th>
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
        ajax: "{{ url('QnAfailTickets') }}",
        columns: [
            {data: 'ticket_id', name: 'ticket_id',class:"ticket_id"},
            {data: 'company_id', name: 'company_id', class:"company_id"},
            {data: 'branch_id', name: 'branch_id', class:"branch_id"},
            {data: 'branch_code', name: 'branch_code', class:"branch_code"},
            {data: 'company_name', name: 'company_name',class:"company_name"},
            {data: 'branch_name', name: 'branch_name',class:"branch_name"},
            {data: 'support_type', name: 'support_type',class:"support_type"},
            {data: 'product', name: 'product',class:"product"},
            {data: 'service', name: 'service',class:"service"},
            {data: 'exec_name', name: 'exec_name',class:"exec_name"},
            {data: 'exec_email', name: 'exec_email',class:"exec_email"},
            {data: 'exec_number', name: 'exec_number',class:"exec_number"},
            
            {data: 'created_at', name: 'created_at',class:"ticket_raised"},
          
            {   
                defaultContent: "",
                data: "ticket_lead",
                class:"ticket_lead ",
                id:"ticket_lead",
                render: function (data, type, row, meta) {
                    var badge = '';
                    if (row != null) {
                        badge = '<span class="badge badge-secondary m-1">'+data+'</span>';
                    }
                    else {
                        badge = '<span class="badge badge-secondary m-1">Ticket Lead</span>';
                    }
                    return badge;
                }
            },
            {data: 'department', name: 'department',class:"department"},
            {data: 'assign_to', name: 'assign_to',class:"assign_to"},
            {data: 'assign_to_id', name: 'assign_to_id',class:"hiddenField assign_to_id"},
            
            {data: 'assigned_tester', name: 'assigned_tester',class:"assigned_tester"},
            {data: 'assigned_tester_id', name: 'assigned_tester_id',class:"hiddenField assigned_tester_id"},
            {       
                defaultContent: "",
                data: "priority",
                class:"priority",
                render: function (data, type, row, meta) {
                    var badge = '';
                    if (row != null) {
                        badge = '<span class="badge badge-primary m-1">'+data+'</span>';
                    }
                    else {
                        badge = '<span class="badge badge-primary m-1">Priority</span>';
                    }
                    return badge;
                }
            },
           
            {data: 'status', name: 'status',class:"status"},
            // {data: 'update', name: 'update'},
        ]
        });
    
    });

</script>

@endsection