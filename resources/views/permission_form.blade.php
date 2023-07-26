@extends('layouts.app')

@section('content')
<style>
.iconBadge i {
    float: left;
    width: 40px;
    height: 40px;
    border-radius: 5px;
    margin-right: 20px;
    vertical-align: middle;
    font-size: 22px;
    color: #fff;
    display: inline-flex;
    -webkit-justify-content: center;
    -moz-justify-content: center;
    -ms-justify-content: center;
    justify-content: center;
    -ms-flex-pack: center;
    -webkit-align-items: center;
    -moz-align-items: center;
    -ms-align-items: center;
    align-items: center;
    -webkit-box-shadow: 0 2px 12px -3px rgba(0, 0, 0, 0.5);
    -moz-box-shadow: 0 2px 12px -3px rgba(0, 0, 0, 0.5);
    box-shadow: 0 2px 12px -3px rgba(0, 0, 0, 0.5);
}


</style>
{{-- <section class="vh-100">
    
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
  
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Add Permission</p>
  
                <form action="{{ route('permission/create') }}" method="Post" name="register_permission" class="mx-1 mx-md-4">
                    @csrf
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input id="permission_name" name="permission_name" class="form-control" placeholder="Permission Name">
                      </div>
                    </div>
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" class="btn btn-success btn-lg">Register Permission</button>
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
  </section> --}}
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
                    <p class="text-left h3 mb-3 mx-1 mx-md-4">Add Permission</p>
                  </div>
                  <form action="{{route('permission/create') }}" method="Post" name="register_permission" class="mx-1 mx-md-4">
                      @csrf
                      <div class="p-1 d-flex align-items-center mt-3">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div>
                          <input id="permission_name" name="permission_name" class="form-control col-md-5" value="{{isset($permission->name) ? $permission->name : ''}}" placeholder="Permission Name" >
                        </div>
                        <button type="submit" class="btn btn-success btn-md mx-3">Register Permission</button>
                      
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

    <div class="permission-table mt-3 container-fluid">
      <div class="row">
          <main class="col-md-12 px-md-4">
            <div class="card-main main-content">
              <div class=" d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-2">
                  <section class="main-header grid ">
                      <h3>Permissions</h3>
                  </section>
              </div>
              <div class="table-responsive">
                  <table class="table data-table">
                      <thead>
                          <tr>
                            <th scope="col">Id</th>
                              <th scope="col">Name</th>
                              <th scope="col">Action</th>
                          </tr>
                      </thead>
            
                      <tbody>
                      
                      </tbody>
                  </table>
              </div>
          </main>
      </div>
    </div>
  </section>
<script>
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  $(document).ready(function () {
    
    var table = $('.data-table').DataTable({
      processing: true,
      oLanguage: {
      oPaginate: {
          sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
          sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
        }
      },
      serverSide: true,
      ajax: "{{ url('permission_table') }}",
        // success:function(data){
        //         if(data!=null){
        //             console.log(data);
        //         }else{
        //             console.log(data.error);
        //         }
        //     },
        columns: [
            {data: 'id', name: 'id',class:"id"},
            {data: 'name', name: 'name',class:"name"},
            {data: 'action', name: 'action'},
        ]
    });

  });

</script>
@endsection