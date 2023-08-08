@extends('layouts.app')

@section('content')

<div class="container-fluid" >
  @if (\Session::has('msg'))
  <div class="alert alert-success">
      <ul>
          <li>{!! \Session::get('msg') !!}</li>
      </ul>
  </div>
  @endif
  <div class="row justify-content-center align-items-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Generate Ticket</h4>
        </div>
        <div class="card-body">
      
          <div class="basic-form">
            <form action="{{route('generateticket')}}" enctype="multipart/form-data" method="Post" name="raise_ticket" class="form-valide-with-icon">
              @csrf
              {{-- <input type="hidden" name="branch_code" value="{{ $branchdetails->branch_code }}"> --}}
              <div class="row">
                <div class="col-xl-6">

                  <div class="form-group">
                    <label class="text-label">Select Company
                      <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fas fa-building"></i> </span>
                        </div>
                        <select id="selectCompany" name="company_id" class="form-control mr-sm-2 default-select" >
                          <option selected>Select Company</option>
                          @foreach($companydetails as $company)
                            <option value="{{$company->id}}">{{$company->company_name}}</option>
                          @endforeach
                        </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="text-label">Select Branch
                      <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa-solid fa-location-dot"></i> </span>
                        </div>
                        <select id="selectBranch" name="branch_id" class="form-control mr-sm-2 " >
                          <option selected>Select Branch</option>
                        </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="text-label">Select Product
                      <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa-solid fa-laptop-code"></i> </span>
                        </div>
                        <select id="selectProduct" name="product_id" class="form-control mr-sm-2" >
                          <option selected>Select Product</option>
                        </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="text-label">Select Service
                      <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text"> <i class="fa-solid fa-laptop-file"></i> </span>
                      </div>
                      <select id="selectService" name="service_id" class="form-control mr-sm-2" >
                        <option selected>Select Service</option>
                      </select>
                    </div>
                  </div>
                
                  <div class="form-group">
                    <label class="text-label">Ticket Title
                      <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa-solid fa-note-sticky"></i> </span>
                        </div>
                        <input id="ticket_title" name="ticket_title" type="text" class="form-control" placeholder="Enter Ticket Title">

                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="text-label">Ticket Description
                      <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text"> <i class="fa-solid fa-square-poll-horizontal"></i> </span>
                      </div>
                      <textarea id="ticket_description" name="ticket_description" type="text" class="form-control" placeholder="Enter Ticket Description"></textarea>
                    </div>
                  </div>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Upload Image</span>
                    </div>
                    <div class="custom-file">
                        <input type="file"name="ticket_image[]" id="file" accept="image/png, image/jpeg" multiple class="custom-file-input">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                  </div>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Upload Excel</span>
                    </div>
                    <div class="custom-file">
                        <input name="ticket_excel[]" type="file" id="excel" multiple class="custom-file-input">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-success btn-lg">Raise Ticket</button>
                  </div>
                </div>
                <div  class="col-xl-6 align-items-center">
                  <img src="{{asset('websiteimages/flat-customer-service.avif')}}"
                    class="img-fluid" alt="Sample image">

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

  $(function() {
      $("#selectCompany").change(function() {
          $("#selectBranch").val('');
          var formData = {
              companyid: $('#selectCompany').find(":selected").val()
          }
          
          $.ajax({
              type:'get',
              url:"{{ url('getbranchdetails') }}",
              data:formData,
              dataType: 'json',
              success:function(data){
                  if(data!=null){
                      console.log(data);
                      branch_dropdown(data);
                  }else{
                      console.log(data.error);
                  }
              }
          });   
      });
  });
    $(function() {
       $("#selectBranch").change(function() {
            var formData = {
              branchid: $('#selectBranch').find(":selected").val()
            }
            
            $.ajax({
                type:'get',
                url:"{{ url('getproductservice') }}",
                data:formData,
                dataType: 'json',
                success:function(data){
                    if(data!=null){
                        console.log(data);
                        productservice_dropdown(data);
                    }else{
                        console.log(data.error);
                    }
                }
            });  
        });
    });

    function branch_dropdown(data){
      var response = data, select = $("#selectBranch"), options = '';
      select.empty();      
      options= "<option value=''>Select Branch</option>"; 
      for(var i=0;i<response.length; i++)
      {
        options += "<option value='"+response[i].id+"'>"+ response[i].branch_name +"</option>";  
      }
      select.append(options);

      $('#selectBranch').append($(options).attr("value", key).text(value)); 

      console.log("branch_data: " + select); 

    }

    function productservice_dropdown(data)
    {
      var responseProduct = data['product'], selectProduct = $("#selectProduct"), productOptions = '';
      var responseService = data['service'], selectService = $("#selectService"), serviceOptions = '';
      
      selectProduct.empty();  
      selectService.empty();  

      productOptions= "<option value=''>Select Product</option>";     
      serviceOptions= "<option value=''>Select Service</option>"; 

      //Below code is also working--for reference
      // for (var key in responseProduct) {
      //   if (responseProduct.hasOwnProperty(key)) {
      //     var value = responseProduct[key];
      //     options += "<option value='" + key + "'>" + value + "</option>";
      //   }
      // }
      //Product Dropdown
      $.each(responseProduct, function(key, value) {
        var option = $('<option>').val(key).text(value)[0].outerHTML;
          productOptions += option;
      });
      selectProduct.append(productOptions);

      //Service Dropdown
      $.each(responseService, function(key, value) {
        var option = $('<option>').val(key).text(value)[0].outerHTML;
          serviceOptions += option;
      });
      selectService.append(serviceOptions);
    }

</script>
@endsection