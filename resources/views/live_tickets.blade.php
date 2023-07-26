@extends('layouts.app')

@section('content')
<style>
    .hiddenField{
        display:none;
    }
    .drop{
        display: inline-block;
    }
</style>

<style>
    /* sidebar css start here */
    #sidebarMenu .nav-item{
        background-color: #a48a29 !important;
    }
    #sidebarMenu .nav-item:hover{
        background-color: #174368 !important;
    }
    /* sidebar css end here */    
</style>

@section('content')
    <div class="container-fluid">
        <div class="row">
            <main class="col-md-12 px-md-4">
            <div class="card-main">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                    <h1 class="h2">Live Tickets</h1>
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
                                <th scope="col">ASSIGN TO</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">PRIORITY</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                        </tbody>
                        
                    </table>
                </div>
            </div>
            <div class="card-main">
                <div class="container-fluid mb-3">
                    <div class="drop dropdown">
                        <select id="assignee" class="ticket_lead btn btn-info dropdown-toggle" >
                            <option value="">Assignee</option>
                            <option value="Dipak">Dipak</option>
                            <option value="Prasad">Prasad</option>
                            <option value="Lokesh">Lokesh</option>
                        </select>
                    </div>
                    
                    <div class="drop dropdown">
                        <select id="ticketlead" class="ticket_lead btn btn-secondary dropdown-toggle" >
                            <option value="">Ticket Lead</option>
                            <option value="Prachi">Prachi</option>
                            <option value="Asmita">Asmita</option>
                            <option value="Akhila">Akhila</option>
                        </select>
                    </div>
                    <button type="submit" id="btnsubmit" class="btnsubmit drop btn btn-success">Submit</button>
                </div>
                
                <div class="table2 table-responsive mt-3">
                    <table class="table data-table2">
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
                                <th scope="col">TICKET CREATED AT</th>
                                <th scope="col">TICKET LEAD</th>
                                <th scope="col">ASSIGN TO</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">PRIORITY</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                        </tbody>
                        
                    </table>
                </div>
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

    var table2;
    $(document).ready(function () {
        $('.table2').hide();
        $('.data-table2').hide();
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('livetickets') }}",
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
                    class:"ticket_lead",
                    id:"ticket_lead",
                    render: function (data, type, row, meta) {
                        var dropdown = '';
                        if (row != null) {
                            dropdown += '<select class="ticket_lead btn btn-secondary dropdown-toggle" >';
                            dropdown += '<option value="'+data+'">'+data+'</option>';
                            dropdown += '<option value="Prachi">Prachi</option>';
                            dropdown += '<option value="Asmita">Asmita</option>';
                            dropdown += '<option value="Akhila">Akhila</option>';
                            dropdown += '</select>';
                        }
                        else {
                            dropdown = '<select class="btn btn-secondary dropdown-toggle"><option value="0">Ticket Lead</option></select>';
                        }
                        return dropdown;
                    }
                },
                {data: 'assign_to', name: 'assign_to',class:"assign_to"},
                // {   
                //     defaultContent: "",
                //     data: "assign_to",
                //     class:"assign_to",
                //     render: function (data, type, row, meta) {
                //         var dropdown = '';
                //         if (row != null) {
                //             dropdown += '<select class="btn btn-info dropdown-toggle">';
                //             dropdown += '<option value="'+data+'">'+data+'</option>';
                //             dropdown += '<option value="Dipak">Dipak</option>';
                //             dropdown += '<option value="Prasad">Prasad</option>';
                //             dropdown += '<option value="Lokesh">Lokesh</option>';
                //             dropdown += '</select>';
                //         }
                //         else {
                //             dropdown = '<select class="btn btn-info dropdown-toggle"><option value="0">Assign to</option></select>';
                //         }
                //         return dropdown;
                //     }
                // },
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
                            dropdown = '<select class="btn btn-warning dropdown-toggle"><option value="0">Status</option></select>';
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
                            dropdown = '<select class="btn btn-primary dropdown-toggle"><option value="0">Priority</option></select>';
                        }
                        return dropdown;
                    }
                },
                {data: 'update', name: 'update'},
            ]
        });

        
        table2 = $('.data-table2').DataTable({
            processing: true,
            serverSide: true,
            bDestroy: true,
            ajax: {
                url: "{{ url('getlivetickets') }}"
               // data: { assign_to: assign_to, ticket_lead: ticket_lead },
                },  
            columns: [
                {data: 'ticket_id', name: 'ticket_id1',class:"ticket_id1"},
                
                {data: 'company_id', name: 'company_id1', class:"company_id1"},
                {data: 'branch_id', name: 'branch_id1', class:"branch_id1"},
                {data: 'branch_code', name: 'branch_code1', class:"branch_code1"},
                {data: 'company_name', name: 'company_name1',class:"company_name1"},
                {data: 'branch_name', name: 'branch_name1',class:"branch_name1"},
                {data: 'support_type', name: 'support_type1',class:"support_type1"},
                {data: 'product', name: 'product1',class:"product1"},
                {data: 'service', name: 'service1',class:"service1"},
                {data: 'exec_name', name: 'exec_name1',class:"exec_name1"},
                {data: 'exec_email', name: 'exec_email1',class:"exec_email1"},
                {data: 'exec_number', name: 'exec_number1',class:"exec_number1"},
                {data: 'created_at1', name: 'created_at1',class:"ticket_raised1"},
            
                {   
                    defaultContent: "",
                    data: "ticket_lead",
                    class:"ticket_lead1",
                    id:"ticket_lead1",
                    render: function (data, type, row, meta) {
                        var dropdown = '';
                        if (row != null) {
                            dropdown += '<select class="btn btn-secondary dropdown-toggle" >';
                            dropdown += '<option value="'+data+'">'+data+'</option>';
                            dropdown += '<option value="Prachi">Prachi</option>';
                            dropdown += '<option value="Asmita">Asmita</option>';
                            dropdown += '<option value="Akhila">Akhila</option>';
                            dropdown += '</select>';
                        }
                        else {
                            dropdown = '<select class="btn btn-secondary dropdown-toggle"><option value="0">Ticket Lead</option></select>';
                        }
                        return dropdown;
                    }
                },
                // {data: 'assign_to', name: 'assign_to',class:"assign_to"},
                {   
                    defaultContent: "",
                    data: "assign_to",
                    class:"assign_to1",
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
                            dropdown = '<select class="btn btn-info dropdown-toggle"><option value="0">Assign to</option></select>';
                        }
                        return dropdown;
                    }
                },
                {       
                    defaultContent: "",
                    data: "status",
                    class:"status1",
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
                            dropdown = '<select class="btn btn-warning dropdown-toggle"><option value="0">Status</option></select>';
                        }
                        return dropdown;
                    }
                },
                {       
                    defaultContent: "",
                    data: "priority",
                    class:"priority1",
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
                            dropdown = '<select class="btn btn-primary dropdown-toggle"><option value="0">Priority</option></select>';
                        }
                        return dropdown;
                    }
                },
                {data: 'update1', name: 'update1'},
            ]
        });

        table2.destroy();
    });
 
