@extends('layouts.app')

@section('content')

@section('content')

    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Masters</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Product Master</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Product Master</h4>
                        <div class="btn-toolbar mb-2 mb-md-0 mx-5">
                            <div class="btn-group">
                                <a href="{{url('productregister')}}"><button type="button" class="btn btn-outline-success .btn-rounded ">+ Add Product</button></a>  
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="" class="customdatatable display min-w850">
                                <thead>
                                    
                                    <tr>
                                        <th scope="col">PRODUCT ID</th>
                                        <th scope="col">PRODUCT NAME</th>
                                        <th scope="col">PRODUCT DESCRIPTION</th>
                                        <th scope="col">ACTION</th>
                                    </tr>
                                    
                                </thead>
                                <tbody>
                
                                </tbody>
                                <tfoot>
                                    
                                    <tr>
                                        <th scope="col">PRODUCT ID</th>
                                        <th scope="col">PRODUCT NAME</th>
                                        <th scope="col">PRODUCT DESCRIPTION</th>
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
        ajax: "{{ url('productmaster') }}",
        columns: [
            {data: 'id', name: 'id',class:"product_id"},
            {data: 'product_name', name: 'product_name', class:"product_name    "},
            {data: 'product_description', name: 'product_description',class:"product_description",},
            {data: 'action', name: 'action'},
        ]
        });
    
    });

    // $('body').on('click', '.btnedit', function (e) {
    //     e.preventDefault();
    //     var id =$(this).closest("tr").find(".product_id").text();
        
    //     $.ajax({
    //         type:'get',
    //         url:"{{ url('editproduct') }}",
    //         data:{"productID":id},
    //         dataType: 'json',
    //         // success:function(data){
    //         //     if(data!=null){
    //         //         console.log(data);
    //         //         alert("SUCCESS");
    //         //     }else{
    //         //         alert(data.error);
    //         //     }
    //         // }
    //     });
    // });

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