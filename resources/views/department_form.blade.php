@extends('layouts.app')

@section('content')

  <div class="container-fluid">
    <div class="page-titles">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Masters</a></li>
        <li class="breadcrumb-item active"><a href="{{route('departmentmaster')}}">Department Master</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Department Register</a></li>
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
            <h4 class="card-title">Department Register</h4>
          </div>
          <div class="card-body">
        
          <div class="basic-form">
            <form action="{{isset($departmentDetails) ? @url('updatedepartment/'.$departmentDetails->id) : @route('department/create') }}" class="form-valide-with-icon" method="post">
              @csrf
              <div class="row">
                <div class="col-xl-6">
                  
                  <div class="form-group">
                      <label class="text-label">Department Name
                        <span class="text-danger">*</span>
                      </label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                          </div>
                          <input type="text" class="form-control" name="department_name" value="{{isset($departmentDetails->department) ? $departmentDetails->department : ''}}" placeholder="Enter Department Name">
                      </div>
                  </div>
                </div>  
                <div class="col-xl-6">
                  <div class="form-group mt-4">
                    <button type="submit" class=" btn mr-2 btn-success">Save Department</button>
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