$('#btnsubmit').click(function () {
    $('.table2').show();
    $('.data-table2').show();

    var assign_to= $("#assignee").val()==""?null:$("#assignee").val();
    var ticket_lead= $("#ticketlead").val()==""?null:$("#ticketlead").val();
    
    //table2.destroy();

    table2 = $('.data-table2').DataTable({
        processing: true,
        serverSide: true,
        bDestroy: true,
        ajax: {
            url: "{{ url('getlivetickets') }}",
            data: { assign_to: assign_to, ticket_lead: ticket_lead },
            },  
        columns: [
            {data: 'ticket_id', name: 'ticket_id1',class:"ticket_id1"},
                
            {data: 'company_id', name: 'company_id1', class:"company_id1"},
            {data: 'branch_id', name: 'branch_id1', class:"branch_id1"},
            {data: 'branch_code', name: 'branch_code1', class:"branch_code1"},
            {data: 'company_name', name: 'company_name1',class:"company_name1"},
            {data: 'branch_name', name: 'branch_name1',class:"branch_name1"},
            {data: 'support_type', name: 'support_type1',class:"support_type1"},
            {data: 'product', name: 'product1',class:"product1"},
            {data: 'service', name: 'service1',class:"service1"},
            {data: 'exec_name', name: 'exec_name1',class:"exec_name1"},
            {data: 'exec_email', name: 'exec_email1',class:"exec_email1"},
            {data: 'exec_number', name: 'exec_number1',class:"exec_number1"},
            {data: 'created_at1', name: 'created_at1',class:"ticket_raised1"},
    
            {   
                defaultContent: "",
                data: "ticket_lead",
                class:"ticket_lead1",
                id:"ticket_lead1",
                render: function (data, type, row, meta) {
                    var dropdown = '';
                    if (row != null) {
                        dropdown += '<select class="btn btn-secondary dropdown-toggle" >';
                        dropdown += '<option value="'+data+'">'+data+'</option>';
                        dropdown += '<option value="Prachi">Prachi</option>';
                        dropdown += '<option value="Asmita">Asmita</option>';
                        dropdown += '<option value="Akhila">Akhila</option>';
                        dropdown += '</select>';
                    }
                    else {
                        dropdown = '<select class="btn btn-secondary dropdown-toggle"><option value="0">Ticket Lead</option></select>';
                    }
                    return dropdown;
                }
            },

            {   
                defaultContent: "",
                data: "assign_to",
                class:"assign_to1",
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
                        dropdown = '<select class="btn btn-info dropdown-toggle"><option value="0">Assign to</option></select>';
                    }
                    return dropdown;
                }
            },
            {       
                defaultContent: "",
                data: "status",
                class:"status1",
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
                        dropdown = '<select class="btn btn-warning dropdown-toggle"><option value="0">Status</option></select>';
                    }
                    return dropdown;
                }
            },
            {       
                defaultContent: "",
                data: "priority",
                class:"priority1",
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
                        dropdown = '<select class="btn btn-primary dropdown-toggle"><option value="0">Priority</option></select>';
                    }
                    return dropdown;
                }
            },
            {data: 'update1', name: 'update1'},
        ]
    });
   
});

</script>

@endsection