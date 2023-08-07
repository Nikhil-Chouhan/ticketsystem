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
                <li class="breadcrumb-item"><a href="javascript:void(0)">Tickets</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Project Management Bucket</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Project Management Bucket</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="" class="customdatatable display min-w850">
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
                                        <th class="hiddenField" scope="col">PRODUCT ID</th>
                                        <th class="hiddenField" scope="col">SERVICE ID</th>
                                        <th scope="col">SERVICE</th>
                                        <th scope="col">CUSTOMER NAME</th>
                                        <th scope="col">CUSTOMER EMAIL</th>
                                        <th scope="col">CUSTOMER NUMBER</th>
                                        <th scope="col">RAISED AT</th>
                                        <th scope="col">TICKET LEAD</th>
                                        <th scope="col">DEPARTMENT</th>
                                        <th scope="col">ASSIGN TO</th>
                                        <th scope="col">PRIORITY</th>
                                        <th scope="col">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="col">TICKET ID</th>
                                        <th class="hiddenField" scope="col">COMPANY ID</th>
                                        <th class="hiddenField" scope="col">BRANCH ID</th>
                                        <th class="hiddenField" scope="col">BRANCH CODE</th>
                                        <th scope="col">COMPANY NAME</th>
                                        <th scope="col">BRANCH NAME</th>
                                        <th scope="col">SUPPORT TYPE</th>
                                        <th scope="col">PRODUCT</th>
                                        <th class="hiddenField" scope="col">PRODUCT ID</th>
                                        <th class="hiddenField" scope="col">SERVICE ID</th>
                                        <th scope="col">SERVICE</th>
                                        <th scope="col">CUSTOMER NAME</th>
                                        <th scope="col">CUSTOMER EMAIL</th>
                                        <th scope="col">CUSTOMER NUMBER</th>
                                        <th scope="col">RAISED AT</th>
                                        <th scope="col">TICKET LEAD</th>
                                        <th scope="col">DEPARTMENT</th>
                                        <th scope="col">ASSIGN TO</th>
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
        ajax: "{{ url('pmbucket') }}",
        columns: [
            {data: 'id', name: 'id',class:"ticket_id"},
            {data: 'company_id', name: 'company_id', class:"company_id hiddenField"},
            {data: 'branch_id', name: 'branch_id', class:"branch_id hiddenField"},
            {data: 'branch_code', name: 'branch_code', class:"branch_code hiddenField"},
            {data: 'company_name', name: 'company_name',class:"company_name"},
            {data: 'branch_name', name: 'branch_name',class:"branch_name"},
            {data: 'support_type', name: 'support_type',class:"support_type"},
            {data: 'product', name: 'product',class:"product"},
            {data: 'product_id', name: 'product_id',class:"product_id hiddenField"},
            {data: 'service_id', name: 'service_id',class:"service_id hiddenField"},
            {data: 'service', name: 'service',class:"service"},
            {data: 'exec_name', name: 'exec_name',class:"exec_name"},
            {data: 'exec_email', name: 'exec_email',class:"exec_email"},
            {data: 'exec_number', name: 'exec_number',class:"exec_number"},
            
            {data: 'created_at', name: 'created_at',class:"ticket_raised"},
            {data: 'ticket_lead', name: 'ticket_lead',class:"ticket_lead"},
            {data: 'department', name: 'department',class:"department"},
            {data: 'assign_to', name: 'assign_to',class:"assign_to"},
      
           {       
                defaultContent: "",
                data: "priority",
                class:"priority",
                render: function (data, type, row, meta) {
                    var dropdown = '';
                    if (row != null) {
                        dropdown += '<select class="btn btn-primary dropdown-toggle">';
                        dropdown += '<option value="">Priority</option>';
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
            {data: 'action', name: 'action'},
        ]
        });
    
    });

    $('body').on('click', '.btnsave', function (e) {
        e.preventDefault();
        var formData = {
            ticket_id: $(this).closest("tr").find(".ticket_id").text(),
            company_id: $(this).closest("tr").find(".company_id").text(),
            branch_id: $(this).closest("tr").find(".branch_id").text(),
            branch_code: $(this).closest("tr").find(".branch_code").text(),
            // company_name: $(this).closest("tr").find(".company_name").text(),
            // branch_name: $(this).closest("tr").find(".branch_name").text(),
            product: $(this).closest("tr").find(".product_id").text(),
            service: $(this).closest("tr").find(".service_id").text(),
            support_type: $(this).closest("tr").find(".support_type").text(),
            exec_name: $(this).closest("tr").find(".exec_name").text(),
            exec_email: $(this).closest("tr").find(".exec_email").text(),
            exec_number: $(this).closest("tr").find(".exec_number").text(),
            // issue_type: $(this).closest("tr").find(".issue_type").text(),
            ticket_raised: $(this).closest("tr").find(".ticket_raised").text(),
            ticket_lead: $(this).closest("tr").find(".ticket_lead").find(":selected").val(),
            assign_to: $(this).closest("tr").find(".assign_to").find(":selected").val(),
            priority: $(this).closest("tr").find(".priority").find(":selected").val(),
            department: $(this).closest("tr").find(".department").find(":selected").val(),
            status:"1",
            
        };
        
        if(formData.ticket_lead == "") {
            alert("Please Select Ticket Lead");
        }
        if(formData.department == "" ) {
            alert("Please Select Department");
        }
        if( formData.status == "") {
            alert("Please Select Status");
        }
        if(formData.priority == "" ) {
            alert("Please Select Priority");
        }
        
        else
        {
            $.ajax({
                type:'post',
                url:"{{ url('ticketstore') }}",
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
        }
   });

   $('body').on('change','.department', function(e){
        e.preventDefault();
        var formData={
            department_id: $(this).closest("tr").find(".department").find(":selected").val(),
        };
        var parentRow = $(this).closest('tr');
        $.ajax({
            type:'get',
            url:"{{ url('getdepartmentusers') }}",
            data:formData,
            dataType: 'json',
            success:function(data,parentRow){
                if(data!=null){
                    // console.log(data);
                    setUsers(data,parentRow);
                }else{
                    alert(data.error);
                }
            }
        });
    });

    function setUsers(users,parentRow){
        var response = users;
        var select = parentRow.find('#assign_to');
        var options = '';
        select.empty();      
        options= "<option value=''>Assignee</option>"; 
        for(var i=0;i<response.length; i++)
        {
            options += "<option value='"+response[i].id+"'>"+ response[i].name +"</option>";   
        }
        select.append(options);   
    }
</script>

@endsection