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
  
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Add Service</p>
  
                <form action="{{route('serviceregister')}}" method="Post" name="register_service" class="mx-1 mx-md-4">
                    @csrf
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input id="service_name" name="service_name" class="form-control imp" placeholder="Service Name">
                      </div>
                    </div>
                    @error('service_name')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror 
  
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <textarea id="service_description" name="service_description" class="form-control" placeholder="Service Description"></textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" class="btn btn-success btn-lg">Save Service</button>
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