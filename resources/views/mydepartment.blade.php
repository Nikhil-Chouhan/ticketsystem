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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">My Department Tickets</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">My Department Tickets</h4>
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
                                        <th scope="col">PRIORITY</th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col">ASSIGNED TO</th>
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
                                        <th scope="col">PRIORITY</th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col">ASSIGNED TO</th>
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
        ajax: "{{ url('mydepartmenttickets') }}",
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
                        badge = '<span class="badge badge-primary m-1">Assignee Name</span>';
                    }
                    return badge;
                }
            },
            {data: 'status', name: 'status',class:"status"},
            {data: 'assign_to', name: 'assign_to',class:"assign_to"},
            {data: 'update', name: 'update'},
        ]
        });
    
    });

    $('body').on('click', '.inprogress', function (e) {
        e.preventDefault();
        var formData = {
            ticket_id: $(this).closest("tr").find(".ticket_id").text(),
            status: "1",
            assign_to: $(this).closest("tr").find(".assign_to").find(":selected").val(),
            
        };
        if(formData.assign_to == "") {
            alert("Please Select Assignee");
        }
    else{
        $.ajax({
            type:'post',
            url:"{{ url('mydepartment/ticketupdate') }}",
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

</script>

@endsection