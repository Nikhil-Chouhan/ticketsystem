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
    
                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Add Role</p>
    
                  <form action="{{ route('role/create') }}" method="Post" name="register" class="mx-1 mx-md-4">
                      @csrf
                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input id="role_name" name="role_name" class="form-control" placeholder="Role Name">
                        </div>
                      </div>

                      <div class="multiselectmain col d-flex flex-row align-items-center mb-4">
                        <div class="drop dropdown " style="width: 100%;">
                          <select id="permissions" name="permissions[]"  multiple="multiple" style="width: 100%;">
                            @foreach($permissions as $permission)
                                <option value="{{$permission->id}}">{{$permission->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>  

                      <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button type="submit" class="btn btn-success btn-lg">Register Role</button>
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

      <div class="permission-table mt-3 container-fluid">
        <div class="row">
            <main class="col-md-12 px-md-4">
              <div class="card-main main-content">
                <div class=" d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-2">
                    <section class="main-header grid ">
                        <h3>Roles</h3>
                    </section>
                </div>
                <div class="table-responsive">
                    <table class="table data-table">
                        <thead>
                            <tr>
                              <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Permissions</th>
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
      ajax: "{{ url('role_table') }}",
        columns: [
            {data: 'id', name: 'id',class:"id"},
            {data: 'name', name: 'name',class:"name"},
            {data: 'permission', name: 'permission',class:"permisison"},
            {data: 'action', name: 'action'},
        ]
    });

  });


  $('#permissions').multiselect({
    selectedClass: null,
    nonSelectedText: "Select Permissions",
    includeSelectAllOption: true,
    minimumCountSelected: 8,
    onChange: function() {
        console.log($('#multiple-checkboxes').val());
    } 
  }); 
</script>
@endsection