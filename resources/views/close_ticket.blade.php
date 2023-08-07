@extends('layouts.app')

@section('content')
<style>
    .hiddenField{
        display:none;
    }
</style>

<div class="container-fluid">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Active Tickets</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Closed Tickets</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Closed Tickets</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="" class="customdatatable display min-w850">
                            <thead>
                                <tr>
                                    <th scope="col">TICKET ID</th>
                                    {{-- <th class="hiddenField" scope="col">COMPANY ID</th>
                                    <th class="hiddenField"scope="col">BRANCH ID</th>
                                    <th scope="col">BRANCH CODE</th> --}}
                                    <th scope="col">COMPANY NAME</th>
                                    <th scope="col">BRANCH NAME</th>
                                    <th scope="col">SUPPORT TYPE</th>
                                    <th scope="col">PRODUCT</th>
                                    <th scope="col">SERVICE</th>
                                    <th scope="col">CUSTOMER NAME</th>
                                    <th scope="col">CUSTOMER EMAIL</th>
                                    <th scope="col">CUSTOMER NUMBER</th>
                                    {{-- <th scope="col">ISSUE TYPE</th> --}}
                                    <th scope="col">ISSUE RAISED </th>
                                    <th scope="col">TICKET CREATED</th>
                                    <th scope="col">TICKET LEAD</th>
                                    <th class="hiddenField" scope="col">TICKET LEAD ID</th>
                                    <th scope="col">DEPARTMENT</th>
                                    <th class="hiddenField" scope="col">DEPARTMENT ID</th>
                                    <th scope="col">ASSIGNED TO</th>
                                    <th class="hiddenField" scope="col">ASSIGNED TO ID</th>
                                    <th scope="col">ASSIGNED TESTER</th>
                                    <th class="hiddenField" scope="col">ASSIGNED TESTER ID</th>
                                    <th scope="col">CURRENT STATUS</th>
                                    <th scope="col">PRIORITY</th> 
                                    <th scope="col">TICKET ACTION</th> 
                                </tr>
                            </thead>
                            <tbody>
            
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col">TICKET ID</th>
                                    {{-- <th class="hiddenField" scope="col">COMPANY ID</th>
                                    <th class="hiddenField"scope="col">BRANCH ID</th>
                                    <th scope="col">BRANCH CODE</th> --}}
                                    <th scope="col">COMPANY NAME</th>
                                    <th scope="col">BRANCH NAME</th>
                                    <th scope="col">SUPPORT TYPE</th>
                                    <th scope="col">PRODUCT</th>
                                    <th scope="col">SERVICE</th>
                                    <th scope="col">CUSTOMER NAME</th>
                                    <th scope="col">CUSTOMER EMAIL</th>
                                    <th scope="col">CUSTOMER NUMBER</th>
                                    {{-- <th scope="col">ISSUE TYPE</th> --}}
                                    <th scope="col">ISSUE RAISED </th>
                                    <th scope="col">TICKET CREATED</th>
                                    <th scope="col">TICKET LEAD</th>
                                    <th class="hiddenField" scope="col">TICKET LEAD ID</th>
                                    <th scope="col">DEPARTMENT</th>
                                    <th class="hiddenField" scope="col">DEPARTMENT ID</th>
                                    <th scope="col">ASSIGNED TO</th>
                                    <th class="hiddenField" scope="col">ASSIGNED TO ID</th>
                                    <th scope="col">ASSIGNED TESTER</th>
                                    <th class="hiddenField" scope="col">ASSIGNED TESTER ID</th>
                                    <th scope="col">CURRENT STATUS</th>
                                    <th scope="col">PRIORITY</th> 
                                    <th scope="col">TICKET ACTION</th> 
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
    serverSide: true,
    ajax: "{{ url('CloseTicket') }}",
    columns: [
        {data: 'ticket_id', name: 'ticket_id',class:"ticket_id"},
        // {data: 'company_id', name: 'company_id', class:"hiddenField company_id"},
        // {data: 'branch_id', name: 'branch_id', class:"hiddenField branch_id"},
        // {data: 'branch_code', name: 'branch_code', class:"branch_code"},
        {data: 'company_name', name: 'company_name',class:"company_name"},
        {data: 'branch_name', name: 'branch_name',class:"branch_name"},
        {data: 'support_type', name: 'support_type',class:"support_type"},
        {data: 'product', name: 'product',class:"product"},
        {data: 'service', name: 'service',class:"service"},
        {data: 'exec_name', name: 'exec_name',class:"exec_name"},
        {data: 'exec_email', name: 'exec_email',class:"exec_email"},
        {data: 'exec_number', name: 'exec_number',class:"exec_number"},
        // {data: 'issue_type', name: 'issue_type',class:"issue_type"},
        {data: 'ticket_raised', name: 'ticket_raised',class:"ticket_raised",},
        {data: 'created_at', name: 'created_at',class:"ticket_created",},

        {data: 'ticket_lead_name', name: 'ticket_lead_name',class:"ticket_lead_name"},
        {data: 'ticket_lead', name: 'ticket_lead_id',class:"hiddenField ticket_lead_id"},

        {data: 'department_name', name: 'department_name',class:"department_name"},
        {data: 'department', name: 'department_id',class:"hiddenField department_id"},

        {data: 'assign_to', name: 'assign_to',class:"assign_to"},
        {data: 'assign_to_id', name: 'assign_to_id',class:"hiddenField assign_to_id"},

        {data: 'assigned_tester', name: 'assigned_tester',class:"assigned_tester"},
        {data: 'assigned_tester_id', name: 'assigned_tester_id',class:"hiddenField assigned_tester_id"},
        {data: 'status', name: 'status',class:"status"},
        
        
        {       
            defaultContent: "",
            data: "priority",
            class:"priority",
            render: function (data, type, row, meta) {
                var dropdown = '';
                if (row != null) {
                    dropdown += '<select class="btn btn-primary dropdown-toggle">';
                    dropdown += '<option value="'+data+'">'+data+'</option>';
                    dropdown += '<option value="Low">Low</option>';
                    dropdown += '<option value="Medium">Medium</option>';
                    dropdown += '<option value="High">High</option>';
                    dropdown += '</select>';
                }
                else {
                    dropdown = '<select class="btn btn-primary dropdown-toggle"><option value="'+data+'">'+data+'</option></select>';
                }
                return dropdown;
            }
        },
      
        {data: 'update', name: 'update'},

    ]

    });

});

$('body').on('click', '.update', function (e) {
    e.preventDefault();
    var formData = {
        ticket_id: $(this).closest("tr").find(".ticket_id").text(),
        ticket_lead: $(this).closest("tr").find(".ticket_lead_id").text(),
        department: $(this).closest("tr").find(".department_id").text(),
        assign_to: $(this).closest("tr").find(".assign_to_id").text(),
        assigned_tester: $(this).closest("tr").find(".assigned_tester_id").text(),
        priority: $(this).closest("tr").find(".priority").find(":selected").val(),
        status:"1",
    };
       
    $.ajax({
        type:'post',
        url:"{{ url('ticket/update') }}",
        data:formData,
        dataType: 'json',
        success:function(data){
            console.log(formData);
            if(data!=null){
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
