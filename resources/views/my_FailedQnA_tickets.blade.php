@extends('layouts.app')

@section('content')
<style>
    .hiddenField{
        display:none;
    }
</style>

@section('content')

    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">My Tickets</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">My Failed Quality & Assurance Tickets</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">My Failed Quality & Assurance Tickets</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="" class="customdatatable display min-w850">
                                <thead>
                                    <tr>
                                        <th scope="col">TICKET ID</th>
                                        {{-- <th class="hiddenField" scope="col">COMPANY ID</th>
                                        <th class="hiddenField" scope="col">BRANCH ID</th>
                                        <th class="hiddenField" scope="col">BRANCH CODE</th> --}}
                                        <th scope="col">COMPANY NAME</th>
                                        <th scope="col">BRANCH NAME</th>
                                        <th scope="col">SUPPORT TYPE</th>
                                        <th scope="col">PRODUCT</th>
                                        <th scope="col">SERVICE</th>
                                        <th scope="col">CUSTOMER NAME</th>
                                        <th scope="col">CUSTOMER EMAIL</th>
                                        <th scope="col">CUSTOMER NUMBER</th>
                                        <th scope="col">RAISED AT</th>
                                        <th scope="col">TICKET LEAD</th>
                                        <th scope="col">DEPARTMENT</th>
                                        <th scope="col">ASSIGNED TO</th>
                                        <th class="hiddenField" scope="col">ASSIGNEE ID</th>
                                        <th scope="col">PRIORITY</th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col">ASSIGNED TESTER</th>
                                        <th scope="col">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="col">TICKET ID</th>
                                        {{-- <th class="hiddenField" scope="col">COMPANY ID</th>
                                        <th class="hiddenField" scope="col">BRANCH ID</th>
                                        <th class="hiddenField" scope="col">BRANCH CODE</th> --}}
                                        <th scope="col">COMPANY NAME</th>
                                        <th scope="col">BRANCH NAME</th>
                                        <th scope="col">SUPPORT TYPE</th>
                                        <th scope="col">PRODUCT</th>
                                        <th scope="col">SERVICE</th>
                                        <th scope="col">CUSTOMER NAME</th>
                                        <th scope="col">CUSTOMER EMAIL</th>
                                        <th scope="col">CUSTOMER NUMBER</th>
                                        <th scope="col">RAISED AT</th>
                                        <th scope="col">TICKET LEAD</th>
                                        <th scope="col">DEPARTMENT</th>
                                        <th scope="col">ASSIGNED TO</th>
                                        <th class="hiddenField" scope="col">ASSIGNEE ID</th>
                                        <th scope="col">PRIORITY</th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col">ASSIGNED TESTER</th>
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
        ajax: "{{ url('myFailedQnAtickets') }}",
        columns: [
            {data: 'ticket_id', name: 'ticket_id',class:"ticket_id"},
            // {data: 'company_id', name: 'company_id', class:"company_id hiddenField"},
            // {data: 'branch_id', name: 'branch_id', class:"branch_id hiddenField"},
            // {data: 'branch_code', name: 'branch_code', class:"branch_code hiddenField"},
            {data: 'company_name', name: 'company_name',class:"company_name"},
            {data: 'branch_name', name: 'branch_name',class:"branch_name"},
            {data: 'support_type', name: 'support_type',class:"support_type"},
            {data: 'product', name: 'product',class:"product"},
            {data: 'service', name: 'service',class:"service"},
            {data: 'exec_name', name: 'exec_name',class:"exec_name"},
            {data: 'exec_email', name: 'exec_email',class:"exec_email"},
            {data: 'exec_number', name: 'exec_number',class:"exec_number"},
            
            {data: 'created_at', name: 'created_at',class:"ticket_raised"},
          
            {data: 'ticket_lead', name: 'ticket_lead',class:"ticket_lead"},
            {data: 'department', name: 'department',class:"department"},
            {data: 'assign_to', name: 'assign_to',class:"assign_to"},
            {data: 'assign_to_id', name: 'assign_to_id',class:"hiddenField assign_to_id"},
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
                        badge = '<span class="badge badge-warning m-1">Priority</span>';
                    }
                    return badge;
                }
            },
            {data: 'status', name: 'status',class:"status"},
            {data: 'assigned_tester', name: 'assigned_tester',class:"assigned_tester"},
            {data: 'update', name: 'update',class:"update"},
        ]
        });
    
    });

    $('body').on('click', '.update', function (e) {
        e.preventDefault();
        var formData = {
            ticket_id: $(this).closest("tr").find(".ticket_id").text(),
            status:"3",

        };

        $.ajax({
            type:'post',
            url:"{{ url('myticket/update') }}",
            data:formData,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            success:function(data){
                if(data!=null){
                    console.log(data);
                    alert("Wow! Ticket Pushed");
                    location.reload();
                }else{
                    alert("error");
                }
            }
        });
        
   });

</script>

@endsection