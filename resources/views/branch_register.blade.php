@extends('layouts.app')

@section('content')
<style>
 .imp.form-control::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: rgb(238, 166, 144);
            opacity: 1; /* Firefox */
}

.multiselectmain .drop.dropdown .multiselect-container.dropdown-menu.show {
    transform: unset !important;
    top: 40px !important;
    width: 100%;
}

.multiselectmain .drop.dropdown .btn-group {
    width: 100%;
}

.multiselectmain .drop.dropdown .multiselect.dropdown-toggle {
    text-align: left;
}

</style>
<section class="vh-100">
    @if (\Session::has('msg'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('msg') !!}</li>
        </ul>
    </div>
    @endif
    <div class="container mt-2">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
  
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Register Branch</p>
  
                <form name="register_company" class="mx-1 mx-md-4">

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="drop dropdown " style="width: 100%;">
                          <select id="selectCompany" name="company_id" class="flex-fill mb-0 btn border dropdown-toggle"  style="width: 100%; text-align:left;">
                            <option style="color: rgb(238, 166, 144);"selected disabled>Select Company</option>
                            @foreach($companydetails as $company)
                            <option value="{{$company->id}}">{{$company->company_name}}</option>
                            @endforeach
                            {{-- <option value="Mumbai">Mumbai</option>
                            <option value="Banglore">Banglore</option> --}}
                          </select>
                        </div>
                    </div>
                    @error('company_name')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror 

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input id="branch_name" name="branch_name" class="form-control imp" placeholder="Branch Name">
                      </div>
                    </div>
                    @error('branch_name')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror 
  
                    <div class="d-flex flex-row align-items-center mb-2">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <textarea id="branch_address" name="branch_address" class="form-control imp" placeholder="Branch Address"></textarea>
                        </div>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="addressCheckbox">
                        <label class="form-check-label">Same as company address </label>
                    </div>
                    @error('branch_address')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror 
                    
                    <div class="d-flex flex-row align-items-center mb-2">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input id="branch_contactperson_name" name="branch_contactperson_name" class="form-control imp" placeholder="Branch Contact Person Name">
                        </div>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="contactpersonCheckbox">
                        <label class="form-check-label">Same as company contact person</label>
                    </div>
                    @error('branch_contactperson_name')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror 

                    <div class="d-flex flex-row align-items-center mb-2">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input id="branch_contactperson_number" name="branch_contactperson_number" class="form-control imp" placeholder="Branch Contact Person Number">
                        </div>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="contactnumberCheckbox">
                        <label class="form-check-label">Same number as company contact person</label>
                    </div>
                    @error('branch_contactperson_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror 

                    <div class="d-flex flex-row align-items-center mb-2">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input id="branch_contactperson_email" name="branch_contactperson_email" class="form-control imp" placeholder="Branch Contact Person Email">
                        </div>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="contactemailCheckbox">
                        <label class="form-check-label">Same email as company contact person</label>
                    </div>
                    @error('branch_contactperson_email')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror 

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="drop dropdown " style="width: 100%;">
                            <select id="support_type" name="support_type" class="flex-fill mb-0 btn border dropdown-toggle"  style="width: 100%; text-align:left;">
                                <option style="color: rgb(238, 166, 144);" value="" selected disabled>Select Support Type</option>
                                {{-- @foreach($progressdata as $progress)
                                    <option value="{{$progress->status}}">{{$progress->ticket_lead}}</option>
                                @endforeach --}}
                                <option value="24/7-Support">24/7-Support</option>
                                <option value="24/5-Support">24/5-Support</option>
                                <option value="8/5-Support">8/5-Support</option>
                                <option value="AMC">Annual Maintenance Contract</option>
                            </select>
                        </div>
                    </div>
                    @error('support_type')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="multiselectmain col d-flex flex-row align-items-center mb-4">
                        
                        <div class="drop dropdown " style="width: 100%;">
                            <select id="product" name="product" multiple="multiple" style="width: 100%;">
                                @foreach($productdetails as $product)
                                <option value="{{$product->id}}">{{$product->product_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="multiselectmain col d-flex flex-row align-items-center mb-4">
                            <div class="drop dropdown " style="width: 100%;">
                            <select id="service" name="service"  multiple="multiple" style="width: 100%;">
                            @foreach($servicedetails as $service)
                                <option value="{{$service->id}}">{{$service->service_name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>        
                    {{-- <div class="multiselectmain col d-flex flex-row align-items-center mb-4">
                        <div class="drop dropdown " style="width: 100%;">
                            <select id="example-multiple-optgroups" multiple="multiple" style="width: 100%;"> 
                                <optgroup label="Product" class="group-1">
                                    <option value="1-1">Foodisoft</option>
                                    <option value="1-2">Qualis</option>
                                    <option value="1-3">Trackit</option>
                                    <option value="1-3">Grab Scan Pay Go</option>
                                </optgroup>
                                <optgroup label="Service" class="group-2">
                                    <option value="2-1">Server Hosting</option>
                                    <option value="2-2">Website Development</option>
                                    <option value="2-3">Custom Software</option>
                                    <option value="2-3">Domain Managing</option>
                                    <option value="2-3">Web Designing</option>
                                    <option value="2-3">Resource Management</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>    --}}
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button id="savebranch" type="submit" class="btn btn-success btn-lg">Save Branch</button>
                    </div>
                </form>
  
                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
  
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                    class="img-fluid" alt="Sample image">
  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<script>

// $('#example-multiple-optgroups').multiselect({
//     selectedClass: null,
//     nonSelectedText: "Select Nature of Product/Service",
//     includeSelectAllOption: true,
//     minimumCountSelected: 8,
//     onChange: function() {
//         console.log($('#example-multiple-optgroups').val());
//     }
// });  

$('#product').multiselect({
    selectedClass: null,
    nonSelectedText: "Select Nature of Product",
    includeSelectAllOption: true,
    minimumCountSelected: 8,
    onChange: function() {
        console.log($('#multiple-checkboxes').val());
    }
});  
$('#service').multiselect({
    selectedClass: null,
    nonSelectedText: "Select Nature of Service",
    includeSelectAllOption: true,
    minimumCountSelected: 8,
    onChange: function() {
        console.log($('#multiple-checkboxes').val());
    }
});  

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
 
    var formData = {
            companyid: $('#selectCompany').find(":selected").val(),
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
                }else{
                    console.log(data.error);
                }
            }
        });
});

</script>
@endsection