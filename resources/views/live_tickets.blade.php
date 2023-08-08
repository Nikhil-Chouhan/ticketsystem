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
@section('content')
    {{-- <div class="container-fluid">
        <div class="row">
            <main class="col-md-12 px-md-4">
            <div class="card-main">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                    <h1 class="h2">Live Tickets</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <!-- Example single danger button -->
                        <div class="btn-group">
                            <div class="container-fluid mb-3">
                                <div class="drop dropdown">
                                    <select id="status" class="status btn btn-warning dropdown-toggle" >
                                        <option value="">Status</option>
                                        <option value="Open">Open</option>
                                        <option value="WorkinProgress">Work in Progress</option>
                                    </select>
                                </div>
                                <div class="drop dropdown">
                                    <select id="ticketlead" class="ticket_lead btn btn-secondary dropdown-toggle" >
                                        <option value="">Ticket Lead</option>
                                        @foreach($ticketlead as $lead)
                                        
                                            <option value="{{$lead->id}}">{{$lead->name}}</option>
                                        
                                        @endforeach
                                    </select>
                                </div>
                                <div class="drop dropdown">
                                    <select id="assignee" class="ticket_lead btn btn-info dropdown-toggle" >
                                        <option value="">Assignee</option>
                                        @foreach($users as $user)
                                        
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" id="btnsubmit" class="btnsubmit drop btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table data-table">
                        <thead>
                            <tr>
                                <th scope="col">TICKET ID</th>
                                <th class="hiddenField" scope="col">COMPANY ID</th>
                                <th class="hiddenField" scope="col">BRANCH ID</th>
                                <th class="hiddenField" scope="col">BRANCH CODE</th>
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
    </div> --}}

    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Active Tickets</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Live Tickets</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Live Tickets</h4>
                        <div class="btn-group">
                            <div class="container-fluid mb-3">
                                <div class="drop dropdown">
                                    <select id="status" class="status btn btn-warning dropdown-toggle" >
                                        <option value="">Status</option>
                                        @foreach($status as $s)
                                        
                                        <option value="{{$s->id}}">{{$s->status_name}}</option>
                                    
                                    @endforeach
                                    </select>
                                </div>
                                <div class="drop dropdown">
                                    <select id="ticketlead" class="ticket_lead btn btn-secondary dropdown-toggle" >
                                        <option value="">Ticket Lead</option>
                                        @foreach($ticketlead as $lead)
                                        
                                            <option value="{{$lead->id}}">{{$lead->name}}</option>
                                        
                                        @endforeach
                                    </select>
                                </div>
                                <div class="drop dropdown">
                                    <select id="assignee" class="ticket_lead btn btn-info dropdown-toggle" >
                                        <option value="">Assignee</option>
                                        @foreach($users as $user)
                                        
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" id="btnsubmit" class="btnsubmit drop btn btn-success">Submit</button>
                            </div>
                        </div>
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
                                        <th scope="col">ASSIGN TO</th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col">PRIORITY</th>
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
                                        <th scope="col">ASSIGN TO</th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col">PRIORITY</th>
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
    var table;
    $(document).ready(function () {

        table = $('.customdatatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('liveticketstable') }}",
            success:function(data){
                if(data!=null){
                    console.log(data);
                }else{
                    alert(data.error);
                }
            },
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
                            dropdown = '<select class="btn btn-primary dropdown-toggle"><option value="0">Priority</option></select>';
                        }
                        return dropdown;
                    }
                },
                {data: 'update', name: 'update'},
            ]
        });
     });
 
$('#btnsubmit').click(function () {

    table.destroy();
    
    var assign_to= $("#assignee").val()==""?null:$("#assignee").val();
    var ticket_lead= $("#ticketlead").val()==""?null:$("#ticketlead").val();
    var status= $("#status").val()==""?null:$("#status").val();
    table = $('.customdatatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
            url: "{{ url('getlivetickets') }}",
            data: { assign_to: assign_to, ticket_lead: ticket_lead, status: status },
            },
            columns: [
                {data: 'ticket_id', name: 'ticket_id',class:"ticket_id"},
                
                // {data: 'company_id', name: 'company_id', class:"company_id"},
                // {data: 'branch_id', name: 'branch_id', class:"branch_id"},
                // {data: 'branch_code', name: 'branch_code', class:"branch_code"},
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
                            dropdown += '<option value="High">High</option>';
                            dropdown += '<option value="Low">Low</option>';
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
});
$('body').on('click', '.update', function (e) {
        e.preventDefault();
        var formData = {
            ticket_id: $(this).closest("tr").find(".ticket_id").text(),
            //  issue_type: $(this).closest("tr").find(".issue_type").text(),
            ticket_lead: $(this).closest("tr").find(".ticket_lead").find(":selected").val(),
            assign_to: $(this).closest("tr").find(".assign_to").find(":selected").val(),
            assigned_tester: $(this).closest("tr").find(".assigned_tester").find(":selected").val(),
            status: $(this).closest("tr").find(".status").find(":selected").val(),
            priority: $(this).closest("tr").find(".priority").find(":selected").text(),
        };

        $.ajax({
            type:'post',
            url:"{{ url('ticket/update') }}",
            data:formData,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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