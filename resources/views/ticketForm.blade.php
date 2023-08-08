<!doctype html>
<html lang="en"
dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Ticketing Tool Help Desk</title>
  <!-- Ajax Crf Token Setup -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">

  <!-- Datatable -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <!-- Custom Stylesheet -->
  <link rel="stylesheet" href="  {{ asset('vendor/chartist/css/chartist.min.css') }}">
  <link href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}"rel="stylesheet">
  <link href="{{ asset('vendor/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
  <link href="{{asset('css/style.css')}}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
  
  <script src="{{URL::asset ('js/kit.fontawesome.com_me.js')}}" ></script> 
  
</head>

<body>
  @if (\Session::has('msg'))
  <div class="alert alert-success">
      <ul>
          <li>{!! \Session::get('msg') !!}</li>
      </ul>
  </div>
  @endif
  <div class="container-fluid p-md-5" >
    <div class="row justify-content-center align-items-center p-md-5">
      <div class=" col-md-10">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Raise Ticket</h4>
          </div>
          <div class="card-body">
        
          <div class="basic-form">
            <form action="{{route('TicketSubmit')}}" enctype="multipart/form-data" method="Post" name="raise_ticket" class="form-valide-with-icon">
              @csrf
              <input type="hidden" name="branch_code" value="{{ $branchdetails->branch_code }}">
              <div class="row">
                <div class="col-xl-6">

                  <div class="form-group">
                    <label class="text-label">Select Product
                      <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa-solid fa-laptop-code"></i> </span>
                        </div>
                        <select id="selectProduct" name="product_id" class="form-control mr-sm-2 default-select" >
                          <option selected>Select Product</option>
                          @foreach($branchdetails['product'] as $productId => $product_name)
                            <option value="{{ $productId }}">{{ $product_name }}</option>
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
                          <span class="input-group-text"> <i class="fa-solid fa-laptop-file"></i> </span>
                      </div>
                      <select id="selectService" name="service_id" class="form-control mr-sm-2 default-select" >
                        <option selected>Select Service</option>
                        @foreach($branchdetails['service'] as $serviceId => $service_name)
                          <option value="{{ $serviceId }}">{{ $service_name }}</option>
                        @endforeach
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
                        <input type="file" name="ticket_image[]" accept="image/png, image/jpeg" class="custom-file-input" multiple>
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


  <script src="{{URL::asset ('vendor/global/global.min.js')}}" ></script> 
  <script src="{{URL::asset ('js/custom.min.js')}}" ></script> 
  <script src="{{URL::asset ('vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}" ></script> 

</body>
</html>