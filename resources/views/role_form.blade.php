@extends('layouts.app')

@section('content')

  <div class="container-fluid">
    <div class="page-titles">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
        <li class="breadcrumb-item active"><a href="{{route('rolemaster')}}">Roles Master</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Roles</a></li>
      </ol>     
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Add Roles</h4>
          </div>
          <div class="card-body">
        
          <div class="basic-form">
            <form action="{{isset($roleDetails) ? @url('role/update/'.$roleDetails->id) : @route('role/create')}}" class="form-valide-with-icon" method="post">
              @csrf
              <div class="row">
                <div class="col-xl-6">
                  
                  <div class="form-group">
                      <label class="text-label">Role Name
                        <span class="text-danger">*</span>
                      </label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                          </div>
                          <input type="text" class="form-control" id="role_name" name="role_name" value="{{isset($roleDetails->name) ? $roleDetails->name : ''}}" placeholder="Enter Role Name">
                      </div>
                  </div>

                  <div class="form-group mt-4">
                    <button type="submit" class=" btn mr-2 btn-success">Save Role</button>
                  </div>

                </div>
                
                <div class="col-xl-6">

                  <div class="form-group">
                    <label class="text-label">Select Permission
                        <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                      </div>
                      <select id="permissions" name="permissions[]" multiple class="form-control default-select">
                        @foreach($permissions as $permission)
                          <option value="{{$permission->id}}">{{$permission->name}}</option>
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

@endsection
