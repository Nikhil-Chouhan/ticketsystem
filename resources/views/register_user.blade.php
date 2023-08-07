@extends('layouts.app')

@section('content')

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
  
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Add User</p>
  
                <form action="{{ route('storeuser') }}" method="Post" name="register" class="mx-1 mx-md-4">
                    @csrf
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input id="name" name="name" class="form-control" placeholder="Name">
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="email" id="email" name="email" placeholder="Email" class="form-control" />
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="password" id="password" name="password" placeholder="Password" class="form-control" />
                      </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fa-solid fa-laptop-file fa-lg me-3 fa-fw"></i>
                      <div class="drop dropdown " style="width: 100%;">
                          <select id="selectDepartment" name="department_id" class="flex-fill mb-0 btn border dropdown-toggle"  style="width: 100%; text-align:left;">
                              <option style="color: rgb(238, 166, 144);"selected disabled>Select Department</option>
                              <option value="1" >Web Development</option>
                              <option value="2" >App Development</option>
                              {{-- @foreach($branchdetails['service'] as $serviceId => $service_name)
                                <option value="{{ $serviceId }}">{{ $service_name }}</option>
                              @endforeach --}}
                          </select>
                      </div>
                    </div>
                    <div class="multiselectmain col d-flex flex-row align-items-center mb-4">
                      <div class="drop dropdown " style="width: 100%;">
                        <select id="roles" name="roles[]"  multiple="multiple" style="width: 100%;">
                          @foreach($roles as $role)
                              <option value="{{$role->id}}">{{$role->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>  

                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" class="btn btn-success btn-lg">Register</button>
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
    $('#roles').multiselect({
      selectedClass: null,
      nonSelectedText: "Select Roles",
      includeSelectAllOption: true,
      minimumCountSelected: 8,
      onChange: function() {
          console.log($('#multiple-checkboxes').val());
      } 
    }); 
  </script>
@endsection