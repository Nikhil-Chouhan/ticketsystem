@extends('layouts.app')

@section('content')
<style>
.multiselectmain .drop.dropdown .multiselect-container.dropdown-menu.show {
    transform: unset !important;
    top: 40px !important;
    width: 100%;
    border:1px;
}

.multiselectmain .drop.dropdown .btn-group {
    width: 100%;
}

.multiselectmain .drop.dropdown .multiselect.dropdown-toggle {
    text-align: left;
}
</style>
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
                          <input id="role_id" name="role_id" class="d-none form-control" value="{{$role->id}}">
                          <input id="role_name" name="role_name" class="form-control" placeholder="Role Name" value="{{$role->name}}">
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
                        <button type="submit" class="btn btn-success btn-lg">Update Role</button>
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
    </section>
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
    $(document).ready(function () {

      $('#permissions').multiselect({
      selectedClass: null,
      nonSelectedText: "Select Permissions",
      includeSelectAllOption: true,
      minimumCountSelected: 8,
      onChange: function() {
          console.log($('#multiple-checkboxes').val());
      } 
    }); 

      var formData={id:$('#role_id').val(),};
      var selectedPermissions=[];
      $.ajax({
        type:'post',
        url:"{{ route('getrolepermission') }}",
        data:formData,
        dataType: 'json',
        success:function(data){
            if(data!=null){
              selectedPermissions=data.toString();
              console.log(selectedPermissions);
              var values="1,3";
              $("#permissions option[value='1']").prop("selected", true);

              // let i = 0;
              //  let size = selectedPermissions.length;
              // for(i; i < size; i++){
              //   $("#permissions").multiselect("widget").find(":checkbox[value='"+selectedPermissions[i]+"']").attr("checked","checked");
              //   $("#permissions option[value='" + selectedPermissions[i] + "']").attr("selected", 1);
              //   $("#permissions").multiselect("refresh");
              // }
            }else{
                //alert(data.error);
            }
        }
    });
  });


  </script>
    @endsection