@extends('layouts.app')

@section('content')

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
                            <th scope="col">PROJECT NAME</th>
                            <th scope="col">CLIENT NAME</th>
                            <th scope="col">EXEC NAME</th>
                            <th scope="col">EXEC EMAIL</th>
                            <th scope="col">EXEC NUMBER</th>
                            <th scope="col">ISSUE TYPE</th>
                            <th scope="col">ISSUE RAISED </th>
                            <th scope="col">TICKET CREATED</th>
                            <th scope="col">TICKET LEAD</th>
                            <th scope="col">ASSIGNED TO</th>
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
        {data: 'project_name', name: 'project_name',class:"project_name",},
        {data: 'client_name', name: 'client_name',class:"client_name",},
        {data: 'exec_name', name: 'exec_name',class:"exec_name"},
        {data: 'exec_email', name: 'exec_email',class:"exec_email"},
        {data: 'exec_number', name: 'exec_number',class:"exec_number"},
        {data: 'issue_type', name: 'issue_type',class:"issue_type"},
        {data: 'ticket_raised', name: 'ticket_raised',class:"ticket_raised",},
        {data: 'created_at', name: 'created_at',class:"ticket_created",},
        {   
            defaultContent: "",
            data: "ticket_lead",
            class:"ticket_lead",
            render: function (data, type, row, meta) {
                var dropdown = '';
                if (row != null) {
                    dropdown += '<select class="btn btn-secondary dropdown-toggle">';
                    dropdown += '<option value="'+data+'">'+data+'</option>';
                    dropdown += '<option value="Prachi">Prachi</option>';
                    dropdown += '<option value="Asmita">Asmita</option>';
                    dropdown += '<option value="Akhila">Akhila</option>';
                    dropdown += '</select>';
                }
                else {
                    dropdown = '<select class="btn btn-secondary dropdown-toggle"><option value="data">'+data+'</option></select>';
                }
                return dropdown;
            }
        },

        {   
            defaultContent: "",
            data: "assign_to",
            class:"assign_to",
            render: function (data, type, row, meta) {
                var dropdown = '';
                if (row != null) {
                    dropdown += '<select class="btn btn-info dropdown-toggle">';
                    dropdown += '<option value="'+data+'">'+data+'</option>';
                    dropdown += '<option value="Dipak">Dipak</option>';
                    dropdown += '<option value="Prasad">Prasad</option>';
                    dropdown += '<option value="Lokesh">Lokesh</option>';
                    dropdown += '</select>';
                }
                else {
                    dropdown = '<select class="btn btn-info dropdown-toggle"><option value="0">'+data+'</option></select>';
                }
                return dropdown;
            }
        },
        {       
            defaultContent: "",
            data: "status",
            class:"status",
            render: function (data, type, row, meta) {
                var dropdown = '';
                if (row != null) {
                    dropdown += '<select class="btn btn-warning dropdown-toggle">';
                    dropdown += '<option value="'+data+'">'+data+'</option>';
                    dropdown += '<option value="Open">Open</option>';
                    dropdown += '<option value="Close">Close</option>';
                    dropdown += '<option value="WorkinProgress">Work in Progress</option>';
                    dropdown += '</select>';
                }
                else {
                    dropdown = '<select class="btn btn-warning dropdown-toggle"><option value="'+data+'">'+data+'</option></select>';
                }
                return dropdown;
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
                    dropdown += '<option value="Open">High</option>';
                    dropdown += '<option value="Close">Low</option>';
                    dropdown += '<option value="Medium">Medium</option>';
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
        ticket_lead: $(this).closest("tr").find(".ticket_lead").find(":selected").text(),
        assign_to: $(this).closest("tr").find(".assign_to").find(":selected").text(),
        status: $(this).closest("tr").find(".status").find(":selected").text(),
        priority: $(this).closest("tr").find(".priority").find(":selected").text(),
        
    };
       
    $.ajax({
        type:'post',
        url:"{{ url('UpdateTicket') }}",
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
