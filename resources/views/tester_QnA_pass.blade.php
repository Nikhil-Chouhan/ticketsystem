@extends('layouts.app')

@section('content')
<style>
    .hiddenField{
        display:none;
    }
</style>

@section('content')

    <div class="container-fluid">
        <div class="row">
            <main class="col-md-12 px-md-4">

                <div class="card-main main-content">
                <div class=" d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-5">
                    <section class="main-header grid ">
                        <h1>QnA Pass Tickets</h1>
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
                                {{-- <th scope="col">ACTION</th> --}}
                            </tr>
                        </thead>
              
                        <tbody>
                        
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).ready(function () {
    
        var table = $('.data-table').DataTable({
        processing: true,
        oLanguage: {
        oPaginate: {
            sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
            sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
          }
        },
        serverSide: true,
        ajax: "{{ url('QnAPassTickets') }}",
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
            {       
                defaultContent: "",
                data: "status",
                class:"status",
                render: function (data, type, row, meta) {
                    var badge = '';
                    if (row != null) {
                        badge='<span class="badge badge-warning m-1">'+data+'</span>';
                    }
                    else {
                        badge='<span class="badge badge-warning m-1">status</span>';
                    }
                    return badge;
                }
            },
            
            // {data: 'update', name: 'update'},
        ]
        });
    
    });

    $('body').on('click', '.update', function (e) {
        e.preventDefault();
        var formData = {
            ticket_id: $(this).closest("tr").find(".ticket_id").text(),
            status: $(this).closest("tr").find(".status").find(":selected").text(),
        };

        $.ajax({
            type:'post',
            url:"{{ url('myticket/update') }}",
            data:formData,
            dataType: 'json',
            success:function(data){
                if(data!=null){
                    console.log(data);
                    alert("SUCCESS");
                    location.reload();
                }else{
                    alert(data.error);
                }
            }
        });
        
   });

</script>

@endsection