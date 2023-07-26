@extends('layouts.app')

@section('content')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <main class="col-md-12 px-md-4">

                <div class="card-main main-content">
                <div class=" d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-5">
                    <section class="main-header grid ">
                        <h1>Users</h1>
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
                                <th scope="col">User ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Roles</th>
                                {{-- <th scope="col">Permissions</th> --}}
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
        ajax: "{{ url('users') }}",
        // success:function(data){
        //         if(data!=null){
        //             console.log(data);
        //         }else{
        //             console.log(data.error);
        //         }
        //     },
        columns: [
            {data: 'id', name: 'id',class:"id"},
            {data: 'name', name: 'name',class:"name"},
            {data: 'email', name: 'email',class:"email"},
            {data: 'role', name: 'role', class:"role"},
            // {data: '', name: '', class:""},          
            {data: 'action', name: 'action'},
        ]
        });
    
    });

    $('body').on('click', '.getLink', function (e) {
        e.preventDefault();
        var generateURL = this.getAttribute('href');

        // Create a temporary input element to copy the URL to the clipboard
        var tempInput = document.createElement('input');
        tempInput.setAttribute('value', generateURL);
        document.body.appendChild(tempInput);

        // Select the URL in the input element
        tempInput.select();
        tempInput.setSelectionRange(0, 99999); // For mobile devices

        // Copy the URL to the clipboard
        document.execCommand('copy');
        document.body.removeChild(tempInput);

        // Optionally, you can display a message to indicate that the URL has been copied
        alert('URL copied to clipboard: ' + generateURL);

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