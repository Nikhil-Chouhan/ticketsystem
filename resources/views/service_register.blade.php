@extends('layouts.app')

@section('content')

    @if (\Session::has('msg'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('msg') !!}</li>
        </ul>
    </div>
    @endif
 
    <div class="container-fluid">
      <div class="page-titles">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Masters</a></li>
          <li class="breadcrumb-item active"><a href="{{route('servicemaster')}}">Service Master</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">Service Register</a></li>
        </ol>     
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Service Register</h4>
            </div>
            <div class="card-body">
          
            <div class="basic-form">
              <form action="{{route('serviceregister')}}" class="form-valide-with-icon" method="post">
                @csrf
                <div class="row">
                  <div class="col-xl-6">
                   
                    <div class="form-group">
                        <label class="text-label">Service Name
                          <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input type="text" class="form-control" name="service_name" placeholder="Enter Service Name">
                        </div>
                    </div>
                  </div>
                  <div class="col-xl-6">
                    <div class="form-group">
                      <label class="text-label">Service Description
                        <span class="text-danger">*</span>
                      </label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                          </div>
                          <textarea type="text" class="form-control" name="service_description" placeholder="Enter Service Description"></textarea>
                      </div>
                    </div>
                  </div>  
                    <div class="form-group">
                      <button type="submit" class=" btn mr-2 btn-success">Save Service</button>
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