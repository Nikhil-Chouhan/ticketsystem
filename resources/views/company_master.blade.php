@extends('layouts.app')

@section('content')
    
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Masters</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Company Master</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Company Master</h4>
                        <div class="btn-toolbar mb-2 mb-md-0 mx-5">
                            <div class="btn-group">
                                <a href="{{url('companyregister')}}"><button type="button" class="btn btn-outline-success .btn-rounded ">+ Add Company</button></a>  
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="" class="customdatatable display min-w850">
                                <thead>
                                    <tr>
                                        <th scope="col">COMPANY ID</th>
                                        <th scope="col">COMPANY NAME</th>
                                        <th scope="col">COMPANY ADDRESS</th>
                                        <th scope="col">COMPANY CITY</th>
                                        <th scope="col">COMPANY GST</th>
                                        <th scope="col">CONTACT PERSON NAME</th>
                                        <th scope="col">CONTACT PERSON NUMBER</th>
                                        <th scope="col">CONTACT PERSON EMAIL</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="col">COMPANY ID</th>
                                        <th scope="col">COMPANY NAME</th>
                                        <th scope="col">COMPANY ADDRESS</th>
                                        <th scope="col">COMPANY CITY</th>
                                        <th scope="col">COMPANY GST</th>
                                        <th scope="col">CONTACT PERSON NAME</th>
                                        <th scope="col">CONTACT PERSON NUMBER</th>
                                        <th scope="col">CONTACT PERSON EMAIL</th>
                                        
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <main class="col-md-12 px-md-4">

                <div class="card-main main-content">
                <div class=" d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-5">
                    <section class="main-header grid ">
                        <h1>Company Master</h1>
                        <!-- <button-main class="button-main">
                          <i class="fa-solid fa-plus"></i>
                          <span>Add new user</span>
                        </button-main> -->
                    </section>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <!-- Example single danger button -->
                        
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table data-table">
                        <thead>
                            <tr>
                                <th scope="col">COMPANY ID</th>
                                <th scope="col">COMPANY NAME</th>
                                <th scope="col">COMPANY ADDRESS</th>
                                <th scope="col">COMPANY CITY</th>
                                <th scope="col">COMPANY GST</th>
                                <th scope="col">CONTACT PERSON NAME</th>
                                <th scope="col">CONTACT PERSON NUMBER</th>
                                <th scope="col">CONTACT PERSON EMAIL</th>
                                
                            </tr>
                        </thead>
              
                        <tbody>
                        
                        </tbody>
                    </table>
                </div>
            </main>
        </div> --}}
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
        ajax: "{{ url('companymaster') }}",
        columns: [
            {data: 'id', name: 'id',class:"company_id"},
            {data: 'company_name', name: 'company_name', class:"company_name    "},
            {data: 'company_address', name: 'company_address',class:"company_address",},
            {data: 'city', name: 'company_city',class:"company_city",},
            {data: 'gst_number', name: 'gst_number',class:"gst_number"},
            {data: 'contactperson_name', name: 'contactperson_name',class:"contactperson_name"},
            {data: 'contactperson_number', name: 'contactperson_number',class:"contactperson_number"},
            {data: 'contactperson_email', name: 'contactperson_email',class:"contactperson_email"},
          
            // {data: 'action', name: 'action'},
        ]
        });
    
    });

//     $('body').on('click', '.btngo', function (e) {
//         e.preventDefault();
//         var formData = {
//             ticket_id: $(this).closest("tr").find(".ticket_id").text(),
//             client_id: $(this).closest("tr").find(".client_id").text(),
//             client_name: $(this).closest("tr").find(".client_name").text(),
//             project_name: $(this).closest("tr").find(".project_name").text(),
//             exec_name: $(this).closest("tr").find(".exec_name").text(),
//             exec_email: $(this).closest("tr").find(".exec_email").text(),
//             exec_number: $(this).closest("tr").find(".exec_number").text(),
//             issue_type: $(this).closest("tr").find(".issue_type").text(),
//             ticket_raised: $(this).closest("tr").find(".ticket_raised").text(),
//             ticket_lead: $(this).closest("tr").find(".ticket_lead").find(":selected").text(),
//             assign_to: $(this).closest("tr").find(".assign_to").find(":selected").text(),
//             status: $(this).closest("tr").find(".status").find(":selected").text(),
//             priority: $(this).closest("tr").find(".priority").find(":selected").text(),
//         };
        
//         if(formData.ticket_lead == "Ticket Lead" || formData.assign_to == "Assign to" || formData.status == "Status" ||formData.priority == "Priority" ) {
//             alert("Please Select the Options");
//         }
        
//         else
//         {
//             // var url1 = "{{ url('ticketstore') }}";
//             // $.post(url1,formData,function(fb){
//             // var resp = $.parseJSON(fb);
//             // consol.log(resp);
//             // })
//            // $(this).closest("tr").find(".ticket_lead").prop("disabled", true);
//             $.ajax({
//                 type:'post',
//                 url:"{{ url('ticketstore') }}",
//                 data:formData,
//                 dataType: 'json',
//                 success:function(data){
//                     if(data!=null){
//                         console.log(data);
//                         alert("SUCCESS");
//                         location.reload();
//                     }else{
//                         alert(data.error);
//                     }
//                 }
//             });
//         }
//    });

</script>

@endsection