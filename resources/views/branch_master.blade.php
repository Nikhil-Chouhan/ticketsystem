@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Masters</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Branch Master</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fa-regular fa-rectangle-list mr-3"></i>Branch Master</h4>
                        <div class="btn-toolbar mb-2 mb-md-0 mx-5">
                            <div class="btn-group">
                                <a href="{{url('branchregister')}}"><button type="button" class="btn light btn-success .btn-rounded ">+ Add Branch</button></a>  
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="" class="customdatatable display min-w850">
                                <thead>
                                    <tr>
                                        <th scope="col">BRANCH ID</th>
                                        <th scope="col">BRANCH CODE</th>
                                        <th scope="col">COMPANY NAME</th>
                                        <th scope="col">BRANCH NAME</th>
                                        <th scope="col">BRANCH ADDRESS</th>
                                        <th scope="col">CONTACT PERSON NAME</th>
                                        <th scope="col">CONTACT PERSON NUMBER</th>
                                        <th scope="col">CONTACT PERSON EMAIL</th>
                                        <th scope="col">SUPPORT TYPE</th>
                                        <th scope="col">PRODUCT</th>
                                        <th scope="col">SERVICE</th>
                                        
                                        <th scope="col">LINK</th>
                                    </tr>
                                </thead>
                                <tbody>
                
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="col">BRANCH ID</th>
                                        <th scope="col">BRANCH CODE</th>
                                        <th scope="col">COMPANY NAME</th>
                                        <th scope="col">BRANCH NAME</th>
                                        <th scope="col">BRANCH ADDRESS</th>
                                        <th scope="col">CONTACT PERSON NAME</th>
                                        <th scope="col">CONTACT PERSON NUMBER</th>
                                        <th scope="col">CONTACT PERSON EMAIL</th>
                                        <th scope="col">SUPPORT TYPE</th>
                                        <th scope="col">PRODUCT</th>
                                        <th scope="col">SERVICE</th>
                                        
                                        <th scope="col">LINK</th>
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
        ajax: "{{ url('branchmaster') }}",
        columns: [
            {data: 'id', name: 'id',class:"id"},
            {data: 'branch_code', name: 'branch_code',class:"branch_code"},
            {data: 'company_id', name: 'company_id',class:"company_id"},
            {data: 'branch_name', name: 'branch_name', class:"branch_name"},
            {data: 'branch_address', name: 'branch_address',class:"branch_address",},
            {data: 'branch_contactperson_name', name: 'branch_contactperson_name',class:"branch_contactperson_name"},
            {data: 'branch_contactperson_number', name: 'branch_contactperson_number',class:"branch_contactperson_number"},
            {data: 'branch_contactperson_email', name: 'branch_contactperson_email',class:"branch_contactperson_email"},
            {data: 'support_type', name: 'support_type',class:"support_type"},
            {data: 'product', name: 'product',class:"product"},
            {data: 'service', name: 'service',class:"service"},
          
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

</script>

@endsection