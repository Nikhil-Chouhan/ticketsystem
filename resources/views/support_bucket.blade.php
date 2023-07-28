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
                        <h1>Support Ticket Bucket</h1>
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
                                <th class="hiddenField" scope="col">PRODUCT ID</th>
                                <th class="hiddenField" scope="col">SERVICE ID</th>
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
        ajax: "{{ url('supportbucket') }}",
        columns: [
            {data: 'id', name: 'id',class:"ticket_id"},
            {data: 'company_id', name: 'company_id', class:"company_id"},
            {data: 'branch_id', name: 'branch_id', class:"branch_id"},
            {data: 'branch_code', name: 'branch_code', class:"branch_code"},
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
            {data: 'assign_to', name: 'assign_to',class:"assign_to"},
            {       
                defaultContent: "",
                data: "status",
                class:"status",
                render: function (data, type, row, meta) {
                    var dropdown = '';
                    if (row != null) {
                        dropdown += '<select class="btn btn-warning dropdown-toggle">';
                        dropdown += '<option value="">Status</option>';
                       // foreach($status as $stat)
                        dropdown += '<option value="Open">Open</option>';
                      //  endforeach
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
                        dropdown += '<option value="0">Priority</option>';
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
            {data: 'action', name: 'action'},
        ]
        });
    
    });

    $('body').on('click', '.btngo', function (e) {
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
            status: $(this).closest("tr").find(".status").find(":selected").text(),
            priority: $(this).closest("tr").find(".priority").find(":selected").text(),
        };
        
        if(formData.ticket_lead == "Ticket Lead" || formData.status == "Status" ||formData.priority == "Priority" ) {
            alert("Please Select the Options");
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

</script>

@endsection