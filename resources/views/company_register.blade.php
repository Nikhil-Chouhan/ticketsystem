@extends('layouts.app')

@section('content')
<style>
 .imp.form-control::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: rgb(238, 166, 144);
            opacity: 1; /* Firefox */
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
  
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Register Company</p>
  
                <form action="{{route('companyregister')}}" method="Post" name="register_company" class="mx-1 mx-md-4">
                    @csrf
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input id="company_name" name="company_name" class="form-control imp" placeholder="Company Name">
                      </div>
                    </div>
                    @error('company_name')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror 
  
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <textarea id="company_address" name="company_address" class="form-control imp" placeholder="Company Address"></textarea>
                        </div>
                    </div>

                    @error('company_address')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror 
    
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="drop dropdown " style="width: 100%;">
                          <select id="selectCity" name="company_city" class="flex-fill mb-0 btn border dropdown-toggle"  style="width: 100%; text-align:left;">
                            <option style="color: rgb(238, 166, 144);" value="" selected disabled>Select City</option>
                            {{-- @foreach($progressdata as $progress)
                            <option value="{{$progress->status}}">{{$progress->ticket_lead}}</option>
                            @endforeach --}}
                            <option value="Mumbai">Mumbai</option>
                            <option value="Banglore">Banglore</option>
                          </select>
                        </div>
                    </div>

                    @error('company_city')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror 

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input id="gst_number" name="gst_number" class="form-control" placeholder="GST Number">
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input id="contactperson_name" name="contactperson_name" class="form-control imp" placeholder="Contact Person Name">
                        </div>
                    </div>
                    @error('contactperson_name')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror 

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input id="contactperson_number" name="contactperson_number" class="form-control imp" placeholder="Contact Person Number">
                        </div>
                    </div>
                    @error('contactperson_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror 

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input id="contactperson_email" name="contactperson_email" class="form-control imp" placeholder="Contact Person Email">
                        </div>
                    </div>
                    @error('contactperson_email')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror 

                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" class="btn btn-success btn-lg">Register Company</button>
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

@endsection