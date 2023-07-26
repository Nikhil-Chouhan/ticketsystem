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
      <div class="row d-flex container-fluid align-items-center h-100">
        <div class="col-lg-12 col-xl-13">
          <div class="card text-black" style="border-radius: 20px;">
            <div class="card-body p-md-3">
              <div class="row justify-content">
                <div class=" order-2 order-lg-1">
                  <div class="border-bottom">
                    <p class="text-left h3 mb-3 mx-1 mx-md-4">Edit Permission</p>
                  </div>
                  <form action="{{url('permission/update/'.$permission->id) }}" method="Post" name="edit_permission" class="mx-1 mx-md-4">
                      @csrf
                      <div class="p-1 d-flex align-items-center mt-3">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div>
                          <input id="permission_name" name="permission_name" class="form-control col-md-5" value="{{isset($permission->name) ? $permission->name : ''}}" placeholder="Permission Name" >
                        </div>
                        <button type="submit" class="btn btn-success btn-md mx-3">Edit Permission</button>
                      
                      </div>
                      <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      </div>
    
                  </form>
  
                </div>
                  <div class="d-flex order-1 order-lg-2">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection