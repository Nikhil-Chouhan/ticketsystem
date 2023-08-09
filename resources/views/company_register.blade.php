@extends('layouts.app')

@section('content')

    <div class="container-fluid">
      <div class="page-titles">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Masters</a></li>
          <li class="breadcrumb-item active"><a href="{{route('companymaster')}}">Company Master</a></li>
          <li class="breadcrumb-item active"><a href="{{route('companyregister')}}">Company Register</a></li>
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
              <h4 class="card-title"><i class="fa-regular fa-building mr-3"></i>Company Register</h4>
            </div>
            <div class="card-body">
            <div class="basic-form">
              <form action="{{isset($companyDetails) ? @url('updatecompany/'.$companyDetails->id) : @route('companyregister') }}" class="form-valide-with-icon" method="post">
                @csrf
                <div class="row">
                  <div class="col-xl-6">
                    <div class="form-group">
                        <label class="text-label">Company Name
                          <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                            </div>
                            <input type="text" class="form-control" name="company_name" value="{{isset($companyDetails->company_name) ? $companyDetails->company_name : ''}}" placeholder="Enter Company Name">
                        </div>
                    </div>

                    <div class="form-group">
                      <label class="text-label">Company Address
                        <span class="text-danger">*</span>
                      </label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text"> <i class="fa-regular fa-address-book"></i></span>
                          </div>
                          <textarea type="text" class="form-control" name="company_address" value="{{isset($companyDetails->company_address) ? $companyDetails->company_address : ''}}" placeholder="Enter Company Address">{{isset($companyDetails->company_address) ? $companyDetails->company_address : ''}}</textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="text-label">Contact Person Email
                        <span class="text-danger">*</span>
                      </label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text"> <i class="fa-solid fa-envelope"></i> </span>
                          </div>
                          <input type="email" class="form-control" name="contactperson_email" placeholder="Contact Person Email" value="{{isset($companyDetails->contactperson_email) ? $companyDetails->contactperson_email : ''}}">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="text-label">Gst Number</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input type="text" class="form-control" name="gst_number" value="{{isset($companyDetails->gst_number) ? $companyDetails->gst_number : ''}}" placeholder="Enter Gst Number">
                      </div>
                    </div>

                  </div>
                  <div  class="col-xl-6">
                    
                    <div class="form-group">
                      <label class="text-label">Contact Person Name
                        <span class="text-danger">*</span>
                      </label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input type="text" class="form-control" name="contactperson_name" placeholder="Contact Person Name" value="{{isset($companyDetails->contactperson_name) ? $companyDetails->contactperson_name : ''}}">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="text-label">Contact Person Number
                        <span class="text-danger">*</span>
                      </label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text"> <i class="fa-solid fa-phone"></i> </span>
                          </div>
                          <input type="text" class="form-control" name="contactperson_number" placeholder="Contact Person Number" value="{{isset($companyDetails->contactperson_number) ? $companyDetails->contactperson_number : ''}}">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="text-label">Select City
                        <span class="text-danger">*</span>
                      </label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa-solid fa-city"></i> </span>
                        </div>
                        <select name="company_city" class="form-control mr-sm-2 default-select" >
                          <option selected>Select City</option>
                          <option value="Mumbai">Mumbai</option>
                          <option value="Banglore">Banglore</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn mr-2 btn-success">Submit</button>
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