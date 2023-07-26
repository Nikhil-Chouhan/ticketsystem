<!doctype html>
<html lang="en"
dir="ltr">

<head>
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->

    <link href="{{URL::asset ('css/sidebar.css')}}" rel="stylesheet" crossorigin="anonymous">
    {{-- <link href="{{URL::asset ('css/dashboard.css')}}" rel="stylesheet" crossorigin="anonymous"> --}}
    <link href="{{URL::asset ('css/bootstrap.min.css')}}" rel="stylesheet" crossorigin="anonymous"> 
    <link href="{{URL::asset ('css/app.css')}}" rel="stylesheet" crossorigin="anonymous">

    <title>Ticket Admin Panel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" ></script>

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>

    {{-- for mulit-select --}}
    {{-- <link rel="stylesheet" href="https://www.codehim.com/demo/bootstrap-multiselect-dropdown/dist/css/bootstrap-multiselect.css" > --}}
    {{-- <script type="text/javascript" src="https://www.codehim.com/demo/bootstrap-multiselect-dropdown/dist/js/bootstrap-multiselect.js"></script> --}}

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" > --}}

    <script src="{{URL::asset ('js/bootstrap.bundle.min.js')}}" ></script> 


</head>
<style>
 .imp.form-control::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: rgb(238, 166, 144);
            opacity: 1; /* Firefox */
}
</style>
<body>
<section class="mt-5">
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
  
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Raise Ticket</p>
  
                <form action="{{route('TicketSubmit')}}" enctype="multipart/form-data" method="Post" name="raise_ticket" class="mx-1 mx-md-4">
                    @csrf
                    <input type="hidden" name="branch_code" value="{{ $branch_code }}">

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input id="ticket_title" name="ticket_title" class="form-control imp" placeholder="Ticket Title">
                      </div>
                    </div>
                    @error('ticket_title')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror 
  
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <textarea id="ticket_description" name="ticket_description" class="form-control" placeholder="Ticket Description"></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label">Upload File : </label>
                        <input class="form-control" name="ticket_image[]" type="file" id="file" accept="image/png, image/jpeg" multiple>
                    </div>

                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" class="btn btn-success btn-lg">Raise Ticket</button>
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

</body>
</html>