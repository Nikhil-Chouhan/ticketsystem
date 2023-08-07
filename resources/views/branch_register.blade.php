@extends('layouts.app')

@section('content')

    @if (\Session::has('msg'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('msg') !!}</li>
        </ul>
    </div>
    @endif

    <div class="container-fluid">
        <div class="page-titles">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Masters</a></li>
            <li class="breadcrumb-item"><a href="{{route('branchmaster')}}">Branch Master</a></li>
            <li class="breadcrumb-item active"><a href="{{route('branchregister')}}">Branch Register</a></li>
          </ol>     
        </div>
  
        <div class="row">
          <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                    <h4 class="card-title">Branch Register</h4>
                    </div>
                    
                    <div class="card-body">
                        {{-- action="{{ url('branchregister') }}" --}}
                        <div class="basic-form">
                            <form  class="form-valide-with-icon" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6">
                                        
                                        <div class="form-group">
                                            <label class="text-label">Select Company
                                                <span class="text-danger">*</span>
                                            </label>
                                            
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                                </div>
                                                <select  id="selectCompany" name="company_id" class="form-control mr-sm-2 default-select" >
                                                    <option selected>Select Company</option>
                                                    @foreach($companydetails as $company)
                                                        <option value="{{$company->id}}">{{$company->company_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="text-label">Branch Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                                </div>
                                                <input id="branch_name" type="text" class="form-control" name="branch_name" placeholder="Enter Branch Name">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="text-label">Branch Address
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                                </div>
                                                <textarea id="branch_address" type="text" class="form-control" name="branch_address" placeholder="Enter Branch Address"></textarea>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="addressCheckbox" type="checkbox">
                                                <label class="form-check-label">
                                                    Same as company address
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="text-label">Branch Contact Person Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                                </div>
                                                <input id="branch_contactperson_name" type="text" class="form-control" name="branch_contactperson_name" placeholder="Branch Contact Person Name">
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="contactpersonCheckbox" type="checkbox">
                                                <label class="form-check-label">
                                                    Same as company contact person
                                                </label>
                                            </div>
                                        </div>

                                    
                                        <div class="form-group">
                                            <label class="text-label">Branch Contact Person Number
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                                </div>
                                                <input type="text" id="branch_contactperson_number" class="form-control" name="branch_contactperson_number" placeholder="Branch Contact Person Number">
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="contactnumberCheckbox" type="checkbox">
                                                <label class="form-check-label">
                                                    Same as company contact person
                                                </label>
                                            </div>
                                        </div>

                                    </div>

                                    <div  class="col-xl-6">
                                        <div class="form-group">
                                            <label class="text-label">Branch Contact Person Email
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                                </div>
                                                <input id="branch_contactperson_email" type="email" class="form-control" name="branch_contactperson_email" placeholder="Branch Contact Person Email">
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="contactemailCheckbox" type="checkbox">
                                                <label class="form-check-label">
                                                    Same as company contact person
                                                </label>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="text-label">Select Support Type
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                                </div>
                                                <select id="support_type" name="support_type" class="form-control mr-sm-2 default-select" >
                                                    <option selected>Select Support Type</option>
                                                    <option value="24/7-Support">24/7-Support</option>
                                                    <option value="24/5-Support">24/5-Support</option>
                                                    <option value="8/5-Support">8/5-Support</option>
                                                    <option value="AMC">Annual Maintenance Contract</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="text-label">Select Product
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                                </div>
                                                <select id="product" name="product" multiple class="form-control default-select">
                                                    @foreach($productdetails as $product)
                                                        <option value="{{$product->id}}">{{$product->product_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="text-label">Select Service
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                                </div>
                                                <select id="service" name="service" multiple class="form-control default-select">
                                                    @foreach($servicedetails as $service)
                                                        <option value="{{$service->id}}">{{$service->service_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" id="savebranch" class="btn mr-2 btn-success">Save Branch</button>
                                        </div>
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>

// $('#product').multiselect({
//     selectedClass: null,
//     nonSelectedText: "Select Nature of Product",
//     includeSelectAllOption: true,
//     minimumCountSelected: 8,
//     onChange: function() {
//         console.log($('#multiple-checkboxes').val());
//     }
// });  
// $('#service').multiselect({
//     selectedClass: null,
//     nonSelectedText: "Select Nature of Service",
//     includeSelectAllOption: true,
//     minimumCountSelected: 8,
//     onChange: function() {
//         console.log($('#multiple-checkboxes').val());
//     }
// });  

var companydetails=[];
$(function() {
    
    $("#selectCompany").change(function() {
        $("#branch_address").val('');
        $("#branch_contactperson_name").val('');
        $("#branch_contactperson_number").val('');
        $("#branch_contactperson_email").val('');

        $('#addressCheckbox').prop('checked', false);
        $('#contactpersonCheckbox').prop('checked', false);
        $('#contactnumberCheckbox').prop('checked', false);
        $('#contactemailCheckbox').prop('checked', false);
        var formData = {
            companyid: $('#selectCompany').find(":selected").val()
        }
        
        $.ajax({
            type:'get',
            url:"{{ url('getCompanyDetails') }}",
            data:formData,
            dataType: 'json',
            success:function(data){
                if(data!=null){
                    companydetails=data;
                    console.log(companydetails);
                }else{
                    console.log(data.error);
                }
            }
        });
    });
});

$('#addressCheckbox').bind('change', function () {

    if ($(this).is(':checked')) {
        // $("#branch_address").prop('disabled', true);
        $("#branch_address").val(companydetails.company_address);
    }
    else {
        $("#branch_address").prop('disabled', false);
        $("#branch_address").val('');
    }
});

$('#contactpersonCheckbox').bind('change', function () {
    if ($(this).is(':checked')) {
        // $("#branch_contactperson_name").prop('disabled', true);
        $("#branch_contactperson_name").val(companydetails.contactperson_name);
    }
    else {
        $("#branch_contactperson_name").prop('disabled', false);
        $("#branch_contactperson_name").val('');
    }
});

$('#contactnumberCheckbox').bind('change', function () {
    if ($(this).is(':checked')) {
        // $("#branch_contactperson_number").prop('disabled', true);
        $("#branch_contactperson_number").val(companydetails.contactperson_number);
    }
    else {
        $("#branch_contactperson_number").prop('disabled', false);
        $("#branch_contactperson_number").val('');
    }
});

$('#contactemailCheckbox').bind('change', function () {
    if ($(this).is(':checked')) {
        // $("#branch_contactperson_email").prop('disabled', true);
        $("#branch_contactperson_email").val(companydetails.contactperson_email);
    }
    else {
        $("#branch_contactperson_email").prop('disabled', false);
        $("#branch_contactperson_email").val('');
    }
});

$("#savebranch").click(function(e){
    e.preventDefault();
    var companyname=$('#selectCompany').find(":selected").text().substr(0, 4);
    var branchname=$('#branch_name').val().substr(0, 3);
    // var initial="Kanishka";
    var branchcode=companyname+'-'+branchname;
    console.log("branchcode:",branchcode);
    var formData = {
            company_id: $('#selectCompany').find(":selected").val(),
            branch_name:$('#branch_name').val(),
            branch_address:$('#branch_address').val(),
            branch_contactperson_name:$('#branch_contactperson_name').val(),
            branch_contactperson_number:$('#branch_contactperson_number').val(),
            branch_contactperson_email:$('#branch_contactperson_email').val(),
            support_type:$('#support_type').val(),
            service:$('#service').val().toString(),
            product:$('#product').val().toString(),
            branch_code: branchcode,
        }

        console.log(formData);
    $.ajax({
            type:'post',
            url:"{{ url('branchregister') }}",
            data:formData,
            dataType: 'json',
            success:function(data){
                if(data!=null){
                    alert("Saved Successfully!")
                    console.log(data);
                    location.reload();
                }else{
                    console.log(data.error);
                }
            }
        });
});

</script>
@endsection