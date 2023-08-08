@extends('layouts.app')

@section('content')

  <div class="container-fluid">
    <div class="page-titles">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
        <li class="breadcrumb-item active"><a href="{{route('permissionmaster')}}">Permission Master</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Permission</a></li>
      </ol>     
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Add Permission</h4>
          </div>
          <div class="card-body">
        
          <div class="basic-form">
            <form action="{{isset($permissionDetails) ? @url('permission/update/'.$permissionDetails->id) : @route('permission/create')}}" class="form-valide-with-icon" method="post">
              @csrf
              <div class="row">
                <div class="col-xl-6">
                  
                  <div class="form-group">
                      <label class="text-label">Permission Name
                        <span class="text-danger">*</span>
                      </label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                          </div>
                          <input type="text" class="form-control" id="permission_name" name="permission_name" value="{{isset($permissionDetails->name) ? $permissionDetails->name : ''}}" placeholder="Enter Permission Name">
                      </div>
                  </div>
                </div>  
                <div class="col-xl-6">
                  <div class="form-group mt-4">
                    <button type="submit" class=" btn mr-2 btn-success">Save Permission</button>
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