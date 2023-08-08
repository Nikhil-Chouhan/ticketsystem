@extends('layouts.app')

@section('content')

  <div class="container-fluid">
    <div class="page-titles">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
        <li class="breadcrumb-item active"><a href="{{route('users')}}">User Master</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Add User</a></li>
      </ol>     
    </div>

    @if (\Session::has('msg'))
    <div class="alert alert-success alert-dismissible fade show">
        <ul>
            <li>{!! \Session::get('msg') !!}</li>
        </ul>
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
        </button>
    </div>
    @endif

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"><i class="fa-solid fa-user-tie mr-3"></i> Add User</h4>
          </div>
          <div class="card-body">
        
          <div class="basic-form">
            <form action="{{isset($userDetails) ? @url('user/update/'.$userDetails->id) : @route('storeuser')}}" class="form-valide-with-icon" method="post">
              @csrf
              <div class="row">
                <div class="col-xl-6">
                  
                  <div class="form-group">
                      <label class="text-label">User Name
                        <span class="text-danger">*</span>
                      </label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                          </div>
                          <input type="text" class="form-control" id="name" name="name" value="{{isset($userDetails->name) ? $userDetails->name : ''}}" placeholder="Enter User Name">
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="text-label">Select Department
                      <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fas fa-laptop-file"></i> </span>
                        </div>
                        <select id="selectDepartment" name="department_id" class="form-control mr-sm-2 " >
                          <option selected>Select Department</option>
                          @foreach($departments as $department)
                            <option value="{{$department->id}}">{{$department->department}}</option>
                          @endforeach
                        </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="text-label">Password
                      <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></i> </span>
                        </div>
                        <input id="password" name="password" type="password" class="form-control" value="{{isset($userDetails->password) ? $userDetails->password : ''}}" placeholder="Enter Password">
                    </div>
                  </div>

                  <div class="form-group mt-4">
                    <button type="submit" class=" btn mr-2 btn-success">Save User</button>
                  </div>

                </div>
                
                <div class="col-xl-6">

                  <div class="form-group">
                    <label class="text-label">User Email
                      <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fas fa-envelope"></i> </span>
                        </div>
                        <input type="email" id="email" name="email" class="form-control" value="{{isset($userDetails->email) ? $userDetails->email : ''}}" placeholder="Enter User Email">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="text-label">Select Roles
                        <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa-solid fa-id-card"></i></span>
                      </div>
                      <select id="roles" name="roles" class="form-control default-select">
                        <option selected>Select Role</option>
                        @foreach($roles as $role)
                          <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                </div>
              </div> 
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

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