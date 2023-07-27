@extends('layouts.app')

@section('content')
<style>
    .hiddenField{
        display:none;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <main class="col-md-12 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Closed Tickets</h1>
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

            <div class="table-responsive card-main">
                <table class="table data-table">
                    <thead>
                        <tr>
                            <th scope="col">TICKET ID</th>
                            <th class="hiddenField" scope="col">COMPANY ID</th>
                            <th class="hiddenField"scope="col">BRANCH ID</th>
                            <th scope="col">BRANCH CODE</th>
                            <th scope="col">COMPANY NAME</th>
                            <th scope="col">BRANCH NAME</th>
                            <th scope="col">SUPPORT TYPE</th>
                            <th scope="col">PRODUCT</th>
                            <th scope="col">SERVICE</th>
                            <th scope="col">EXEC NAME</th>
                            <th scope="col">EXEC EMAIL</th>
                            <th scope="col">EXEC NUMBER</th>
                            {{-- <th scope="col">ISSUE TYPE</th> --}}
                            <th scope="col">ISSUE RAISED </th>
                            <th scope="col">TICKET CREATED</th>
                            <th scope="col">TICKET LEAD</th>
                            <th class="hiddenField" scope="col">TICKET LEAD ID</th>
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
    serverSide: true,
    ajax: "{{ url('CloseTicket') }}",
    columns: [
        {data: 'ticket_id', name: 'ticket_id',class:"ticket_id"},
        {data: 'company_id', name: 'company_id', class:"hiddenField company_id"},
        {data: 'branch_id', name: 'branch_id', class:"hiddenField branch_id"},
        {data: 'branch_code', name: 'branch_code', class:"branch_code"},
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

        {data: 'ticket_lead', name: 'ticket_lead',class:"ticket_lead"},
        {data: 'ticket_lead_id', name: 'ticket_lead_id',class:"hiddenField ticket_lead_id"},

        {data: 'assign_to', name: 'assign_to',class:"assign_to"},
        {data: 'assign_to_id', name: 'assign_to_id',class:"hiddenField assign_to_id"},

        {data: 'assigned_tester', name: 'assigned_tester',class:"assigned_tester"},
        {data: 'assigned_tester_id', name: 'assigned_tester_id',class:"hiddenField assigned_tester_id"},
        
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
                    badge='<span class="badge badge-warning m-1">'+data+'</span>';
                }
                return badge;
            }
        },
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
        assign_to: $(this).closest("tr").find(".assign_to_id").text(),
        assigned_tester: $(this).closest("tr").find(".assigned_tester_id").text(),
        priority: $(this).closest("tr").find(".priority").find(":selected").val(),
        status:"Open",
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
