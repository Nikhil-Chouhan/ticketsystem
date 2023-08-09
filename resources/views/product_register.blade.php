@extends('layouts.app')

@section('content')

    <div class="container-fluid">
      <div class="page-titles">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Masters</a></li>
          <li class="breadcrumb-item active"><a href="{{route('productmaster')}}">Product Master</a></li>
          <li class="breadcrumb-item active"><a href="{{route('productregister')}}">Product Register</a></li>
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
              <h4 class="card-title">Product Register</h4>
            </div>
            <div class="card-body">
          
            <div class="basic-form">
              <form action="{{isset($productDetails) ? @url('updateproduct/'.$productDetails->id) : @route('productregister') }}" class="form-valide-with-icon" method="post">
                @csrf
                <div class="row">
                  <div class="col-xl-6">
                   
                    <div class="form-group">
                        <label class="text-label">Product Name
                          <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input type="text" class="form-control" name="product_name" value="{{isset($productDetails->product_name) ? $productDetails->product_name : ''}}" placeholder="Enter Product Name">
                        </div>
                    </div>
                  </div>
                  <div class="col-xl-6">
                    <div class="form-group">
                      <label class="text-label">Product Description
                        <span class="text-danger">*</span>
                      </label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                          </div>
                          <textarea type="text" class="form-control" name="product_description" placeholder="Enter Product Description">{{isset($productDetails->product_description) ? $productDetails->product_description : ''}}</textarea>
                      </div>
                    </div>
                  </div>  
                    <div class="form-group">
                      <button type="submit" class=" btn mr-2 btn-success">Submit</button>
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